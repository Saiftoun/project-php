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

    <button class="btn btn-primary ms-5" type="button">Login</button> 
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
  <div class="row">

    <!-- PRODUCTS COLUMN (takes 10 spaces) -->
    <div class="col-md-10">

      <div class="row">

        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <img src="images/images" class="card-img-top" alt="Salad">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title.</p>
              <a href="#" class="btn btn-info">Add to Cart</a>
              <a href="#" class="btn btn-secondary">View more</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <img src="images/jus.webp" class="card-img-top" alt="Juice">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title.</p>
              <a href="#" class="btn btn-info">Add to Cart</a>
              <a href="#" class="btn btn-secondary">View More</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <img src="images/mer.jpeg" class="card-img-top" alt="Meal">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title.</p>
              <a href="#" class="btn btn-info">Add to Cart</a>
              <a href="#" class="btn btn-secondary">View More</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <img src="images/mer.jpeg" class="card-img-top" alt="Meal">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title.</p>
              <a href="#" class="btn btn-info">Add to Cart</a>
              <a href="#" class="btn btn-secondary">View More</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <img src="images/mer.jpeg" class="card-img-top" alt="Meal">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title.</p>
              <a href="#" class="btn btn-info">Add to Cart</a>
              <a href="#" class="btn btn-secondary">View More</a>
            </div>
          </div>
        </div>

      </div> <!-- end product row -->
    </div> <!-- end col-md-10 -->


    <!-- SIDEBAR COLUMN (fixed 2 spaces) -->
    <div class="col-md-2 bg-secondary p-0">

      <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-info"><a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Brand 1</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Brand 2</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Brand 3</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Brand 4</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Brand 5</a></li>
      </ul>

      <ul class="navbar-nav me-auto text-center mt-3">
        <li class="nav-item bg-info"><a href="#" class="nav-link text-light"><h4>Categories</h4></a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Categorie 1</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Categorie 2</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Categorie 3</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Categorie 4</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-light">Categorie 5</a></li>
      </ul>

    </div> <!-- end col-md-2 -->
  </div> <!-- end row -->
</div>


<!-- footer -->
<footer class="bg-info text-center p-3 mt-4">
  <p class="mb-0">All rights reserved © Created by Saif Tounsi</p>
</footer>

<!-- Bootstrap javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
