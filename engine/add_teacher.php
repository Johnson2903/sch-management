<?php 
session_start();
include "database.php";
$teachername = htmlspecialchars($_POST['teachername']);
$address = htmlspecialchars($_POST['teacheraddress']);
$email = htmlspecialchars($_POST['teacheremail']);
$phone = htmlspecialchars($_POST['teacherphone']);  
$teachersubject = htmlspecialchars($_POST['teachersubject']);
$teacherclass = htmlspecialchars($_POST['teacherclass']);

$password="0987654321";
$schoolId= $_SESSION["school_id"];
$sql= "INSERT INTO teacher (school_id,teacher_name,teacher_password,teacher_email,teacher_phone,teacher_adddress,subject_id,class_id)
value('$schoolId','$teachername','$password',' $email','$phone','$address','$teachersubject','$teacherclass')";
if($conn->query($sql)){
echo "New Teacher added successfully";
 // $_SESSION['mysqlmessage']="new school added successfully";
}else{
    
echo "Error: " . $sql . "<br>" . $conn->error;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
};


 ?>