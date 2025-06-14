<?php
include 'connect.php';

session_start();

if (isset($_GET['department']) && isset($_GET['level']) && isset($_GET['semester'])) {
    $department = htmlspecialchars($_GET['department']);
    $level = htmlspecialchars($_GET['level']);
    $semester = htmlspecialchars($_GET['semester']);
}else{
    $department = "";
    $level = "";
    $semester = "";
}

if(isset($_SESSION['teacherId'])) {
    $teacherId = $_SESSION['teacherId'];
}

if(isset($_SESSION['adminId'])) {
    $adminId = $_SESSION['adminId'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Semester Courses</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">

    <style>
        .createCourseBtnContainer{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-bottom: 50px;
        }
    </style>

</head>
<body>
<header class="header">
        <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
    </header>

    <div class="container">
        <?php
            if(isset($_SESSION['adminId']) || isset($_SESSION['teacherId'])) {
        ?>
                <h2> <?php echo ''.$semester.''; ?>, <?php echo ''.$level.''; ?>L</h2>
        <?php }else{?>
                <h2>You are not logged in</h2>
                <div class="courses-button"><a href="Index.html">Login</a></div>
        <?php }?>

        <?php if(isset($_SESSION['adminId'])){?>
                <div class="createCourseBtnContainer">
                    <a href="CreateCourse.php"><button class="courses-button" style="background-color: #007bff; color: white; padding: 1rem 1rem; font-size: 1rem">Create Course</button></a>
                </div>
        <?php }?>
        <?php
        
        $getCourses = "SELECT * FROM course WHERE department = '$department' AND semester = '$semester' AND level = '$level' ORDER BY courseName";
            $getCoursesResult = mysqli_query($conn, $getCourses);

            if ($getCoursesResult && mysqli_num_rows($getCoursesResult) > 0) {
                while ($row = mysqli_fetch_assoc($getCoursesResult)) {
                    $courseId = $row['courseId'];
                    $courseCode = $row['courseCode'];
                    $courseName = $row['courseName'];
                    $credits = $row['credits'];
        ?>
                    <?php if(isset($_SESSION['adminId'])){?>
                        <div class="courses">
                            <h3> <?php echo $courseCode; ?>: <?php echo $courseName; ?> </h3>
                            <h3> Credits: <?php echo $credits; ?> </h3>
                            <div class="courses-button"><a href="ViewCourseDetails.php?courseId=<?php echo urlencode($courseId); ?>">Course Details</a></div>
                            <div class="courses-button"><a href="ViewStudents.php?courseId=<?php echo urlencode($courseId); ?>">View Students</a></div>
                        </div>
                    <?php }?>

                    <?php if(isset($_SESSION['teacherId'])){?>
                        <div class="courses">
                            <h3> <?php echo $courseCode; ?>: <?php echo $courseName; ?> </h3>
                            <h3> Credits: <?php echo $credits; ?> </h3>
                            <div class="courses-button"><a href="CourseTeacher.php?teacherId=<?php echo urlencode($teacherId); ?>&courseId=<?php echo urlencode($courseId); ?>">Teach Course</a></div>
                        </div>
                    <?php }?>

        <?php
                }
            }
            else{
                echo '<h3 id="empty" style="margin-top: 30px;">No Course Available.</h3>';
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