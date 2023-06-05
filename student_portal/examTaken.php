<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Exams</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container p-5 my-5 border">
  <h1>Exams Taken by the Student</h1>

  <?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  session_start();
  require_once "../engine/database.php";
  
  if (isset($_SESSION["examNo"])) {
      $examNO = $_SESSION["examNo"];
      $query = "SELECT  DISTINCT ea.examid, et.subj
                FROM exam_answers ea
                JOIN examtimetable et ON ea.examid = et.examid
                WHERE ea.examNo = '$examNO'";
      $result = mysqli_query($conn, $query);
  
      if (mysqli_num_rows($result) > 0) {
          echo "<ul>";
          while ($row = mysqli_fetch_assoc($result)) {
              $examId = $row['examid'];
              $examName = $row['subj'];
              echo "<li><a href=\"result.php?exam_id=$examId\">$examName</a></li>";
          }
          echo "</ul>";
      } else {
          echo "<p>No exams found for the student.</p>";
      }
  }else{
    echo "NOt login";
  }
  ?>
  
</div>

</body>
</html>
