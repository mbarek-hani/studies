<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q3</title>
    <style>
    table {
        border-collapse: collapse;
    }

    th {
        background-color: lightblue;
        text-align: left;
    }

    td,
    th {
        padding: 12px;
        border: 1px solid gray;
    }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Variable</th>
                <th>Valeur</th>
                <th>Signification</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$SERVER_ADDR</td>
                <td><?= gethostbyname($_SERVER["SERVER_NAME"]) ?></td>
                <td>L'adresse IP du serveur sur lequel le script PHP est exécuté</td>
            </tr>
            <tr>
                <td>$HTTP_HOST</td>
                <td><?= $_SERVER["HTTP_HOST"]; ?></td>
                <td>Le nom d'hôte et le port utilisés dans la requête HTTP actuelle</td>
            </tr>
            <tr>
                <td>$REMOTE_ADDR</td>
                <td><?= $_SERVER["REMOTE_ADDR"]; ?></td>
                <td>L'adresse IP du client/visiteur qui accède à la page</td>
            </tr>
            <tr>
                <td>gethostbyAddr($REMOTE_ADDR)</td>
                <td><?= gethostbyaddr($_SERVER["REMOTE_ADDR"]); ?></td>
                <td>Le nom d'hôte correspondant à l'adresse IP du client</td>
            </tr>
            <tr>
                <td>$HTTP_USER_AGENT</td>
                <td><?= $_SERVER["HTTP_USER_AGENT"]; ?></td>
                <td>La chaîne d'identification du navigateur utilisée par le client, qui contient des informations sur
                    le navigateur, le système d'exploitation et d'autres caractéristiques du client</td>
            </tr>
        </tbody>
    </table>
</body>

</html>