
<!-- // session_start();
// include "../engin/database.php";
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   $schoolId = $_SESSION["school_id"];
//   $examNo =  $_SESSION['examNO'];
//   $examid = $_POST['examid'];
//   $answers = $_POST['option']; // array of selected answers

//   // Save the answers to the database
//   foreach ($answers as $questionId => $answer) {
//     mysqli_query($conn, "INSERT INTO exam_answers (schoolID, examid, questionid, examNO, answer) VALUES ('$schoolId', '$examid', '$questionId','$examNo', '$answer')");
//   }
//  echo "done";
//   // Redirect the user to a result page
// //   $redirect_url = 'result.php?examid=' . $examid;
// //   header("Location: $redirect_url");
//   exit();
// } -->

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "../engine/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $schoolId = $_SESSION["school_id"];
  $examNo = $_SESSION['examNO'];
  $examid = $_POST['examid'];
  $answers=  $_POST['options']; // array of selected answers
  $questionId=$_POST['questionIds'];
//   $answers = "option" . $answer;

//   var_dump($schoolId, $examNo, $examid, $answers);
  // Validate the input data
  if (!empty($schoolId) && !empty($examNo) && !empty($examid) && is_array($answers)) {
    // Save the answers to the database
// foreach ($answers as $questionId => $answer) {
//     $answerString = "option" . $answer; // Concatenate the answer with "option"
//     mysqli_query($conn, "INSERT INTO exam_answers (schoolID, examid, questionid, examNO, answer) VALUES ('$schoolId', '$examid', '$questionId', '$examNo', '$answerString')");
// }
    // Prepare the INSERT statement
    $stmt = mysqli_prepare($conn, "INSERT INTO exam_answers (school_id, examid, question_id, examNO, answer) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters and execute the statement for each answer
    foreach ($answers as $questionId => $answer) {
    $answerString = "option" . $answer; // Concatenate the answer with "option"
    echo $answerString;
      mysqli_stmt_bind_param($stmt, "iiiss", $schoolId, $examid, $questionId, $examNo, $answerString);
      mysqli_stmt_execute($stmt);
    }

    // Check if any rows were affected
    $rowsAffected = mysqli_stmt_affected_rows($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    if ($rowsAffected > 0) {
      echo "Answers inserted successfully!";
      // Redirect the user to a result page
//  
$redirect_url = 'result.php?examid=' . $examid . '&queid=' . $questionId;

header("Location: $redirect_url");
//   exit();
    } else {
      echo "No rows were affected.";
    }
  } else {
    echo "Invalid input data.";
  }

  // Close the database connection
  mysqli_close($conn);
} else {
    echo "Not set";
}
?>
