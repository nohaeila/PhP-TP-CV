<?php session_start();
// Initialisation des variables
$name = $email = $message = "";
$messageSent = false;

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Configuration des paramètres de l'email
    $to = "admin@example.com"; 
    $subject = "Nouveau message de contact";
    $body = "Nom: $name\nEmail: $email\n\n$message";
    $headers = "From: $email\r\n";

    // Envoi de l'email et vérification du succès
    if (mail($to, $subject, $body, $headers)) {
        $messageSent = true;
    } else {
        $messageSent = false; // En cas d'échec d'envoi
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="/css/contact.css">
</head>
<body>
<?php include '/app/header.php'; ?>
    <main>
        <section class="contact">
            <h1>Contactez-moi</h1>
            <?php if ($messageSent): ?>
            <?php endif; ?>
             <!-- Formulaire de contact -->
            <form action="/includes/contact.php" method="post">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                

                <label for="message">Message :</label>
                <textarea id="message" name="message" required></textarea>
                
                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Mon CV.</p>
    </footer>
</body>
</html>