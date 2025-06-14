<?php
include 'connect.php';
session_start();

$fullName = $_POST['fName'];
$email = $_POST['email'];
$phoneNumber = $_POST['pNumber'];
$password = $_POST['password'];
$password = md5($password);

$checkEmail = "SELECT * FROM teachers WHERE email='$email'";
$result = $conn->query($checkEmail);

if ($result->num_rows > 0) {
    echo "Email Address Already Exists!";
} else {
    $insertQueue = "INSERT INTO teachers (fullName, email, phoneNumber, password) 
                    VALUES ('$fullName', '$email', '$phoneNumber', '$password')";

    if ($conn->query($insertQueue) === TRUE) {
        header("Location: ./LoginAsTeacher.html");
        exit();
    } else {
        echo "Error inserting into teachers: " . $conn->error;
    }
}
?>