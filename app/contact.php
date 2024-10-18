<?php include 'header.php';
// Initialisation des variables
$name = $email = $message = "";
$messageSent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $messageSent = true; 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <section class="contact">
            <h1>Contactez-moi</h1>
            <?php if ($messageSent): ?>
            <?php endif; ?>
            <form action="contact.php" method="post">
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
        <p>&copy; 2024 Mon Portfolio.</p>
    </footer>
</body>
</html>