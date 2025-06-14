<?php
include 'connect.php';

$studentId = $_GET['studentId'];
$courseId = $_GET['courseId'];

$insertQueue = "UPDATE enrollment SET isCompleted = 0";

if($conn->query($insertQueue)==TRUE){
    header("Location: ./ViewStudents.php");
    exit();
}
else{
    echo "Error Completing Student:".$conn->error;
}
?>