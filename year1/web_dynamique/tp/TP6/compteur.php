<?php
session_start();

if (!isset($_SESSION['visites'])) {
    $_SESSION['visites'] = 1;
}
 else {
    if ($_SESSION['visites']>=10){
        session_destroy();
        header('location: compteur.php');
        exit();
    }
    $_SESSION['visites']++;
}

echo "Vous avez visité cette page " . $_SESSION['visites'] . " fois.";
?>
