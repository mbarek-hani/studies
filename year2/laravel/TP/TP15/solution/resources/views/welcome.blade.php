<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>TP Journalisation Laravel</title>
</head>

<body>
    <h1>Bienvenue dans le TP de Journalisation Laravel 12</h1>
    <p>Choisissez un niveau de log et un canal en cliquant sur un lien ci-
        dessous. Chaque clic déclenchera un log de test via une requête GET.</p>
    <h2>Canaux disponibles : stack, single, daily, slack</h2>
    <h2>Niveaux disponibles :</h2>
    <ul>
        @foreach ([
                'debug',
                'info',
                'notice',
                'warning',
                'error',
                'critical',
                'alert',
                'emergency'
            ] as $level)
                <li>
                <strong>Niveau : {{ $level }}</strong><br>
                @foreach (['stack', 'single', 'daily', 'slack'] as $channel)
                                    <a href="/log/{{ $channel }}/{{ $level }}">Logger "{{ $level
                    }}" sur "{{ $channel }}"</a><br>
                @endforeach
            </li>
        @endforeach
    </ul>
        <p>Après avoir cliqué, vérifiez les fichiers de logs ou Slack pour voir le
message
.</p>
</body>
</html>