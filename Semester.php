<?php
    include 'connect.php';

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Semester</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">

</head>
<body>
    <header class="header">
        <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
    </header>

    <div class="container">
        <h2> Select Semester </h2>
        <?php 
            if(isset($_SESSION['studentId'])){
        ?>
            <div class="courses-container">
                <div class="courses">
                    <div><h3> 1st Semester </h3></div>
                    <div class="courses-button"><a href="MySemesterCourse.php?semester=<?php echo urlencode('1st Semester'); ?>"> View Courses </a></div>
                </div>
                <div class="courses">
                    <div><h3> 2nd Semester </h3></div>
                    <div class="courses-button"><a href="MySemesterCourse.php?semester=<?php echo urlencode('2nd Semester'); ?>"> View Courses </a></div>
                </div>
            </div>
        <?php
            }else{
        ?>
            <div class="courses-container">
                <div class="courses">
                    <div><h3> 1st Semester </h3></div>
                    <div class="courses-button"><a href="Index.html"> View Courses </a></div>
                </div>
                <div class="courses">
                    <div><h3> 2nd Semester </h3></div>
                    <div class="courses-button"><a href="Index.html"> View Courses </a></div>
                </div>
            </div>
        <?php }?>

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