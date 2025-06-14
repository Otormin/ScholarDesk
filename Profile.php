<?php
    include 'connect.php';

    session_start();

    if(isset($_SESSION['adminId'])) {
        $adminId = $_SESSION['adminId'];
        $getAdminDetails = "SELECT * FROM admin WHERE adminId = $adminId";

        $getAdminDetailsResult = mysqli_query($conn, $getAdminDetails);

        if($getAdminDetailsResult){
            while($row = mysqli_fetch_assoc($getAdminDetailsResult)){
                $adminEmail = htmlspecialchars($row['email']);
            }
        }
    }

    if(isset($_SESSION['teacherId'])) {
        $teacherId = $_SESSION['teacherId'];
        $getTeacherDetails = "SELECT * FROM teachers WHERE teacherId = $teacherId";

        $getTeacherDetailsResult = mysqli_query($conn, $getTeacherDetails);

        if($getTeacherDetailsResult){
            while($row = mysqli_fetch_assoc($getTeacherDetailsResult)){
                $teacherFullName = htmlspecialchars($row['fullName']);
                $teacherEmail = htmlspecialchars($row['email']);
                $teacherPhoneNumber = htmlspecialchars($row['phoneNumber']);
            }
        }
    }

    if(isset($_SESSION['studentId'])) {
        $studentId = $_SESSION['studentId'];
        $getStudentDetails = "SELECT * FROM students WHERE studentId = $studentId";

        $getStudentDetailsResult = mysqli_query($conn, $getStudentDetails);

        if($getStudentDetailsResult){
            while($row = mysqli_fetch_assoc($getStudentDetailsResult)){
                $studentFullName = htmlspecialchars($row['fullName']);
                $matricNumber = htmlspecialchars($row['matricNumber']);
                $DOB = htmlspecialchars($row['DOB']);
                $gender = htmlspecialchars($row['gender']);
                $studentEmail = htmlspecialchars($row['email']);
                $studentPhoneNumber = htmlspecialchars($row['phoneNumber']);
                $department = htmlspecialchars($row['department']);
                $level = htmlspecialchars($row['level']);
            }
        }
    }

    $courseId = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Profile</title>
    <link rel="stylesheet" href="CSS/Homepage.css">

