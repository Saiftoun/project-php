<?php
include_once('../products/config/database1.php');

$database = new Database1();
$conn = $database->connect();

if(isset($_POST['insert_cat'])){
    $category_title = $_POST['cat_title'];
    
    $stmt = $conn->prepare("INSERT INTO categories (category_title, created_at) VALUES (:title, NOW())");
    $stmt->bindParam(':title', $category_title);
    $stmt->execute();
    
    echo "<div class='alert alert-success'>Category inserted successfully!</div>";
}
?>

<form action="" method="post" class="mb-2">
    <div class="input-group w-80 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Category" aria-label="Category" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group w-80 mb-2">
        <button type="submit" name="insert_cat" class="bg-info p-2 my-3 border-0">Insert Category</button>
    </div>
</form>
