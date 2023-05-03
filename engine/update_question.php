<?php 
session_start();
include "database.php";
// if (isset($_POST["updateteacher"]))
// {
$schoolId=$_SESSION["school_id"];
$teacherId = htmlspecialchars($_POST['teacherid']);
$teachername = htmlspecialchars($_POST['teachername']);
$teachersubject = htmlspecialchars($_POST['teachersubject']);
$address = htmlspecialchars($_POST['teacheraddress']);
$email = htmlspecialchars($_POST['teacheremail']);
$phone = htmlspecialchars($_POST['teacherphone']);
$sql="UPDATE teacher SET teacher_name='$teachername',teacher_subject='$teachersubject',teacher_adddress='$address',
teacher_email='$email',teacher_phone='$phone' WHERE teacher_id=$teacherId AND school_id=$schoolId";

if ($conn->query($sql) === TRUE) {
  // echo "Record updated successfully";
  $result = mysqli_query($conn, "SELECT * FROM teacher WHERE teacher_id=$teacherId AND school_id=$schoolId");
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