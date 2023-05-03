 <?php 
session_start();
include "database.php";
$examdate = htmlspecialchars($_POST['examdate']);
$class = htmlspecialchars($_POST['class']);
$subject = htmlspecialchars($_POST['subject']);
$classroom = htmlspecialchars($_POST['classroom']);
$schoolId= $_SESSION["school_id"];
$sql= "INSERT INTO `examtimetable` (`examdate`,`class`,`subj`,`classroom`,`schoolID`) VALUES ('$examdate','$class','$subject','$classroom','$schoolId')";
if($conn->query($sql)){
    echo "New exam added successfully";
} else {
    echo 'Something went wrong kindly try again';
}

 ?>