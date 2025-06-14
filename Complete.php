<?php
include 'connect.php';

$studentId = $_GET['studentId'];
$courseId = $_GET['courseId'];

$insertQueue = "UPDATE enrollment SET isCompleted = 1";

if($conn->query($insertQueue)==TRUE){
    header("Location: ./ViewStudents.php?courseId=".urlencode($courseId)."");
    exit();
}
else{
    echo "Error Completing Student:".$conn->error;
}
?>