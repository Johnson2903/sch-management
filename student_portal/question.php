<?php
session_start();
require_once "../engine/database.php";
if(isset( $_SESSION["school_id"]) AND $_GET['postid'] AND $_SESSION["student_regno"] ){
$schoolId=$_SESSION["school_id"];
$schoolName= $_SESSION["school_name"];
$examid=$_GET['postid'];
$student=$_SESSION["student_regno"];
$result = mysqli_query($conn, "SELECT * FROM examtimetable  WHERE examid=$examid AND schoolID=$schoolId");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $subject=$row["subj"];
      $class=$row["class"];
      $hall=$row["classroom"];
      $examdate=$row["examdate"];
      $readable_date = date("F j, Y", strtotime($examdate));
      $readable_time=date("h:i A", strtotime($row["examTime"]));
      $readable_endtime=date("h:i A", strtotime($row["endTime"]));

      
    }
  } else {
    echo "0 results";
  }  
  
 
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php echo $subject?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>

  <style>
    /* @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap'); */

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    background-color: #333;
}
.container{
    background-color: #555;
    color: #ddd;
    border-radius: 10px;
    padding: 20px;
    /* font-family: 'Montserrat', sans-serif; */
    /* max-width: 700px; */
}
.container > p{
    font-size: 24px;
}
.question{
    width: 75%;
}
.options{
    position: relative;
    padding-left: 40px;
}
#options label{
    display: block;
    margin-bottom: 15px;
    font-size: 14px;
    cursor: pointer;
}
.options input{
    opacity: 0;
}
.checkmark {
    position: absolute;
    top: -1px;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #555;
    border: 1px solid #ddd;
    border-radius: 50%;
}
.options input:checked ~ .checkmark:after {
    display: block;
}
.options .checkmark:after{
    content: "";
	width: 10px;
    height: 10px;
    display: block;
	background: white;
    position: absolute;
    top: 50%;
	left: 50%;
    border-radius: 50%;
    transform: translate(-50%,-50%) scale(0);
    transition: 300ms ease-in-out 0s;
}
.options input[type="radio"]:checked ~ .checkmark{
    background: #21bf73;
    transition: 300ms ease-in-out 0s;
}
.options input[type="radio"]:checked ~ .checkmark:after{
    transform: translate(-50%,-50%) scale(1);
}
.btn-primary{
    background-color: #555;
    color: #ddd;
    border: 1px solid #ddd;
}
.btn-primary:hover{
    background-color: #21bf73;
    border: 1px solid #21bf73;
}
.btn-success{
    padding: 5px 25px;
    background-color: #21bf73;
}
@media(max-width:576px){
    .question{
        /* width: 100%; */
        word-spacing: 2px;
    } 
}
  </style>
  <body>
  <div class="sticky-top">
  <button class="btn btn-primary" onclick="history.back()">Back</button>
</div>
<div class=>
    <h2><?php echo $schoolName?></h2>
</div>
    <div class="container my-5">
    <h3 class="mb-3"> Subject: <?php echo   $subject?></h3>
    <!-- <h3 class="mb-3"> Hall: <?php echo   $hall?></h3> -->

    <h3 class="mb-3"> Exam Date: <?php echo  $readable_date?></h3>
    <h3 class="mb-3"> Start Time: <?php echo  $readable_time?></h3>
    <h3 class="mb-3"> End Time: <?php echo  $readable_endtime?></h3>

    <br><br>
    <span>Instruction: <text>Lorem ipsum dolor sit amet consectetur adipisicing elit.
       Placeat totam officiis quia nihil dolores quasi autem laudantium mollitia! Ratione laboriosam, esse beatae ad tempore aut? Incidunt nobis aliquid distinctio sint?</text></span>
<br><br>
<div style="margin-top: -390px;margin-left:300px;ß positon:absolute">
<?php include "clock.php"?>
</div>
<?php
// Retrieve the questions from the database
$questions_result = mysqli_query($conn, "SELECT * FROM questions WHERE examid=$examid");
echo '<input type="number" id="examId" value="' . $examid . '" hidden>';

