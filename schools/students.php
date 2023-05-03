<?php
session_start();
require_once "../engine/database.php";
if(isset($_SESSION["school_id"])){
    $schoolId=$_SESSION["school_id"];
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
  <!-- create exam -->
<button type="button" class="d-none d-sm-inline-block btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@getbootstrap">
    <i class="fas fa-plus fa-sm text-white-50"></i>Add New Student</button>
   <!--  <button type="button" class="d-none d-sm-inline-block btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@getbootstrap">
    <i class="fas fa-plus fa-sm text-white-50"></i>Add a New class</button> -->
    <!-- <button type="button" d="exampleModal1" class="d-none d-sm-inline-block btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@getbootstrap">
    <i class="fas fa-plus fa-sm text-white-50"></i>upload course material</button> -->
</div>


<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="addstudent-form">
      <!-- djkkjkkkdfkjjfdjfdjk? -->
      <div class="wrapper rounded bg-white">

<div class="h3">Registration Form</div>
<div class="form">
    <div class="row">
        <div class="col-md-6 mt-md-0 mt-3">
            <label>First Name</label>
            <input type="text" name="fname" id="fname" class="form-control" required>
        </div>
        <div class="col-md-6 mt-md-0 mt-3">
            <label>Last Name</label>
            <input type="text" name="lname"  id="lname" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-md-0 mt-3">
            <label>Birthday</label>
            <input type="date" name="dob" id="dob" class="form-control" required>
        </div>
        <div class="col-md-6 mt-md-0 mt-3">
            <label>Gender</label>
            <div class="d-flex align-items-center mt-2">
                <label class="option">
                    <input type="radio" name="gender" id="gender" value="Male">Male
                    <span class="checkmark"></span>
                </label>
                <label class="option ms-4">
                    <input type="radio" name="gender" id="gender" value="Female">Female
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-md-0 mt-3">
            <label>Student Email</label>
            <input type="email" id="semail" name="semail" class="form-control" required>
        </div>
        <div class="col-md-6 mt-md-0 mt-3">
            <label>Parent Email</label>
            <input type="email" id="pemail" name="pemail" class="form-control" required>
        </div>
       
    </div>
<div class="row">
<div class="col-md-6 mt-md-0 mt-3">
            <label> Student Phone No</label>
            <input type="tel" id="sphone" name="sphone" class="form-control" required>
        </div>
        <div class="col-md-6 mt-md-0 mt-3">
            <label> Parent Phone No.</label>
            <input type="tel" id="pphone" name="pphone" class="form-control" required>
        </div>
</div>
    <div class=" my-md-2 my-3">
        <label>class</label>
        <select id="class" name="class" id="class" required>
            <option value="" selected hidden>Choose Option</option>
            <?php
                                  $sql= "SELECT * FROM class where school_id='$schoolId'";
                                  $result = $conn->query($sql);
                                  if (mysqli_num_rows($result) > 0) {
                                  // output data of each row
                                  while($row = mysqli_fetch_assoc($result)) {
              ?>
            <option><?php echo $row['class_name']?></option>
             <?php
             }
            }else{
                echo '<option>No Class available</option>';
            }
             ?>
        </select>
    </div>
    <div class="mb-3">
            <label for="message-text" class="col-form-label">Home Address</label>
            <textarea class="form-control" name="haddress" id="haddress" required /></textarea>
          </div> 
    <!-- <div class="btn btn-primary mt-3">Submit</div> -->
</div>
</div>
</div> 
      <!-- sdjjsdjkjk -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="addstudent" name="addstudent" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
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
          $sql= "SELECT * FROM student where schoolID='$schoolId'";
          $result = $conn->query($sql);
          if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {

          ?>
                    <tr>
                        <td id="studentreg"><?php echo $row["student_regno"]?></td>
                        <td id="examno"><?php echo     $row["exam_no"]?></td>
                        <td id="firstname"><?php echo  $row["firstname"]?></td>
                        <td id="lastname"><?php echo   $row["lastname"]?></td>
                        <td id="gender"><?php echo     $row["gender"]?></td>
                        <td id="clas"><?php echo       $row["class"]?></td>
                        <td id="date"><?php echo       $row["date"]?></td>                        
                        <td>
                             <div class="input-group">
                              <a href="viewstudent.php?stud=<?php echo $row['student_regno']?>" class="view btn btn-primary" type="button">View</a>
                              <!-- <button class=" delete btn btn-danger" type="button" data-id="<?php echo $row['examid']?>">Delete</button> -->
                              <!-- <button class="questions btn btn-secondary" type="button" data-bs-toggle="" data-bs-target="" data-bs-whatever="@getbootstrap" data-id="<?php echo $row['examid']?>"
                              >questions</button> -->

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
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Exam Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="updatexam-form" name="updatexam-form">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Exam ID</label>
            <input type="number" class="form-control" name="examid" id="examid" required readonly>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Exam date</label>
            <input type="date" class="form-control" name="examdate" id="examdate" required>
          </div>
          <div>
          <label for="recipient-name" class="col-form-label">Subject</label>
            <input type="text" class="form-control" name="subject" id="subject" required>
          </div>
          <div>
          <label for="recipient-name" class="col-form-label">Class</label>
            <input type="text" class="form-control" name="class" id="class" required>
          </div>
          <div>
          <label for="recipient-name" class="col-form-label">Hall</label>
            <input type="text" class="form-control" name="hall" id="hall" required>
          </div>
        
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="updatexam" name="updatexam" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
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


// when the user clicks on Update
$('#updatexam').on('click', function() {
  let data = $("#updatexam-form").serialize();

  $.ajax({
    url: '../engine/update_exam.php',
    type: 'post',
    data: data,
    dataType: 'json',
    success: function(response) {
      if (response.error) {
        console.log(response.error);
        return;
      }

      try {
        // Check if the JSON response contains the expected data
        if (response.length > 0 && response[0].hasOwnProperty('examdate')) {
          $("#examd").val(response[0].examdate);
          $("#subj").val(response[0].subj);
          $("#clas").val(response[0].class);
          $("#classr").val(response[0].classroom);
          alert('EXAM updated successfuly');
        } else {
          console.log('Unexpected JSON response: ' + JSON.stringify(response));
        }
      } catch (e) {
        console.log('Error parsing JSON response: ' + response);
      }           
    },
    error: function(xhr, status, error) {
      console.log('Error: ' + error);
    }
  });
});

// when user click on questions
$('.questions').on('click', function() {
    var postid = $(this).data('id');  
    console.log(postid); 
    $.ajax({
        url: '../engine/getquestions.php',
        type: 'post',
        data: {
            'questions': 1,
            'postid': postid
        },
        dataType: "json",
        success: function(response) {
            if(response.hasOwnProperty('message')) {
                var message = response.message;
        var button = "<button type='button' class='btn btn-primary' data-bs-dismiss='modal'>OK</button>";
        var create = "<a href='question.php?postid=" + postid + "' type='button' class='btn btn-success'>Create Questions</a>";
        var modalHTML = "<div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>" + 
            "<div class='modal-dialog'>" +
                "<div class='modal-content'>" +
                    "<div class='modal-header'>" +
                        "<h5 class='modal-title' id='exampleModalLabel'>Message</h5>" +
                        "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>" +
                    "</div>" +
                    "<div class='modal-body'>" + message + "</div>" +
                    "<div class='modal-body'>" + create + "</div>" +

                    "<div class='modal-footer'>" + button + "</div>" +
                "</div>" +
            "</div>" +
        "</div>";
        $('body').append(modalHTML);
        $('#exampleModal').modal('show');
            } else {
                // console.log(response);
                window.location = response.redirect_url;
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
});


        // when the user clicks on delete
        $('.delete').on('click', function(){
          //  var subjectid = $(this).data('id'); 
          var postid = $(this).data('id');  

           // alert(teacherid); 
            $.ajax({
                url: '../engine/edit_exam.php',
                type: 'post',
                async: false,
                data: {
                    'delete': 1,
                    'postid': postid
                     },
                     dataType: "json",
                 success: function(response){
                    // alert(JSON.parse(response.teacher_name));
                    // $.each(response, function() {
                    // $("#sname").text(this.subject);

                    // $("#tsubject").text(this.teacher_subject);
                    // $("#tname").text(this.teacher_name);
                    // $("#temail").text(this.teacher_email);
                    // $("#tphone").text(this.teacher_phone);
                    // $("#taddress").text(this.teacher_adddress);
                    alert(response);
                    // });
                
               
    
                },
            });
        });
    });

    function closeModal() {
    $('#exampleModal').modal('hide');
    $('.modal-backdrop').remove();
}

</script>