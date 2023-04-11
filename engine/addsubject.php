<?php 
session_start();
include "database.php";
if (!empty($_POST['subjectname'])) {
$schoolId= $_SESSION["school_id"];
$subjectname = htmlspecialchars($_POST['subjectname']);
$sql= "INSERT INTO subjects (school_id,subject)
value('$schoolId','$subjectname')";
if($conn->query($sql)){
echo "New subject added successfully";
 // $_SESSION['mysqlmessage']="new school added successfully";
}else{
echo "Error: " . $sql . "<br>" . $conn->error;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
};
}else{
    echo "No data";

}



 ?>