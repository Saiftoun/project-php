
<?php

$conn = mysqli_connect('localhost', 'root', '', 'crudoperation');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// For compatibility with your existing code that uses $con
$con = $conn;

?>