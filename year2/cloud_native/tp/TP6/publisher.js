import amqp from "amqplib";

const RABBITMQ_URL = process.env.RABBITMQ_URL || "amqp://localhost";
const QUEUE = process.env.QUEUE_NAME || "commandes";

async function sendMessage(message) {
  let connection;
  try {
    // 1. Etablir la connexion au serveur RabbitMQ
    connection = await amqp.connect(RABBITMQ_URL);

    // 2. Creer un channel (canal de communication)
    const channel = await connection.createChannel();

    // 3. Declarer la queue (la creer si elle n'existe pas)
    //    durable: true = la queue survit au redemarrage de RabbitMQ
    await channel.assertQueue(QUEUE, { durable: true });

    // 4. Convertir le message en Buffer et l'envoyer
    const msgBuffer = Buffer.from(JSON.stringify(message));
    channel.sendToQueue(QUEUE, msgBuffer, {
      persistent: true, // Message sauvegarde sur disque
    });

    console.log("[Publisher] Message envoye:", message);

    // 5. Fermer le channel et la connexion
    await channel.close();
    await connection.close();
  } catch (error) {
    console.error("[Publisher] Erreur:", error.message);
    if (connection) await connection.close();
  }
}

// Exemple d ’ utilisation
sendMessage({
  type: "NOUVELLE_COMMANDE",
  id: 42,
  produit: "Laptop",
  quantite: 1,
});
