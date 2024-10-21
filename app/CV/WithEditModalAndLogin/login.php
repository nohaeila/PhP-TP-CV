<?php
session_start();

$adminUsername = "admin";
$adminPassword = "password123";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['is_admin'] = true;
        
        $_SESSION['first_name'] = 'Admin'; 
        $_SESSION['last_name'] = 'User'; 
        $_SESSION['email'] = 'admin@example.com'; 
        
        session_regenerate_id(); // Sécurise la session
        
        // Vérification du paramètre de redirection
        if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
             // Redirection vers la page spécifiée
            $redirect_url = $_GET['redirect']; 
            header("Location: " . $redirect_url);
        } else {
            // Redirection par défaut vers index.php
            header("Location: ../../index.php");
        }
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
