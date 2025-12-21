<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT, POST');

include_once('../../config/database1.php');
include_once('../../models/Product.php');

$database = new Database1();
$db = $database->connect();

$product = new Product($db);

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id'])) {
    $params = [
        'id' => $data['id'],
        'product_title' => $data['product_title'],
        'product_description' => $data['product_description'],
        'product_keyword' => $data['product_keyword'],
        'category_id' => $data['category_id'],
        'brand_id' => $data['brand_id'],
        'product_image' => $data['product_image'],
        'product_price' => $data['product_price']
    ];
    
    if($product->update($params)) {
        echo json_encode(['message' => 'Product Updated Successfully']);
    } else {
        echo json_encode(['message' => 'Product Not Updated']);
    }
} else {
    echo json_encode(['message' => 'No ID provided']);
}
?>
