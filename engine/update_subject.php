<?php 
session_start();
include "database.php";
// if (isset($_POST["updateteacher"]))
// {
$schoolId=$_SESSION["school_id"];
$subjectId = htmlspecialchars($_POST['subjectid']);
$subjectname = htmlspecialchars($_POST['subjectname']);

$sql="UPDATE subjects SET subject='$subjectname' WHERE subject_id=$subjectId AND school_id=$schoolId";

if ($conn->query($sql) === TRUE) {
  // echo "Record updated successfully";
  $result = mysqli_query($conn, "SELECT * FROM subjects WHERE subject_id=$subjectId AND school_id=$schoolId");
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
  echo "Error updating record: " . $conn->error;
}


// }else{
// 	echo "something happen";
// }
?>