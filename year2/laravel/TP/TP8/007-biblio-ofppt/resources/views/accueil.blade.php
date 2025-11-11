<!DOCTYPE html>
<html>
    <head>
        <title>Bibliothèque OFPPT</title>
        <meta charset="utf-8">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
        <div class="container mx-auto mt-10">
            <h1 class="text-4xl text-center font-bold text-blue-800">
                Bienvenue à la bibliothèque OFPPT
            </h1>
            <p class="text-center mt-4">
                <a href="{{ route('livres.index') }}" class="text-blue-600 underline">
                    Voir tous les livres →
                </a>
            </p>
        </div>
    </body>
</html>