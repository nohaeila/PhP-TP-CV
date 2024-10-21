<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['is_admin'])) {
    header("Location: /CV/WithEditModalAndLogin/login.php?redirect=./cv.php");
    exit();
}

// Connexion à la base de données SQLite
$db = new PDO('sqlite:my_database.sqlite');

// Vérifie si l'ID du CV est fourni
if (isset($_GET['id'])) {
    $cv_id = $_GET['id'];

    // Prépare la requête SQL pour supprimer le CV
    $stmt = $db->prepare("DELETE FROM cvs WHERE id = :id");
    $stmt->bindParam(':id', $cv_id, PDO::PARAM_INT);

    // Exécute la requête
    if ($stmt->execute()) {
        $_SESSION['message'] = "CV supprimé avec succès.";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression du CV.";
        $_SESSION['message_type'] = 'error';
    }
} else {
    $_SESSION['message'] = "ID du CV non fourni.";
    $_SESSION['message_type'] = 'error';
}

// Redirige vers la page des projets
header("Location: projects.php");
exit();
