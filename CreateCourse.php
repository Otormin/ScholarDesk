<?php
    include 'connect.php';

    session_start();

    if(isset($_SESSION['adminId'])) {
        $adminId = $_SESSION['adminId'];

        $getDepartments = "SELECT * FROM department";

        $getDepartmentsResult = mysqli_query($conn, $getDepartments);

    } else {
        $adminId = null;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Desk - Create Course</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">
</head>
<body>
    <div class="Container"> 
        <h2>Create Course</h2>

        <form id="resourceForm" method="post" action="Course.php">
            <input type="text" id="courseCode" name="cCode" placeholder="Enter Course code" required> <br>
            <input type="text" id="courseName" name="cName" placeholder="Enter Course name" required> <br>
            <input type="number" id="credits" name="credits" placeholder="Credits" required> <br>
            <input type="number" id="pGrade" name="pGrade" placeholder="Passing Grade" required> <br>            

            <select id="department" name="department" required>
                <option value="" disabled selected> Select Department</option>
            <?php
                if($getDepartmentsResult){
                    while($row = mysqli_fetch_assoc($getDepartmentsResult)){
                        $departmentName = htmlspecialchars($row['departmentName']);

                        echo '<option value="'.$departmentName.'"> '.$departmentName.' </option>';
                    }
                }
            ?>
            </select> <br>

            <select id="semester" name="semester" required>
                <option value="" disabled selected>Select Semester</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
            </select> <br>

            <select id="Level" name="level" required>
                <option value="" disabled selected> Select Level </option>
                <option value="100"> 100L </option>
                <option value="200"> 200L </option>
                <option value="300"> 300L </option>
                <option value="400"> 400L </option>
                <option value="500"> 500L </option>
                <option value="600"> 600L </option>
            </select> <br>
            <?php
                if (isset($_SESSION['adminId'])) {
                ?>
                        <button type="submit" name="submit">Create</button>
                <?php
                    }else{
                ?>
                        <p style="padding-bottom: 20px">You are not logged in. <a href="Index.html">Login</a></p>
                        <a href="index.html"><button>Create</button></a>
                <?php
                    }
            ?>
        </form>
    </div>
</body>
</html>