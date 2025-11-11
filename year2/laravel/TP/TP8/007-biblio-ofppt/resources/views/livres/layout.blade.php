<!DOCTYPE html>
<html>

<head>
    <title>@yield('title') - Bibliothèque OFPPT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-800 p-4 flex justify-between items-center">
        <div>
            <a href="{{ route('accueil') }}" class="text-white font-bold">Accueil</a>
            <a href="{{ route('livres.index') }}" class="text-white ml-6">Livres</a>
        </div>
        <a href="{{ route('livres.create') }}" class="bg-green-400 text-black py-2 px-4 rounded">Ajouter un livre</a>
    </nav>
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>

</html>
