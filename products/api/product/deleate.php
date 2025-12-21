<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE, POST');

include_once('../../config/database1.php');
include_once('../../models/Product.php');

$database = new Database1();
$db = $database->connect();

$product = new Product($db);

// Read JSON input from Postman or API client
$data = json_decode(file_get_contents("php://input"), true);

if(isset($data["id"])) {
    // Call delete method with associative array for passing id
    if($product->delete(['id' => $data['id']])) {
        echo json_encode(['message' => 'Product Deleted Successfully']);
    } else {
        echo json_encode(['message' => 'Product Not Deleted']);
    }
} else {
    echo json_encode(['message' => 'No ID provided']);
}
?>