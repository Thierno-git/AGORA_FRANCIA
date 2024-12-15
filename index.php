<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$database = "Web";
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les produits récents (en triant par id_produit comme proxy pour la nouveauté)
$products_query = "
    SELECT 
        id_produit, 
        nom, 
        description, 
        prix, 
        stock, 
        image 
    FROM produit 
    WHERE statut = 'actif' 
    ORDER BY id_produit DESC 
    LIMIT 5
";
$products_result = $conn->query($products_query);
$products = [];

if ($products_result->num_rows > 0) {
    while ($row = $products_result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Agora Francia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
       .carousel-item img {
            height: auto; /* Ajuste automatiquement la hauteur en fonction de la largeur */
            max-height: 400px; /* Limite la hauteur maximale pour éviter des images trop grandes */
            object-fit: contain; /* Garde l'intégralité de l'image visible sans la couper */
            width: 100%; /* S'assure que l'image remplit la largeur du conteneur */
            background-color: black; /* Ajoute un fond clair pour les images avec des bordures */
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
        }
        .product-card {
            margin-bottom: 20px;
        }
        footer {
            background-color: #333;
            color: #fff;
        }
        footer h5 {
            font-size: 1.2em;
            margin-bottom: 15px;
        }
        footer ul {
            padding-left: 0;
        }
        footer ul li {
            margin-bottom: 10px;
        }
        footer ul li a {
            color: #fff;
            text-decoration: none;
        }
        footer ul li a:hover {
            text-decoration: underline;
        }
        footer i {
            font-size: 1.5em;
        }
    </style>
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
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tout_parcourir.php">Tout Parcourir</a>
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

<!-- Carrousel -->
<div id="productCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($products as $index => $product): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($product['nom']); ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo htmlspecialchars($product['nom']); ?></h5>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>

<!-- Section "Ventes flash" -->
<div class="container mt-4">
    <h2 class="text-center">Ventes Flash</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-3">
                <div class="card product-card">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['nom']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['nom']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="card-text">Prix: <?php echo htmlspecialchars($product['prix']); ?> €</p>
                        <a href="tout_parcourir.php?id=<?php echo htmlspecialchars($product['id_produit']); ?>" class="btn btn-primary">Voir le produit</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-md-6">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9995881824484!2d2.287592315674391!3d48.85884407928761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66efc2c2b935f%3A0x408ab2ae4baa134!2sTour%20Eiffel!5e0!3m2!1sen!2sfr!4v1622193199123!5m2!1sen!2sfr" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
