<?php 
session_start();
include "database.php";
$fname = htmlspecialchars($_POST['fname']);
$lname = htmlspecialchars($_POST['lname']);
$dob = htmlspecialchars($_POST['dob']);
$gender = htmlspecialchars($_POST['gender']);
$semail = htmlspecialchars($_POST['semail']);
$pemail = htmlspecialchars($_POST['pemail']);
$sphone = htmlspecialchars($_POST['sphone']);
$pphone = htmlspecialchars($_POST['pphone']);
$class = htmlspecialchars($_POST['class']);
$haddress = htmlspecialchars($_POST['haddress']);
$schoolId = $_SESSION["school_id"];
$parentname="I will fix  later";
// Generate a random 8-digit number
$number = rand(100000, 999999);
// Add prefix to the number
$student_number = rand(10000000, 99999999);
$exam_number = $fname . $number;
// Prepare the statement with placeholders
$sql = "INSERT INTO `student` (`student_regno`, `exam_no`, `firstname`, `lastname`, `gender`, `dob`, `class_id`, `student_email`, `parent_email`, `student_phone`, `parent_phone`, `schoolID`, `address`,`parent_name`) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
// Bind the variables to the prepared statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssss", $student_number, $exam_number, $fname, $lname, $gender, $dob, $class, $semail, $pemail, $sphone, $pphone, $schoolId, $haddress,$parentname);
// Execute the statement
if($stmt->execute()){
    $mess = "New exam added successfully";
    echo json_encode($mess);
} else {
    $mess = 'Something went wrong kindly try again';
    echo json_encode($mess);
}

 ?>