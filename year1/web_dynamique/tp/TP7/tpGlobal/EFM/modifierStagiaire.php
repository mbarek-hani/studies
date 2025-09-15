<?php
include "config.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location : authentifier.php");
    exit();
}

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("ID stagaire non connue");
}

$idStagiaire = $_GET["id"];
$message = "";

try {
    $stmt = $pdo->prepare("SELECT * from stagiaire where idStagiaire  = :id");
    $stmt->execute([":id" => $idStagiaire]);
    $stagiaire = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$stagiaire) {
        die("stagiare no trouvé");
    }
} catch (PDOException $e) {
    die("error" . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $prenom = trim($_POST["prenom"]);
    $dateNaissance = $_POST["dateNaissance"];
    $idFiliere = $_POST["idFiliere"];

    if (
        empty($nom) ||
        empty($prenom) ||
        empty($dateNaissance) ||
        empty($idFiliere)
    ) {
        $message = "veuillez remplir tous les champs.";
    } else {
        try {
            $stmt = $pdo->prepare("
                UPDATE stagiaire
                SET nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, idFiliere = :idFiliere
                WHERE idStagiaire = :id
            ");
            $stmt->execute([
                ":nom" => $nom,
                ":prenom" => $prenom,
                ":dateNaissance" => $dateNaissance,
                ":idFiliere" => $idFiliere,
                ":id" => $idStagiaire,
            ]);

            header("Location: espacePrive.php");
            exit();
        } catch (PDOException $e) {
            $message = "error " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Modifier un Stagiaire</title>
    <style>
        form { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        .message { color: red; }
        .btn { margin-top: 15px; padding: 10px 15px; background: #28a745; color: white; border: none; cursor: pointer; }
        .btn:hover { background: #218838; }
        .img-preview { margin-top: 10px; max-width: 150px; }
    </style>
</head>
<body>

<h2>Modifier un Stagiaire</h2>

<?php if ($message): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label for="nom">NOM</label>
    <input type="text" id="nom" name="nom" value="<?php echo isset($stagiaire["nom"])? $stagiaire["nom"]: ""; ?>" />

    <label for="prenom">PRÉNOM</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo isset($stagiaire["prenom"])? $stagiaire["prenom"]: ""; ?>" />

    <label for="dateNaissance">DATE NAISSANCE</label>
    <input type="date" id="dateNaissance" name="dateNaissance"value="<?php echo isset($stagiaire["dateNaissance"])? $stagiaire["dateNaissance"]: ""; ?>" />


    <label for="idFiliere">FILIÈRE</label>
    <select id="idFiliere" name="idFiliere" value="<?php echo isset($stagiaire["idFiliere"])? $stagiaire["idFiliere"]: ""; ?>" >
        <option value="">-- Choisir une filière --</option>
        <?php
        $stmt = $pdo->prepare("SELECT DISTINCT idFiliere FROM stagiaire");
        $stmt->execute();

        $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($filieres as $filiere) {
            echo "<option vlaue='{$filiere["idFiliere"]}'>{$filiere["idFiliere"]}</option>";
        }
        ?>
    </select>

    <button type="submit" class="btn">MODIFIER</button>
</form>

<p><a href="espacePrive.php">retour à l'espace privé</a></p>

</body>
</html>