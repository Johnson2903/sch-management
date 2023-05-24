
<?php 
// error_reporting(0);
session_start();
require_once "../engine/database.php";
// if(isset($_SESSION["school_id"])){
    $schoolId=$_SESSION["school_id"];
    $classid=$_SESSION["class_id"];
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link href="img/logo/attnlg.jpg" rel="icon"> -->
  <title>Dashboard</title>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

<script>
    function typeDropDown(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxCallTypes.php?tid="+str,true);
        xmlhttp.send();
    }
}
</script>

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php include "Includes/topbar.php";?>
        <!-- Topbar -->
        <div class="sticky-top">
  <button class="btn btn-primary" onclick="history.back()">Back</button>
</div>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Student Attendance</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">View Student Attendance</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">View Student Attendance</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
    <form method="post">
        <div class="row mb-3">
            <div class="col-xl-6">
                <label class="form-label">Select Student<span class="text-danger">*</span></label>
                <?php
                // //  $sql= "SELECT * FROM student where schoolId=$schoolId and student_regno=$studentid";
                //  $result = $conn->query($sql_shool);
                //  $row = mysqli_fetch_assoc($result);
                $qry = "SELECT * FROM student WHERE class_Id = $classid AND schoolId = $schoolId ORDER BY firstName ASC";
                $result = $conn->query($qry);
                $num = $result->num_rows;
                if ($num > 0) {
                    echo '<select required name="studentNumber" class="form-select mb-3">';
                    echo '<option value="">--Select Student--</option>';
                    while ($rows = $result->fetch_assoc()) {
                        echo '<option value="'.$rows['student_regno'].'">'.$rows['firstName'].' '.$rows['lastName'].'</option>';
                    }
                    echo '</select>';
                } 
                
                // echo $rows['student_regno'];
                ?>
            </div>
            <div class="col-xl-6">
                <label class="form-label">Type<span class="text-danger">*</span></label>
                <select required name="type" onchange="typeDropDown(this.value)" class="form-select mb-3">
                    <option value="">--Select--</option>
                    <option value="1">All</option>
                    <option value="2">By Single Date</option>
                    <option value="3">By Date Range</option>
                </select>
            </div>
            <?php
        echo "<div id='txtHint'></div>";
        ?>
        </div>
       
        <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
    </form>
</div>

              </div>
              <!-- <! Input Group -->
                 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!-- <th>Id</th> -->
                        <th>#</th>
                        <th>Student Reg</th>
                        <th>Examination Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Date </th>
                        <th>Status</th>

                     
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student Reg</th>
                        <th>Examination Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Date </th>
                        <th>Status</th>
                     

                    </tr>
                </tfoot>
                <tbody>


                  <?php

                    if(isset($_POST['view'])){

                       $admissionNumber =  $_POST['studentNumber'];
                       $type =  $_POST['type'];

                       if($type == "1"){ //All Attendance

                        $query = "SELECT * FROM attendance
                        INNER JOIN student ON student.student_regno = attendance.studentNO
                        INNER JOIN class ON class.class_Id = attendance.class_id
                        where attendance.studentNO = '$admissionNumber' and attendance.class_Id = '$classid' and attendance.school_id = '$schoolId'";

                       }
                       if($type == "2"){ //Single Date Attendance

                        $singleDate =  $_POST['singleDate'];

                        $query = "SELECT * FROM attendance
                        INNER JOIN student ON student.student_regno = attendance.studentNO
                        INNER JOIN class ON class.class_Id = attendance.class_id
                        where attendance.studentNO = '$admissionNumber' and attendance.class_Id = '$classid' and attendance.school_id = '$schoolId' and attendance.dateTimeTaken = '$singleDate'";

                        

                       }
                       if($type == "3"){ //Date Range Attendance

                         $fromDate =  $_POST['fromDate'];
                         $toDate =  $_POST['toDate'];

                         $query = "SELECT * FROM attendance
                         INNER JOIN student ON student.student_regno = attendance.studentNO
                         INNER JOIN class ON class.class_Id = attendance.class_id
                         where attendance.studentNO = '$admissionNumber' and attendance.class_Id = '$classid' and attendance.school_id = '$schoolId' and attendance.dateTimeTaken between '$fromDate' and '$toDate'";
                         
                       }

                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                              if($rows['status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}
                             $sn = $sn + 1;
                            echo"
                            <tr>
                            <td>".$sn."</td>
                            <td>".$rows['student_regno']."</td>
                            <td>".$rows['exam_no']."</td>
                            <td>".$rows['firstname']."</td>
                            <td>".$rows['lastname']."</td>
                            <td>".$rows['gender']."</td>
                            <td>".$rows['class_name']."</td>
                            <td>".$rows['dateTimeTaken']."</td>
                            <td style='color:white;background-color:".$colour."'>".$status."</td>
                        </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                    }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
          </div>
          <!--Row-->

          <!-- Documentation Link -->
          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>For more documentations you can visit<a href="https://getbootstrap.com/docs/4.3/components/forms/"
                  target="_blank">
                  bootstrap forms documentations.</a> and <a
                  href="https://getbootstrap.com/docs/4.3/components/input-group/" target="_blank">bootstrap input
                  groups documentations</a></p>
            </div>
          </div> -->

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
       <!-- <?php include "Includes/footer.php";?> -->
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

   <!-- Bootstrap core JavaScript-->
   <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>