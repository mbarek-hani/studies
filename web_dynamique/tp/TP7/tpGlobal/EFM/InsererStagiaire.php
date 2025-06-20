<?php

// Q2 - Q3 - Q4 
include "config.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location : authentifier.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $dateNaissance = $_POST["dateNaissance"];
    $idFiliere = $_POST["idFiliere"];

    if (
        !empty($nom) &&
        !empty($prenom) &&
        !empty($dateNaissance) &&
        !empty($idFiliere) &&
        isset($_FILES["photoProfil"])
    ) {
        // Q2
        if($_FILES["photoProfil"]["errors"] == 0){
            $imageName = $_FILES["photoProfil"]["name"];
            $imageTmp = $_FILES["photoProfil"]["tmp_name"];
            $imagePath = "images/" . basename($imageName);

            if (move_uploaded_file($imageTmp, $imagePath)) {
                try {
                    // Q3
                    $stmt = $pdo->prepare(
                        "INSERT INTO stagiaire (nom, prenom, dateNaissance, photoProfil, idFiliere) VALUES (:nom, :prenom, :dateNaissance, :photoProfil, :idFiliere)"
                    );
                    $stmt->execute([
                        ":nom" => $nom,
                        ":prenom" => $prenom,
                        ":dateNaissance" => $dateNaissance,
                        ":photoProfil" => $imagePath,
                        ":idFiliere" => $idFiliere,
                    ]);
                    // Q4
                    header("Location: espacePrive.php");
                    exit();
                } catch (PDOException $e) {
                    $message = "Erreur: " . $e->getMessage();
                }
            } else {
                $message = "echec  du transfert ";
            }
        }else {
            $message = "echec LORS DU CHARGEMENT DU FICHIER ";
        }
        
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Stagiaire</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 500px; margin: auto; }
        label, input, select { display: block; width: 100%; margin-bottom: 10px; }
        .btn { padding: 10px; background: #28a745; color: white; border: none; cursor: pointer; }
        .btn:hover { background: #218838; }
        .error { color: red; margin-bottom: 10px; }
        a { text-decoration: none; color: #007BFF; }
    </style>
</head>
<body>

<a href="espacePrive.php">← Retour</a>
<h2>Ajouter un Stagiaire</h2>

<?php if (!empty($message)) {
    echo "<div class='error'>$message</div>";
} ?>

<form method="POST" enctype="multipart/form-data">
    <label>NOM</label>
    <input type="text" name="nom" >

    <label>PRÉNOM</label>
    <input type="text" name="prenom" >

    <label>DATE NAISSANCE</label>
    <input type="date" name="dateNaissance" >

    <label>PHOTO PROFIL</label>
    <input type="file" name="photoProfil" accept="image/*" >

    <!-- D - Q1 -->
    <label>FILIÈRE</label>
    <select name="idFiliere" >
        <option value="">-- Choisir une filière --</option>
        <?php
        $filieres = $pdo->query("SELECT DISTINCT idFiliere FROM stagiaire");
        foreach ($filieres as $filiere) {
            echo "<option value='{$filiere["idFiliere"]}'>{$filiere["idFiliere"]}</option>";
        }
        ?>
    </select>

    <button type="submit" class="btn">AJOUTER</button>
</form>

</body>
</html>
