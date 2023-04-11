<?php 
include "database.php";
$schoolname = htmlspecialchars($_POST['schoolname']);
$address = htmlspecialchars($_POST['schooladdress']);
$email = htmlspecialchars($_POST['schoolemail']);
$phone = htmlspecialchars($_POST['schoolphone']);  
$password="0987654321";
$sql= "INSERT INTO schools (school_name,password,email,phone,address)
value('$schoolname','$password',' $email','$phone','$address')";
if($conn->query($sql)){
echo "New school added successfully";
                        // $_SESSION['mysqlmessage']="new school added successfully";
}else{
echo "Error: " . $sql . "<br>" . $conn->error;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
};


 ?>