<?php

$fichierCourses = 'courses.txt';

function chargerListe($fichier) {
    if (!file_exists($fichier)) {
        file_put_contents($fichier, '');
        return [];
    }
    
    $contenu = file_get_contents($fichier);
    $liste = explode("\n", trim($contenu));
    return $liste;
}

function sauvegarderListe($fichier, $liste) {
    sort($liste);
    $handle = fopen($fichier, 'w');
    if ($handle) {
        foreach ($liste as $item) {
            fwrite($handle, trim($item) . "\n");
        }
        fclose($handle);
        return true;
    }
    return false;
}

$courses = chargerListe($fichierCourses);
$message = '';
$messageType = '';

if (isset($_GET['action']) && isset($_GET['item'])) {
    $action = $_GET['action'];
    $item = trim($_GET['item']);
    
    if (!empty($item)) {
        switch ($action) {
            case 'add':
                if (!in_array($item, $courses)) {
                    $courses[] = $item;
                    if (sauvegarderListe($fichierCourses, $courses)) {
                        $message = "Article '$item' ajouté avec succès !";
                        $messageType = 'succes';
                    } else {
                        $message = "Erreur lors de la sauvegarde.";
                        $messageType = 'erreur';
                    }
                } else {
                    $message = "L'article '$item' est déjà dans la liste.";
                    $messageType = 'attention';
                }
                break;
                
            case 'delete':
                $index = array_search($item, $courses);
                if ($index !== false) {
                    unset($courses[$index]);
                    $courses = array_values($courses);
                    if (sauvegarderListe($fichierCourses, $courses)) {
                        $message = "Article '$item' supprimé avec succès !";
                        $messageType = 'succes';
                    } else {
                        $message = "Erreur lors de la sauvegarde.";
                        $messageType = 'erreur';
                    }
                } else {
                    $message = "L'article '$item' n'existe pas dans la liste.";
                    $messageType = 'attention';
                }
                break;
        }
        
        $courses = chargerListe($fichierCourses);
    } else {
        $message = "Le nom de l'article ne peut pas être vide.";
        $messageType = 'erreur';
    }
}

sort($courses);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Liste de Courses</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px; }
        input[type="text"] { padding: 8px; margin: 5px; border: 1px solid #ccc; }
        button, .btn { background: #4CAF50; color: white; padding: 8px 15px; border: none; text-decoration: none; }
        .btn-delete { background: #f44336; }
        .message { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .succes { background: #d4edda; color: #155724; }
        .erreur { background: #f8d7da; color: #721c24; }
        .attention { background: #fff3cd; color: #856404; }
        .item { display: flex; justify-content: space-between; padding: 10px; border: 1px solid #ddd; margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Gestionnaire de Liste de Courses</h1>
    
    <?php if (!empty($message)): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    
    <h3>Actions</h3>
    <form method="GET" style="margin-bottom: 20px;">
        <input type="hidden" name="action" value="add">
        <input type="text" name="item" placeholder="Nouvel article..." required>
        <button type="submit">Ajouter</button>
    </form>
    
    <p><strong>Liens directs :</strong></p>
    <p>
        <a href="?action=add&item=Pomme">Ajouter Pomme</a> | 
        <a href="?action=add&item=Pain">Ajouter Pain</a> | 
        <a href="?action=add&item=Lait">Ajouter Lait</a>
    </p>
    
    <h3>Ma liste (<?php echo count($courses); ?> articles)</h3>
    
    <?php if (empty($courses)): ?>
        <p><em>Aucun article dans la liste.</em></p>
    <?php else: ?>
        <?php foreach ($courses as $item): ?>
            <div class="item">
                <span><?php echo htmlspecialchars($item); ?></span>
                <a href="?action=delete&item=<?php echo urlencode($item); ?>" class="btn btn-delete">Supprimer</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
