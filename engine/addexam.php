
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "database.php";

$examdate = htmlspecialchars($_POST['examdate']);
$examtime = htmlspecialchars($_POST['examtime']);
$examendtime = htmlspecialchars($_POST['examendtime']);

$class = htmlspecialchars($_POST['class']);
$subject = htmlspecialchars($_POST['subject']);
$classroom = htmlspecialchars($_POST['classroom']);
$schoolId= $_SESSION["school_id"];
// echo $examtime;
$sql= "INSERT INTO examtimetable (`examdate`,`examTime`,`endTime`,`class_id`,`subj`,`classroom`,`schoolID`) 
VALUES ('$examdate','$examtime','$examendtime','$class','$subject','$classroom','$schoolId')";
if($conn->query($sql)){
    echo "New exam added successfully";
} else {
    echo 'Something went wrong kindly try again';
} 
?>
