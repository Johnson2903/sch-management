<?php
session_start();
 require_once "database.php";
 if(isset( $_SESSION["school_id"]) AND $_POST['examid'] ){
    $schoolId=$_SESSION["school_id"];
    $examid = $_POST["examid"];
    $question = $_POST["question"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];
    $answer = $_POST["answer"];
    // echo $answer;
    
    $sql = "INSERT INTO questions (examid,schoolId, question, option1, option2, option3, option4, answer) VALUES ('$examid','$schoolId', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')";
    
    if (mysqli_query($conn, $sql)) {
      echo '<div class="alert alert-success">Question added successfully!</div>';
    } else {
      echo '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
  }

?>