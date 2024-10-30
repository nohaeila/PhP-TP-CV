<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['is_admin'])) {
    header("Location: /CV/WithEditModalAndLogin/login.php?redirect=/edit_project.php");
    exit();
}

// Connexion à la base de données SQLite
$db = new PDO('sqlite:my_database.sqlite');

// Si un ID est fourni, on récupère le projet correspondant
$project = null;
if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Sauvegarder les données du projet
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Préparation de la requête d'insertion ou de mise à jour
    if ($project) {
        // Mettre à jour le projet existant
        $stmt = $db->prepare("UPDATE projects SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $description, $project['id']]);
        echo "Projet mis à jour avec succès.";
    } else {
        // Insérer un nouveau projet
        $stmt = $db->prepare("INSERT INTO projects (title, description) VALUES (?, ?)");
        $stmt->execute([$title, $description]);
        echo "Projet enregistré avec succès.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $project ? 'Modifier' : 'Créer'; ?> Projet</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<main>
    <div class="project-container"> <!-- Conteneur pour le formulaire du projet -->
        <h1><?php echo $project ? 'Modifier le Projet' : 'Créer un Projet'; ?></h1>

        <!-- Formulaire pour créer ou modifier un projet -->
        <form action="edit_project.php<?php echo $project ? '?id=' . $project['id'] : ''; ?>" method="post">
            <div class="form-group">
                <label for="title">Titre du projet :</label>
                <input type="text" id="title" name="title" value="<?php echo $project ? htmlspecialchars($project['title']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" required><?php echo $project ? htmlspecialchars($project['description']) : ''; ?></textarea>
            </div>

            <button type="submit">Sauvegarder</button>
        </form>
    </div>
</main>
</body>
</html>
