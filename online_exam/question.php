<?php
session_start();
require_once "../engine/database.php";
if(isset( $_SESSION["school_id"]) AND $_GET['postid'] ){
$schoolId=$_SESSION["school_id"];
$examid=$_GET['postid'];
$result = mysqli_query($conn, "SELECT * FROM examtimetable  WHERE examid=$examid AND schoolID=$schoolId");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $subject=$row["subj"];
      $class=$row["class"];
      $hall=$row["classroom"];
      $examdate=$row["examdate"];
      $readable_date = date("F j, Y", strtotime($examdate));
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
  <body>
  <div class="sticky-top">
  <button class="btn btn-primary" onclick="history.back()">Back</button>
</div>

    <div class="container my-5">
    <h3 class="mb-3"> Subject: <?php echo   $subject?></h3>
    <h3 class="mb-3"> Hall: <?php echo   $hall?></h3>

    <h3 class="mb-3"> Exam Date: <?php echo  $readable_date?></h3>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Question
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ask a Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="form"> 
          <input type="hidden" id="examid" name="examid" value="<?php echo $examid; ?>">
          <div class="mb-3">
            <label for="details" class="form-label">Question</label>
            <textarea class="form-control" id="question" name="question" rows="5" placeholder="Provide any additional details about your question"></textarea>
          </div>
          <div class="mb-3">
            <label for="question" class="form-label">option 1</label>
            <input type="text" class="form-control" id="option1" name="option1"placeholder="Enter your question" required/>
          </div>
          <div class="mb-3">
            <label for="question" class="form-label">option 2</label>
            <input type="text" class="form-control" id="option2" name="option2"placeholder="Enter your question" required/>
          </div>
          <div class="mb-3">
            <label for="question" class="form-label">option 3</label>
            <input type="text" class="form-control" id="option3" name="option3" placeholder="Enter your question" required/>
          </div>
          <div class="mb-3">
            <label for="question" class="form-label">option 4</label>
            <input type="text" class="form-control" id="option4" name="option4" placeholder="Enter your question" required/>
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Answer</label>
            <select class="form-select" name="answer" id="answer" required>
              <option value="option1">Option 1</option>
              <option value="option2">Option 2</option>
              <option value="option3">Option 3</option>
              <option value="option4">Option 4</option>
              <!-- <option value="arts">Arts</option> -->
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
    <h1 class="mb-3">Existing Questions</h1>
<?php
       // Retrieve the questions from the database
$questions_result = mysqli_query($conn, "SELECT * FROM questions WHERE examid=$examid");

if ($questions_result->num_rows > 0) {
    $counter = 1; // initialize the counter
    // Display each question
    echo '<div class="container">';
    foreach ($questions_result as $question_row) {
        echo '<div class="card my-3">';
        echo '<div class="card-header text-primary">Question ' . $counter . ': ' . $question_row['question'] . '</div>'; // add the counter to the header
        echo '<div class="card-body">';
        echo '<ul class="list-group">';
        echo '<li class="list-group-item">Option 1: ' . $question_row['option1'] . '</li>';
        echo '<li class="list-group-item">Option 2: ' . $question_row['option2'] . '</li>';
        echo '<li class="list-group-item">Option 3: ' . $question_row['option3'] . '</li>';
        echo '<li class="list-group-item">Option 4: ' . $question_row['option4'] . '</li>';
        echo '<li class="list-group-item text-success">Answer: ' . $question_row['answer'] . '</li>';
        echo '</ul>';
        echo '<div class="mt-3">';
        echo '<button type="button" class="btn btn-success edit-btn" data-bs-toggle="modal" data-bs-target="#editModal' . $question_row['id'] . '">Edit</button>'; // add edit button with corresponding modal ID
        echo '<button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal' . $question_row['id'] . '">Delete</button>'; // add delete button with corresponding modal ID
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
// edit modal
echo '
<div class="modal fade" id="editModal' . $question_row['id'] . '" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Question ' . $counter . '</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form method="POST" >
          <input type="hidden" id="examid" name="examid" value="' . $examid . '">
          <input type="hidden" id="question_id" name="question_id" value="' . $question_row['id'] . '">
          <div class="mb-3">
            <label for="details" class="form-label">Question</label>
            <textarea class="form-control" id="question" name="question" rows="5" placeholder="Provide any additional details about your question">' . $question_row['question'] . '</textarea>
          </div>
          <div class="mb-3">
            <label for="option1" class="form-label">Option 1</label>
            <input type="text" class="form-control" id="option1" name="option1" placeholder="Enter option 1" value="' . $question_row['option1'] . '" required>
          </div>
          <div class="mb-3">
            <label for="option2" class="form-label">Option 2</label>
            <input type="text" class="form-control" id="option2" name="option2" placeholder="Enter option 2" value="' . $question_row['option2'] . '" required>
          </div>
          <div class="mb-3">
            <label for="option3" class="form-label">Option 3</label>
            <input type="text" class="form-control" id="option3" name="option3" placeholder="Enter option 3" value="' . $question_row['option3'] . '" required>
          </div>
          <div class="mb-3">
            <label for="option4" class="form-label">Option 4</label>
            <input type="text" class="form-control" id="option4" name="option4" placeholder="Enter option 4" value="' . $question_row['option4'] . '" required>
          </div>
          <div class="mb-3">
            <label for="answer" class="form-label">Answer</label>
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Enter the answer" value="' . $question_row['answer'] . '" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           
            <a href="delete.php?examid=' . $examid . '&question_id=' . $question_row['id'] . '" class="btn btn-primary">Save changes</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
';
        // delete modal
echo '<div class="modal fade" id="deleteModal' . $question_row['id'] . '" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">';
echo '<div class="modal-dialog">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title" id="deleteModalLabel">Delete Question ' . $counter . '</h5>';
echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
echo '</div>';
echo '<div class="modal-body">';
echo '<p>Are you sure you want to delete this question?</p>';
echo '</div>';
echo '<div class="modal-footer">';
echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>';
// echo '<form method="POST" action="../engine/edit_question.php">';
// echo '<input type="hidden" id="examid" name="examid" value="<?php echo $examid; ?;
// echo '<input type="hidden" id="question_id" name="question_id" value="' . $question_row['id'] . '">'; -->
// echo '<button type="submit" name="delete" class="btn btn-danger">Delete</button>'; -->
echo '<a href="../engine/edit_question.php?examid=' . $examid . '&question_id=' . $question_row['id'] . '" class="btn btn-danger">Delete</a>';

// echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
    // increment counter
    $counter++;
    }
    echo '</div>';

} else {
  echo '<p>No questions added yet.</p>';
}

?>  
  </body>
</html>

<?php
}else{
    header("location: ../schools/slogin.php");
}

?>

<script type="text/javascript">
  $(document).ready(function(){
// Submit the form using AJAX
$("#form").submit(function(event) {
  event.preventDefault();
  // Serialize the form data
  var formData = $(this).serialize();
  // Send an AJAX request to add the question
  $.ajax({
    type: "POST",
    url: "../engine/add_question.php",
    data: formData,
    success: function(response) {
      // alert('<div class="alert alert-success">' + response + '</div>'); 
      var successModal = `
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Success!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-success">${response}</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
`;

$('body').append(successModal);

$('#successModal').modal('show');
      // Display the new question
      $("#question-list").append(response);
      // Clear the form inputs
      $("form")[0].reset();
    },
    error: function(xhr, status, error) {
      alert("An error occurred while adding the question.");
    }
  });
});



});
</script>
