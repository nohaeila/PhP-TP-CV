<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['is_admin'])) {
    header("Location: /CV/WithEditModalAndLogin/login.php?redirect=./cv.php");
    exit();
}

// Connexion à la base de données SQLite
$db = new PDO('sqlite:my_database.sqlite');

// Récupérer tous les CV
$stmt = $db->query("SELECT * FROM cvs");
$cvs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<main>
    <div class="projects-container">
        <h1>Mes Projets</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type']; ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Vérifie s'il y a des CV à afficher -->
        <?php if (count($cvs) > 0): ?>
            <ul>
                <?php foreach ($cvs as $cv): ?>
                    <li>
                        <!-- Lien vers la page du CV -->
                        <a href="cv.php?id=<?php echo $cv['id']; ?>">
                            <?php echo htmlspecialchars($cv['first_name'] . ' ' . $cv['name']); ?>
                        </a>
                        <!-- Lien pour supprimer le CV avec confirmation -->
                        <a href="delete_cv.php?id=<?php echo $cv['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce CV ?');"> Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun CV enregistré.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
