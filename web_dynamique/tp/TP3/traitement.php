<?php
session_start();

if ((!isset($_SERVER["REQUEST_METHOD"])) || ($_SERVER["REQUEST_METHOD"] !== "GET")) {
    http_response_code(405);
    header("Allow: GET");
    exit(1);
}

$errors = [
    "nom" => [],
    "prenom" => [],
    "genre" => [],
    "cours" => []
];

$_SESSION["errors"] = $errors;

$nom = $_GET["nom"] ?? "";
$prenom = $_GET["prenom"] ?? "";
$genre = $_GET["genre"] ?? "";
$cours = $_GET["cours"] ?? "";

if (empty($nom)) {
    $errors["nom"][] = "Le nom est obligatoire";
}

if (empty($prenom)) {
    $errors["prenom"][] = "Le prenom est obligatoire";
}

if (empty($genre)) {
    $errors["genre"][] = "Le genre est obligatoire";
}

if (empty($cours)) {
    $errors["cours"][] = "Le cours est obligatoire";
}

if (!preg_match("/^[a-z]{4,32}$/i", $nom)) {
    $errors["nom"][] = "Le nom doit être 4 lettres au minimum et 32 au maximum.";
}

if (!preg_match("/^[a-z]{4,32}$/i", $prenom)) {
    $errors["prenom"][] = "Le nom doit être 4 lettres au minimum et 32 au maximum.";
}

if (!empty($errors["nom"]) || !empty($errors["prenom"]) || !empty($errors["genre"]) || !empty($errors["cours"])) {
    $_SESSION["errors"] = $errors;
    $_SESSION["data"] = [
        "nom" => htmlspecialchars($nom),
        "prenom" => htmlspecialchars($prenom),
        "genre" => htmlspecialchars($genre),
        "cours" => htmlspecialchars($cours),
    ];
    header("Location: /");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitement</title>
</head>

<body>
    <h1>bonjour
        <?= $genre === "homme" ? "Mr. " : "Mme. " ?><?= htmlspecialchars($nom) . " " . htmlspecialchars($prenom)?>
    </h1>
    <p>Vous avez choisit le cours <?= htmlspecialchars($cours) ?></p>
</body>

</html>
