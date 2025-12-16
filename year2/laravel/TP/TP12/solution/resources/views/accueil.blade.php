<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Page d'Accueil - Tests des Réponses Laravel</title>
    </head>
    <body>
        @session("status")
            <div style="background-color: #f0f0f0; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session("status") }}
            </div>
        @endsession
        <h1>Tests de Manipulation des Réponses HTTP dans Laravel</h1>
        <h2>Section 1 : Création</h2>
        <ul>
            <li><a href="/test-chaine">1 : Réponses basiques avec chaînes</a></li>
            <li><a href="/test-tableau">2 : Réponses avec tableaux (JSON)</a></li>
            <li><a href="/test-response">3 : Objets de réponse personnalisés</a></li>
            <li><a href="/test-user/1">4 : Réponses avec modèles Eloquent (remplacez
                1 par un ID valide)</a></li>
            <li><a href="/test-headers">5 : Ajout d'en-têtes</a></li>
            <li><a href="/test-cookie">6 : Ajout de cookies</a></li>
            <li><a href="/test-expire-cookie">7 : Expiration de cookies</a></li>
        </ul>
        <h2>Section 2 : Redirection</h2>
        <ul>
            <li><a href="/test-redirect">8 : Redirections basiques</a></li>
            <li><a href="/test-flash">9 : Redirections avec données flashées</a></li>
        </ul>
            <h2>Section 3 : Types de réponses</h2><ul>
            <li><a href="/test-view">10.1 : Vues</a></li>
            <li><a href="/test-json">10.2 : JSON</a></li>
            <li><a href="/test-download">10.3 : Téléchargements de fichiers</a></li>
            <li><a href="/test-file">10.4 : Affichage de fichiers</a></li>
        </ul>
    </body>
</html>
