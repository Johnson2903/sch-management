<?php
session_start();
require_once "../engine/database.php";
if(isset($_SESSION["school_id"])){
    $schoolId=$_SESSION["school_id"];
    $classid=$_SESSION["class_id"];
    $sql1 = "SELECT * FROM class WHERE class_id='$classid'";
    $result1 = $conn->query($sql1);
    $row1 = mysqli_fetch_assoc($result1);
    


// >>>>>>>>>>>>>>>>>Attendance logic Start>>>>>>>>>>>>>>>>>>>>>>>

// Check if the form is submitted
if (isset($_POST['save'])) {
    // Get the school ID and class ID from the session
    $schoolId = $_SESSION["school_id"];
    $classid = $_SESSION["class_id"];

    // Get the selected student registration numbers and checkboxes
    $studentNos = $_POST['studentNo'];
    $check = $_POST['check'];

    // Check if attendance has already been marked for the current date
    $dateTaken = date("Y-m-d"); // Get the current date
    $query = "SELECT * FROM attendance WHERE class_id = '$classid' AND school_id = '$schoolId' AND dateTimeTaken = '$dateTaken' AND status = '1'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Attendance has already been marked for today!</div>";
    } else {
        // Prepare the SQL statement for marking attendance
        $sql = "INSERT INTO attendance (class_id, school_id, studentNo, status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("ssss", $classid, $schoolId, $studentNo, $status);

        // Iterate over the selected students and mark their attendance
        foreach ($studentNos as $studentNo) {
            // Check if the student is checked in the checkboxes
            $isChecked = in_array($studentNo, $check) ? true : false;

            // Set the status based on the checkbox
            $status = $isChecked ? '1' : '0';

            // Mark attendance for the student
            $studentNo = $conn->real_escape_string($studentNo);
            $stmt->execute();
        }

        // Close the prepared statement
        $stmt->close();

        // Provide a status message
        $statusMsg = "<div class='alert alert-success' style='margin-right:700px;'>Attendance taken successfully!</div>";
    }

    // Redirect or display the status message as needed
    // You can redirect the user to another page or display the status message on the same page
    // Example: header("Location: attendance_success.php");
    echo $statusMsg;
}
?>

<!-- // >>>>>>>>>>>>>>>>>Attendance logic End>>>>>>>>>>>>>>>>>>>>>>> -->


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Students</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<style>
    /* Importing fonts from Google */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Reseting */
/* * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
} */



.wrapper {
    max-width: 800px;
    /* margin: 80px auto; */
    padding: 30px 45px;
    /* box-shadow: 5px 25px 35px #3535356b; */
}

.wrapper label {
    display: block;
    padding-bottom: 0.2rem;
}

.wrapper .form .row {
    padding: 0.6rem 0;
}

.wrapper .form .row .form-control {
    box-shadow: none;
}

.wrapper .form .option {
    position: relative;
    padding-left: 20px;
    cursor: pointer;
}


.wrapper .form .option input {
    opacity: 0;
}

.wrapper .form .checkmark {
    position: absolute;
    top: 1px;
    left: 0;
    height: 20px;
    width: 20px;
    border: 1px solid #bbb;
    border-radius: 50%;
}

.wrapper .form .option input:checked~.checkmark:after {
    display: block;
}

.wrapper .form .option:hover .checkmark {
    background: #f3f3f3;
}

.wrapper .form .option .checkmark:after {
    content: "";
    width: 10px;
    height: 10px;
    display: block;
    background: linear-gradient(45deg, #ce1e53, #8f00c7);
    position: absolute;
    top: 50%;
    left: 50%;
    border-radius: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: 300ms ease-in-out 0s;
}

.wrapper .form .option input[type="radio"]:checked~.checkmark {
    background: #fff;
    transition: 300ms ease-in-out 0s;
}

.wrapper .form .option input[type="radio"]:checked~.checkmark:after {
    transform: translate(-50%, -50%) scale(1);
}

#class {
    display: block;
    width: 100%;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
    color: #333;
}

#class:focus {
    outline: none;
}

@media(max-width: 768.5px) {
    .wrapper {
        margin: 30px;
    }

    .wrapper .form .row {
        padding: 0;
    }
}

@media(max-width: 400px) {
    .wrapper {
        padding: 25px;
        margin: 20px;
    }
}
</style>
<body>
<div class="container-fluid">
<div class="sticky-top">
  <button class="btn btn-primary" onclick="history.back()">Back</button>
</div>
  <br><br>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Take Attendance (Today's Date : <?php echo $todaysDate = date("m-d-Y");?>)</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Student in Class</li>
            </ol>
          </div>   
  <br><br>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Students</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Students</h6>
    </div>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Student in (<?php echo $row1['class_name'];?>) Class</h6>
                  <h6 class="m-0 font-weight-bold text-danger">Note: <i>Click on the checkboxes besides each student to take attendance!</i></h6>
                </div>
                <form  method="post">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!-- <th>Id</th> -->
                        <th>Student Reg</th>
                        <th>Examination Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Date created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Student Reg</th>
                        <th>Examination Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Date created</th>
                        <th>Attendance</th>

                    </tr>
                </tfoot>
                <tbody>
                <?php
$sql = "SELECT * FROM student WHERE schoolID='$schoolId' AND class_id='$classid'";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        // $classid = $row['class_id'];
        // fetch subject with subjectid
        $sql2 = "SELECT * FROM class WHERE class_id='$classid'";
        $result2 = $conn->query($sql2);
        $row2 = mysqli_fetch_assoc($result2);
        ?>
        <tr>
            <td id="studentreg"><?php echo $row["student_regno"] ?></td>
            <td id="examno"><?php echo $row["exam_no"] ?></td>
            <td id="firstname"><?php echo $row["firstname"] ?></td>
            <td id="lastname"><?php echo $row["lastname"] ?></td>
            <td id="gender"><?php echo $row["gender"] ?></td>
            <td id="clas"><?php echo $row2["class_name"] ?></td>
            <td id="date"><?php echo $row["date"] ?></td>
            <td>
                <input name='check[]' type='checkbox' class='text-success' value="<?php echo $row['student_regno']; ?>" >
            </td>
            <td>
                <div class="input-group">
                    <input name='studentNo[]' value="<?php echo $row['student_regno']; ?>" type='hidden' class='form-control'>
                </div>
            </td>
        </tr>
        <?php
    }
} else {
    echo "No data available";
}
?>


                </tbody>
            </table>
        </div>
        <br>
        <button type="submit" name="save" class="btn btn-primary">Take Attendance</button>
    </div>
</div>
</div>
</form>
      
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

     
  </div>
</div>
</body>
<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</html>


<?php
}else{
    header("location: tlogin.php");
}
?>

