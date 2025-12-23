<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include_once('products/config/database1.php');
include_once('products/models/product1.php');

// Initialize cart if not exists
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add to cart
if(isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    if(isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
    
    header('Location: cart.php');
    exit();
}

// Remove from cart
if(isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    header('Location: cart.php');
    exit();
}

// Clear cart
if(isset($_GET['clear'])) {
    $_SESSION['cart'] = array();
    header('Location: cart.php');
    exit();
}

// Get cart products
$cart_products = array();
$total = 0;

if(!empty($_SESSION['cart'])) {
    try {
        $database2 = new Database1();
        $conn = $database2->connect();
        $product = new Product($conn);
        
        foreach($_SESSION['cart'] as $product_id => $quantity) {
            $product_details = $product->readSingle($product_id);
            if($product_details) {
                $product_details['quantity'] = $quantity;
                $product_details['subtotal'] = $product_details['product_price'] * $quantity;
                $cart_products[] = $product_details;
                $total += $product_details['subtotal'];
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


$message = isset($_COOKIE['user']) ? "Welcome back, " . $_COOKIE['user'] : "Welcome Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .logo {
            width: 100%;
            height: 50px;
        }
        .cart-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
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
        <li class="nav-item">
            <a class="nav-link" href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
                <sup><?php echo count($_SESSION['cart']); ?></sup>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Total: $<?php echo number_format($total, 2); ?></a></li>
      </ul>
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

<!-- Cart Content -->
<div class="container my-5">
    <h2 class="mb-4"><i class="fa-solid fa-cart-shopping"></i> Shopping Cart</h2>
    
    <?php if(empty($cart_products)): ?>
        
        <div class="alert alert-info text-center">
            <h4>Your cart is empty!</h4>
            <p>Add some products to your cart.</p>
            <a href="index.php" class="btn btn-primary">Continue Shopping</a>
        </div>
        
    <?php else: ?>
        
        <form method="POST" action="">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cart_products as $item): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="images/<?php echo htmlspecialchars($item['product_image']); ?>" 
                                         class="cart-image me-3" 
                                         alt="<?php echo htmlspecialchars($item['product_title']); ?>">
                                    <div>
                                        <h6 class="mb-0"><?php echo htmlspecialchars($item['product_title']); ?></h6>
                                        <small class="text-muted">Brand: <?php echo htmlspecialchars($item['brand_name']); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>$<?php echo number_format($item['product_price'], 2); ?></td>
                            <td>
                                <input type="number" 
                                       name="quantity[<?php echo $item['id']; ?>]" 
                                       value="<?php echo $item['quantity']; ?>" 
                                       min="1" 
                                       class="form-control" 
                                       style="width: 80px;">
                            </td>
                            <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                            <td>
                                <a href="cart.php?remove=<?php echo $item['id']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Remove this item?')">
                                    <i class="fa-solid fa-trash"></i> Remove
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td colspan="2"><strong class="text-primary">$<?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <div>

                    <a href="cart.php?clear=1" class="btn btn-danger" onclick="return confirm('Clear entire cart?')">
                        <i class="fa-solid fa-trash"></i> Clear Cart
                    </a>
                </div>
                <div>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Continue Shopping
                    </a>
                    <a href="checkout.php" class="btn btn-success">
                        <i class="fa-solid fa-credit-card"></i> Checkout
                    </a>
                </div>
            </div>
        </form>
        
    <?php endif; ?>
</div>

<!-- Footer -->
<footer class="bg-info p-3 mt-5">
  <p class="mb-0 text-center">All rights reserved © Created by Saif Tounsi</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>