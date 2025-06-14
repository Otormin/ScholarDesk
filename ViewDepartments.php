<?php 
include 'connect.php';

session_start();

$getDepartments = "SELECT * FROM department";

$getDepartmentsResult = mysqli_query($conn, $getDepartments);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Departments</title>
    <link rel="stylesheet" href="CSS/MyCourses.css">

    <style>
        .createDepartmentBtnContainer{
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
        <h2> Select Department </h2>
                <?php if(isset($_SESSION['adminId'])){?>
                    <div class="createDepartmentBtnContainer">
                        <a href="CreateDepartment.php"><button class="courses-button" style="background-color: #007bff; color: white; padding: 1rem 1rem; font-size: 1rem">Create Department</button></a>
                    </div>
                <?php }?>
                <?php
                    if(isset($_SESSION['adminId']) || isset($_SESSION['teacherId'])){
                ?>
                    <div class="courses-container">
                        <?php
                            if($getDepartmentsResult){
                                while($row = mysqli_fetch_assoc($getDepartmentsResult)){
                                    $departmentName = htmlspecialchars($row['departmentName']);

                                    echo '<div class="courses">
                                                <div><h3> '.$departmentName.'</h3></div>
                                                <div class="courses-button"><a href="Level.php?department='.$departmentName.'"> Select Level </a></div>
                                            </div>';
                                }
                            }
                            else{
                                echo 'No Departments available.';
                            }
                        ?>
                    </div>
                <?php
                    }else{
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