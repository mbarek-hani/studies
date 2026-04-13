<!doctype html>
<html>
    <head>
        <title>Chat</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="bg-gray-100 p-4">
        <h1 class="text-2xl font-bold text-center mb-4">Chat Temps Réel</h1>
        <div id="messages" class="bg-white p-4 rounded shadow-md mb-4">
            @foreach ($messages as $msg)
            <p class="text-gray-700">{{ $msg->content }}</p>
            @endforeach
        </div>
        <div class="flex items-center space-x-2">
            <input
                type="text"
                id="message"
                placeholder="Votre message"
                class="border border-gray-300 rounded p-2 flex-1"
            /><button
                onclick="sendMessage()"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            >
                Envoyer
            </button>
        </div>
        <script>
            function sendMessage() {
                fetch("/send", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]',
                        ).content,
                    },
                    body: JSON.stringify({
                        content: document.getElementById("message").value,
                    }),
                });
                document.getElementById("message").value = "";
            }
        </script>
    </body>
</html>
