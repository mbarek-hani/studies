<?php
    class Database
    {
        private $host     = 'localhost';
        private $dbname   = 'gestionstagiaire_v1';
        private $username = 'root';
        private $password = 'password';
        private $pdo;

        public function connect()
        {
            try {
                $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->pdo;
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
    }

    class AdminManager
    {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function login($login, $password)
        {
            $stmt = $this->pdo->prepare("SELECT * FROM compteadministrateur WHERE loginAdmin = ? AND motPasse = ?");
            $stmt->execute([$login, $password]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    class FiliereManager
    {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function getAllFilieres()
        {
            $stmt = $this->pdo->query("SELECT * FROM filiere ORDER BY intitule");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addFiliere($idFiliere, $intitule, $nombreGroupe)
        {
            $stmt = $this->pdo->prepare("INSERT INTO filiere (idFiliere, intitule, nombreGroupe) VALUES (?, ?, ?)");
            return $stmt->execute([$idFiliere, $intitule, $nombreGroupe]);
        }

        public function updateFiliere($idFiliere, $intitule, $nombreGroupe)
        {
            $stmt = $this->pdo->prepare("UPDATE filiere SET intitule = ?, nombreGroupe = ? WHERE idFiliere = ?");
            return $stmt->execute([$intitule, $nombreGroupe, $idFiliere]);
        }

        public function deleteFiliere($idFiliere)
        {
            $stmt = $this->pdo->prepare("DELETE FROM filiere WHERE idFiliere = ?");
            return $stmt->execute([$idFiliere]);
        }
    }

    class StagiaireManager
    {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function getAllStagiaires()
        {
            $stmt = $this->pdo->query("
            SELECT s.*, f.intitule as filiere_nom
            FROM stagiaire s
            LEFT JOIN filiere f ON s.idFiliere = f.idFiliere
            ORDER BY s.nom, s.prenom
        ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getStagiaireById($id)
        {
            $stmt = $this->pdo->prepare("SELECT * FROM stagiaire WHERE idStagiaire = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addStagiaire($nom, $prenom, $dateNaissance, $idFiliere)
        {
            $stmt = $this->pdo->prepare("INSERT INTO stagiaire (nom, prenom, dateNaissance, idFiliere) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$nom, $prenom, $dateNaissance, $idFiliere]);
        }

        public function updateStagiaire($id, $nom, $prenom, $dateNaissance, $idFiliere)
        {
            $stmt = $this->pdo->prepare("UPDATE stagiaire SET nom = ?, prenom = ?, dateNaissance = ?, idFiliere = ? WHERE idStagiaire = ?");
            return $stmt->execute([$nom, $prenom, $dateNaissance, $idFiliere, $id]);
        }

        public function deleteStagiaire($id)
        {
            $stmt = $this->pdo->prepare("DELETE FROM stagiaire WHERE idStagiaire = ?");
            return $stmt->execute([$id]);
        }

        public function searchStagiaires($search)
        {
            $stmt = $this->pdo->prepare("
            SELECT s.*, f.intitule as filiere_nom
            FROM stagiaire s
            LEFT JOIN filiere f ON s.idFiliere = f.idFiliere
            WHERE s.nom LIKE ? OR s.prenom LIKE ? OR f.intitule LIKE ?
            ORDER BY s.nom, s.prenom
        ");
            $searchTerm = "%$search%";
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    session_start();

    $db  = new Database();
    $pdo = $db->connect();

    $adminManager     = new AdminManager($pdo);
    $filiereManager   = new FiliereManager($pdo);
    $stagiaireManager = new StagiaireManager($pdo);

    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: ?');
        exit;
    }

    if (isset($_POST['login'])) {
        $login    = $_POST['loginAdmin'];
        $password = $_POST['motPasse'];

        $admin = $adminManager->login($login, $password);
        if ($admin) {
            $_SESSION['admin'] = $admin;
            header('Location: ?page=dashboard');
            exit;
        } else {
            $error = "Identifiants incorrects";
        }
    }

    if (isset($_SESSION['admin'])) {
        // Ajouter un stagiaire
        if (isset($_POST['add_stagiaire'])) {
            $stagiaireManager->addStagiaire($_POST['nom'], $_POST['prenom'], $_POST['dateNaissance'], $_POST['idFiliere']);
            header('Location: ?page=stagiaires&success=add');
            exit;
        }

        // Modifier un stagiaire
        if (isset($_POST['update_stagiaire'])) {
            $stagiaireManager->updateStagiaire($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['dateNaissance'], $_POST['idFiliere']);
            header('Location: ?page=stagiaires&success=update');
            exit;
        }

        // Supprimer un stagiaire
        if (isset($_GET['delete_stagiaire'])) {
            $stagiaireManager->deleteStagiaire($_GET['delete_stagiaire']);
            header('Location: ?page=stagiaires&success=delete');
            exit;
        }

        // Ajouter une filière
        if (isset($_POST['add_filiere'])) {
            $filiereManager->addFiliere($_POST['idFiliere'], $_POST['intitule'], $_POST['nombreGroupe']);
            header('Location: ?page=filieres&success=add');
            exit;
        }

        // Modifier une filière
        if (isset($_POST['update_filiere'])) {
            $filiereManager->updateFiliere($_POST['idFiliere'], $_POST['intitule'], $_POST['nombreGroupe']);
            header('Location: ?page=filieres&success=update');
            exit;
        }

        // Supprimer une filière
        if (isset($_GET['delete_filiere'])) {
            $filiereManager->deleteFiliere($_GET['delete_filiere']);
            header('Location: ?page=filieres&success=delete');
            exit;
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stagiaires</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { background: #333; color: white; padding: 15px; margin: -20px -20px 20px -20px; border-radius: 5px 5px 0 0; }
        .nav { margin: 20px 0; }
        .nav a { background: #007bff; color: white; padding: 10px 15px; text-decoration: none; margin-right: 10px; border-radius: 3px; }
        .nav a:hover { background: #0056b3; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .form-group { margin: 15px 0; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
        .btn { background: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 3px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .alert { padding: 15px; margin: 20px 0; border-radius: 3px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .login-form { max-width: 400px; margin: 100px auto; }
        .search-box { margin: 20px 0; }
        .search-box input { width: 300px; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
    </style>
</head>
<body>

<?php if (! isset($_SESSION['admin'])): ?>
    <div class="login-form">
        <div class="container">
            <h2>Connexion Administrateur</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Login:</label>
                    <input type="text" name="loginAdmin">
                </div>
                <div class="form-group">
                    <label>Mot de passe:</label>
                    <input type="password" name="motPasse">
                </div>
                <button type="submit" name="login" class="btn">Se connecter</button>
            </form>
        </div>
    </div>

<?php else: ?>
    <div class="container">
        <div class="header">
            <h1>Gestion des Stagiaires</h1>
            <p>Connecté en tant que:                                                                                                                <?php echo $_SESSION['admin']['prenom'] . ' ' . $_SESSION['admin']['nom']; ?></p>
        </div>

        <div class="nav">
            <a href="?page=dashboard">Tableau de bord</a>
            <a href="?page=stagiaires">Stagiaires</a>
            <a href="?page=filieres">Filières</a>
            <a href="?logout=1" style="float: right; background: #dc3545;">Déconnexion</a>
        </div>

        <?php
            $page = $_GET['page'] ?? 'dashboard';

            switch ($page):
            case 'dashboard':
                $stagiaires = $stagiaireManager->getAllStagiaires();
                $filieres   = $filiereManager->getAllFilieres();
            ?>
                <h2>Tableau de bord</h2>
                <div style="display: flex; gap: 20px; margin: 20px 0;">
                    <div style="background: #e3f2fd; padding: 20px; border-radius: 5px; flex: 1;">
                        <h3>Total Stagiaires</h3>
                        <p style="font-size: 24px; font-weight: bold;"><?php echo count($stagiaires); ?></p>
                    </div>
                    <div style="background: #f3e5f5; padding: 20px; border-radius: 5px; flex: 1;">
                        <h3>Total Filières</h3>
                        <p style="font-size: 24px; font-weight: bold;"><?php echo count($filieres); ?></p>
                    </div>
                </div>

                <h3>Répartition par filière</h3>
                <table>
                    <tr><th>Filière</th><th>Nombre de stagiaires</th></tr>
                    <?php
                        $repartition = [];
                            foreach ($stagiaires as $stagiaire) {
                                    $filiere               = $stagiaire['filiere_nom'] ?? 'Non définie';
                                    $repartition[$filiere] = ($repartition[$filiere] ?? 0) + 1;
                            }
                        foreach ($repartition as $filiere => $count): ?>
                        <tr><td><?php echo $filiere; ?></td><td><?php echo $count; ?></td></tr>
                    <?php endforeach; ?>
                </table>
                <?php
                    break;

                    case 'stagiaires':
                        if (isset($_GET['success'])) {
                            $messages = [
                                'add'    => 'Stagiaire ajouté avec succès',
                                'update' => 'Stagiaire modifié avec succès',
                                'delete' => 'Stagiaire supprimé avec succès',
                            ];
                            echo '<div class="alert alert-success">' . $messages[$_GET['success']] . '</div>';
                        }

                        $search     = $_GET['search'] ?? '';
                        $stagiaires = $search ? $stagiaireManager->searchStagiaires($search) : $stagiaireManager->getAllStagiaires();
                        $filieres   = $filiereManager->getAllFilieres();
                    ?>

                <h2>Gestion des Stagiaires</h2>

                <div class="search-box">
                    <form method="GET">
                        <input type="hidden" name="page" value="stagiaires">
                        <input type="text" name="search" placeholder="Rechercher un stagiaire..." value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit" class="btn">Rechercher</button>
                        <?php if ($search): ?><a href="?page=stagiaires" class="btn">Annuler</a><?php endif; ?>
                    </form>
                </div>

                <?php if (! isset($_GET['edit'])): ?>
                <h3>Ajouter un stagiaire</h3>
                <form method="POST">
                    <div style="display: flex; gap: 15px;">
                        <div class="form-group" style="flex: 1;">
                            <label>Nom:</label>
                            <input type="text" name="nom" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Prénom:</label>
                            <input type="text" name="prenom" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Date de naissance:</label>
                            <input type="date" name="dateNaissance" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Filière:</label>
                            <select name="idFiliere" required>
                                <option value="">Sélectionner...</option>
                                <?php foreach ($filieres as $filiere): ?>
                                    <option value="<?php echo $filiere['idFiliere']; ?>"><?php echo $filiere['intitule']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="add_stagiaire" class="btn btn-success">Ajouter</button>
                </form>
                <?php endif; ?>

                <?php if (isset($_GET['edit'])):
                            $editStagiaire = $stagiaireManager->getStagiaireById($_GET['edit']);
                        ?>
			                <h3>Modifier le stagiaire</h3>
			                <form method="POST">
			                    <input type="hidden" name="id" value="<?php echo $editStagiaire['idStagiaire']; ?>">
			                    <div style="display: flex; gap: 15px;">
			                        <div class="form-group" style="flex: 1;">
			                            <label>Nom:</label>
			                            <input type="text" name="nom" value="<?php echo $editStagiaire['nom']; ?>" required>
			                        </div>
			                        <div class="form-group" style="flex: 1;">
			                            <label>Prénom:</label>
			                            <input type="text" name="prenom" value="<?php echo $editStagiaire['prenom']; ?>" required>
			                        </div>
			                        <div class="form-group" style="flex: 1;">
			                            <label>Date de naissance:</label>
			                            <input type="date" name="dateNaissance" value="<?php echo $editStagiaire['dateNaissance']; ?>" required>
			                        </div>
			                        <div class="form-group" style="flex: 1;">
			                            <label>Filière:</label>
			                            <select name="idFiliere" required>
			                                <?php foreach ($filieres as $filiere): ?>
			                                    <option value="<?php echo $filiere['idFiliere']; ?>"<?php echo $filiere['idFiliere'] == $editStagiaire['idFiliere'] ? 'selected' : ''; ?>>
			                                        <?php echo $filiere['intitule']; ?>
			                                    </option>
			                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="update_stagiaire" class="btn btn-success">Modifier</button>
                    <a href="?page=stagiaires" class="btn">Annuler</a>
                </form>
                <?php endif; ?>

                <h3>Liste des stagiaires (<?php echo count($stagiaires); ?>)</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Filière</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($stagiaires as $stagiaire): ?>
                    <tr>
                        <td><?php echo $stagiaire['idStagiaire']; ?></td>
                        <td><?php echo $stagiaire['nom']; ?></td>
                        <td><?php echo $stagiaire['prenom']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($stagiaire['dateNaissance'])); ?></td>
                        <td><?php echo $stagiaire['filiere_nom']; ?></td>
                        <td>
                            <a href="?page=stagiaires&edit=<?php echo $stagiaire['idStagiaire']; ?>" class="btn" style="font-size: 12px; padding: 5px 10px;">Modifier</a>
                            <a href="?delete_stagiaire=<?php echo $stagiaire['idStagiaire']; ?>"
                               class="btn btn-danger" style="font-size: 12px; padding: 5px 10px;"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stagiaire ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                    break;

                    case 'filieres':
                        if (isset($_GET['success'])) {
                            $messages = [
                                'add'    => 'Filière ajoutée avec succès',
                                'update' => 'Filière modifiée avec succès',
                                'delete' => 'Filière supprimée avec succès',
                            ];
                            echo '<div class="alert alert-success">' . $messages[$_GET['success']] . '</div>';
                        }

                        $filieres = $filiereManager->getAllFilieres();
                    ?>

                <h2>Gestion des Filières</h2>

                <?php if (! isset($_GET['edit'])): ?>
                <h3>Ajouter une filière</h3>
                <form method="POST">
                    <div style="display: flex; gap: 15px;">
                        <div class="form-group" style="flex: 1;">
                            <label>ID Filière:</label>
                            <input type="text" name="idFiliere" maxlength="5" required>
                        </div>
                        <div class="form-group" style="flex: 2;">
                            <label>Intitulé:</label>
                            <input type="text" name="intitule" maxlength="20" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Nombre de groupes:</label>
                            <input type="number" name="nombreGroupe" min="1" required>
                        </div>
                    </div>
                    <button type="submit" name="add_filiere" class="btn btn-success">Ajouter</button>
                </form>
                <?php endif; ?>

                <?php if (isset($_GET['edit'])):
                            $editFiliere = null;
                            foreach ($filieres as $filiere) {
                                if ($filiere['idFiliere'] == $_GET['edit']) {
                                    $editFiliere = $filiere;
                                    break;
                                }
                            }
                        ?>
			                <h3>Modifier la filière</h3>
			                <form method="POST">
			                    <div style="display: flex; gap: 15px;">
			                        <div class="form-group" style="flex: 1;">
			                            <label>ID Filière:</label>
			                            <input type="text" name="idFiliere" value="<?php echo $editFiliere['idFiliere']; ?>" readonly>
			                        </div>
			                        <div class="form-group" style="flex: 2;">
			                            <label>Intitulé:</label>
			                            <input type="text" name="intitule" value="<?php echo $editFiliere['intitule']; ?>" maxlength="20" required>
			                        </div>
			                        <div class="form-group" style="flex: 1;">
			                            <label>Nombre de groupes:</label>
			                            <input type="number" name="nombreGroupe" value="<?php echo $editFiliere['nombreGroupe']; ?>" min="1" required>
			                        </div>
			                    </div>
			                    <button type="submit" name="update_filiere" class="btn btn-success">Modifier</button>
			                    <a href="?page=filieres" class="btn">Annuler</a>
			                </form>
			                <?php endif; ?>

                <h3>Liste des filières</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Intitulé</th>
                        <th>Nombre de groupes</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($filieres as $filiere): ?>
                    <tr>
                        <td><?php echo $filiere['idFiliere']; ?></td>
                        <td><?php echo $filiere['intitule']; ?></td>
                        <td><?php echo $filiere['nombreGroupe']; ?></td>
                        <td>
                            <a href="?page=filieres&edit=<?php echo $filiere['idFiliere']; ?>" class="btn" style="font-size: 12px; padding: 5px 10px;">Modifier</a>
                            <a href="?delete_filiere=<?php echo $filiere['idFiliere']; ?>"
                               class="btn btn-danger" style="font-size: 12px; padding: 5px 10px;"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ? Tous les stagiaires associés seront également supprimés.')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                    break;
                        endswitch;
                    ?>
    </div>
<?php endif; ?>

</body>
</html>
