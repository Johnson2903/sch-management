<?php 
session_start();
include "database.php";
$examdate = htmlspecialchars($_POST['examdate']);
$class = htmlspecialchars($_POST['class']);
$subject = htmlspecialchars($_POST['subject']);
$schoolId= $_SESSION["school_id"];
$sql= "INSERT INTO examtimetable (examdate,class,subject,schoolID,classroom)
value('$examdate','$class','$subject,' $schoolId','$classrom')";
if($conn->query($sql)){
echo "New exma added successfully";
 // $_SESSION['mysqlmessage']="new school added successfully";
}else{
    
echo "Error: " . $sql . "<br>" . $conn->error;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
};


 ?>