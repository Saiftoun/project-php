<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection and Post model
include_once('../projectP/config/Database.php');
include_once('../projectP/models/Post.php');
include_once('products/config/database1.php');
include_once('products/models/product1.php');

// Initialize database and get posts
try {
    $database = new Database();
    $db = $database->connect();
    $post = new Post($db);
    $database2 = new Database1();
    $conn = $database2->connect();
    $product = new Product($conn);
    $products = $product->read();
    
/*     fetch categorie
 */    $category_query = "SELECT * FROM categories ORDER BY category_title ASC";
    $stmt_cat = $conn->prepare($category_query);
    $stmt_cat->execute();
    $categories = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);
    
/*      fetch  brands
 */    $brand_query = "SELECT * FROM brands ORDER BY brand_title ASC";
    $stmt_brand = $conn->prepare($brand_query);
    $stmt_brand->execute();
    $brands = $stmt_brand->fetchAll(PDO::FETCH_ASSOC);



    // Fetch all posts
    $posts = $post->readPosts();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $categories = [];
    $brands = [];
    $posts = null; 
}

// Cookie message
$message = isset($_COOKIE['user']) ? "Welcome back, " . $_COOKIE['user'] : "Welcome Guest";



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>

<!-- bootstrap css--> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../style.css">

<style>


*{
    margin:0;
    padding:0;  
    box-sizing:border-box;
}

.logo {
    width: 100%;
    height: 50px;
}
.card-img-top{
    width: 90%;/*fix the width even if the page is smaller */
    height:200px;
    object-fit:contain;/*without this the image is squeezed*/
}
.admin{
    width:80%;
    object-fit:contain;

}
</style>

</head>

<body>



<!-- navbar--> 
<nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="images/logo1.png" alt="logo" class="logo me-2">
      My Shop
    </a>
<p><?php echo $message; ?></p><!-- cookie -->

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>



    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Register</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="#">Total: $100</a></li>
      </ul>

    <form class="d-flex" role="search">
    <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">

    <button class="btn btn-outline-light " type="submit">Search</button> 

    <a href="../ProjectDSI/CRUD/login.php" class="btn btn-primary ms-2" role="button">login</a>


    <a href="../ProjectDSI/CRUD/user.php" class="btn btn-secondary ms-2" role="button">Signup</a>
      </form>
    </div>
  </div>
</nav>

<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <div class="container">
    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link">Welcome Guest</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
    </ul>
  </div>
</nav>

<!-- store heading -->
<div class="bg-light p-3">
  <h3 class="text-center">Hidden Store</h3>
  <p class="text-center">Communication is at the heart of e-commerce</p>
</div>

<!-- product cards -->
<!-- product + sidebar layout FIX -->
<div class="container mt-4">
  <div class="row"> <div class="col-md-9">
      <div class="row">
        <?php 
        if($products && $products->rowCount() > 0) {
            while($row = $products->fetch(PDO::FETCH_ASSOC)) : 
        ?>
            <div class="col-md-4 mb-3">
              <div class="card h-100">
                <img src="images/<?php echo htmlspecialchars($row['product_image']); ?>" class="card-img-top">
                <div class="card-body">
                  <h5><?php echo htmlspecialchars($row['product_title']); ?></h5>
                  <p><?php echo htmlspecialchars($row['product_description']); ?></p>
                  <p><small>Brand: <?php echo htmlspecialchars($row['brand_name']); ?></small></p>
                  <p class="fw-bold text-primary">$<?php echo number_format($row['product_price'],2); ?></p>
                  <a class="btn btn-info btn-sm">Add to Cart</a>
                  <a class="btn btn-secondary btn-sm">View More</a>
                </div>
              </div>
            </div>
        <?php endwhile; } ?>
      </div>
    </div> <div class="col-md-3 bg-secondary p-0">
      <ul class="navbar-nav text-center">
        <li class="nav-item bg-info">
          <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
        </li>
        <?php if(!empty($brands)): ?>
          <?php foreach($brands as $brand): ?>
            <li class="nav-item">
              <a href="?brand_id=<?php echo $brand['brand_id'] ?? $brand['id']; ?>" class="nav-link text-light" >
                <?php echo htmlspecialchars($brand['brand_title']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav text-center mt-3">
        <li class="nav-item bg-info">
          <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
        </li>
        <?php if(!empty($categories)): ?>
          <?php foreach($categories as $category): ?>
            <li class="nav-item">
              <a href="?category_id=<?php echo $category['id']; ?>" class="nav-link text-light">
                <?php echo htmlspecialchars($category['category_title']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </div> </div> </div>
<!-- POSTS SECTION (full width) -->
<div class="container mt-5">
  <h3 class="text-center mb-4">Latest Posts</h3>

  <div class="row">
    <?php 
if($posts && $posts->rowCount() > 0) {
    while ($row = $posts->fetch(PDO::FETCH_ASSOC)) : 
?>
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title"><?php echo ($row['title']); ?></h5>
            <p class="text-muted">Category: <?php echo ($row['category']); ?></p>
            <p class="card-text"><?php echo ($row['description']); ?></p>
            <small class="text-secondary">Posted on: <?php echo ($row['created_at']); ?></small>
          </div>
        </div>
      </div>
<?php 
    endwhile;
} else {
    echo '<p class="text-center col-12">No posts available</p>';
}
?>
  </div>
</div>
















<!-- footer -->
<footer class="bg-info  p-3 mt-4">
  <p class="mb-0 text-center">All rights reserved © Created by Saif Tounsi</p>
  <div>
  <strong><p class="mb-0 my-4 text-end fs-3">Contact</p></strong>
  <strong><p class="mb-0 text-end  fs-5   ">FAQ&Policy</p></strong>
 <strong> <p class="mb-0 text-end  fs-5">saiftounsi.facebook@gmail.com</p></strong>
</div>
</footer>

<!-- Bootstrap javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
