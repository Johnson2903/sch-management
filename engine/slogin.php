<?php
include "database.php";
$email = htmlspecialchars($_POST['schoolemail']);
$password = htmlspecialchars($_POST['schoolpassword']); 


$sql = "SELECT * FROM schools WHERE email ='$email' and  password='$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
    $srow = $result->fetch_assoc();
    if($srow["admin_email"]=$email && $srow["admin_password"]=$password){
      session_start();
          $_SESSION["school_id"]=$srow["school_id"];
          $_SESSION["school_name"]=$srow["school_name"];
          $_SESSION["school_email"]=$srow["school_email"];
          header("location: ../school_dashboard.php");
      } 
  }else{
    session_start();
    $_SESSION["error"]=true;
    $errormessage="Email or Password not correct";
    header("location: ../slogin.php?message=$errormessage");
  }



$conn->close();
 ?>