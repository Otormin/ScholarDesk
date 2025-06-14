<?php
include 'connect.php';
session_start();

if (isset($_GET['courseId'])) {
    $courseId = $_GET['courseId'];

    $getCourseDetails = "SELECT * FROM course WHERE courseId = $courseId";
    $getCourseDetailsResult = mysqli_query($conn, $getCourseDetails);
    $row = mysqli_fetch_assoc($getCourseDetailsResult);

    $previousCourseCode = htmlspecialchars($row['courseCode']);
    $previousCourseName = htmlspecialchars($row['courseName']);
    $previousCredits = htmlspecialchars($row['credits']);
    $previousPassingGrade = htmlspecialchars($row['passingGrade']);
    $previousDepartment = htmlspecialchars($row['department']);
    $previousSemester = htmlspecialchars($row['semester']);
    $previousLevel = htmlspecialchars($row['level']);
}
else{
    $previousCourseCode = "";
    $previousCourseName = "";
    $previousCredits = "";
    $previousPassingGrade = "";
    $previousDepartment = "";
    $previousSemester = "";
    $previousLevel = "";

    echo '<h2 style="">You are not logged in</h2>
                        <div class="courses-button"><a href="Index.html">Login</a></div>';
}

$getDepartments = "SELECT * FROM department";
$getDepartmentsResult = mysqli_query($conn, $getDepartments);

if (isset($_POST['submit'])) {
    $courseCode = $_POST['cCode'];
    $courseName = $_POST['cName'];
    $credits = $_POST['credits'];
    $passingGrade = $_POST['pGrade'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $level = $_POST['level'];

    $updateQuery = "UPDATE course 
        SET 
            courseCode = '$courseCode',
            courseName = '$courseName',
            credits = '$credits',
            passingGrade = '$passingGrade',
            department = '$department',
            semester = '$semester',
            level = '$level'
        WHERE courseId = '$courseId'";

    if ($conn->query($updateQuery) === TRUE) {
        header("Location: ./ViewCourseDetails.php?courseId=".urlencode($courseId)."");
        exit();
    } else {
        echo "Error updating course: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Update Course</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">

    <style>
        .courses-button {
            font-size: 14px;
            padding: 12px 20px;
            background: #ebebeb;
            border-radius: 15px;
            border: none;
            cursor: pointer; 
        }

        .courses-button a {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <div class="Container"> 
        <h2> Update Course</h2>
        
        <form id="courseForm" method="post">
            <input type="text" id="courseCode" name="cCode" value="<?php echo $previousCourseCode; ?>" placeholder="Enter Course code" required> <br>
            <input type="text" id="courseName" name="cName" value="<?php echo $previousCourseName; ?>" placeholder="Enter Course name" required> <br>
            <input type="number" id="credits" name="credits" value="<?php echo $previousCredits; ?>" placeholder="Credits" required> <br>
            <input type="number" id="pGrade" name="pGrade" value="<?php echo $previousPassingGrade; ?>" placeholder="Passing Grade" required> <br>
            
            <select id="department" name="department" required>
                <option value="" disabled>Select Department</option>
                <?php
                    if ($getDepartmentsResult) {
                        while ($dept = mysqli_fetch_assoc($getDepartmentsResult)) {
                            $departmentName = htmlspecialchars($dept['departmentName']);
                            $selected = ($departmentName == $previousDepartment) ? 'selected' : '';
                            echo "<option value=\"$departmentName\" $selected>$departmentName</option>";
                        }
                    }
                ?>
            </select><br>

            <select id="semester" name="semester" required>
                <option value="" disabled selected>Select Semester</option>
                <option value="1st Semester" <?php if($previousSemester == '1st Semester') echo 'selected'; ?>>1st Semester</option>
                <option value="2nd Semester" <?php if($previousSemester == '2nd Semester') echo 'selected'; ?>>2nd Semester</option>
            </select> <br>

            <select id="Level" name="level" required>
                <option value="" disabled>Select Level</option>
                <?php
                    foreach ([100, 200, 300, 400, 500, 600] as $lvl) {
                        $selected = ($previousLevel == $lvl) ? 'selected' : '';
                        echo "<option value=\"$lvl\" $selected>{$lvl}L</option>";
                    }
                ?>
            </select><br>
            <?php
                if (isset($_GET['courseId'])) {
            ?>
                    <button type="submit" name="submit">Update</button>
            <?php
                }else{
            ?>
                    <a href="index.html"><button>Update</button></a>
            <?php
                }
            ?>
        </form>
    </div>

    <script src="JS/function.js"></script>
</body>
</html>