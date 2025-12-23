<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <meta http-equiv="refresh" content="4;url=index.php">
</head>
<body>

<div class="container mt-5">
    <?php
    echo '<div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Well done!</h4>
      <p>Checkout successful!</p>
      <hr>
    </div>';
    ?>
</div>

<script>
    setTimeout(function(){
        window.location.href = "index.php";
    }, 2500);
</script>

</body>
</html>