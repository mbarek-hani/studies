<?php 

$heure = (int)date('h');

$message = match (true) {
    $heure < 12 => 'C\'est le matin', 
    $heure > 12 =>'C\'est l\'après-midi'
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q2</title>
</head>

<body>
    <h1><?= date('D j M Y') . "! " . $message; ?></h1>
</body>

</html>
