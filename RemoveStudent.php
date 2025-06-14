<?php
session_start();

include 'connect.php';

$studentId = $_GET['studentId'];
$courseId = $_GET['courseId'];

$removeStudentFromEnrollment = "DELETE FROM enrollment WHERE studentId=$studentId AND courseId=$courseId";
$removeStudentFromGrade = "DELETE FROM grade WHERE studentId=$studentId AND courseId=$courseId";
$removeStudentFromAttendance = "DELETE FROM attendance WHERE studentId=$studentId AND courseId=$courseId";

$removeStudentFromEnrollmentResult = mysqli_query($conn, $removeStudentFromEnrollment);
$removeStudentFromGradeResult = mysqli_query($conn, $removeStudentFromGrade);
$removeStudentFromAttendanceResult = mysqli_query($conn, $removeStudentFromAttendance);

if($removeStudentFromEnrollmentResult){
    if($removeStudentFromGradeResult){
        if($removeStudentFromAttendanceResult){
            header("Location: ./ViewStudents.php?courseId=".urlencode($courseId)."");
        }
        else{
            die(mysqli_error($conn));
        }
    }
    else{
        die(mysqli_error($conn));
    }
}
else{
    die(mysqli_error($conn));
}

?>