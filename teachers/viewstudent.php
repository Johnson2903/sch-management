<?php
session_start();
require_once "../engine/database.php";
if(isset($_SESSION["school_id"])){
    $schoolId=$_SESSION["school_id"];
    $classid=$_SESSION["class_id"];
?>
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
    <br><br>
<div class="sticky-top">
  <button class="d-none d-sm-inline-block btn btn-primary" onclick="history.back()">Back</button>
</div>

</div>



  <br><br>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Students</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Students</h6>
    </div>
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
                        <th>Action</th>

                    </tr>
                </tfoot>
                <tbody>
          <?php
          $sql= "SELECT * FROM student where schoolID='$schoolId' and class_id='$classid'";
          $result = $conn->query($sql);
          if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            $classid=$row['class_id'];
            //fetch subject with subjectid
            $sql2= "SELECT * FROM class  where class_id='$classid'";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);

          ?>
                    <tr>
                        <td id="studentreg"><?php echo $row["student_regno"]?></td>
                        <td id="examno"><?php echo     $row["exam_no"]?></td>
                        <td id="firstname"><?php echo  $row["firstname"]?></td>
                        <td id="lastname"><?php echo   $row["lastname"]?></td>
                        <td id="gender"><?php echo     $row["gender"]?></td>
                        <td id="clas"><?php echo       $row2["class_name"]?></td>
                        <td id="date"><?php echo       $row["date"]?></td>                        
                        <td>
                             <div class="input-group">
                              <a href="viewstudent.php?stud=<?php echo $row['student_regno']?>" class="view btn btn-primary" type="button">View</a>
                             

                            </div>
                        </td>
                    </tr>
<?php
}
}else{
echo "No data available";
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
      
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

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
    header("location: slogin.php");
}
?>

<script type="text/javascript">
    $(document).ready(function(){
      // when user click add student
      $('#addstudent').on('click', function() {
    var data = $("#addstudent-form").serialize();   
    $.ajax({
        url: '../engine/addstudent.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        async: true
    })
    .done(function(response) {
        if (response.success) {
            alert(JSON.stringify(response));
        } else {
            alert(JSON.stringify(response));
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        alert("Error: " + textStatus + " - " + errorThrown);
    });
});

        // when the user clicks on view student
        $('.view').on('click', function(){
           var studentid = $(this).data('id');  
        //    alert(postid); 
            $.ajax({
                url: 'viewstudent.php',
                type: 'post',
                async: false,
                data: {
                    'view': 1,
                    'studentid': studentid
                     },
                     dataType: "json",
                 success: function(response){
                    // alert(response);
                    header("location:")
                    
               
    
                },
            });
        });






    });

    function closeModal() {
    $('#exampleModal').modal('hide');
    $('.modal-backdrop').remove();
}

</script>