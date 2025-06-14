<?php
include 'connect.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Courses</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">

</head>
<body>
<header class="header">
        <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
    </header>

    <div class="container">
        <h2 style="margin-top: 100px">Courses</h2>
        <?php
            if(isset($_SESSION['teacherId'])) {
                $teacherId = $_SESSION['teacherId'];
                $getCourseId = "SELECT * FROM courseTeacher WHERE teacherId = '$teacherId'";
                $getCourseIdResult = mysqli_query($conn, $getCourseId);

                if ($getCourseIdResult && mysqli_num_rows($getCourseIdResult) > 0) {
                    while ($row = mysqli_fetch_assoc($getCourseIdResult)) {
                        $courseId = $row['courseId'];

                        $getCourses = "SELECT * FROM course WHERE courseId = '$courseId'";
                        $getCoursesResult = mysqli_query($conn, $getCourses);

                        if ($getCoursesResult && mysqli_num_rows($getCoursesResult) > 0) {
                            while ($row = mysqli_fetch_assoc($getCoursesResult)) {
                                $courseCode = $row['courseCode'];
                                $courseName = $row['courseName'];
                                $credits = $row['credits'];

                            echo '<div class="courses" style="margin-top: 100px;">
                                    <div><h3> '.$courseCode.': '.$courseName.'</h3></div>
                                    <div class="courses-button"><a href="ViewStudentTeacher.php?courseId='.$courseId.'">Students</a></div>
                                    <div class="courses-button"><a href="ViewCourseDetails.php?courseId='.$courseId.'">Course Details</a></div>
                                </div>';
                            }
                        }
                        else{
                            echo '<h3 id="empty">No Course has been Selected.</h3>';
                        }
                    }
                }
            }  
            if(!isset($_SESSION['teacherId'])){
                echo '<h2 style="">You are not logged in</h2>
                        <div class="courses-button"><a href="Index.html">Login</a></div>';
            }          
        ?>
                
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