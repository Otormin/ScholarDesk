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
    <title>Scholar Desk - Student Sign Up</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">

</head>
<body>
    <div class="Container"> 
        <h2 style="margin-top: 100px;"> Welcome to Scholar Desk </h2>
        
        <form id="registerForm" method="post" action="./StudentRegisterAccount.php">
            <input type="text" id="matricNumber" name="mNumber" placeholder="Matriculation Number" required> <br>
            <input type="text" id="fullname" name="fName" placeholder="Full Name (Surname + Firstname)" required> <br>
            <p>Date of Birth</p>
            <input type="date" id="DOB" name="DOB" required> <br>
            <select id="gender" name="gender">
                <option value="" disabled selected> Select Gender</option>
                <option value="Male"> Male </option>
                <option value="Female"> Female </option>
            </select> <br>

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

            <select id="Level" name="level" required>
                <option value="" disabled selected> Select Level </option>
                <option value="100"> 100L </option>
                <option value="200"> 200L </option>
                <option value="300"> 300L </option>
                <option value="400"> 400L </option>
                <option value="500"> 500L </option>
                <option value="600"> 600L </option>
            </select> <br>


            <input type="email" id="email" name="email" placeholder="Email" required> <br>
            <input type="text" id="pNumber" name="pNumber" placeholder="Phone Number" required> <br>

            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <img src="Images/hide.png" alt="Toggle Password" class="eye-icon" onclick="togglePassword()">
            <div class="password-container">
                <input type="password" id="confirm-password" placeholder="Confirm Password" required>
                <img src="Images/hide.png" alt="Toggle Password" class="eye-icon" onclick="togglePassword()">
                <p id="passwordError" style="color: red; display: none;">Passwords do not match</p>
            </div>         
    </div>
    <p class="terms"> Already have an account? <a href="LoginAsStudent.html"> Log In </a></p>
    <button type="submit"> Sign up </button>
    <p class="terms"> By continuing, you agree to the <a href="#"> Terms and Conditions</a>. Read our <a href="#"> Privacy Policy</a>.</p> <br>
        
    </form>

    <script>
        let registerForm = document.getElementById('registerForm')
        let password = document.getElementById('password')
        let phoneNumber = document.getElementById('pNumber');
        let confirmPassword = document.getElementById('confirm-password')
        let passwordError = document.getElementById("passwordError")

        registerForm.addEventListener('submit', function(event) {
            if (!/^\d+$/.test(phoneNumber.value)) {
                event.preventDefault();
                alert('Phone number must contain only digits.');
                return;
            }

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