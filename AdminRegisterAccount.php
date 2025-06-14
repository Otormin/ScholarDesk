<?php
include 'connect.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);

$checkEmail = "SELECT * FROM admin WHERE email='$email'";
$result = $conn->query($checkEmail);

if ($result->num_rows > 0) {
    echo "Email Address Already Exists!";
} else {
    $insertQueue = "INSERT INTO admin (email, password) 
                    VALUES ('$email', '$password')";

    if ($conn->query($insertQueue) === TRUE) {
        header("Location: ./LoginAsAdmin.html");
        exit();
    } else {
        echo "Error inserting into admins: " . $conn->error;
    }
}
?>