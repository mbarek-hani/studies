<?php

session_start();

$errors = [];
$data = [
    "nom" => "",
    "prenom" => "",
    "genre" => "",
    "cours" => "",
];

if (isset($_SESSION["errors"])) {
    $errors = $_SESSION["errors"];
    $data = $_SESSION["data"] ?? $data;
}

session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire</title>
    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: sans-serif;
    }

    form {
        width: 500px;
        padding: 20px;
        border: 2px solid gray;
        border-radius: 10px;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 8px 8px;
    }

    input {
        margin: 8px 0;
    }

    .error {
        color: red;
        font-size: 12px;
    }
    </style>
</head>

<body>
    <form action="traitement.php" method="get">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?= $data["nom"] ?? '' ?>" />
        </div>
        <?php if (isset($errors["nom"])): ?>
            <?php foreach ($errors["nom"] as $error): ?>
                <p class="error"><?= $error ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <div>
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" id="prenom" value="<?= $data["prenom"] ?? '' ?>" />
        </div>
        <?php if (isset($errors["prenom"])): ?>
            <?php foreach ($errors["prenom"] as $error): ?>
                <p class="error"><?= $error ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <div>
            <input type="radio" name="genre" value="femme" id="F" <?= $data["genre"] === "femme" ? "checked" : '' ?> />
            <label for="F">Femme</label>
            <input type="radio" name="genre" value="homme" id="M" <?= $data["genre"] === "homme" ? "checked" : '' ?> />
            <label for="M">Homme</label>
        </div>
        <?php if (isset($errors["genre"])): ?>
            <?php foreach ($errors["genre"] as $error): ?>
                <p class="error"><?= $error ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <div>
            <label for="cours">Cours</label>
            <select name="cours" id="cours">
                <option value="simple" <?= $data["cours"] === "simple" ? "selected" : '' ?>>simple</option>
                <option value="moyen" <?= $data["cours"] === "moyen" ? "selected" : '' ?>>moyen</option>
                <option value="difficile" <?= $data["cours"] === "difficile" ? "selected" : '' ?>>difficile</option>
            </select>
        </div>
        <?php if (isset($errors["cours"])): ?>
            <?php foreach ($errors["cours"] as $error): ?>
                <p class="error"><?= $error ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <input type="submit" value="Envoyer" />
    </form>
</body>

</html>
