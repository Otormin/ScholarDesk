<?php
include 'connect.php';

session_start();

if (isset($_GET['teacherId']) && isset($_GET['courseId'])) {
    $teacherId = htmlspecialchars($_GET['teacherId']);
    $courseId = htmlspecialchars($_GET['courseId']);

    $checkCourseTeacher = "SELECT * FROM courseteacher WHERE teacherId='$teacherId' AND courseId = '$courseId'";
    $result = $conn->query($checkCourseTeacher);

    if ($result->num_rows > 0) {
        echo "You have already selected this course!";
    } else {
        $insertQueue = "INSERT INTO courseTeacher ( teacherId, courseId) 
                            VALUES ('$teacherId', '$courseId')";

        if ($conn->query($insertQueue) === TRUE) {
            header("Location: ./ViewDepartments.php");
            exit();
        } else {
            echo "Error inserting into Course Teacher: " . $conn->error;
        }
    }
}

?>