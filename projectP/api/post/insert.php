<?php
 
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Headers */
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET,POST');

/* include required files */
include_once('../../config/Database.php');
include_once('../../models/Post.php');

/* connect to database */
$database = new Database();
$db = $database->connect();

$post = new Post($db);
if(count($_POST)){
    $params = [
        'title' => $_POST['title'],
        'category_id' => $_POST['category_id'],
        'description' => $_POST['description']
    ];
    if($post->create_new_post($params)){
        echo json_encode(['message' => 'Post Created Successfully']);
    } else {
        echo json_encode(['message' => 'Post Not Created']);
    }
}

