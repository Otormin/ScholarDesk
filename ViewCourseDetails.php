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
    <title>Scholar Desk - Course Details</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">
</head>
<body>
<header class="header">
    <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
</header>

    <div class="container">
        <?php
            if(isset($_SESSION['teacherId'])){
                $teacherId = $_SESSION['teacherId'];
                $getCourseDetails = "SELECT * FROM course WHERE courseId = '$courseId'";
                $getCourseDetailsResult = mysqli_query($conn, $getCourseDetails);

                if ($getCourseDetailsResult && mysqli_num_rows($getCourseDetailsResult) > 0) {
                    $course = mysqli_fetch_assoc($getCourseDetailsResult);
                    $courseCode = $course['courseCode'];
                    $courseName = $course['courseName'];
                    $credits = $course['credits'];
                    $passingGrade = $course['passingGrade'];
                    $department = $course['department'];
                    $semester = $course['semester'];
                    $level = $course['level'];

                    echo '<div style="padding: 10px; background-color: lightblue; margin-bottom: 20px">
                        <h2> Course Code: ' . $courseCode . '</h2>
                        <h2> Course Name: ' . $courseName . '</h2>
                        <h2> Credits: ' . $credits . '</h2>
                        <h2> Passing Score: ' . $passingGrade . '</h2>
                        <h2> Department: ' . $department . '</h2>
                        <h2> Semester: ' . $semester . '</h2>
                        <h2> Level: ' . $level . '</h2>
                        <div class="courses-button" style="background: red"><a href="RemoveCourse.php?teacherId=' . $teacherId . '&courseId=' . $courseId . '" style="color: white; font-weight: bold">Remove Course</a></div>
                    </div>';
                }
                else {
                    echo '<h3>No Details Available.</h3>';
                }
            }
            if(isset($_SESSION['adminId'])){
                $adminId = $_SESSION['adminId'];
                $getCourseDetails = "SELECT * FROM course WHERE courseId = '$courseId'";
                $getCourseDetailsResult = mysqli_query($conn, $getCourseDetails);

                if ($getCourseDetailsResult && mysqli_num_rows($getCourseDetailsResult) > 0) {
                    $course = mysqli_fetch_assoc($getCourseDetailsResult);
                    $courseCode = $course['courseCode'];
                    $courseName = $course['courseName'];
                    $credits = $course['credits'];
                    $passingGrade = $course['passingGrade'];
                    $department = $course['department'];
                    $semester = $course['semester'];
                    $level = $course['level'];

                    echo '<div style="padding: 10px; background-color: lightblue; margin-bottom: 20px">
                        <h2> Course Code: ' . $courseCode . '</h2>
                        <h2> Course Name: ' . $courseName . '</h2>
                        <h2> Credits: ' . $credits . '</h2>
                        <h2> Passing Score: ' . $passingGrade . '</h2>
                        <h2> Department: ' . $department . '</h2>
                        <h2> Semester: ' . $semester . '</h2>
                        <h2> Level: ' . $level . '</h2>
                        <div class="courses-button" style="background: lightgreen"><a href="UpdateCourse.php?courseId=' . $courseId . '" style="font-weight : bold">Update Course</a></div>
                    </div>';
                }
                else {
                    echo '<h3>No Details Available.</h3>';
                }
            }
            if(!isset($_SESSION['adminId']) && !isset($_SESSION['teacherId'])){
                echo '<h2 style="">You are not logged in</h2>
                        <div class="courses-button"><a href="Index.html">Login</a></div>';
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