
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Agora Francia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Agora Francia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="tout_parcourir.php">Tout Parcourir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notifications.php">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="panier.php">Panier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="votre_compte.html">Votre Compte</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Container principal -->
    <div class="container mt-4">
        <h1>Aucune Notifications</h1>
        <p>Pour recevoir des notifications sur les articles qui vous intéressent, vous devez vous connecter.</p>

        <!-- Formulaire d'incitation à la connexion -->
        <div class="alert alert-info" role="alert">
            <p>Connectez-vous ou creer un compte pour activer les notifications personnalisées.</p>
            <a href="votre_compte.html" class="btn btn-primary">Se connecter</a>
        </div>
    </div>

    <!-- Footer -->
<footer class="bg-dark text-white pt-4 pb-4 mt-4">
    <div class="container">
        <div class="row">
            <!-- Informations générales -->
            <div class="col-md-3">
                <h5>À propos</h5>
                <p>Agora Francia est une plateforme de commerce en ligne qui vous permet d'acheter, vendre et enchérir des produits variés.</p>
            </div>

            <!-- Liens utiles -->
            <div class="col-md-3">
                <h5>Liens utiles</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white">Accueil</a></li>
                    <li><a href="tout_parcourir.php" class="text-white">Tout Parcourir</a></li>
                    <li><a href="tout_parcourir.php" class="text-white">Notifications</a></li>
                    <li><a href="panier.php" class="text-white">Panier</a></li>
                    <li><a href="votre_compte.html" class="text-white">Votre Compte</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-3">
                <h5>Contact</h5>
                <p><i class="bi bi-geo-alt"></i> Adresse: 10 Rue sextius Michel, Paris</p>
                <p><i class="bi bi-envelope"></i> Email: Ece@agorafrancia.com</p>
                <p><i class="bi bi-phone"></i> Téléphone: +33 1 23 45 67 89</p>
            </div>
           
            <!-- Section 4: Réseaux sociaux -->
            <div class="col-md-3">
                <h5>Suivez-nous</h5>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
