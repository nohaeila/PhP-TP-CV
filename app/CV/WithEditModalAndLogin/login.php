<?php
session_start();

// Définition des identifiants administratifs
$adminUsername = "admin";
$adminPassword = "password123";

// Récupération des valeurs soumises par le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des identifiants
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['is_admin'] = true;
        
        // Stocke des informations supplémentaires sur l'utilisateur dans la session
        $_SESSION['first_name'] = 'Admin'; 
        $_SESSION['last_name'] = 'User'; 
        $_SESSION['email'] = 'admin@example.com'; 
        
        session_regenerate_id(); // Sécurise la session
        
        // Vérification du paramètre de redirection
        if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
            // Redirection vers la page spécifiée
            $redirect_url = $_GET['redirect'];
        
            // Assure-toi que le chemin de redirection est correct
            if (strpos($redirect_url, '/') === 0) {
                header("Location: " . $redirect_url);
            } else {
                // Si le chemin n'est pas absolu, redirige vers index.php par défaut
                header("Location: /index.php");
            }
        } else {
            // Redirection par défaut vers index.php
            header("Location: /index.php");
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="main">  
        <h2>Connexion</h2>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action=""><!-- Formulaire de connexion -->
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
