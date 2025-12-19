<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* include required files */
include_once('../../config/Database.php');
include_once('../../models/Post.php');

// Initialize database and post object
$database = new Database();
$db = $database->connect();
$post = new Post($db);

// Check if it's a form submission or API call
$isFormSubmission = !empty($_POST) && !isset($_SERVER['HTTP_X_REQUESTED_WITH']);

/* Get input data */
$input = null;

// Handle JSON (for Postman/API calls)
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
    $input = $data;
} elseif (!empty($_POST)) {
    $input = $_POST;
}

if (!empty($input)) {

    $params = [
        'title'       => $input['title'] ?? null,
        'description' => $input['description'] ?? null,
        'category_id' => $input['category_id'] ?? null
    ];

    /* Validate required fields */
    if (empty($params['title']) || empty($params['category_id']) || empty($params['description'])) {
        if ($isFormSubmission) {
            // Redirect back to form with error
            header('Location: ../admin/insertPosts.php?error=missing_fields');
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Missing required fields']);
            exit;
        }
    }

    if ($post->create_new_post($params)) {
        if ($isFormSubmission) {
            // Redirect back to form with success
            header('Location: ../admin/insertPosts.php?success=1');
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Post Created Successful']);
        }
    } else {
        if ($isFormSubmission) {
            header('Location: ../admin/insertPosts.php?error=creation_failed');
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Post Not Created']);
        }
    }

} else {
    if ($isFormSubmission) {
        header('Location: ../admin/insertPosts.php?error=no_data');
        exit;
    } else {
        header('Content-Type: application/json');
        echo json_encode(['message' => 'No Input Data Received']);
    }
}
?>
