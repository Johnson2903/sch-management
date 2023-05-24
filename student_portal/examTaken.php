<?php
// Assuming you have the student ID stored in a variable
$studentId = 123;

// Retrieve the list of exams taken by the student
$query = "SELECT e.exam_name
          FROM exams e
          INNER JOIN student_exams se ON e.exam_id = se.exam_id
          WHERE se.student_id = $studentId";
$result = mysqli_query($conn, $query);

// Check if any exams were found
if (mysqli_num_rows($result) > 0) {
    // Display the list of exams
    echo "Exams taken by the student:";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row['exam_name'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No exams found for the student.";
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  
<div class="container p-5 my-5 border">
  <h1>My First Bootstrap Page</h1>
  <p>This container has a border and some extra padding and margins.</p>
</div>


</body>
</html>
