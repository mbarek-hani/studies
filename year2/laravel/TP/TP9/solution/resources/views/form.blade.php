<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire CSRF</title>
    </head>
    <body>
        <h1>Soumission d'un formulaire</h1>
        <form method="POST" action="/submit">
            <!-- Jeton CSRF -->
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Envoyer</button>
        </form>
    </body>
</html>