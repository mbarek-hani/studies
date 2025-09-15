<?php

$livres = [
    "php" => 21,
    "mysql" => 9,
    "html" => 7,
    "js" => 12,
];

$panier = isset($_COOKIE["panier"]) ? unserialize($_COOKIE["panier"]) : [];

if (isset($_GET["livre"]) && isset($livres[$_GET["livre"]])) {
    $livre = $_GET["livre"];
    $panier[$livre] = ($panier[$livre] ?? 0) + 1;
    setcookie("panier", serialize($panier), time() + 3600);
    header("Location: remplir.php");
    exit();
}

foreach ($livres as $cle => $prix) {
    echo "<a href='remplir.php?livre=$cle'>ajouter livre " .
        strtoupper($cle) .
        "  </a><br>";
}
echo "<br><a href='marche.php'>vider le panel</a>";
echo "<br><a href='total.php'>voir total</a>";

echo "<br>";
echo "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php foreach ($panier as $cle => $quantite) {
    echo "le livre " . $cle . "le quantite est " . $quantite;
    echo "<br>";
} ?>
</body>
</html>

