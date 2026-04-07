const amqp = require("amqplib");

async function broadcast(evenement) {
  const connection = await amqp.connect("amqp://localhost");
  const channel = await connection.createChannel();

  const EXCHANGE = "evenements_boutique";

  // Declarer un exchange de type 'fanout'
  await channel.assertExchange(EXCHANGE, "fanout", { durable: false });

  // Envoyer le message (routing key vide avec fanout)
  channel.publish(EXCHANGE, "", Buffer.from(JSON.stringify(evenement)));

  console.log("[Publisher] Evenement diffuse:", evenement);
  await channel.close();
  await connection.close();
}

broadcast({ type: "COMMANDE_VALIDEE", commandeId: 99, montant: 1200 });
