<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['is_admin'])) {
    header("Location: /CV/WithEditModalAndLogin/login.php?redirect=/edit_project.php");
    exit();
}

// Connexion à la base de données SQLite
$db = new PDO('sqlite:my_database.sqlite');

// Vérifie si l'ID du projet est fourni
if (isset($_GET['id'])) {
    $project_id = $_GET['id'];

    // Prépare la requête SQL pour supprimer le projet
    $stmt = $db->prepare("DELETE FROM projects WHERE id = :id");
    $stmt->bindParam(':id', $project_id, PDO::PARAM_INT);

    // Exécute la requête
    if ($stmt->execute()) {
        $_SESSION['message'] = "Projet supprimé avec succès.";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression du projet.";
        $_SESSION['message_type'] = 'error';
    }
} else {
    $_SESSION['message'] = "ID du projet non fourni.";
    $_SESSION['message_type'] = 'error';
}

// Redirige vers la page des projets
header("Location: project.php");
exit();
