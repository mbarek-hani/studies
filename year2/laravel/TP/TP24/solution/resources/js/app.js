import "./bootstrap";

Echo.channel("chat").listen("MessageSent", (e) => {
    const div = document.getElementById("messages");
    div.innerHTML += `<p class="text-gray-700">${e.message}</p>`;
});
