<?php
include "config.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: authentifier.php");
    exit();
}

// SUPPRIMER
if (isset($_GET["supprimer"]) && !empty($_GET["supprimer"])) {
    $idDelete = $_GET["supprimer"];

    try {
        $stmt = $pdo->prepare(
            "DELETE FROM stagiaire where idStagiaire = :idDelete"
        );
        $stmt->execute(["idDelete" => $idDelete]);
    } catch (PDOException $e) {
        die("error" . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Liste des stagiaires</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 20px;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        .salutation {
            font-size: 18px;
            font-weight: bold;
        }
    .add {
    display: inline-block;
    padding: 10px 20px;
    background-color: #28a745; 
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}


    </style>
</head>

<body>


    <div class="salutation">
        <?php
        // C - Q1
        $heure = date("H");
        $salutation = $heure >= 6 && $heure < 18 ? "Bonjour" : "Bonsoir";
        echo $salutation . ", " . htmlspecialchars($_SESSION["user"]["prenom"]). " " . htmlspecialchars($_SESSION["user"]["nom"]);
        ?>
    </div>

    <h2>Liste des stagiaires</h2>
    <a class="add" href="InsererStagiaire.php">Ajouter</a>
    <a class="add" href="deconnecter.php">deconnecter</a>
    
    <table>
        <thead>
            <tr>
                <th>nom</th>
                <th>prénom</th>
                <th>date de naissance</th>
                <th>photo</th>
                <th>Filiere</th>
                <th>modifier</th>
                <th>supprimer</th>
            </tr>
        </thead>
        <tbody>
    
        <?php try {
            // C - Q2
            $stmt = $pdo->prepare("SELECT * FROM stagiaire JOIN filiere ON filiere.idFiliere = stagiaire.idFiliere  ORDER BY nom ASC ");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nom"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["prenom"]) . "</td>";
                    echo "<td>" .
                        htmlspecialchars($row["dateNaissance"]) .
                        "</td>";

                    if (!empty($row["photoProfil"])) {
                        echo "<td><img src='" .
                            htmlspecialchars($row["photoProfil"]) .
                            "' alt='' width='50'></td>";
                    } else {
                        echo "<td>--</td>";
                    }

                    echo "<td>" . htmlspecialchars($row["intitule"]) . "</td>";

                    echo "<td><a href='modifierStagiaire.php?id=" .$row["idStagiaire"] ."'>Modifier</a></td>";
                    echo "<td><a href='espacePrive.php?supprimer=" .$row["idStagiaire"] ."' >Supprimer</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td>acun  stagiaire trouvé.</td></tr>";
            }
        } catch (PDOException $e) {
            echo htmlspecialchars($e->getMessage());
        } ?>
        </tbody>
    </table>

</body>
</html>
