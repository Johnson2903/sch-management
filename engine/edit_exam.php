<?php 
session_start();
include "database.php";
if(isset($_POST['edit'])){
$schoolId=$_SESSION["school_id"];
$postid = $_POST['postid'];
$result = mysqli_query($conn, "SELECT * FROM examtimetable  WHERE examid=$postid AND schoolID=$schoolId");
$data=array();
// $row = mysqli_fetch_array($result);
if (mysqli_num_rows($result) > 0) {
                              // output data of each row
while($row = mysqli_fetch_assoc($result)) {
$data[]=$row;
}
echo json_encode($data);
exit();
} 

} 

// delete
if(isset($_POST['delete'])){
$schoolId=$_SESSION["school_id"];
// $examid = htmlspecialchars($_POST['examid']);
$postid = $_POST['postid'];
// sql to delete a record
$sql = "DELETE FROM examtimetable WHERE examid=$postid AND schoolID=$schoolId";
if ($conn->query($sql) === TRUE) {
  $mess="Record deleted successfully";
//   $result = mysqli_query($conn, "SELECT * FROM examtimetable WHERE examid=$postid AND schoolID=$schoolId");
// $data=array();
// $row = mysqli_fetch_array($result);
// if (mysqli_num_rows($result) > 0) {
// output data of each row
// while($row = mysqli_fetch_assoc($result)) {
// $data[]=$row;
// }
echo json_encode($mess);
// exit();
// }
} else {
  echo "Error deleting record: " . $conn->error;
}
} 
?>