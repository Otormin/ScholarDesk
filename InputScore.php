<?php
include 'connect.php';

if (isset($_GET['studentId']) && isset($_GET['courseId'])) {
    $studentId = $_GET['studentId'];
    $courseId = $_GET['courseId'];

    $getScore = "SELECT * FROM grade WHERE studentId = $studentId AND courseId = $courseId";
    $getScoreResult = mysqli_query($conn, $getScore);
    $row = mysqli_fetch_assoc($getScoreResult);

    $previousScore = htmlspecialchars($row['score']);

    $checkIfCompleted = "SELECT * FROM enrollment WHERE studentId = $studentId AND courseId = $courseId";
    $checkIfCompletedResult = mysqli_query($conn, $checkIfCompleted);
    $check = mysqli_fetch_assoc($checkIfCompletedResult);

    $isCompleted = htmlspecialchars($check['isCompleted']);

    $getCoursePassingGrade = "SELECT * FROM course WHERE courseId = $courseId";
    $getCoursePassingGradeResult = mysqli_query($conn, $getCoursePassingGrade);
    $passing = mysqli_fetch_assoc($getCoursePassingGradeResult);

    $passingGrade = htmlspecialchars($passing['passingGrade']);
}else{
    $studentId = null;
    $courseId = null;
    $previousScore = null;
    $isCompleted = null;
    $passingGrade = null;
}


if(isset($_POST['submit'])){
    $score=$_POST['score'];

    $newScore = $previousScore + $score;

    if($newScore <= 100){
        $updateQueue = "UPDATE grade SET score = '$newScore' WHERE studentId = $studentId AND courseId = $courseId";

        $updateQueueResult = mysqli_query($conn, $updateQueue);

        if ($updateQueueResult) {
            if($newScore > $passingGrade){
                $isCompleted = 1;
                $updateCompletion = "UPDATE enrollment SET isCompleted = '$isCompleted' WHERE studentId = $studentId AND courseId = $courseId";
        
                if ($updateQueueResult) {
                    header("Location: ./ViewStudentTeacher.php?courseId=".urlencode($courseId)."");
                    exit();
                }
                else {
                    echo "Error updating grade: " . $conn->error;
                }
            }else{
                $isCompleted = 0;
                $updateCompletion = "UPDATE enrollment SET isCompleted = '$isCompleted' WHERE studentId = $studentId AND courseId = $courseId";
                if ($updateQueueResult) {
                    header("Location: ./ViewStudentTeacher.php?courseId=".urlencode($courseId)."");
                    exit();
                }
                else {
                    echo "Error updating grade: " . $conn->error;
                }
            }
        }
        else {
            echo "Error updating grade: " . $conn->error;
        }
    }
    else{
        echo 'Score can not be above 100.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Desk - Input Score</title>
    <link rel="stylesheet" href="CSS/SignpUp.css">

</head>
<body>
    <div class="Container"> 
        <h2> Input Score </h2>
        <p style="margin-bottom: 30px;">The score you input here will be added to the overall score</p>
        <p>Overall Score = <?php echo $previousScore; ?></p>
        <form id="gradeForm" method="post">
            <input style="" type="number" id="score" name="score" placeholder="The score you input here will be added to the overall score" value="<?php echo $previousScore; ?>" required> <br>
            <?php
                if (isset($_GET['studentId']) && isset($_GET['courseId'])) {
            ?>
                    <button type="submit" name="submit">Add Score</button>
            <?php
                }else{
            ?>
                    <p style="padding-bottom: 20px">You are not logged in. <a href="Index.html">Login</a></p>
                    <a href="index.html"><button>Add Score</button></a>
            <?php
                }
            ?>
        </form>
    </div>

    <script src="JS/function.js"></script>
</body>
</html>