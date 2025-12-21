<?php
include_once("../products/config/database1.php");

$database = new Database1();
$conn = $database->connect();

$category_query = "SELECT * FROM categories ORDER BY category_title ASC";
$stmt_cat = $conn->prepare($category_query);
$stmt_cat->execute();
$categories = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

$brand_query = "SELECT * FROM brands ORDER BY brand_title ASC";
$stmt_brand = $conn->prepare($brand_query);
$stmt_brand->execute();
$brands = $stmt_brand->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Insert New Product</h4>
                </div>

                <div class="card-body">
                    <!-- This form sends data to create.php -->
                    <form action="../products/api/product/create.php" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Product Title</label>
                            <input type="text" name="product_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Description</label>
                            <textarea name="product_description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Keywords</label>
                            <input type="text" name="product_keyword" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                <?php foreach($categories as $category): ?>
                                    <option value="<?= $category['id']; ?>">
                                        <?= htmlspecialchars($category['category_title']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-select" required>
                                <option value="">Select Brand</option>
                                <?php foreach($brands as $brand): ?>
                                    <option value="<?= $brand['id']; ?>">
                                        <?= htmlspecialchars($brand['brand_title']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="product_image" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Product Price</label>
                            <input type="number" step="0.01" name="product_price" class="form-control" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="insert_product" class="btn btn-info text-white">
                                Insert Product
                            </button>
                            <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>