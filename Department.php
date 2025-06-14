<?php

session_start();

include 'connect.php';

$departmentName=$_POST['dName'];

$checkDepartment = "SELECT * FROM department WHERE departmentName='$departmentName'";
$checkDepartmentResult = $conn->query($checkDepartment);

if ($checkDepartmentResult->num_rows > 0) {
    echo "Department Already Exists!";
} else {
    $insertQueue = "INSERT INTO department (departmentName) VALUES ('$departmentName')";

    if ($conn->query($insertQueue) === TRUE) {
        header("Location: ViewDepartments.php");
        exit();
    }else{
        echo "Error inserting into department table: " . $conn->error;
    }
}
?>