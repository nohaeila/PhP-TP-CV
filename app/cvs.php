<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['is_admin'])) {
    header("Location: /CV/WithEditModalAndLogin/login.php?redirect=/cvs.php");
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
    <title>Mes CVs</title>
    <link rel="stylesheet" href="css/cvs.css"> 
</head>
<body class="cv-page"> 

<?php include 'header.php'; ?> 

<main>
    <div class="projects-container">
        <h1>Mes CVs 
            <a href="/edit_cv.php" class="add-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
            </a>
        </h1>
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
                    <div class="title-container">
                        <a href="/edit_cv.php?id=<?php echo $cv['id']; ?>">
                            <?php echo htmlspecialchars($cv['first_name'] . ' ' . $cv['name']); ?>
                        </a>
                    </div>
                    <!-- Lien pour supprimer le CV avec confirmation -->
                    <a href="/delete_cv.php?id=<?php echo $cv['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce CV ?');">
                        <!-- Icône de la corbeille -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </a>
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
