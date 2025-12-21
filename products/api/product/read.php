<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once('../../config/database1.php');
include_once('../../models/Product.php');

$database = new Database1();
$db = $database->connect();

$product = new Product($db);

// Get all products
$result = $product->read();

if($result) {
    $products_array = [];
    
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $product_item = [
            'id' => $row['id'],
            'product_title' => $row['product_title'],
            'product_description' => $row['product_description'],
            'product_keyword' => $row['product_keyword'],
            'category_id' => $row['category_id'],
            'category_name' => $row['category_name'],
            'brand_id' => $row['brand_id'],
            'brand_name' => $row['brand_name'],
            'product_image' => $row['product_image'],
            'product_price' => $row['product_price'],
            'created_at' => $row['created_at']
        ];
        
        array_push($products_array, $product_item);
    }
    
    echo json_encode($products_array);
} else {
    echo json_encode(['message' => 'No Products Found']);
}
?>
