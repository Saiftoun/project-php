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
$data = $post->readPosts();

if($data->rowCount()) {
    $posts = [];
    
    while($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $postss[] = $row;  // ajouter chaque ligne au tableau
    }
    
    echo json_encode($postss);  //envoyer le data en format json
    
} else {
    echo json_encode(['message' => 'No Posts Found']);
}

?>