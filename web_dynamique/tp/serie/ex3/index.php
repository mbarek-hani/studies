<?php
$texte = '';
$motRecherche = '';
$statistiques = [];
$formSoumis = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['texte'])) {
    $formSoumis = true;
    $texte = $_POST['texte'];
    $motRecherche = $_POST['motRecherche'] ?? '';
    
    $statistiques['nombreMots'] = str_word_count($texte);
    $statistiques['longueurTotale'] = strlen($texte);
    $statistiques['nombreCaracteres'] = strlen(str_replace(' ', '', $texte)); // Sans espaces
    $statistiques['nombreLignes'] = substr_count($texte, "\n") + 1;
    
    $statistiques['nombrePhrases'] = preg_match_all('/[.!?]+/', $texte);
    
    $statistiques['motTrouve'] = false;
    $statistiques['positionMot'] = -1;
    if (!empty($motRecherche)) {
        $position = strpos(strtolower($texte), strtolower($motRecherche));
        if ($position !== false) {
            $statistiques['motTrouve'] = true;
            $statistiques['positionMot'] = $position;
        }
    }
    
    $statistiques['texteAvecBr'] = nl2br(htmlspecialchars($texte));
    
    $texteFormate = $texte;
    $texteFormate = ucfirst(strtolower($texteFormate));
    $texteFormate = preg_replace_callback('/([.!?]\s*)([a-z])/', function($matches) {
        return $matches[1] . strtoupper($matches[2]);
    }, $texteFormate);
    $statistiques['texteFormate'] = nl2br(htmlspecialchars($texteFormate));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques de Texte</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px; }
        textarea { width: 100%; padding: 10px; border: 1px solid #ccc; }
        input[type="text"] { padding: 8px; margin: 5px; border: 1px solid #ccc; width: 200px; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .stats { background: #f9f9f9; padding: 15px; margin: 20px 0; border: 1px solid #ddd; }
        .stat-item { margin: 10px 0; }
        .texte-section { background: #f0f0f0; padding: 15px; margin: 10px 0; border-left: 4px solid #4CAF50; }
        .trouve { color: green; font-weight: bold; }
        .non-trouve { color: red; }
    </style>
</head>
<body>
    <h1>Analyseur de Statistiques de Texte</h1>
    
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <textarea name="texte" rows="6" cols="50" placeholder="Saisissez votre texte ici..."><?php echo htmlspecialchars($texte); ?></textarea><br>
        <input type="text" name="motRecherche" placeholder="Mot à chercher" value="<?php echo htmlspecialchars($motRecherche); ?>">
        <button type="submit">Analyser</button>
    </form>

    <?php if ($formSoumis): ?>
        <div class="stats">
            <h2>Statistiques du texte</h2>
            
            <div class="stat-item">
                <strong>Nombre de mots :</strong> <?php echo $statistiques['nombreMots']; ?>
            </div>
            
            <div class="stat-item">
                <strong>Longueur totale :</strong> <?php echo $statistiques['longueurTotale']; ?> caractères
            </div>
            
            <div class="stat-item">
                <strong>Caractères (sans espaces) :</strong> <?php echo $statistiques['nombreCaracteres']; ?>
            </div>
            
            <div class="stat-item">
                <strong>Nombre de lignes :</strong> <?php echo $statistiques['nombreLignes']; ?>
            </div>
            
            <div class="stat-item">
                <strong>Nombre de phrases :</strong> <?php echo $statistiques['nombrePhrases']; ?>
            </div>
            
            <?php if (!empty($motRecherche)): ?>
                <div class="stat-item">
                    <strong>Recherche du mot "<?php echo htmlspecialchars($motRecherche); ?>" :</strong>
                    <?php if ($statistiques['motTrouve']): ?>
                        <span class="trouve">Trouvé à la position <?php echo $statistiques['positionMot']; ?></span>
                    <?php else: ?>
                        <span class="non-trouve">Non trouvé</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="texte-section">
            <h3>Texte original avec retours à la ligne visibles</h3>
            <p><?php echo $statistiques['texteAvecBr']; ?></p>
        </div>
        
        <div class="texte-section">
            <h3>Texte formaté (première lettre de chaque phrase en majuscule)</h3>
            <p><?php echo $statistiques['texteFormate']; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
