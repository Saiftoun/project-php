
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">

    <title>Home</title>

</head>
<body>

<h1 class="text-center text-warning mt-5">Welcome
<?php 
session_start();

echo $_SESSION['username'];
?>
</h1>
<div class="container">
<a href="logout.php" class="btn btn-primary mt-5">logout</a>
<!-- FIXED: Changed path from ../index.php to ./index.php -->
<a href="../index.php" class="btn btn-primary mt-5">Shop now</a>

</div>
</body>
</html>