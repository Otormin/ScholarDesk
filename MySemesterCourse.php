<?php
include 'connect.php';

session_start();

if(isset($_SESSION['studentId'])) {
    $studentId = $_SESSION['studentId'];
    $getStudentDetails = "SELECT * FROM students WHERE studentId = $studentId";

    $getStudentDetailsResult = mysqli_query($conn, $getStudentDetails);

    if($getStudentDetailsResult){
        while($row = mysqli_fetch_assoc($getStudentDetailsResult)){
            $level = htmlspecialchars($row['level']);
            $department = htmlspecialchars($row['department']);
        }
    }

    $semester = htmlspecialchars($_GET['semester']);
}else{
    $semester = "";
    $level = "";
    $department = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - My Semester Courses</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">

</head>
<body>
<header class="header">
        <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
    </header>

    <div class="container">
        <?php
            if(isset($_SESSION['studentId'])) {
        ?>
                <h2> <?php echo ''.$semester.''; ?>, <?php echo ''.$level.''; ?>L</h2>
        <?php }else{?>
                <h2>You are not logged in</h2>
                <div class="courses-button"><a href="Index.html">Login</a></div>
        <?php }?>
        <?php
        
        $getCourses = "SELECT * FROM course WHERE department = '$department' AND semester = '$semester' AND level = '$level' ORDER BY courseCode";
            $getCoursesResult = mysqli_query($conn, $getCourses);

            if ($getCoursesResult && mysqli_num_rows($getCoursesResult) > 0) {
                while ($row = mysqli_fetch_assoc($getCoursesResult)) {
                    $courseId = $row['courseId'];
                    $courseCode = $row['courseCode'];
                    $courseName = $row['courseName'];
                    $credits = $row['credits'];
        ?>

                    <div class="courses">
                        <div><h3> <?php echo $courseCode; ?>: <?php echo $courseName; ?> </h3></div>
                        <div><h3> Credits: <?php echo $credits; ?> </h3></div>
                        <div class="courses-button"><a href="Enrollment.php?studentId=<?php echo urlencode($studentId); ?>&courseId=<?php echo urlencode($courseId); ?>">Enroll</a></div>
                    </div>

        <?php
                }
            }
            else{
                echo '<h3 id="empty" style="margin-top: 30px;">No Course Available.</h3>';
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