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

// Récupérer les catégories
$categories_query = "SELECT * FROM categorie";
$categories_result = $conn->query($categories_query);
$categories = [];

if ($categories_result->num_rows > 0) {
    while ($row = $categories_result->fetch_assoc()) {
        $categories[$row['id_categorie']] = $row['nom'];
    }
}

// Récupérer les produits
$products_query = "
    SELECT 
        p.id_produit, 
        p.nom AS nom_produit, 
        p.description, 
        p.prix, 
        p.image, 
        p.stock, 
        p.id_categorie, 
        c.nom AS categorie 
    FROM produit p
    INNER JOIN categorie c ON p.id_categorie = c.id_categorie
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
    <title>Tout Parcourir - Agora Francia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    <style>
        .card-img-top {
            width: 100%; /* Les images prennent toute la largeur du conteneur */
            height: 200px; /* Hauteur fixe pour les images */
            object-fit: cover; /* Les images sont recadrées pour remplir le cadre sans déformation */
            border-radius: 5px; /* Optionnel : arrondi des coins */
        }
        .category-title {
            margin-top: 20px;
            text-transform: capitalize;
        }
        .product-card {
            margin: 10px 0;
        }
        .out-of-stock {
            color: red;
            font-size: 0.9em;
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

<!-- Contenu principal -->
<div class="container mt-4">
    <h1 class="text-center">Tout Parcourir</h1>

    <?php foreach ($categories as $category_id => $category_name): ?>
        <div class="category-section">
            <h2 class="category-title">Catégorie: <?php echo htmlspecialchars($category_name); ?></h2>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <?php if ($product['id_categorie'] == $category_id): ?>
                        <div class="col-md-3">
                            <div class="card product-card">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['nom_produit']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['nom_produit']); ?></h5>
                                    <p class="card-text">Prix: <?php echo htmlspecialchars($product['prix']); ?> €</p>
                                    <p class="card-text">Description: <?php echo htmlspecialchars($product['description']); ?></p>
                                    <p class="card-text">Stock: 
                                        <?php if ($product['stock'] > 0): ?>
                                            <?php echo htmlspecialchars($product['stock']); ?> disponibles
                                        <?php else: ?>
                                            <span class="out-of-stock">Rupture de stock</span>
                                        <?php endif; ?>
                                    </p>

                                    <?php
                                    // Normalisation des noms de catégorie pour comparaison
                                    $normalized_category_name = strtolower(trim($category_name));
                                    
                                    if ($normalized_category_name == 'haute gamme'): ?>
                                        <!-- Bouton Négociation pour la catégorie Haute gamme -->
                                        <br><a href="negociation.php?action=add&id_produit=<?php echo $product['id_produit']; ?>" 
                                        class="btn btn-primary <?php echo $product['stock'] > 0 ? '' : 'disabled'; ?>">
                                            Négocier
                                        </a></br>
                                    <?php elseif ($normalized_category_name == 'article rare'): ?>
                                        <!-- Bouton Vente aux enchères pour la catégorie Article rare -->
                                        <br><a href="enchere.php?action=add&id_produit=<?php echo $product['id_produit']; ?>" 
                                        class="btn btn-primary <?php echo $product['stock'] > 0 ? '' : 'disabled'; ?>">
                                            Vente aux enchères
                                        </a></br>
                                    <?php else: ?>
                                        <!-- Boutons Acheter maintenant et Ajouter au panier pour les autres catégories -->
                                        <br><a href="paiement.php?action=add&id_produit=<?php echo $product['id_produit']; ?>" 
                                        class="btn btn-primary <?php echo $product['stock'] > 0 ? '' : 'disabled'; ?>">
                                            Acheter maintenant
                                        </a></br>

                                        <br><a href="panier.php?action=add&id_produit=<?php echo $product['id_produit']; ?>" 
                                        class="btn btn-primary <?php echo $product['stock'] > 0 ? '' : 'disabled'; ?>">
                                            Ajouter au panier
                                        </a>
                                        </br>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
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
