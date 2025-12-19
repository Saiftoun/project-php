<?php
include_once('../products/config/database1.php');

$database = new Database();
$conn = $database->connect();

if(isset($_POST['insert_brand'])){
    $brand_title = $_POST['brand_title'];
    
    $stmt = $conn->prepare("INSERT INTO brands (brand_title, created_at) VALUES (:title, NOW())");
    $stmt->bindParam(':title', $brand_title);
    $stmt->execute();
    
    echo "<div class='alert alert-success'>Brand inserted successfully!</div>";
}
?>

<form action="" method="post" class="mb-2">
    <div class="input-group w-80 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brand" aria-label="Brand" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group w-80 mb-2">
        <button type="submit" name="insert_brand" class="bg-info p-2 my-3 border-0">Insert Brand</button>
    </div>
</form>
