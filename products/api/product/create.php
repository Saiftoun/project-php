<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once('../../config/database1.php');
include_once('../../models/Product.php');

$database = new Database();
$db = $database->connect();

$product = new Product($db);

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if($data) {
    $params = [
        'product_title' => $data['product_title'],
        'product_description' => $data['product_description'],
        'product_keyword' => $data['product_keyword'],
        'category_id' => $data['category_id'],
        'brand_id' => $data['brand_id'],
        'product_image' => $data['product_image'],
        'product_price' => $data['product_price']
    ];
    
    if($product->create($params)) {
        echo json_encode(['message' => 'Product Created Successfully']);
    } else {
        echo json_encode(['message' => 'Product Not Created']);
    }
} else {
    echo json_encode(['message' => 'No data provided']);
}
?>
