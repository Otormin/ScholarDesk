<?php

include 'connect.php';

$matricNumber=$_POST['mNumber'];
$password=$_POST['password'];
$password=md5($password);

$sql="SELECT * FROM students WHERE matricNumber = '$matricNumber' and password = '$password'";
$result=$conn->query($sql); 
if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['studentId'] = $row['studentId'];
    header("Location: ./Homepage.php");
    exit();
}
else{
    echo "Not Found, Incorrect Email or Password";
}
?>