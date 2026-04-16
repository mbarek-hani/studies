const express = require('express');
const mongoose = require('mongoose');
const amqplib = require('amqplib');

const app = express();
app.use(express.json());

const produitSchema = new mongoose.Schema({
  nom:   { type: String, required: true },
  prix:  { type: Number, required: true, min: 0 },
  stock: { type: Number, default: 0 },
});
const Produit = mongoose.model('Produit', produitSchema);

let channel = null;
const QUEUE = 'produits';

async function connectRabbitMQ() {
  try {
    const conn = await amqplib.connect(process.env.RABBITMQ_URL);
    channel = await conn.createChannel();
    await channel.assertQueue(QUEUE, { durable: true });
    console.log('RabbitMQ connecté');
  } catch (err) {
    console.error('RabbitMQ erreur:', err.message);
    // Retry après 5s si RabbitMQ n'est pas encore prêt
    setTimeout(connectRabbitMQ, 5000);
  }
}

async function connectMongo() {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('MongoDB connecté');
  } catch (err) {
    console.error('MongoDB erreur:', err.message);
    setTimeout(connectMongo, 5000);
  }
}

app.get('/', (_, res) => {
  res.json({
    message: 'Bienvenue sur l\'API Produits',
    version: '1.0',
    statut: 'OK',
  });
});

app.get('/api/produits', async (req, res) => {
  try {
    const filtre = req.query.stock !== undefined
      ? { stock: Number(req.query.stock) }
      : {};
    const produits = await Produit.find(filtre);
    res.json(produits);
  } catch (err) {
    res.status(500).json({ erreur: err.message });
  }
});

app.post('/api/produits', async (req, res) => {
  try {
    const produit = new Produit(req.body);
    await produit.save();

    if (channel) {
      const message = JSON.stringify({
        evenement: 'PRODUIT_CREE',
        produit,
        date: new Date().toISOString(),
      });
      channel.sendToQueue(QUEUE, Buffer.from(message), { persistent: true });
      console.log('Message publié dans RabbitMQ:', message);
    }

    res.status(201).json(produit);
  } catch (err) {
    res.status(400).json({ erreur: err.message });
  }
});

app.delete('/api/produits/:id', async (req, res) => {
  try {
    const produit = await Produit.findByIdAndDelete(req.params.id);
    if (!produit) return res.status(404).json({ erreur: 'Produit non trouvé' });

    if (channel) {
      const message = JSON.stringify({
        evenement: 'PRODUIT_SUPPRIME',
        produitId: req.params.id,
        date: new Date().toISOString(),
      });
      channel.sendToQueue(QUEUE, Buffer.from(message), { persistent: true });
    }

    res.json({ message: 'Produit supprimé', produit });
  } catch (err) {
    res.status(500).json({ erreur: err.message });
  }
});

const PORT = process.env.PORT || 3000;

(async () => {
  await connectMongo();
  await connectRabbitMQ();
  app.listen(PORT, () => console.log(`API démarrée sur le port ${PORT}`));
})();
