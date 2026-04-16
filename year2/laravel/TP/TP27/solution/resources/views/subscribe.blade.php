<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Eventify - Subscribe</title>
    </head>
    <body>
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
                <h2 class="text-2xl font-bold mb-6 text-center">
                    S'inscrire à l'Événement
                </h2>
                @if (session('success'))
                <p id="success-message" class="text-green-500 text-center mb-4">
                    {{ session('success') }}
                </p>
                <script>
                    setTimeout(() => {
                        const message =
                            document.getElementById("success-message");
                        if (message) {
                            message.style.display = "none";
                        }
                    }, 3000);
                </script>
                @endif
                <form action="/send-mail" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                            >Nom complet</label
                        >
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray- 700"
                            >Adresse e-mail</label
                        >
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>
                    <button
                        type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue- 600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        S'inscrire
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>
