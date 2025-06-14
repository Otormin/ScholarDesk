<?php
include 'connect.php';

if (isset($_GET['studentId']) && isset($_GET['courseId'])) {
    $studentId = $_GET['studentId'];
    $courseId = $_GET['courseId'];

    $getStudentScore = "SELECT * FROM grade WHERE studentId = $studentId AND courseId = $courseId";
    $getStudentScoreResult = mysqli_query($conn, $getStudentScore);
    $row = mysqli_fetch_assoc($getStudentScoreResult);

    $previousScore = htmlspecialchars($row['score']);

    $checkIfCompleted = "SELECT * FROM enrollment WHERE studentId = $studentId AND courseId = $courseId";
    $checkIfCompletedResult = mysqli_query($conn, $checkIfCompleted);
    $check = mysqli_fetch_assoc($checkIfCompletedResult);

    $isCompleted = htmlspecialchars($check['isCompleted']);

    $getCoursePassingGrade = "SELECT * FROM course WHERE courseId = $courseId";
    $getCoursePassingGradeResult = mysqli_query($conn, $getCoursePassingGrade);
    $passing = mysqli_fetch_assoc($getCoursePassingGradeResult);

    $passingGrade = htmlspecialchars($passing['passingGrade']);
}
else{
    $studentId = null;
    $courseId = null;
    $previousScore = null;
    $isCompleted = null;
    $passingGrade = null;
}

if(isset($_POST['submit'])){
    $score = $_POST['score'];

    if($score <= 100){
        $insertQueue = "UPDATE grade SET score = '$score' WHERE studentId = $studentId AND courseId = $courseId";

        if($conn->query($insertQueue)==TRUE){
            if($score > $passingGrade){
                $isCompleted = 1;
                $updateCompletion = "UPDATE enrollment SET isCompleted = '$isCompleted' WHERE studentId = $studentId AND courseId = $courseId";
        
                if($conn->query($updateCompletion)==TRUE){
                    header("Location: ./ViewStudentDetails.php?studentId=".urlencode($studentId)."&courseId=".urlencode($courseId)."");
                    exit();
                }
                else{
                    echo "Error Updating completion:".$conn->error;
                }
            }else{
                $isCompleted = 0;
                $updateCompletion = "UPDATE enrollment SET isCompleted = '$isCompleted' WHERE studentId = $studentId AND courseId = $courseId";
                if($conn->query($updateCompletion)==TRUE){
                    header("Location: ./ViewStudentDetails.php?studentId=".urlencode($studentId)."&courseId=".urlencode($courseId)."");
                    exit();
                }
                else{
                    echo "Error Updating completion:".$conn->error;
                }
            }
        }
        else{
            echo "Error Updating score:".$conn->error;
        }
    }
    else{
        echo 'Score can not be more than 100.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Change Grade</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">

</head>
<body>
    <div class="Container"> 
        <h2> Change Score </h2>
        <p style="margin-bottom: 30px;">The score you input here will override the current score</p>
        <p>Current Score = <?php echo $previousScore; ?></p>
        <form id="departmentForm" method="post">
            <input type="number" id="score" name="score" placeholder="Score" value="<?php echo $previousScore; ?>" required> <br>
            <?php
                if (isset($_GET['studentId']) && isset($_GET['courseId'])) {
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

    <script src="JS/function.js"></script>
</body>
</html>