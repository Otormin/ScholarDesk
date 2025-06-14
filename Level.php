<?php
include 'connect.php';

session_start();

if (isset($_GET['department'])) {
    $department = $_GET['department'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Level</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">

</head>
<body>
    <header class="header">
        <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
    </header>

    <div class="container">
        <h2> Select Level </h2>
            <?php if(isset($_SESSION['adminId']) || isset($_SESSION['teacherId'])){?>
                <div class="courses-container">
                    <div class="courses">
                        <div><h3> 100L </h3></div>
                        <div class="courses-button"><a href="SelectSem.php?department=<?php echo urlencode($department); ?>&level=100">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 200L </h3></div>
                        <div class="courses-button"><a href="SelectSem.php?department=<?php echo urlencode($department); ?>&level=200">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 300L </h3></div>
                        <div class="courses-button"><a href="SelectSem.php?department=<?php echo urlencode($department); ?>&level=300">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 400L </h3></div>
                        <div class="courses-button"><a href="SelectSem.php?department=<?php echo urlencode($department); ?>&level=400">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 500L </h3></div>
                        <div class="courses-button"><a href="SelectSem.php?department=<?php echo urlencode($department); ?>&level=500">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 600L </h3></div>
                        <div class="courses-button"><a href="SelectSem.php?department=<?php echo urlencode($department); ?>&level=600">Select Semester</a></div>
                    </div>
                </div>
            <?php } else{?>
                <div class="courses-container">
                    <div class="courses">
                        <div><h3> 100L </h3></div>
                        <div class="courses-button"><a href="LoginAs.html">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 200L </h3></div>
                        <div class="courses-button"><a href="LoginAs.html">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 300L </h3></div>
                        <div class="courses-button"><a href="LoginAs.html">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 400L </h3></div>
                        <div class="courses-button"><a href="LoginAs.html">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 500L </h3></div>
                        <div class="courses-button"><a href="LoginAs.html">Select Semester</a></div>
                    </div>
                    <div class="courses">
                        <div><h3> 600L </h3></div>
                        <div class="courses-button"><a href="LoginAs.html">Select Semester</a></div>
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
    <script src="../JS/function.js"> </script>

</body>
</html>