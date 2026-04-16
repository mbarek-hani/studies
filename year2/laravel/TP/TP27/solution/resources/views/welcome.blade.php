<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Eventify</title>
    </head>
    <body>
        <div class="container mx-auto text-center mt-10">
            <h1 class="text-4xl font-bold">Bienvenue sur Eventify</h1>
            <p class="mt-4 text-lg">
                Inscrivez-vous pour participer à nos événements passionnants !
            </p>
            <a
                href="/subscribe"
                class="mt-6 inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600"
            >
                S'inscrire à un événement
            </a>
        </div>
    </body>
</html>
