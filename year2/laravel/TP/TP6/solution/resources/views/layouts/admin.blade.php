<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Admin Dashboard')</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 0; background: #f4f6f9; }
            .container { display: flex; }
            .sidebar { width: 250px; background: #343a40; color: white; padding: 20px; }
            .content { flex: 1; padding: 20px; }
            .card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px
            5px rgba(0,0,0,0.1); margin-bottom: 20px; }
        </style>
    </head>
    <body>
        <div class="container">
            @yield('sidebar')
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
