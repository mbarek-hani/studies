<?php
$host = "localhost";
$dbName = "gestionstagiaire_v1";
$user = "root";
$password = "200446";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbName;charset=utf8",
        $user,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed :" . $e->getMessage());
}




