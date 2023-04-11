<?php
include "database.php";
$email = htmlspecialchars($_POST['teacheremail']);
$password = htmlspecialchars($_POST['teacherpassword']); 


$sql = "SELECT * FROM teacher WHERE teacher_email ='$email' and  teacher_password='$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
    $srow = $result->fetch_assoc();
    if($srow["teacher_email"]=$email && $srow["teacher_password"]=$password){
      session_start();
          $_SESSION["school_id"]=$srow["school_id"];
          $_SESSION["teacher_id"]=$srow["teacher_id"];
          $_SESSION["teacher_name"]=$srow["teacher_name"];
          $_SESSION["teacher_email"]=$srow["teacher_email"];
          header("location: ../teacher_dashboard.php");
      } 
  }else{
    session_start();
    $_SESSION["error"]=true;
    $errormessage="Email or Password not correct";
    header("location: ../tlogin.php?message=$errormessage");
  }



$conn->close();
 ?>