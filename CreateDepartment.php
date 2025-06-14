<?php
    include 'connect.php';

    session_start();

    if(isset($_SESSION['adminId'])) {
        $adminId = $_SESSION['adminId'];
    } else {
        $adminId = null;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Create Department</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">

</head>
<body>
    <div class="Container"> 
        <h2> Create Department </h2>
        
        <form id="departmentForm" method="post" action="./Department.php">
            <input type="text" id="departmentName" name="dName" placeholder="Department Name" required> <br>
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

    <script src="JS/function.js"></script>
</body>
</html>