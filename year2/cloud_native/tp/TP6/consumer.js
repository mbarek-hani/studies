import amqp from "amqplib";

const RABBITMQ_URL = process.env.RABBITMQ_URL || "amqp://localhost";
const QUEUE = process.env.QUEUE_NAME || "commandes";

async function startConsumer() {
  try {
    // 1. Connexion et channel
    const connection = await amqp.connect(RABBITMQ_URL);
    const channel = await connection.createChannel();

    // 2. Declarer la meme queue que le publisher
    await channel.assertQueue(QUEUE, { durable: true });

    // 3. Traiter un seul message a la fois (evite la surcharge)
    channel.prefetch(1);

    console.log(`[Consumer] En attente de messages sur "${QUEUE}"...`);

    // 4. Ecouter les messages en continu
    channel.consume(QUEUE, async (msg) => {
      if (msg === null) return; // Consumer annule

      // 5. Decoder le message JSON
      const content = JSON.parse(msg.content.toString());
      console.log("[Consumer] Message recu:", content);

      try {
        // 6. Traiter le message (logique metier)
        await traiterCommande(content);

        // 7. ACK : confirmer le traitement reussi
        channel.ack(msg);
        console.log("[Consumer] Message traite avec succes");
      } catch (error) {
        // 8. NACK : rejeter et remettre dans la queue
        channel.nack(msg, false, true);
        console.error("[Consumer] Erreur:", error.message);
      }
    });
  } catch (error) {
    console.error("[Consumer] Connexion impossible:", error.message);
    // Reconnexion automatique apres 5 secondes
    setTimeout(startConsumer, 5000);
  }
}

async function traiterCommande(commande) {
  // Logique metier (ex: enregistrement en BDD)
  console.log(`Traitement commande n${commande.id} : ${commande.produit}`);
  await new Promise((resolve) => setTimeout(resolve, 500));
}

startConsumer();
