<?php 
session_start();
include "database.php";
if(isset($_POST['edit'])){
$schoolId=$_SESSION["school_id"];
$postid = $_POST['postid'];
$result = mysqli_query($conn, "SELECT * FROM class WHERE class_id=$postid AND school_id=$schoolId");
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
$classId = $_POST['classid'];
// sql to delete a record
$sql = "DELETE FROM subjects WHERE class_id='$classId' AND school_id='$schoolId'";
if ($conn->query($sql) === TRUE) {
  // echo "Record deleted successfully";
  $result = mysqli_query($conn, "SELECT * FROM class WHERE class_id=$classId AND school_id=$schoolId");
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
} else {
  echo "Error deleting record: " . $conn->error;
}



} 




?>