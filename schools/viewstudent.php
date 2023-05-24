<?php

session_start();
require_once "../engine/database.php";
if(isset( $_SESSION["school_id"])){
    $schoolId=$_SESSION["school_id"];
    $studentid=$_GET['stud'];
    $sql_shool= "SELECT * FROM student where schoolId=$schoolId and student_regno=$studentid";
    $result = $conn->query($sql_shool);
    $row = mysqli_fetch_assoc($result);
   // output data of each row
    $fname= $row["firstname"];
    $lname= $row["lastname"];
    $gender=$row["gender"];
    $dob=$row["dob"];
    $tudentReg= $row["student_regno"];
    $examNO= $row["exam_no"];
    $studentemail= $row["student_email"];
    $parentemail=$row["parent_email"];
    $pname=$row["parent_name"];
    $pphone= $row["parent_phone"];
    $sphone= $row["student_phone"];
    $address=$row["address"];
    $class=$row["class"];


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fname?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css
">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js
"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js
"></script>
</head>
<style>
    body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>
<body>
<div class="container rounded bg-white mt-5 mb-5">
<div class="sticky-top">
  <button class="btn btn-primary" onclick="history.back()">Back</button>
</div>
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold"><?php echo $fname ."". $lname?></span>
                <span class="text-black-50">Student No:<?php echo  $tudentReg?></span><span> </span>
                <br>
                <span class="text-black-50">Exam No:<?php echo  $examNO?></span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="<?php echo $fname ?>"></div>
                <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="<?php echo $lname ?>" placeholder="surname"></div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Date of birth</label><input type="dob" class="form-control" placeholder="dob" value="<?php echo $dob?> "></div>
                    <div class="col-md-12"><label class="labels">Gender</label><input type="text" class="form-control" placeholder="Gender" value="<?php echo $gender?>"></div>
                    <!-- <div class="col-md-12"><label class="labels">Student Phone<input type="text" class="form-control" placeholder="enter address line 2" value=""></div> -->
                    <div class="col-md-12"><label class="labels">Parent Phone</label><input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $pphone?>"></div>
                    <div class="col-md-12"><label class="labels">Parent Email</label><input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $parentemail?>"></div>
                    <div class="col-md-12"><label class="labels">Student Email</label><input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $studentemail?>"></div>
                    <div class="col-md-12"><label class="labels">Student Phone</label><input type="text" class="form-control" placeholder="enter email id" value="<?php echo $sphone?>"></div>
                    <div class="col-md-12"><label class="labels">Parent Name</label><input type="text" class="form-control" placeholder="education" value="<?php echo $pname?>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Address</label><input type="text" class="form-control" placeholder="country" value="<?php echo $address?>"></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>
<?php
}else{
    echo "not set";
}


?>
</html>

