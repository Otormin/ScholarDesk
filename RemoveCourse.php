<?php
session_start();

include 'connect.php';

$teacherId = $_GET['teacherId'];
$courseId = $_GET['courseId'];

$removeCourse = "DELETE FROM courseteacher WHERE teacherId=$teacherId AND courseId=$courseId";

$removeCourseResult = mysqli_query($conn, $removeCourse);

if($removeCourseResult){
    header("Location: ./ViewCourseTeacher.php");
}
else{
    die(mysqli_error($conn));
}

?>