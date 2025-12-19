<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
</head>
<body>
    <h1>Create New Post</h1>
  <?php
    if (isset($_GET['success'])) {
        echo '<div class="message success">Post Created Successfull!</div>';
    }
    if (isset($_GET['error'])) {
        echo '<div class="message error">Error: ' . htmlspecialchars($_GET['error']) . '</div>';
    }
    ?>
    
    <!-- FIX: Correct path to insert.php -->
    <form action="../../projectP/api/post/insert.php" method="POST">
            <label>
            Title:
            <input type="text" name="title" required>
        </label>
        
        <label>
            Category ID:
            <input type="number" name="category_id" required>
        </label>
        
        <label>
            Description:
            <textarea name="description" rows="5" required></textarea>
        </label>
        
        <button type="submit">Create Post</button>
    </form>

</body>
</html>
 
   