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
                $studentEmail = htmlspecialchars($row['email']);
                $department = htmlspecialchars($row['department']);
                $level = htmlspecialchars($row['level']);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Homepage</title>
    <link rel="stylesheet" href="CSS/homepage.css">

    <style>
        .hero-section {
            background-image: url('Images/desola-lanre-ologun-IgUR1iX0mqM-unsplash.jpg');
            background-size: cover;
            background-position: center;
            height: 530px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 80px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .welcome-text {
            color: white;
            font-size: 2.5rem;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px 30px;
            border-radius: 10px;
            z-index: 1;
        }

        .homepage-button {
            font-size: 14px;
            padding: 12px 20px;
            background: #ebebeb;
            border-radius: 15px;
            border: none;
            cursor: pointer; 
        }

        .homepage-button a {
            font-size: 2rem;
            font-weight: bold;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
<header class="header">
        <div class="logo"><a href="#">Scholar Desk <img src="Icons/my courses.png" alt="logo"></a></div>
    </header>

    <div class="container">
        <div class="hero-section">
            <?php if(isset($_SESSION['adminId'])){ ?>
                <h2 class="welcome-text">Welcome, <?php echo $adminEmail; ?>.</h2>
            <?php } elseif(isset($_SESSION['teacherId'])){ ?>
                <h2 class="welcome-text">Welcome, <?php echo $teacherFullName; ?>.</h2>
            <?php } elseif(isset($_SESSION['studentId'])){ ?>
                <h2 class="welcome-text">Welcome, <?php echo $studentFullName; ?>.</h2>
            <?php } else{?>
                <h2 class="welcome-text">You are not logged in</h2>
                <div class="homepage-button"><a href="Index.html">Login</a></div>
            <?php }?>
        </div>            
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