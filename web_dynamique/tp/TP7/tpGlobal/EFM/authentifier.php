<?php

include "config.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $username = htmlspecialchars(trim($_POST["username"])) ?? "";
    $password = htmlspecialchars(trim($_POST["password"])) ?? "";

    if (empty($username) || empty($password)) {
        header("location :".$_SERVER['PHP_SELF']."?error=empty");
        exit();
    } else {
        try {
            $stmt = $pdo->prepare(
                "SELECT * FROM compteadministrateur WHERE loginAdmin = :user AND motPasse = :mdp"
                
            );

            $stmt->bindParam(":user", $username);
            $stmt->bindParam(":mdp", $password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                session_regenerate_id(true);
                $_SESSION["user"] = $row;
                header("Location: espacePrive.php");
                exit();
            } else {
                header("Location: " . $_SERVER["PHP_SELF"] . "?error=errone");
                exit();
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<?php if (isset($_GET["error"])) {
    if ($_GET["error"] == "empty") {
        echo "<p style='color:red'> les données sont obligatoires.</p>";
    } else {
        echo "<p style='color:red'> les données sont incorrectes.</p>";
    }
    unset($_GET["error"]);
} ?>

<form method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" />
    <input type="password" name="password" placeholder="Mot de passe" />
    <input type="submit" class="btn" name="submit" value="Se connecter" />
</form>

</body>
</html>
