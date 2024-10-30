<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css"> 
</head>
<body>
<header>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="index.php">Accueil</a></li> 
            <li><a href="cvs.php">CV</a></li>
            <li><a href="project.php">Projets</a></li> 
            <li><a href="contact.php">Contact</a></li> 
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
                <!-- Vérifie si l'utilisateur est connecté en tant qu'administrateur -->
                <li><a href="logout.php">Déconnexion</a></li> 
                <li>
                    <a href="profile.php" class="profile-icon"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg><!-- Icône de profil -->
                    </a>
                </li>
            <?php else: ?>
                <li><a href="../CV/WithEditModalAndLogin/login.php">Connexion</a></li> 
            <?php endif; ?>
        </ul>
    </nav>
</header>
