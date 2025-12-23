<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include_once('products/config/database1.php');
include_once('products/models/product1.php');

// Get product ID from URL
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

if(!$product_id) {
    header('Location: index.php');
    exit();
}

try {
    $database2 = new Database1();
    $conn = $database2->connect();
    
    $product = new Product($conn);
    $product_details = $product->readSingle($product_id);
    
    if(!$product_details) {
        echo "Product not found!";
        exit();
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

$message = isset($_COOKIE['user']) ? "Welcome back, " . $_COOKIE['user'] : "Welcome Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product_details['product_title']); ?> - My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .product-image {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
        }
        .logo {
            width: 100%;
            height: 50px;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="images/logo1.png" alt="logo" class="logo me-2">
      My Shop
    </a>
    <p class="mb-0"><?php echo $message; ?></p>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Register</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a></li>
        <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $product_details['id']; ?>">
        <div class="input-group mb-3">
        <span class="input-group-text">Quantity:</span>
        <input type="number" name="quantity" value="1" min="1" class="form-control" style="max-width: 100px;">
        </div>
        <div class="d-grid gap-2">
        <button type="submit" name="add_to_cart" class="btn btn-info btn-lg">
            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
        </button>
        </div>
        </form>



      </ul>

      <form class="d-flex" method="GET" action="index.php">
        <input class="form-control me-2" type="search" name="search_data" placeholder="Search">
        <button type="submit" name="search" class="btn btn-outline-light">Search</button>
      </form>
    </div>
  </div>
</nav>

<!-- Second navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <div class="container">
    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link">Welcome Guest</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
    </ul>
  </div>
</nav>

<!-- Product Details -->
<div class="container my-5">
    <div class="row">
        
        <!-- Product Image -->
        <div class="col-md-6">
            <div class="card">
                <img src="images/<?php echo htmlspecialchars($product_details['product_image']); ?>" 
                     class="card-img-top product-image p-4" 
                     alt="<?php echo htmlspecialchars($product_details['product_title']); ?>">
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><?php echo htmlspecialchars($product_details['product_title']); ?></h1>
                    
                    <hr>
                    
                    <h3 class="text-primary">$<?php echo number_format($product_details['product_price'], 2); ?></h3>
                    
                    <hr>
                    
                    <h5>Description:</h5>
                    <p class="card-text"><?php echo htmlspecialchars($product_details['product_description']); ?></p>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Category:</strong><br>
                            <span class="badge bg-info"><?php echo htmlspecialchars($product_details['category_name']); ?></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Brand:</strong><br>
                            <span class="badge bg-secondary"><?php echo htmlspecialchars($product_details['brand_name']); ?></span></p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-info btn-lg">
                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Back to Products
                        </a>
                    </div>
                    
                    <hr>
                    
                    <p class="text-muted">
                        <small><i class="fa-solid fa-clock"></i> Added on: 
                        <?php echo date('F d, Y', strtotime($product_details['created_at'])); ?></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-info p-3 mt-5">
  <p class="mb-0 text-center">All rights reserved © Created by Saif Tounsi</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>