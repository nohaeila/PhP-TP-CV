<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['is_admin'])) {
    header("Location: /CV/WithEditModalAndLogin/login.php?redirect=/edit_cv.php");
    exit();
}

// Connexion à la base de données SQLite
$db = new PDO('sqlite:my_database.sqlite');

// Si un ID est fourni, on récupère le CV correspondant
$cv = null;
if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM cvs WHERE id = ?"); // Prépare la requête
    $stmt->execute([$_GET['id']]); // Exécute la requête avec l'ID
    $cv = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère le CV sous forme de tableau associatif
}

// Sauvegarder les données du CV
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];

    // Préparation de la requête d'insertion
    if ($cv) {
        // Mettre à jour le CV existant
        $stmt = $db->prepare("UPDATE cvs SET name = ?, first_name = ?, email = ?, bio = ?, skills = ?, experience = ?, education = ? WHERE id = ?");
        $stmt->execute([$name, $first_name, $email, $bio, $skills, $experience, $education, $cv['id']]);
        echo "CV mis à jour avec succès.";
    } else {
        // Insérer un nouveau CV
        $stmt = $db->prepare("INSERT INTO cvs (name, first_name, email, bio, skills, experience, education) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $first_name, $email, $bio, $skills, $experience, $education]);
        echo "CV enregistré avec succès.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cv ? 'Modifier' : 'Créer'; ?> CV</title>
    <link rel="stylesheet" href="css/edit_cv.css">
</head>
<body>
<?php include 'header.php'; ?> 

<main>
    <div class="cv-container"> <!-- Conteneur pour le formulaire du CV -->
        <h1><?php echo $cv ? 'Modifier mon CV' : 'Créer mon CV'; ?></h1>

        <!-- Formulaire pour créer ou modifier un CV -->
        <form action="edit_cv.php<?php echo $cv ? '?id=' . $cv['id'] : ''; ?>" method="post">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" value="<?php echo $cv ? htmlspecialchars($cv['name']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="first_name">Prénom :</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $cv ? htmlspecialchars($cv['first_name']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo $cv ? htmlspecialchars($cv['email']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="bio">Bio :</label>
                <textarea id="bio" name="bio" required><?php echo $cv ? htmlspecialchars($cv['bio']) : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="skills">Compétences :</label>
                <textarea id="skills" name="skills" required><?php echo $cv ? htmlspecialchars($cv['skills']) : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="experience">Expérience :</label>
                <textarea id="experience" name="experience" required><?php echo $cv ? htmlspecialchars($cv['experience']) : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="education">Formation :</label>
                <textarea id="education" name="education" required><?php echo $cv ? htmlspecialchars($cv['education']) : ''; ?></textarea> 
            </div>

            <button type="submit">Sauvegarder</button>
        </form>
    </div>
</main>
</body>
</html>
