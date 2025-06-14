<?php

session_start();

include 'connect.php';

$courseCode = $_POST['cCode'];
$courseName = $_POST['cName'];
$credits = $_POST['credits'];
$passingGrade = $_POST['pGrade'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$level = $_POST['level'];

$checkCourseCode = "SELECT * FROM course WHERE courseCode='$courseCode'";
$checkCourseCodeResult = $conn->query($checkCourseCode);

if ($checkCourseCodeResult->num_rows > 0) {
    echo "Course Already Exists!";
} else {
    $checkCourseName = "SELECT * FROM course WHERE courseName='$courseName'";
    $checkCourseNameResult = $conn->query($checkCourseName);

    if ($checkCourseNameResult->num_rows > 0) {
        echo "Course Already Exists!";
    } else {
        $insertQueue = "INSERT INTO course (courseCode, courseName, credits, passingGrade, department, semester, level) VALUES ('$courseCode', '$courseName', '$credits', '$passingGrade', '$department', '$semester', '$level')";

        if ($conn->query($insertQueue) === TRUE) {
            header("Location: ./ViewDepartments.php");
            exit();
        } else {
            echo "Error inserting into course: " . $conn->error;
        }
    }
}
?>