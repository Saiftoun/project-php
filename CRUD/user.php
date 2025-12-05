<?php
// Initialize status variables
$user = 0;
$invalid = 0;
$success = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // FIXED: connect.php is in the same folder (CRUD)
    include 'connect.php'; 
    
    // Check if $con is a valid mysqli object before proceeding
    if (!isset($con) || $con === false) {
        die("Error: Database connection failed or \$con variable is not set in connect.php");
    }

    // Get all form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $cpassword = $_POST['cpassword'];

    // --- 1. Basic Validation (Passwords Match) ---
    if ($password !== $cpassword) {
        $invalid = 1;
    } else {
        // --- 2. Check if Username Already Exists (SECURITY: Use prepared statement) ---
        // FIXED: Changed table name from 'registration' to 'crud'
        $stmt_check = mysqli_prepare($con, "SELECT * FROM `crud` WHERE name=?");
        
        if ($stmt_check === false) {
             die("Prepare failed for SELECT: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt_check, "s", $username);
        mysqli_stmt_execute($stmt_check);
        $result_check = mysqli_stmt_get_result($stmt_check);
        
        if ($result_check) {
            $num = mysqli_num_rows($result_check);
            
            if ($num > 0) {
                // Username already exists
                $user = 1;
            } else {
                // --- 3. Insert User (SECURITY: Hash password and use prepared statement) ---
                
                // Hash password before storing
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // FIXED: Changed table name from 'registration' to 'crud'
                $sql_insert = "INSERT INTO `crud` (name, password, email, mobile) VALUES (?, ?, ?, ?)";
                $stmt_insert = mysqli_prepare($con, $sql_insert);
                
                if ($stmt_insert === false) {
                     die("Prepare failed for INSERT: " . mysqli_error($con));
                }

                // Bind parameters: 'ssss' for four strings
                mysqli_stmt_bind_param($stmt_insert, "ssss", $username, $hashed_password, $email, $mobile);
                
                $result_insert = mysqli_stmt_execute($stmt_insert);

                if ($result_insert) {
                    $success = 1;
                } else {
                    die(mysqli_error($con));
                }
                
                mysqli_stmt_close($stmt_insert);
            }
        } else {
            die(mysqli_error($con));
        }
        
        mysqli_stmt_close($stmt_check);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
    Data inserted successfully! Redirecting to login  page...
</div>';
    echo '<meta http-equiv="refresh" content="2;url=./login.php">';
}

if($invalid){
    echo '<div class="alert alert-danger" role="alert">
    Passwords do not match! Please confirm your password.
</div>';
}
?>
<div class="container mt-5">
    <h1 class="text-center">Signup</h1>
    <br>

    <!-- FIXED: Form submits to itself -->
    <form class="row" action="" method="post"> 
        <div class="form-group col-12">
            <label class="sr-only" for="username">Username</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username" required autocomplete="off">
        </div>

        <div class="form-group col-12">
            <label class="sr-only" for="email">Email</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" required autocomplete="off">
        </div>
        
        <div class="form-group col-12">
            <label class="sr-only" for="mobile">Mobile</label>
            <input type="text" id="mobile" class="form-control" name="mobile" placeholder="Enter your mobile number" required autocomplete="off">
        </div>

        <div class="form-group col-12">
            <label class="sr-only" for="password">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required autocomplete="off">
        </div>
        
        <div class="form-group col-12">
            <label class="sr-only" for="cpassword">Confirm Password</label>
            <input type="password" id="cpassword" class="form-control" name="cpassword" placeholder="Confirm your password" required autocomplete="off">
        </div>
        
        <div class="form-group col-12">
            <button type="submit" class="btn btn-primary w-100">Signup</button> 
        </div>
    </form>
</div>
</body>
</html>