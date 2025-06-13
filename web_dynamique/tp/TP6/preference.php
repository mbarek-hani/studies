<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["langue"] = $_POST["langue"];
    $_SESSION["couleur"] = $_POST["couleur"];
    $_SESSION["taille"] = $_POST["taille"];
}

$background = $_SESSION["couleur"] ?? "white";
$fontSize = $_SESSION["taille"] ?? "medium";
$langue = $_SESSION["langue"] ?? "arabe";

$translations = [
    "français" => [
        "language" => "Langue",
        "color" => "Couleur",
        "size" => "Taille",
        "submit" => "Enregistrer",
        "small" => "petite",
        "medium" => "moyenne",
        "large" => "grande",
    ],
    "anglais" => [
        "language" => "Language",
        "color" => "Color",
        "size" => "Size",
        "submit" => "Save",
        "small" => "small",
        "medium" => "medium",
        "large" => "large",
    ],
    "arabe" => [
        "language" => "اللغة",
        "color" => "اللون",
        "size" => "الحجم",
        "submit" => "حفظ",
        "small" => "صغير",
        "medium" => "متوسط",
        "large" => "كبير",
    ],
];

$trans = $translations[$langue];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Préférences</title>
</head>
<body style="background-color: <?= $background ?>; font-size: <?= $fontSize ?>;">
    <h2><?= $trans["language"] ?> : <?= $langue ?></h2>
    <form method="post">
        <label><?= $trans["language"] ?> : </label>
        <select name="langue">
            <option <?= $langue == "français"
                ? "selected"
                : "" ?>>français</option>
            <option <?= $langue == "anglais"
                ? "selected"
                : "" ?>>anglais</option>
            <option <?= $langue == "arabe" ? "selected" : "" ?>>arabe</option>
        </select>
        <br><br>

        <label><?= $trans["color"] ?> : </label>
        <select name="couleur">
            <option value="red" <?= $background == "red"
                ? "selected"
                : "" ?>>Rouge</option>
            <option value="blue" <?= $background == "blue"
                ? "selected"
                : "" ?>>Bleu</option>
            <option value="green" <?= $background == "green"
                ? "selected"
                : "" ?>>Vert</option>
        </select>
        <br><br>

        <label><?= $trans["size"] ?> : </label>
        <select name="taille">
            <option value="small" <?= $fontSize == "small"
                ? "selected"
                : "" ?>><?= $trans["small"] ?></option>
            <option value="medium" <?= $fontSize == "medium"
                ? "selected"
                : "" ?>><?= $trans["medium"] ?></option>
            <option value="large" <?= $fontSize == "large"
                ? "selected"
                : "" ?>><?= $trans["large"] ?></option>
        </select>
        <br><br>

        <button type="submit"><?= $trans["submit"] ?></button>
    </form>
</body>
</html>
