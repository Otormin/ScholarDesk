<?php
include 'connect.php';

session_start();

if (isset($_GET['studentId']) && isset($_GET['courseId'])) {
    $studentId = htmlspecialchars($_GET['studentId']);
    $courseId = htmlspecialchars($_GET['courseId']);
    $enrollmentDate = date('Y-m-d');
    $isCompleted = 0;
    $score = 0;
    $examDate = date('Y-m-d');

    $checkEnrollment = "SELECT * FROM enrollment WHERE studentId='$studentId' AND courseId = '$courseId'";
    $result = $conn->query($checkEnrollment);

    if ($result->num_rows > 0) {
        echo "You have already selected this course!";
    } else {
        $insertQueue = "INSERT INTO enrollment ( studentId, courseId, enrollmentDate, isCompleted) 
                            VALUES ('$studentId', '$courseId', '$enrollmentDate', '$isCompleted')";

        if ($conn->query($insertQueue) === TRUE) {
            $insert = "INSERT INTO grade ( studentId, courseId, score, examDate) 
                            VALUES ('$studentId', '$courseId', '$score', '$examDate')";

            if ($conn->query($insert) === TRUE) {
                header("Location: ./Semester.php");
                exit();
            } else {
                echo "Error inserting into grade: " . $conn->error;
            }
        } else {
            echo "Error inserting into enrollment: " . $conn->error;
        }
    }
}

?>