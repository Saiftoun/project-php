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

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id'])) {
    $product->id = $data['id'];
} elseif(isset($_GET['id'])) {
    $product->id = $_GET['id'];
}

if($product->read_single()) {
    $product_array = [
        'id' => $product->id,
        'product_title' => $product->product_title,
        'product_description' => $product->product_description,
        'product_keyword' => $product->product_keyword,
        'category_id' => $product->category_id,
        'brand_id' => $product->brand_id,
        'product_image' => $product->product_image,
        'product_price' => $product->product_price,
        'created_at' => $product->created_at
    ];
    
    echo json_encode($product_array);
} else {
    echo json_encode(['message' => 'Product Not Found']);
}
?>
