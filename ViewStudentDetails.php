<?php
include 'connect.php';
session_start();

if (isset($_GET['studentId']) && isset($_GET['courseId'])) {
    $studentId = htmlspecialchars($_GET['studentId']);
    $courseId = htmlspecialchars($_GET['courseId']);
}
else{
    $studentId = "";
    $courseId = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - View Student Details</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">
</head>
<body>
<header class="header">
    <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
</header>

    <div class="container">
        <?php
        if(!isset($_SESSION['adminId'])){
            echo '<h2 style="">You are not logged in</h2>
                        <div class="courses-button"><a href="Index.html">Login</a></div>';
        }else{
            $getEnrollment = "SELECT * FROM enrollment WHERE studentId = '$studentId' AND courseId = '$courseId'";
            $getEnrollmentResult = mysqli_query($conn, $getEnrollment);

            if ($getEnrollmentResult && mysqli_num_rows($getEnrollmentResult) > 0) {
                if($enrollment = mysqli_fetch_assoc($getEnrollmentResult)) {
                    $isCompleted = $enrollment['isCompleted'];

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

                    $getCourses = "SELECT * FROM course WHERE courseId = '$courseId'";
                    $getCoursesResult = mysqli_query($conn, $getCourses);

                    if ($getCoursesResult && mysqli_num_rows($getCoursesResult) > 0) {
                        $course = mysqli_fetch_assoc($getCoursesResult);
                        $passingGrade = $course['passingGrade'];
                    } else {
                        echo '<h3>No Passing Grade Found.</h3>';
                    }

                    $getStudent = "SELECT * FROM students WHERE studentId = '$studentId'";
                    $getStudentResult = mysqli_query($conn, $getStudent);

                    if ($getStudentResult && mysqli_num_rows($getStudentResult) > 0) {
                        $student = mysqli_fetch_assoc($getStudentResult);
                        $matricNumber = $student['matricNumber'];
                        $fullName = $student['fullName'];
                        $email = $student['email'];
                        $level = $student['level'];
                        $department = $student['department'];

                        if($score < $passingGrade){
                            echo '<div style="padding: 10px; background-color: lightblue; margin-bottom: 20px">
                                <h2> Matric Number: ' . $matricNumber . '</h2>
                                <h2> Full Name: ' . $fullName . '</h2>
                                <h2> Email: ' . $email . '</h2>
                                <h2> Level: ' . $level . '</h2>
                                <h2> Department: ' . $department . '</h2>
                                <h2> Status: Not Completed</h2>
                                <div class="courses-button" style="margin-bottom: 20px"><a href="ChangeGrade.php?studentId=' . $studentId . '&courseId=' . $courseId . '" style="font-weight: bold">Change grade</a></div>
                                <div class="courses-button" style="margin-bottom: 20px; background-color: lightgreen;"><a href="UpdateStudentAccount.php?studentId=' . $studentId . '&courseId=' . $courseId . '" style="font-weight: bold">Update Account</a></div>
                                <div class="courses-button" style="background: red;"><a href="RemoveStudent.php?studentId=' . $studentId . '&courseId=' . $courseId . '" style="color: white; font-weight: bold">Remove Student</a></div>
                            </div>';
                        }else{
                            echo '<div style="padding: 10px; background-color: lightblue; margin-bottom: 20px">
                                <h2> Matric Number: ' . $matricNumber . '</h2>
                                <h2> fullName: ' . $fullName . '</h2>
                                <h2> Email: ' . $email . '</h2>
                                <h2> Level: ' . $level . '</h2>
                                <h2> Department: ' . $department . '</h2>
                                <h2> Status: Completed</h2>
                                <div class="courses-button" style="margin-bottom: 20px"><a href="ChangeGrade.php?studentId=' . $studentId . '&courseId=' . $courseId . '" style="font-weight: bold">Change grade</a></div>
                                <div class="courses-button" style="margin-bottom: 20px; background-color: lightgreen;"><a href="UpdateStudentAccount.php?studentId=' . $studentId . '&courseId=' . $courseId . '" style="font-weight: bold">Update Account</a></div>
                                <div class="courses-button" style="background: red;"><a href="RemoveStudent.php?studentId=' . $studentId . '&courseId=' . $courseId . '" style="color: white; font-weight: bold">Remove Student</a></div>
                            </div>';
                        }
                    }
                }
            } else {
                echo '<h3>No Details Available.</h3>';
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