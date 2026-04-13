import "./bootstrap";

Pusher.logToConsole = true;

Echo.channel("chat").listen("MessageSent", (e) => {
    console.log("got message", e.message);
    document.getElementById("messages").innerHTML +=
        `<p class="text-gray-700">${e.message}</p>`;
});
