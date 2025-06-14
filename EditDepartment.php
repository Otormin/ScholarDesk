<?php
include 'connect.php';

if (isset($_GET['departmentId'])) {
    $departmentId = $_GET['departmentId'];

    $departmentDetails = "SELECT * FROM department WHERE departmentId = $departmentId";
    $departmentDetailsResult = mysqli_query($conn, $departmentDetails);
    $row = mysqli_fetch_assoc($departmentDetailsResult);

    $previousDepartmentName = htmlspecialchars($row['departmentName']);
}
else{
    $departmentId = null;
    $previousDepartmentName = null;
}

if(isset($_POST['submit'])){
    $departmentName=$_POST['dName'];

    $updateQueue = "UPDATE department SET departmentName = '$departmentName' WHERE departmentId = $departmentId";

    $updateQueueResult = mysqli_query($conn, $updateQueue);

    if ($updateQueueResult) {
        header("Location: ./ViewDepartments.php");
    }
    else {
        echo "Error updating department Name: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Edit Department</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">

</head>
<body>
    <div class="Container"> 
        <h2> Edit Department </h2>
        
        <form id="departmentForm" method="post">
            <input type="text" id="dName" name="dName" placeholder="Department Name" value="<?php echo $previousDepartmentName; ?>" required> <br>
            <?php
                if (isset($_GET['departmentId'])) {
            ?>
                    <button type="submit" name="submit">Edit</button>
            <?php
                }else{
            ?>
                    <p style="padding-bottom: 20px">You are not logged in. <a href="Index.html">Login</a></p>
                    <a href="index.html"><button>Edit</button></a>
            <?php
                }
            ?>
        </form>
    </div>

    <script src="JS/function.js"></script>
</body>
</html>