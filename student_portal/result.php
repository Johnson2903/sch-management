
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "../engine/database.php";

if (isset($_GET['exam_id']) && isset($_SESSION["school_id"]) ) {
    $schoolId = $_SESSION["school_id"];
    $examid = $_GET['exam_id'];
    // $question_id=$_GET['queid'];
    // Retrieve the exam details
    $exam_result = mysqli_query($conn, "SELECT * FROM examtimetable WHERE schoolID= $schoolId AND examid = $examid");

    if ($exam_result->num_rows > 0) {
        $exam_row = mysqli_fetch_assoc($exam_result);
        $exam_name = $exam_row['subj'];
        // Retrieve the answers from the database
        $answers_result = mysqli_query($conn, "SELECT * FROM exam_answers WHERE examid = $examid");

        // Display the exam result
        echo "<h2 stlye='text-align:center;'>Exam Result - $exam_name</h2>";

        if ($answers_result->num_rows > 0) {
            $total_questions = $answers_result->num_rows;
            $correct_answers = 0;

            while ($answer_row = mysqli_fetch_assoc($answers_result)) {
                $question_id = $answer_row['question_id'];
                $selected_option = $answer_row['answer'];

                // Retrieve the correct answer for each question
                $question_result = mysqli_query($conn, "SELECT * FROM questions WHERE id = $question_id");
                $question_row = mysqli_fetch_assoc($question_result);
                $correct_option = $question_row['answer'];

                // Check if the selected option matches the correct option
                if ($selected_option == $correct_option) {
                    $correct_answers++;
                }
            }

            // Calculate the percentage of correct answers
            $percentage = ($correct_answers / $total_questions) * 100;
            
            // echo "<p>Total Questions: $total_questions</p>";
            // echo "<p>Correct Answers: $correct_answers</p>";
            // echo "<p>Percentage: $percentage%</p>";
            echo <<<HTML
            <div class="result-container">
              <h2>Exam Result</h2>
              <p>Total Questions: $total_questions</p>
              <p>Correct Answers: $correct_answers</p>
              <p>Percentage: $percentage%</p>
            </div>
            HTML;



        } else {
            echo "<p>No answers found for this exam.</p>";
        }
    } else {
        echo "<p>Exam not found.</p>";
    }
} else {
    // echo "<p>Invalid exam ID.</p>";
    header("location: index.php");
}
?>


<style>
    .result-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f5f5f5;
      text-align: center;
    }

    .result-container h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .result-container p {
      font-size: 18px;
      margin-bottom: 10px;
    }
  </style>