<?php 
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $conn = new mysqli("localhost", "username", "password", "database");

    // Vérifie la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Récupération des données du formulaire
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Préparation de la requête SQL pour mettre à jour les informations de l'utilisateur
    $sql = "UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $first_name, $last_name, $email, $_SESSION['user_id']); // Assurez-vous d'avoir un ID d'utilisateur dans la session

    // Exécution de la requête et gestion des résultats
    if ($stmt->execute()) {
        echo "Profil mis à jour avec succès.";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Fermeture de la déclaration et de la connexion
    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css"> 
    <title>Mon Profil</title>
</head>
<body class="profile-page">
    <?php include 'header.php'; ?>
    
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Profile Picture">
            </div>
        </div>
        <div class="col-md-4 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3"></div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Prénom</label><input type="text" class="form-control" placeholder="Prénom" value="<?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; ?>"></div>
                    <div class="col-md-6"><label class="labels">Nom</label><input type="text" class="form-control" value="<?php echo isset($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; ?>" placeholder="Nom"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Numéro de Mobile</label><input type="text" class="form-control" placeholder="Entrez le numéro de téléphone" value=""></div>
                    <div class="col-md-12"><label class="labels">Code Postal</label><input type="text" class="form-control" placeholder="Entrez le code postal" value=""></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="Entrez l'email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Pays</label><input type="text" class="form-control" placeholder="Pays" value=""></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Sauvegarder le Profil</button></div>
            </div>
        </div>
    </div>
</div>

    <footer>
        <p>&copy; 2024 Mon CV.</p>
    </footer>
</body>
</html>
