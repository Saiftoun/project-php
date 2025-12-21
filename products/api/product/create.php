<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../../config/database1.php');
include_once('../../models/product1.php');

$database = new Database1();
$db = $database->connect();

$product = new Product($db);

// Check if form was submitted
if(isset($_POST['insert_product'])) {
    
    // Handle image upload
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];
    $upload_directory = "../../../images/";
    
    // Move uploaded file
    move_uploaded_file($product_image_tmp, $upload_directory . $product_image);
    
    // Prepare data
    $params = [
        'product_title' => $_POST['product_title'],
        'product_description' => $_POST['product_description'],
        'product_keyword' => $_POST['product_keyword'],
        'category_id' => $_POST['category_id'],
        'brand_id' => $_POST['brand_id'],
        'product_image' => $product_image,
        'product_price' => $_POST['product_price']
    ];
    
    // Call create method from Product class
    if($product->create($params)) {
        echo "<script>alert('Product Created Successfully'); window.location.href='../../../admin/index.php';</script>";
    } else {
        echo "<script>alert('Product Not Created'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid Request'); window.history.back();</script>";
}
?>