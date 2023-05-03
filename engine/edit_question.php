<?php 
include "database.php";
if(isset($_GET['examid']) && isset($_GET['question_id'])){
    $examId=$_GET["examid"];
    $questionId = $_GET['question_id'];
    // sql to delete a record
    $sql = "DELETE FROM questions WHERE id='$questionId' AND examid='$examId'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Record deleted successfully");window.location.href="../online_exam/question.php?postid='.$examId.'"</script>';

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}





?>