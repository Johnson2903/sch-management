<?php 
session_start();
include "database.php";
$schoolId = $_SESSION["school_id"];
$examid = htmlspecialchars($_POST['examid']);
$examdate = htmlspecialchars($_POST['examdate']);
$subject = htmlspecialchars($_POST['subject']);
$class = htmlspecialchars($_POST['class']);
$hall = htmlspecialchars($_POST['hall']);
// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("UPDATE `examtimetable` SET examdate=?, subj=?, class=?, classroom=? WHERE examid=? AND schoolID=?");
$stmt->bind_param("ssssii", $examdate, $subject, $class, $hall, $examid, $schoolId);
if ($stmt->execute()) {
  // Use prepared statement to prevent SQL injection
//   echo "<script>window.location.href = '../schools/index.php';</script>";
  $stmt = $conn->prepare("SELECT * FROM examtimetable WHERE examid=? AND schoolID=?");
  $stmt->bind_param("ii", $examid, $schoolId);
  $stmt->execute();

  $result = $stmt->get_result();
  $data = array();

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    echo json_encode($data);
  } else {
    // Return an error message if no record is found
    echo json_encode(array("error" => "NO RECORD FOUND"));
  }
} else {
  // Return an error message if the SQL query fails
  echo json_encode(array("error" => "Error updating record: " . $conn->error));
}


?>