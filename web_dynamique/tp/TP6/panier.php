<?php
session_start();

// Initialiser le panier s'il n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    
    switch ($action) {
        case 'ajouter':
            $nom = $_POST['nom'];
            $prix = floatval($_POST['prix']);
            $quantite = intval($_POST['quantite']);
            
            // Vérifier si l'article existe déjà
            $trouve = false;
            foreach ($_SESSION['panier'] as &$article) {
                if ($article['nom'] == $nom) {
                    $article['quantite'] += $quantite;
                    $trouve = true;
                    break;
                }
            }
            
            // Si l'article n'existe pas, l'ajouter
            if (!$trouve) {
                $_SESSION['panier'][] = array(
                    'nom' => $nom,
                    'prix' => $prix,
                    'quantite' => $quantite
                );
            }
            break;
            
        case 'modifier':
            $index = intval($_POST['index']);
            $nouvelle_quantite = intval($_POST['nouvelle_quantite']);
            
            if (isset($_SESSION['panier'][$index])) {
                if ($nouvelle_quantite > 0) {
                    $_SESSION['panier'][$index]['quantite'] = $nouvelle_quantite;
                } else {
                    // Supprimer l'article si quantité = 0
                    array_splice($_SESSION['panier'], $index, 1);
                }
            }
            break;
            
        case 'supprimer':
            $index = intval($_POST['index']);
            if (isset($_SESSION['panier'][$index])) {
                array_splice($_SESSION['panier'], $index, 1);
            }
            break;
            
        case 'vider':
            $_SESSION['panier'] = array();
            break;
    }
    
    // Redirection pour éviter la resoumission du formulaire
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Calculer le total du panier
function calculerTotal() {
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total += $article['prix'] * $article['quantite'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier d'achat</title>
</head>
<body>
    <h1>Panier d'achat</h1>
    
    <!-- Ajouter un article -->
    <h2>Ajouter un article</h2>
    <form method="post">
        <input type="hidden" name="action" value="ajouter">
        <p>
            <label>Nom : </label>
            <input type="text" name="nom" required>
        </p>
        <p>
            <label>Prix : </label>
            <input type="number" name="prix" step="0.01" min="0" required>
        </p>
        <p>
            <label>Quantité : </label>
            <input type="number" name="quantite" min="1" value="1" required>
        </p>
        <p>
            <input type="submit" value="Ajouter au panier">
        </p>
    </form>
    
    <!-- Affichage du panier -->
    <h2>Contenu du panier</h2>
    
    <?php if (empty($_SESSION['panier'])): ?>
        <p>Votre panier est vide</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($_SESSION['panier'] as $index => $article): ?>
                <tr>
                    <td><?php echo htmlspecialchars($article['nom']); ?></td>
                    <td><?php echo number_format($article['prix'], 2); ?> DH</td>
                    <td>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="action" value="modifier">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="number" name="nouvelle_quantite" value="<?php echo $article['quantite']; ?>" min="0" style="width: 50px;">
                            <input type="submit" value="Modifier">
                        </form>
                    </td>
                    <td><?php echo number_format($article['prix'] * $article['quantite'], 2); ?> €</td>
                    <td>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="action" value="supprimer">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="submit" value="Supprimer">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
        <p><strong>Total : <?php echo number_format(calculerTotal(), 2); ?> DH</strong></p>
        
        <form method="post">
            <input type="hidden" name="action" value="vider">
            <input type="submit" value="Vider le panier">
        </form>
    <?php endif; ?>
    
    <!-- Informations de debug -->
    <h2>Informations de session</h2>
    <p>ID de session : <?php echo session_id(); ?></p>
    <p>Nombre d'articles : <?php echo count($_SESSION['panier']); ?></p>
    <pre><?php print_r($_SESSION['panier']); ?></pre>
</body>
</html>
