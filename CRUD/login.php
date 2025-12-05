<?php
// Start session at the top
session_start();

$user = 0;
$success = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connect.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = mysqli_prepare($con, "SELECT * FROM `crud` WHERE name = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($result){
        $num = mysqli_num_rows($result);
        
        if($num > 0){
            $row = mysqli_fetch_assoc($result);
            
            if(password_verify($password, $row['password'])){
                // Password is correct - login successful
                $success = 1;
                // FIXED: Changed from 'name' to 'username'
                $_SESSION['username'] = $username;
            } else {
                // Password is wrong
                $user = 1;
            }
        } else {
            // Username not found
            $user = 1;
        }
    }
    
    mysqli_stmt_close($stmt);
}
?>

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

    <title>Login</title>
</head>
<body>
<?php
if ($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
   Invalid username or password!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if($success){
    echo '<div class="alert alert-success" role="alert">
  Login successful! Redirecting to home page...
</div>';
    echo '<meta http-equiv="refresh" content="2;url=home.php">';
}
?>
<div class="container mt-5">
    <h1 class="text-center">Login</h1>
    <br>

    <form class="row" method="post">
        <div class="form-group col-12">
            <label class="sr-only" for="username">Username</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username" required>
        </div>

        <div class="form-group col-12">
            <label class="sr-only" for="password">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required>
        </div>

        <div class="form-group col-12">
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <a href="user.php" class="btn btn-light text-dark my-2 w-100 border-dark" role="button">Don't have an account? Signup</a>
        </div>
    </form>
</div>
</body>
</html>