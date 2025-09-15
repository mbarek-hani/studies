<?php
$livres = [
    "php" => 21,
    "mysql" => 9,
    "html" => 7,
    "js" => 12,
];

$panier = isset($_COOKIE["panier"]) ? unserialize($_COOKIE["panier"]) : [];
$total = 0;

foreach ($panier as $cle => $quantite) {
    $prix = $livres[$cle] * $quantite;
    echo $cle . " x $quantite = $prix <br>";
    $total += $prix;
}

echo "<h3>$total €</h3>";
echo "<br><a href='remplir.php'>modifier</a>";
echo "<br><a href='marche.php'>vider</a>";
?>
