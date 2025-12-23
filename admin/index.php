<?php
session_start();
include_once('../products/config/database1.php');  // Changed include to include_once
$database = new Database1();
$conn = $database->connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>$
.footer{
    position:absolute;
    bottom:5;
}
*{
    margin:0;
    padding:0;  
    box-sizing:border-box;
}

.logo {
    width: 70px;
    height: 70px;
}

.card-img-top{
    width: 90%;
    height:200px;
    object-fit:contain;
}

.admin {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    display: block;
    margin: 20px auto;
}

.button button {
    width: 100%;
    border: none;
    margin: 5px 0;
    padding: 10px;
    border-radius: 5px;
}

.button button a {
    text-decoration: none;
    display: block;
}
</style>

</head>
<body>
    
<div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="../images/logo1.png" alt="Logo" class="logo">
            <!-- CORRECTED: Fixed navbar structure -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="" class="nav-link">Welcome guest</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- second child -->
    <div class="bg-light">
        <h3 class="text-center p-2">Manage Details</h3>
    </div>

    <!-- third child -->
    <div class="row">
        <!-- CORRECTED: Changed col-md-12 to col-md-2 for sidebar -->
        <div class="col-md-2 bg-secondary p-3">
            <div>
                <a href="../index.php"><img src="../images/jus.webp" alt="Admin" class="admin"></a>
                <p class="text-light text-center">Saifeddine tounsi</p>
            </div>

            <div class="button text-center">
                <button class="btn btn-info w-100 my-1"><a href="index.php?insert_post" class="nav-link text-light">Insert Posts</a></button>
                <button class="btn btn-info w-100 my-1"><a href="../admin/insert_product.php" class="nav-link text-light">Insert Products</a></button>
                <button class="btn btn-info w-100 my-1"><a href="#" class="nav-link text-light">View Products</a></button>
                <button class="btn btn-info w-100 my-1"><a href="index.php?insert_category" class="nav-link text-light">Insert Categories</a></button>
                <button class="btn btn-info w-100 my-1"><a href="#" class="nav-link text-light">View Categories</a></button>
                <button class="btn btn-info w-100 my-1"><a href="index.php?insert_brand" class="nav-link text-light">Insert Brands</a></button>
                <button class="btn btn-info w-100 my-1"><a href="#" class="nav-link text-light">View Brands</a></button>
                <button class="btn btn-info w-100 my-1"><a href="#" class="nav-link text-light">All Orders</a></button>
                <button class="btn btn-info w-100 my-1"><a href="#" class="nav-link text-light">All Payments</a></button>
                <button class="btn btn-info w-100 my-1"><a href="index.php?view_users" class="nav-link text-light">List Users</a></button>
                <button class="btn btn-info w-100 my-1"><a href="../CRUD/logout.php" class="nav-link text-light">Logout</a></button>
            </div>
        </div>

        <div class="col-md-10 bg-light p-4">
            <h4>Welcome to Admin Dashboard</h4>
            <p>Select an option from the sidebar to manage your store.</p>

   <div class="container">
        <?php
   
     if(isset($_GET["view_users"])){
    include("../CRUD/display.php");
   }
   ?>
    </div>
    
    <div class="container">
    
    <?php
   if(isset($_GET["insert_category"])){
    include("insert_category.php");
   }
?>
    </div>

    <div class="container">
    <?php
     if(isset($_GET["insert_brand"])){
    include("insert_brand.php");
   }
   ?>
    </div>

    <div class="container">
    <?php
    if(isset($_GET["insert_post"])){
        include("insertPosts.php");
    }
    
      ?>  
</div>


         </div>


  
    </div>














<footer class="bg-info text-center p-3  footer">
  <p class="mb-0">All rights reserved © Created by Saif Tounsi</p>
</footer>



</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>