if ($questions_result->num_rows > 0) {
    $counter = 1; // initialize the counter
    echo '<div class="container">';
    
            // Display each question
    foreach ($questions_result as $question_row) {

        echo '<div class="container mt-sm-5 my-1 question" id="question'.$counter.'" style="display: none;">';
        echo '<div class="question ml-sm-5 pl-sm-5 pt-2">';
        echo '<input type="number" name="questionId[]" value="' . $question_row['id']. '" hidden>';
        echo '<div class="py-2"><b>Q. ' . $counter . '. ' . $question_row['question'] . '</b></div>';
        echo '<div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">';
        echo '<label class="options">';
        echo '<input type="radio" name="option['.$counter.']" value="1">';
        echo $question_row['option1'];
        echo '<span class="checkmark"></span>';
        echo '</label>';
        echo '<label class="options">';
        echo '<input type="radio" name="option['.$counter.']" value="2">';
        echo $question_row['option2'];
        echo '<span class="checkmark"></span>';
        echo '</label>';
        echo '<label class="options">';
        echo '<input type="radio" name="option['.$counter.']" value="3">';
        echo $question_row['option3'];
        echo '<span class="checkmark"></span>';
        echo '</label>';
        echo '<label class="options">';
        echo '<input type="radio" name="option['.$counter.']" value="4">';
        echo $question_row['option4'];
        echo '<span class="checkmark"></span>';
        echo '</label>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        $counter++;
    }
    echo '</div>';
    echo '<div class="d-flex align-items-center pt-3">';
    echo '<div>';
    echo '<button class="btn btn-primary btn-prev">Previous</button>';
    echo '</div>';
    echo '<div class="ml-auto mr-sm-5">';
    echo '<button class="btn btn-success btn-next">Next</button>';
    echo '</div>';
    echo '<button class="btn btn-success btn-submit">Submit</button>';
    echo '</div>';

} else {
    echo '<p>No questions added yet.</p>';
}
?>


    
  </body>
</html>

<?php
}else{
    header("location: index.php");
}

?>
<script>
$(function() {
  var currentQuestion = 1;
  var totalQuestions = <?php echo $questions_result->num_rows; ?>;

  // Show the first question
  $('#question1').show();
// Hide the Submit button on previous questions
$('.btn-submit').hide();
  // Handle Next button click
  $('.btn-next').click(function() {
    navigateToQuestion('next');
  });

  // Handle Previous button click
  $('.btn-prev').click(function() {
    navigateToQuestion('prev');
  });

  // Handle Submit button click
  $('.btn-submit').click(function() {
    // Add your submit logic here
    alert('Form submitted!');
  });

  function navigateToQuestion(direction) {
    if (direction === 'next') {
      // Validate the current question
      if (!validateQuestion(currentQuestion)) {
        return false;
      }

      // Hide the current question
      $('#question' + currentQuestion).hide();

      // Increment the current question counter
      currentQuestion++;

      // Show the next question
      $('#question' + currentQuestion).show();

      // Disable the Next button on the last question
      if (currentQuestion === totalQuestions) {
        $('.btn-next').prop('disabled', true);
        $('.btn-submit').show(); // Show the Submit button on the last question
      }

      // Enable the Previous button
      $('.btn-prev').prop('disabled', false);
    } else if (direction === 'prev') {
      // Hide the current question
      $('#question' + currentQuestion).hide();

      // Decrement the current question counter
      currentQuestion--;

      // Show the previous question
      $('#question' + currentQuestion).show();

      // Disable the Previous button on the first question
      if (currentQuestion === 1) {
        $('.btn-prev').prop('disabled', true);
      }

      // Enable the Next button
      $('.btn-next').prop('disabled', false);

      // Hide the Submit button on previous questions
      $('.btn-submit').hide();
    }
  }

  function validateQuestion(questionNumber) {
    var selectedOption = $('input[name="option[' + questionNumber + ']"]:checked').val();

    // Perform your validation logic
    if (selectedOption === undefined) {
      // No option selected, display an error message or take necessary action
      alert('Please select an option for question ' + questionNumber);
      return false;
    }

    // Validation passed, return true
    return true;
  }
});

$(document).ready(function() {
    // Handle the submit button click event
    $('.btn-submit').on('click', function() {
        // Collect the selected options
        var options = {};
        var questionIds = [];
        // $('input[type="radio"]:checked').each(function() {
        //     var questionId = $(this).attr('name');
        //     var optionValue = $(this).val();
        //     options[questionId] = optionValue;
        // });
        $('input[type="radio"]:checked').each(function() {
        var questionId = $(this).closest('.question').find('input[name="questionId[]"]').val();
        var optionValue = $(this).val();

        options[questionId] = optionValue;
        questionIds.push(questionId);
    });
        var examId = $('#examId').val(); // Adjust this line to match your actual element

        // Send the selected options to the PHP server
        $.ajax({
            url: 'submit_exam.php',
            type: 'post',
            data: {
                examid: examId,
                questionIds: questionIds,
                options: options
            },
            dataType: 'json',
            success: function(response) {
                // Handle the server response here
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.log(xhr.responseText);
            }
        });
    });
});

</script>
