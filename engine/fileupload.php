<?php 
$img = $_FILES["image"]["name"];
$tmp = $_FILES["image"]["tmp_name"];
$errorimg = $_FILES["image"][“error”]; 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = '../uploads/'; // upload directory
if(!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image'])
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = rand(1000,1000000).$img;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 
if(move_uploaded_file($tmp,$path)) 
{
echo "<img src='$path' />";
session_start();
include "database.php";
$name = htmlspecialchars($_POST['filename']);
$schoolId=$_SESSION["school_id"];

$teacherId =$_SESSION["teacher_id"];
//include database configuration file
// include_once 'db.php';
//insert form data in the database
// $insert = $db->query("INSERT fileuploading (filename,schooIID,teacherID,file_name) VALUES ('".$name."','".$schoolId."','".$teacherId."','".$path."')");
// echo $insert?'ok':'err';

$sql= "INSERT INTO fileuploading  (filename,schooIID,teacherID,file_name)
value('".$name."','".$schoolId."','".$teacherId."','".$path."')";
if($conn->query($sql)){
echo "New Book added successfully";
 // $_SESSION['mysqlmessage']="new school added successfully";
}else{
    
echo "Error: " . $sql . "<br>" . $conn->error;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
};
}
} 
else 
{
echo 'invalid';
}
}
?>