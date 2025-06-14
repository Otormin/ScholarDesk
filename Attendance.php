<?php

session_start();

include 'connect.php';

$studentId = $_GET['studentId'];
$courseId = $_GET['courseId'];

$date = date('Y-m-d');
$isAttended = 1;

$insertAttendance = "INSERT INTO attendance (studentId, courseId, date, isAttended) VALUES ('$studentId', '$courseId', '$date', '$isAttended')";

if ($conn->query($insertAttendance) === TRUE) {
    header("Location: ./ViewStudentTeacher.php?studentId=".urlencode($studentId)."&courseId=".urlencode($courseId)."");
    exit();
} else {
    echo "Error inserting attendance: " . $conn->error;
}
?>