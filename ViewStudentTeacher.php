<?php
include 'connect.php';
session_start();

if (isset($_GET['courseId'])) {
    $courseId = htmlspecialchars($_GET['courseId']);
}
else{
    $courseId = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - View Students</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">

    <style>
        h2 {
            margin-top: 0rem;
        }
        .courses {
            margin-top: 5rem;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
</header>

    <div class="container">
        <?php
        if(!isset($_SESSION['teacherId'])){
        echo '<h2 style="margin-top: 100px">You are not logged in</h2>
                    <div class="courses-button"><a href="Index.html">Login</a></div>';
        }else{
            $getCourses = "SELECT * FROM course WHERE courseId = '$courseId'";
            $getCoursesResult = mysqli_query($conn, $getCourses);

            if ($getCoursesResult && mysqli_num_rows($getCoursesResult) > 0) {
                while($course = mysqli_fetch_assoc($getCoursesResult)){
                    $passingGrade = $course['passingGrade'];
                    echo '<h2 style="margin-top: 90px">' . $course['courseCode'] . ': ' . $course['courseName'] . ' - ' . $course['credits'] . ' Credits - Passing Grade = ' . $passingGrade . '</h2>';
                }
            } else {
                echo '<h3 style="margin-top: 100px">No Course Found.</h3>';
            }

            $getEnrollment = "SELECT * FROM enrollment WHERE courseId = '$courseId'";
            $getEnrollmentResult = mysqli_query($conn, $getEnrollment);

            if ($getEnrollmentResult && mysqli_num_rows($getEnrollmentResult) > 0) {
                while ($enrollment = mysqli_fetch_assoc($getEnrollmentResult)) {
                    $studentId = $enrollment['studentId'];
                    $isCompleted = $enrollment['isCompleted'];

                    $getAttendance = "SELECT COUNT(*) AS addAttendance FROM attendance WHERE studentId = '$studentId' AND courseId = '$courseId'";
                    $getAttendanceResult = mysqli_query($conn, $getAttendance);

                    if($getAttendanceResult){
                        $attendanceDetail = mysqli_fetch_assoc($getAttendanceResult);
                        $totalAttendance = $attendanceDetail['addAttendance'];
                    }

                    $getScore = "SELECT * FROM grade WHERE studentId = '$studentId' AND courseId = '$courseId'";
                    $getScoreResult = mysqli_query($conn, $getScore);

                    if ($getScoreResult && mysqli_num_rows($getScoreResult) > 0) {
                        $studentScore = mysqli_fetch_assoc($getScoreResult);
                        $score = $studentScore['score'];
                        $examDate = $studentScore['examDate'];
                    } else {
                        $score = 0;
                        $examDate = 'Not Available';
                    }

                    $getStudent = "SELECT * FROM students WHERE studentId = '$studentId'";
                    $getStudentResult = mysqli_query($conn, $getStudent);

                    if ($getStudentResult && mysqli_num_rows($getStudentResult) > 0) {
                        $student = mysqli_fetch_assoc($getStudentResult);
                        $matricNumber = $student['matricNumber'];

                        if($score < $passingGrade){
                            echo '<div class="courses">
                                <h3>| Matric Number: ' . $matricNumber . ' |</h3>
                                <h3>| Score: ' . $score . '/100 |</h3>
                                <h3>| Attendance: ' . $totalAttendance . ' |</h3>
                                <h3>| Status: Not Complete |</h3>
                                <div class="courses-button" style="background-color: lightblue; height: 20px; display: flex; align-items: center;"><a href="InputScore.php?studentId=' . $studentId . '&courseId=' . $courseId . '">Input Score</a></div>
                                <div class="courses-button" style="background-color: lightgreen; height: 20px; display: flex; align-items: center;"><a href="Attendance.php?studentId=' . $studentId . '&courseId=' . $courseId . '">Sign Attendance</a></div>
                            </div>';
                        }else{
                            echo '<div class="courses">
                                <h3>| Matric Number: ' . $matricNumber . ' |</h3>
                                <h3>| Score: ' . $score . '/100 |</h3>
                                <h3>| Attendance: ' . $totalAttendance . ' |</h3>
                                <h3>| Status: Complete |</h3>
                                <div class="courses-button" style="background-color: lightgreen; height: 20px; display: flex; align-items: center;"><a href="Attendance.php?studentId=' . $studentId . '&courseId=' . $courseId . '">Sign Attendance</a></div>
                            </div>';
                        }
                    }
                }
            } 
            else {
                echo '<h3>No Students Enrolled.</h3>';
            }
        }
        ?>
    </div>
                
    <?php if(isset($_SESSION['adminId'])){?>
        <nav class="navigation">
            <a href="Homepage.php" class="nav-item">
                <img src="Icons/house.fill.png" alt="Profile icon">
                <span>Home</span>
            </a>
            <a href="ViewDepartments.php" class="nav-item">
                <img src="Icons/folder.png" alt="Profile icon">
                <span>Departments</span>
            </a>
            <a href="Profile.php" class="nav-item">
                <img src="Icons/profile.png" alt="Profile icon">
                <span>Profile</span>
            </a>
        </nav>
    <?php }?>
    <?php if(isset($_SESSION['teacherId'])){?>
        <nav class="navigation">
            <a href="Homepage.php" class="nav-item">
                <img src="Icons/house.fill.png" alt="Profile icon">
                <span>Home</span>
            </a>
            <a href="ViewDepartments.php" class="nav-item">
                <img src="Icons/folder.png" alt="Profile icon">
                <span>Courses</span>
            </a>
            <a href="ViewCourseTeacher.php" class="nav-item">
                <img src="Icons/my courses.png" alt="Profile icon">
                <span>My Students</span>
            </a>
            <a href="Profile.php" class="nav-item">
                <img src="Icons/profile.png" alt="Profile icon">
                <span>Profile</span>
            </a>
        </nav>
    <?php }?>
    <?php if(isset($_SESSION['studentId'])){?>
        <nav class="navigation">
            <a href="Homepage.php" class="nav-item">
                <img src="Icons/house.fill.png" alt="Profile icon">
                <span>Home</span>
            </a>
            <a href="Semester.php" class="nav-item">
                <img src="Icons/my courses.png" alt="Profile icon">
                <span>My Courses</span>
            </a>
            <a href="Profile.php" class="nav-item">
                <img src="Icons/profile.png" alt="Profile icon">
                <span>Profile</span>
            </a>
        </nav>
    <?php }?>
</body>
</html>

    <script src="JS/function.js"> </script>
</body>
</html>