</head>
<body>
<header class="header">
        <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>

        <style>
            .courses {
                display: flex;
                margin-bottom: 2rem;
                justify-content: space-between;
                width: 100%;
            }

            .courses-button {
                font-size: 14px;
                padding: 12px 20px;
                background: #ebebeb;
                border-radius: 15px;
                border: none;
                cursor: pointer; 
            }

            .courses-button a {
                font-size: 15px;
                text-decoration: none;
                color: black;
            }
        </style>
    </header>

    <div class="container">
        <?php
            if (isset($_SESSION['adminId'])) echo '<div style= "margin-top: 100Px">
                                            <h2> Admin Details </h2>
                                            <div style= "margin-top: 15px">
                                                <p style= "margin-top: 10px"> Email: '.$adminEmail.'</p>
                                            </div>
                                        </div>';
            
            if (isset($_SESSION['studentId'])) echo '<div style= "margin-top: 100px">
                                            <h2> Student Details </h2>
                                            <div style= "margin-top: 15px">
                                                <p>Name: '.$studentFullName.'</p>
                                                <p>Matriculation Number: '.$matricNumber.'</p>
                                                <p>Date Of Birth: '.$DOB.'</p>
                                                <p>Gender: '.$gender.'</p>
                                                <p style= "margin-top: 10px"> Email: '.$studentEmail.'</p>
                                                <p>Phone Number: '.$studentPhoneNumber.'</p>
                                                <p>Department: '.$department.'</p>
                                                <p>Level: '.$level.'</p>
                                            </div>
                                        </div>
                                        <a href="ChangeStudentDetails.php?studentId=' . $studentId . '"><button style="padding: 0.5rem 1rem; border-radius: 5px; width: 25%; color: white; background-color: #007bff; margin-top: 15px; margin-bottom: 30px; cursor: pointer; font-weight: bold; border: none">Change Details</button></a></br>';

            if (isset($_SESSION['teacherId'])) echo '<div style= "margin-top: 100px">
                                            <h2> Teacher Details </h2>
                                            <div style= "margin-top: 15px">
                                                <p>Name: '.$teacherFullName.'</p>
                                                <p style= "margin-top: 10px"> Email: '.$teacherEmail.'</p>
                                                <p>Phone Number: '.$teacherPhoneNumber.'</p>
                                            </div>
                                        </div>
                                        <a href="ChangeTeacherDetails.php?teacherId=' . $teacherId . '"><button style="padding: 0.5rem 1rem; border-radius: 5px; width: 25%; color: white; background-color: #007bff; margin-top: 15px; margin-bottom: 30px; cursor: pointer; font-weight: bold; border: none">Change Details</button></a></br>';

            if (!isset($_SESSION['adminId']) && !isset($_SESSION['teacherId']) && !isset($_SESSION['studentId'])){
                echo '<h2 style="padding-top: 100px; padding-bottom: 30px">You are not logged in</h2>
                        <div class="courses-button"><a href="Index.html">Login</a></div>';
            } 
        ?>

        
        <?php 
            if(isset($_SESSION['studentId'])){
        ?>
            <div style="margin-bottom: 30px"><h2> Courses </h2></div>
            <?php
                $getCourseId = "SELECT * FROM enrollment WHERE studentId = '$studentId'";
                    $getCourseIdResult = mysqli_query($conn, $getCourseId);

                    if ($getCourseIdResult && mysqli_num_rows($getCourseIdResult) > 0) {
                        while ($row = mysqli_fetch_assoc($getCourseIdResult)) {
                            $courseId = $row['courseId'];

                            $getCourses = "SELECT * FROM course WHERE courseId = '$courseId'";
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
                                    </div>
            <?php
                                }
                            }
                        }
                    }
                    else{
                        echo '<h3 id="empty">You have not selected any course.</h3>';
                    }

            ?>

        <?php }?>

        <?php 
            if(isset($_SESSION['teacherId'])){
        ?>
            <div style="margin-bottom: 30px"><h2> Courses </h2></div>
            <?php
                $getCourseId = "SELECT * FROM courseTeacher WHERE teacherId = '$teacherId'";
                    $getCourseIdResult = mysqli_query($conn, $getCourseId);

                    if ($getCourseIdResult && mysqli_num_rows($getCourseIdResult) > 0) {
                        while ($row = mysqli_fetch_assoc($getCourseIdResult)) {
                            $courseId = $row['courseId'];

                            $getCourses = "SELECT * FROM course WHERE courseId = '$courseId'";
                            $getCoursesResult = mysqli_query($conn, $getCourses);

                            if ($getCoursesResult && mysqli_num_rows($getCoursesResult) > 0) {
                                while ($row = mysqli_fetch_assoc($getCoursesResult)) {
                                    $courseId = $row['courseId'];
                                    $courseCode = $row['courseCode'];
                                    $courseName = $row['courseName'];
                                    $courseDepartment = $row['department'];
                                    $credits = $row['credits'];
            ?>
                                    <div class="courses">
                                        <div><h3> <?php echo $courseCode; ?>: <?php echo $courseName; ?> </h3></div>
                                        <div><h3> <?php echo $courseDepartment; ?> </h3></div>
                                        <div><h3> Credits: <?php echo $credits; ?> </h3></div>
                                    </div>
            <?php
                                }
                            }
                        }
                    }
                    else{
                        echo '<h3 id="empty">You have not selected any course.</h3>';
                    }

            ?>

        <?php }?>

        <?php
            if (!isset($_SESSION['adminId']) && !isset($_SESSION['teacherId']) && !isset($_SESSION['studentId'])){
                echo '';
            } else{
        ?>
            <a href="Logout.php"><button style="width: 100%; color: white; background-color: red; font-weight: bold; margin-bottom: 40px; margin-top: 50px; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">Logout</button></a>
        <?php
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
    <script src="JS/function.js"> </script>
</html>