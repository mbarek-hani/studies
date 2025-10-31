<!DOCTYPE html>
<html>
    <head>
        <title>@yield('titre', 'Mon Site')</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        header { background: #f0f0f0; padding: 10px; }
        nav ul { list-style: none; padding: 0; }
        nav li { display: inline; margin: 0 10px; }
    </style>
    </head>
    <body>
        <header>
            <h1>Mon Application Laravel</h1>
            <nav>
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/users">Utilisateurs</a></li>
                </ul>
            </nav>
        </header>
        <main>
            @yield('contenu')
        </main>
        <footer>
            <p>&copy; 2025 - Tous droits réservés</p>
        </footer>
    </body>
</html>
