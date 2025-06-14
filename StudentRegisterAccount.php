<?php
include 'connect.php';
session_start();

$matricNumber = $_POST['mNumber'];
$fullName = $_POST['fName'];
$DOB = $_POST['DOB'];
$gender =$_POST['gender'];
$email = $_POST['email'];
$phoneNumber = $_POST['pNumber'];
$department = $_POST['department'];
$level = $_POST['level'];
$registrationDate = date('Y-m-d');
$password = $_POST['password'];
$password = md5($password);

$checkMatricNumber = "SELECT * FROM students WHERE matricNumber='$matricNumber'";
$matricResult = $conn->query($checkMatricNumber);

if ($matricResult->num_rows == 0) {
    $checkEmail = "SELECT * FROM students WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQueue = "INSERT INTO students ( matricNumber, fullName, DOB, gender, email, phoneNumber, department, level, registrationDate, password) 
                        VALUES ('$matricNumber', '$fullName', '$DOB', '$gender', '$email', '$phoneNumber', '$department', '$level', '$registrationDate', '$password')";

        if ($conn->query($insertQueue) === TRUE) {
            header("Location: ./LoginAsStudent.html");
            exit();
        } else {
            echo "Error inserting into students: " . $conn->error;
        }
    }
}else{
    echo "Matriculation Number Already Exists!";
}
?>