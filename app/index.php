<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio - Accueil</title>
    <!-- Lien vers la bibliothèque de styles Animate.css pour des animations préconfigurées -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Lien vers le fichier CSS personnalisé pour le style de cette page -->
    <link rel="stylesheet" href="css/index.css"> 
</head>
<body>
    <!-- Conteneur pour les particules d'animation -->
    <div class="particles" id="particles"></div>
    <main>
        <section class="welcome-section animate__animated animate__fadeIn">
            <h1 class="welcome-message">Bienvenue dans mon site</h1>
            <p class="subtext">Découvrez mon parcours professionnel et mes réalisations à travers mon site interactif</p>
            <div class="button-container">
                <!-- Bouton menant à la page de création de CV avec une icône SVG -->
                <a href="edit_cv.php" class="button-35">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                    </svg>
                    Créer mon CV
                </a>
                <!-- Bouton menant à la page d'ajout de projet avec une icône SVG -->
                <a href="edit_project.php" class="button-35">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                        <line x1="12" y1="11" x2="12" y2="17"></line>
                        <line x1="9" y1="14" x2="15" y2="14"></line>
                    </svg>
                    Ajouter un projet
                </a>
            </div>
        </section>
    </main>

    <script>
        // Fonction pour créer et animer des particules dans le fond de la page
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const numberOfParticles = 50;

            // Génère un certain nombre de particules et leur applique des styles aléatoires
            for (let i = 0; i < numberOfParticles; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Taille aléatoire entre 2px et 6px
                const size = Math.random() * 4 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Position de départ aléatoire
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Durée de l'animation aléatoire entre 15s et 25s
                particle.style.animationDuration = `${Math.random() * 10 + 15}s`;
                
                // Délai d'animation aléatoire
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                // Ajoute la particule au conteneur des particules
                particlesContainer.appendChild(particle);
            }
        }

        // Appel de la fonction pour créer les particules
        createParticles();
    </script>
</body>
</html>
