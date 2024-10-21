<?php
session_start();

if (!isset($_SESSION['is_admin'])) {
    header("Location: /CV/WithEditModalAndLogin/login.php");
    exit();
}

// Connexion à la base de données (ajuste les paramètres)
$conn = new mysqli("localhost", "username", "password", "database");

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sauvegarder les données du CV
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];

    $sql = "INSERT INTO cvs (name, first_name, email, bio, skills, experience, education) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $first_name, $email, $bio, $skills, $experience, $education);

    if ($stmt->execute()) {
        echo "CV enregistré avec succès.";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
