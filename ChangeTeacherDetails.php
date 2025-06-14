<?php
include 'connect.php';

if (isset($_GET['teacherId'])) {
    $teacherId = $_GET['teacherId'];

    $getTeacherDetails = "SELECT * FROM teachers WHERE teacherId = $teacherId";
    $getTeacherDetailsResult = mysqli_query($conn, $getTeacherDetails);
    $row = mysqli_fetch_assoc($getTeacherDetailsResult);

    $previousFullName = htmlspecialchars($row['fullName']);
    $previousEmail = htmlspecialchars($row['email']);
    $previousPhoneNumber = htmlspecialchars($row['phoneNumber']);
}
else{
    $previousFullName = "";
    $previousEmail = "";
    $previousPhoneNumber = "";
}

if(isset($_POST['submit'])){
    $fullName = $_POST['fName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['pNumber'];
    $password = $_POST['password'];
    $password = md5($password);
    
    $insertQueue = "UPDATE teachers SET fullName = '$fullName', email = '$email', phoneNumber = '$phoneNumber', password = '$password' WHERE teacherId = $teacherId";

    if($conn->query($insertQueue)==TRUE){
        header("Location: ./Profile.php");
        exit();
    }
    else{
        echo "Error Updating Teacher password:".$conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Teacher Details</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">

</head>
<body>
    <div class="Container"> 
        <h2> Change Details </h2>
        <form id="passwordForm" method="post">
            <input type="text" id="fullname" name="fName" value="<?php echo $previousFullName; ?>" placeholder="Full Name (Surname + Firstname)" required> <br>
            <input type="email" id="email" name="email" value="<?php echo $previousEmail; ?>" placeholder="Email" required> <br>
            <input type="text" id="pNumber" name="pNumber" value="<?php echo $previousPhoneNumber; ?>" placeholder="Phone Number" required> <br>

            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <img src="Images/hide.png" alt="Toggle Password" class="eye-icon" onclick="togglePassword()">
            <div class="password-container">
                <input type="password" id="confirm-password" placeholder="Confirm Password" required>
                <img src="Images/hide.png" alt="Toggle Password" class="eye-icon" onclick="togglePassword()">
                <p id="passwordError" style="color: red; display: none;">Passwords do not match</p>
            </div> 
            <?php
                if (isset($_GET['teacherId'])) {
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
        let phoneNumber = document.getElementById('pNumber');
        let confirmPassword = document.getElementById('confirm-password')
        let passwordError = document.getElementById("passwordError")

        passwordForm.addEventListener('submit', function(event) {
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