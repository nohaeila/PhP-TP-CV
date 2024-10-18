<?php
// Start the session
session_start();

// Hardcoded credentials for the admin user
$adminUsername = "admin";
$adminPassword = "password123";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if ($username === $adminUsername && $password === $adminPassword) {
        // Set session for admin user
        $_SESSION['is_admin'] = true;
        
        // Set user information in session (ajoute des valeurs réelles ici)
        $_SESSION['first_name'] = 'Admin'; // Remplace par le prénom réel
        $_SESSION['last_name'] = 'User'; // Remplace par le nom réel
        $_SESSION['email'] = 'admin@example.com'; // Remplace par l'email réel
        
        session_regenerate_id(); // Sécurise la session
        // Redirect to the projects page
        header("Location: ../../projects.php");
        exit;
    } else { 
        $error = "Nom d'utilisateur ou mot de passe invalide !";
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
        <form method="POST" action="">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
