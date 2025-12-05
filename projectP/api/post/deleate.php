<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
include_once('../../config/Database.php');
include_once('../../models/Post.php');

$database = new Database();
$db = $database->connect();

$post = new Post($db);

// Read JSON input from postman
$data = json_decode(file_get_contents("php://input"), true);

if(isset($data["id"])) {


    // Call your actual method name
    if($post->deleate(['id' => $data['id']])){/*temporary associative array for passing id input*/
        echo json_encode(['message' => 'Post Deleted Successfully']);
    } else {
        echo json_encode(['message' => 'Post Not Deleted']);
    }
} 
?>
