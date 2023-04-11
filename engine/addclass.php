<?php 
session_start();
include "database.php";
$schoolId= $_SESSION["school_id"];
$classname = htmlspecialchars($_POST['classname']);
$sql= "INSERT INTO class (school_id,class_name)
value('$schoolId','$classname')";
if($conn->query($sql)){
echo "New Class added successfully";
 // $_SESSION['mysqlmessage']="new school added successfully";
}else{
echo "Error: " . $sql . "<br>" . $conn->error;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
};


 ?>