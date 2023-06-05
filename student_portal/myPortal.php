<?php
session_start();
require_once "../engine/database.php";
if(isset( $_SESSION["student_id"])){
   $id= $_SESSION["student_id"];
   $studentid= $_SESSION["student_regno"] ;
    $schoolId= $_SESSION["school_id"];
    $sql_shool= "SELECT * FROM student WHERE schoolID='$schoolId' AND student_regno='$studentid'";
    $result = $conn->query($sql_shool);
    $row = mysqli_fetch_assoc($result);
   // output data of each row
    $fname= $row["firstname"];
    $lname= $row["lastname"];
    $gender=$row["gender"];
    $dob=$row["dob"];
    $tudentReg= $row["student_regno"];
    $_SESSION['examNO']= $row["exam_no"];
    $studentemail= $row["student_email"];
    $parentemail=$row["parent_email"];
    $pname=$row["parent_name"];
    $pphone= $row["parent_phone"];
    $sphone= $row["student_phone"];
    $address=$row["address"];
    $class=$row["class"];

    $sql_shool2= "SELECT * FROM schools WHERE school_id='$schoolId'";
    $result2= $conn->query($sql_shool2);
    $row2 = mysqli_fetch_assoc($result2);
     $_SESSION["school_name"]=$row2["school_name"];

?>

<?php
include "nav.php";
?>
<br>
<p class="text-center">
  <strong class="text-white"><?php echo $_SESSION["school_name"]; ?></strong>
</p>

<div class="container rounded bg-white mt-5 mb-5">
  <!-- <div class="sticky-top">
    <button class="btn btn-primary" onclick="history.back()">Back</button>
  </div> -->
  <div class="row">
    <div class="col-md-3 border-end">
      <div class="d-flex flex-column align-items-center text-center p-3 py-5">
        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
        <span class="font-weight-bold"><?php echo $fname . " " . $lname ?></span>
        <span class="text-black-50">Student No: <?php echo $tudentReg ?></span>
        <br>
        <span style="display:none" class="text-black-50">Exam No: <span class="blur"><?php echo $examNO ?></span></span>
      </div>
    </div>
    <div class="col-md-5 border-end">
      <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="text-end">Profile Settings</h4>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label class="labels">Name</label>
            <input type="text" readonly class="form-control" placeholder="First name" value="<?php echo $fname ?>">
          </div>
          <div class="col-md-6">
            <label class="labels">Surname</label>
            <input type="text" readonly class="form-control" value="<?php echo $lname ?>" placeholder="Surname">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-12">
            <label class="labels">Date of Birth</label>
            <input type="text" readonly class="form-control" placeholder="DOB" value="<?php echo $dob ?>">
          </div>
          <div class="col-md-12">
            <label class="labels">Gender</label>
            <input type="text" readonly class="form-control" placeholder="Gender" value="<?php echo $gender ?>">
          </div>
          <div class="col-md-12">
            <label class="labels">Parent Phone</label>
            <input type="text" readonly class="form-control" placeholder="Parent Phone" value="<?php echo $pphone ?>">
          </div>
          <div class="col-md-12">
            <label class="labels">Parent Email</label>
            <input type="text" readonly class="form-control" placeholder="Parent Email" value="<?php echo $parentemail ?>">
          </div>
          <div class="col-md-12">
            <label class="labels">Student Email</label>
            <input type="text" readonly class="form-control" placeholder="Student Email" value="<?php echo $studentemail ?>">
          </div>
          <div class="col-md-12">
            <label class="labels">Student Phone</label>
            <input type="text" readonly class="form-control" placeholder="Student Phone" value="<?php echo $sphone ?>">
          </div>
          <div class="col-md-12">
            <label class="labels">Parent Name</label>
            <input type="text" readonly class="form-control" placeholder="Parent Name" value="<?php echo $pname ?>">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-12">
            <label class="labels">Address</label>
            <input type="text" readonly class="form-control" placeholder="Address" value="<?php echo $address ?>">
          </div>
        </div>
        <div class="mt-5 text-center">
          <!-- <button class="btn btn-primary profile-button" type="button">Save Profile</button> -->
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center experience">
          <span>Edit Experience</span>
          <span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span>
        </div>
        <br>
        <div class="col-md-12">
          <label class="labels">Experience in Designing</label>
          <input type="text" class="form-control" placeholder="Experience" value="">
        </div>
        <br>
        <div class="col-md-12">
          <label class="labels">Additional Details</label>
          <input type="text" class="form-control" placeholder="Additional Details" value="">
        </div>
      </div>
    </div>
  </div>
</div>


</body>
<?php
}else{
    header("location:index.php");
}


?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>

