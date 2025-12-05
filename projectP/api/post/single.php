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

if(isset($_GET['id'])){
    $post->id = $_GET['id'];
    
    $data = $post->read_single_post($post->id);
    
    $data->execute();
    if($data->rowCount()) {
        $posts = [];
        while($row = $data->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;  
        }
        echo json_encode($posts);
    } else {
        echo json_encode(['message' => 'No Posts Found']);
    }
}
?>