import amqp from "amqplib";

async function subscribe(nomService, handler) {
  const connection = await amqp.connect("amqp://localhost");
  const channel = await connection.createChannel();

  const EXCHANGE = "evenements_boutique";
  await channel.assertExchange(EXCHANGE, "fanout", { durable: false });

  // Creer une queue temporaire unique pour ce consumer
  const { queue } = await channel.assertQueue("", { exclusive: true });

  // Relier la queue a l'exchange (binding)
  await channel.bindQueue(queue, EXCHANGE, "");

  console.log(`[${nomService}] En attente d'evenements...`);

  channel.consume(
    queue,
    (msg) => {
      const data = JSON.parse(msg.content.toString());
      handler(data);
    },
    { noAck: true },
  );
}

// Chaque service cree son propre consumer
subscribe("ServiceEmail", (event) => {
  if (event.type === "COMMANDE_VALIDEE") {
    console.log(`[Email] Confirmation commande n${event.commandeId}`);
  }
});

subscribe("ServiceStock", (event) => {
  if (event.type === "COMMANDE_VALIDEE") {
    console.log(`[Stock] Mise a jour apres commande n${event.commandeId}`);
  }
});
