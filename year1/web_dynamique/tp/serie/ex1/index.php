<?php

function validerNom($nom) {
    return preg_match('/^[a-zA-Z\s]{2,}$/', trim($nom));
}

function validerEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function nettoyerChaine($str) {
    return strtolower(htmlspecialchars(trim($str)));
}

$erreurs = [];
$donnees = [];
$formSoumis = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formSoumis = true;
    
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['mdp'] ?? '';
    
    // Validation du nom
    if (empty($nom)) {
        $erreurs['nom'] = "Le nom est requis.";
    } elseif (!validerNom($nom)) {
        $erreurs['nom'] = "Le nom doit contenir au moins 2 caractères alphabétiques.";
    } else {
        $donnees['nom'] = nettoyerChaine($nom);
    }
    
    // Validation de l'email
    if (empty($email)) {
        $erreurs['email'] = "L'email est requis.";
    } elseif (!validerEmail($email)) {
        $erreurs['email'] = "L'email n'est pas valide.";
    } else {
        $donnees['email'] = nettoyerChaine($email);
    }
    
    // Validation du mot de passe
    if (empty($mdp)) {
        $erreurs['mdp'] = "Le mot de passe est requis.";
    } elseif (strlen($mdp) < 6) {
        $erreurs['mdp'] = "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        $donnees['mdp'] = nettoyerChaine($mdp);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de Formulaire</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px; }
        input { width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .erreur { color: red; margin: 5px 0; }
        .succes { background: #e8f5e8; padding: 15px; margin: 20px 0; border: 1px solid #4CAF50; }
    </style>
</head>
<body>
    <h1>Validation de Formulaire</h1>
    
    <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="nom" placeholder="Nom" value="<?= htmlspecialchars($_POST['nom'] ?? ''); ?>">
        <?php if (isset($erreurs['nom'])): ?>
            <div class="erreur"><?= $erreurs['nom']; ?></div>
        <?php endif; ?>
        
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>">
        <?php if (isset($erreurs['email'])): ?>
            <div class="erreur"><?= $erreurs['email']; ?></div>
        <?php endif; ?>
        
        <input type="password" name="mdp" placeholder="Mot de passe">
        <?php if (isset($erreurs['mdp'])): ?>
            <div class="erreur"><?= $erreurs['mdp']; ?></div>
        <?php endif; ?>
        
        <button type="submit">Valider</button>
    </form>

    <?php if ($formSoumis): ?>
        <?php if (empty($erreurs)): ?>
            <div class="succes">
                <h2>Données validées avec succès !</h2>
                <p><strong>Nom :</strong> <?php echo $donnees['nom']; ?></p>
                <p><strong>Email :</strong> <?php echo $donnees['email']; ?></p>
                <p><strong>Mot de passe :</strong> <?php echo $donnees['mdp']; ?></p>
            </div>
        <?php else: ?>
            <div class="erreur">
                <h3>Veuillez corriger les erreurs ci-dessus</h3>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
