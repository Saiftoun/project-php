<?php
include 'connect.php';  
$id = $_GET['updateid'];

if(isset($_POST['submit'])){
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // FIXED: Removed "id=$id," from SET
    $sql = "UPDATE `crud` SET name='$username', email='$email', mobile='$mobile', password='$password' WHERE id=$id";
    
    $result = mysqli_query($conn, $sql);
    
    if($result){
         echo "Data updated successfully";
         header('location:display.php'); // Redirect after update
    }else{
        die(mysqli_error($conn));
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
    <title>Update</title>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Update Form</h2>
    <form method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
        </div>
        <div class="form-group">    
            <label for="mobile">mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
    </form>
</div>

</body>
</html>