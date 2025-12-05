<?php
$user = 0;
$invalid = 0;
$success = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connect.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST['cpassword'];

    // SECURITY: Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($con, "SELECT * FROM `registration` WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result) {
        $num = mysqli_num_rows($result);
        
        // Check passwords first
        if ($password !== $cpassword) {
            $invalid = 1;
        }
        // Then check if username exists
        else if ($num > 0) {
            $user = 1;
        }
        // If both checks pass, insert user
        else {
            // SECURITY: Hash password before storing
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // SECURITY: Use prepared statement for insert
            $stmt = mysqli_prepare($con, "INSERT INTO `registration` (username, password) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $success = 1;
               
            } else {
                die(mysqli_error($con));
            }
        }
    } else {
        die(mysqli_error($con));
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

    <title>Signup</title>
</head>
<body>
<?php
if ($user){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Already exist!</strong> You need to change your username.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if($success){
    echo '<div class="alert alert-success" role="alert">
  Data inserted successfully!
</div>';
    echo '<meta http-equiv="refresh" content="2;url=home.php">';/*it is going to wait two seconds after that send to home*/

}

if($invalid){
    echo '<div class="alert alert-danger" role="alert">
  You need to confirm the password!
</div>';
}
?>
<div class="container mt-5">
    <h1 class="text-center">Signup</h1>
    <br>

    <form class="row" action="sign.php" method="post">
        <div class="form-group col-12">
            <label class="sr-only" for="username">Name</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username" required>
        </div>

        <div class="form-group col-12">
            <label class="sr-only" for="password">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required>
        </div>
        
        <div class="form-group col-12">
            <label class="sr-only" for="cpassword">Confirm Password</label>
            <input type="password" id="cpassword" class="form-control" name="cpassword" placeholder="Enter your password" required>
        </div>
        
        <div class="form-group col-12">
            <button type="submit" class="btn btn-primary w-100">Signup</button>
            <a href="../signup/login.php" class="btn btn-light text-dark my-2 w-100 border-dark" role="button">Login</a>
        </div>
    </form>
</div>
</body>
</html>