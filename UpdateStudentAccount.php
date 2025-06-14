<?php
include 'connect.php';
session_start();

if (isset($_GET['courseId']) && isset($_GET['studentId'])) {
    $studentId = $_GET['studentId'];
    $courseId = $_GET['courseId'];

    $getStudentDetails = "SELECT * FROM students WHERE studentId = $studentId";
    $getStudentDetailsResult = mysqli_query($conn, $getStudentDetails);
    $row = mysqli_fetch_assoc($getStudentDetailsResult);

    $previousMatricNumber = htmlspecialchars($row['matricNumber']);
    $previousFullName = htmlspecialchars($row['fullName']);
    $previousDOB = htmlspecialchars($row['DOB']);
    $previousGender = htmlspecialchars($row['gender']);
    $previousEmail = htmlspecialchars($row['email']);
    $previousPhone = htmlspecialchars($row['phoneNumber']);
    $previousDepartment = htmlspecialchars($row['department']);
    $previousLevel = htmlspecialchars($row['level']);
    $previousRegistrationDate = htmlspecialchars($row['registrationDate']);
}else{
    $previousMatricNumber = "";
    $previousFullName = "";
    $previousDOB = "";
    $previousGender = "";
    $previousEmail = "";
    $previousPhone = "";
    $previousDepartment = "";
    $previousLevel = "";
    $previousRegistrationDate = "";

    echo '<h2 style="">You are not logged in</h2>
                        <div class="courses-button"><a href="Index.html">Login</a></div>';
}


$getDepartments = "SELECT * FROM department";
$getDepartmentsResult = mysqli_query($conn, $getDepartments);

if (isset($_POST['submit'])) {
    $matricNumber = $_POST['mNumber'];
    $fullName = $_POST['fName'];
    $DOB = $_POST['DOB'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['pNumber'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $registrationDate = date("Y-m-d");

    $updateQuery = "UPDATE students 
        SET 
            matricNumber = '$matricNumber',
            fullName = '$fullName',
            DOB = '$DOB',
            gender = '$gender',
            email = '$email',
            phoneNumber = '$phoneNumber',
            department = '$department',
            level = '$level',
            registrationDate = '$registrationDate'
        WHERE studentId = $studentId";

    if ($conn->query($updateQuery) === TRUE) {
        header("Location: ./ViewStudentDetails.php?studentId=".urlencode($studentId)."&courseId=".urlencode($courseId)."");
        exit();
    } else {
        echo "Error updating student: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Update Student Details</title>
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
        <h2> Update Student Details </h2>
        
        <form id="registerForm" method="post" action="">
            <input type="text" id="matricNumber" name="mNumber" value="<?php echo $previousMatricNumber; ?>" placeholder="Matriculation Number" required><br>
            <input type="text" id="fullname" name="fName" value="<?php echo $previousFullName; ?>" placeholder="Full Name (Surname + Firstname)" required><br>
            <p>Date of Birth</p>
            <input type="date" id="DOB" name="DOB" value="<?php echo $previousDOB; ?>" required><br>
            
            <select id="gender" name="gender" required>
                <option value="" disabled>Select Gender</option>
                <option value="Male" <?php if($previousGender == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if($previousGender == 'Female') echo 'selected'; ?>>Female</option>
            </select><br>

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

            <select id="Level" name="level" required>
                <option value="" disabled>Select Level</option>
                <?php
                    foreach ([100, 200, 300, 400, 500, 600] as $lvl) {
                        $selected = ($previousLevel == $lvl) ? 'selected' : '';
                        echo "<option value=\"$lvl\" $selected>{$lvl}L</option>";
                    }
                ?>
            </select><br>

            <input type="email" id="email" name="email" value="<?php echo $previousEmail; ?>" placeholder="Email" required><br>
            <input type="text" id="pNumber" name="pNumber" value="<?php echo $previousPhone; ?>" placeholder="Phone Number" required><br>

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

    <script>
        let phoneNumber = document.getElementById('pNumber');

        registerForm.addEventListener('submit', function(event) {
            if (!/^\d+$/.test(phoneNumber.value)) {
                event.preventDefault();
                alert('Phone number must contain only digits.');
                return;
            }
        });

    </script>

    <script src="JS/function.js"></script>
</body>
</html>