<?php
include 'connect.php';

if (isset($_GET['studentId'])) {
    $studentId = $_GET['studentId'];
    $getStudentDetails = "SELECT * FROM students WHERE studentId = $studentId";
    $getStudentDetailsResult = mysqli_query($conn, $getStudentDetails);
    $row = mysqli_fetch_assoc($getStudentDetailsResult);

    $previousLevel = htmlspecialchars($row['level']);
}else{
    $previousLevel = null;
}


if(isset($_POST['submit'])){
    $level = $_POST['level'];
    $password = $_POST['password'];
    $password = md5($password);
    
    $insertQueue = "UPDATE students SET password = '$password', level = '$level' WHERE studentId = $studentId";

    if($conn->query($insertQueue)==TRUE){
        header("Location: ./Profile.php");
        exit();
    }
    else{
        echo "Error Updating Student password:".$conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Student Details</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">

</head>
<body>
    <div class="Container"> 
        <h2> Change Password </h2>
            <form id="passwordForm" method="post">
                <select id="Level" name="level" required>
                    <option value="" disabled>Select Level</option>
                    <?php
                        foreach ([100, 200, 300, 400, 500, 600] as $lvl) {
                            $selected = ($previousLevel == $lvl) ? 'selected' : '';
                            echo "<option value=\"$lvl\" $selected>{$lvl}L</option>";
                        }
                    ?>
                </select><br>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <img src="Images/hide.png" alt="Toggle Password" class="eye-icon" onclick="togglePassword()">
                <div class="password-container">
                    <input type="password" id="confirm-password" placeholder="Confirm Password" required>
                    <img src="Images/hide.png" alt="Toggle Password" class="eye-icon" onclick="togglePassword()">
                    <p id="passwordError" style="color: red; display: none;">Passwords do not match</p>
                </div> 
                <?php
                if (isset($_GET['studentId'])) {
                ?>
                        <button type="submit" name="submit">Change</button>
                <?php
                    }else{
                ?>
                        <p style="padding-bottom: 20px">You are not logged in. <a href="Index.html">Login</a></p>
                        <a href="index.html"><button>Change</button></a>
                <?php
                    }
                ?>
            </form>
    </div>
    <script>
        let passwordForm = document.getElementById('passwordForm')
        let password = document.getElementById('password')
        let confirmPassword = document.getElementById('confirm-password')
        let passwordError = document.getElementById("passwordError")

        passwordForm.addEventListener('submit', function(event) {
            if (password.value !== confirmPassword.value) {
                event.preventDefault();
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }
        });
    </script>

    <script src="JS/function.js"></script>
</body>
</html>