<?php
session_start();

$isLoggedIn = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon CV - Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur mon CV en ligne</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="login.php">Connexion</a></li>
                <li><a href="projects.php">Projets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="welcome">
            <h2>Bienvenue sur mon site !</h2>
            <p>Découvrez mon parcours professionnel, mes projets et mes compétences.</p>
            <a href="cv.php" class="button">Voir mon CV</a>
        </section>
    </main>

</body>
</html>
