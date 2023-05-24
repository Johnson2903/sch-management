<?php
session_start();
require_once "../engine/database.php";
if(isset($_SESSION["school_id"])){
    $schoolId=$_SESSION["school_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Exame</title>
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
<body>
<div class="container-fluid">
<div class="sticky-top">
  <button class="btn btn-primary" onclick="history.back()">Back</button>
</div>
  <br><br>
  <!-- create exam -->
<button type="button" class="d-none d-sm-inline-block btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@getbootstrap">
    <i class="fas fa-plus fa-sm text-white-50"></i>Create Exam</button>
  
</div>


<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Exam</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="addexam-form">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Examination Date</label>
            <input type="date" class="form-control" name="examdate" id="examdate" required />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Examination start Time</label>
            <input type="time" class="form-control" name="examtime" id="examtime" required />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Examination End Time</label>
            <input type="time" class="form-control" name="examendtime" id="examendtime" required />
          </div>
          <div class="mb-3">
    <select class="form-select form-select-md" name="class" id="class">
        <option disabled>Choose Class</option>
        <?php
        $sql = "SELECT * FROM class where school_id='$schoolId'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = $row['class_id'] == $selectedClassId ? 'selected' : '';
                ?>
                <option value="<?php echo $row['class_id'] ?>" <?php echo $selected ?>><?php echo $row['class_name'] ?></option>
                <?php
            }
        } else {
            echo '<option>No Class available</option>';
        }
        ?>
    </select>
</div>

          <div class="mb-3">
             <select class="form-select form-select-md" name="subject" id="subject">
             <option disabled>Choose subject</option>
               <?php
                                  $sql= "SELECT * FROM subjects where school_id='$schoolId'";
                                  $result = $conn->query($sql);
                                  if (mysqli_num_rows($result) > 0) {
                                  // output data of each row
                                  while($row = mysqli_fetch_assoc($result)) {
     
              ?>
            <option><?php echo $row['subject']?></option>
             <?php
                }
            }else{
                echo '<option>No subject available</option>';
            }
             ?>
             </select>
        </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">classroom</label>
            <textarea class="form-control" name="classroom" id="classroom" required /></textarea>
          </div>
        
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="addexam" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>     
  <br><br>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Exams</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Examination Timetable</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!-- <th>Id</th> -->
                        <th>Exam date</th>
                        <th>Subject</th>
                        <th>Hall</th>
                        <th>Class</th>
                        <th>Date created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Exam date</th>
                        <th>Subject</th>
                        <th>Hall</th>
                        <th>Class</th>
                        <th>Date created</th>
                        <th>Action</th>

                    </tr>
                </tfoot>
                <tbody>
          <?php
          $sql= "SELECT * FROM examtimetable where schoolID='$schoolId'";
          $result = $conn->query($sql);
          if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            $classid = $row['class_id'];
        // fetch class with classid
        $sql2 = "SELECT * FROM class WHERE class_id='$classid'";
        $result2 = $conn->query($sql2);
        $row2 = mysqli_fetch_assoc($result2);
          ?>
                    <tr>
                        <td id="examd"><?php echo $row["examdate"]?></td>
                        <td id="subj"><?php echo $row["subj"]?></td>
                        <td id="classr"><?php echo $row["classroom"]?></td>
                        <td id="clas"><?php echo $row2["class_name"]?></td>
                        <td id="date"><?php echo $row["date"]?></td>                        
                        <td>
                             <div class="input-group">
                              <button class="edit btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@getbootstrap" data-id="<?php echo $row['examid']?>"
                               >Edit</button>
                              <button class=" delete btn btn-danger" type="button" data-id="<?php echo $row['examid']?>">Delete</button>
                              <button class="questions btn btn-secondary" type="button" data-bs-toggle="" data-bs-target="" data-bs-whatever="@getbootstrap" data-id="<?php echo $row['examid']?>"
                              >questions</button>

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
<!-- <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> -->

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Exam</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="addexam-form">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Examination Date</label>
            <input type="date" class="form-control" name="examdate" id="examdate" required />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Examination start Time</label>
            <input type="time" class="form-control" name="examtime" id="examtime" required />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Examination End Time</label>
            <input type="time" class="form-control" name="examendtime" id="examendtime" required />
          </div>
          <div class="mb-3">
    <select class="form-select form-select-md" name="class" id="class">
        <option disabled>Choose Class</option>
        <?php
        $sql = "SELECT * FROM class where school_id='$schoolId'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = $row['class_id'] == $selectedClassId ? 'selected' : '';
                ?>
                <option value="<?php echo $row['class_id'] ?>" <?php echo $selected ?>><?php echo $row['class_name'] ?></option>
                <?php
            }
        } else {
            echo '<option>No Class available</option>';
        }
        ?>
    </select>
</div>

          <div class="mb-3">
             <select class="form-select form-select-md" name="subject" id="subject">
             <option disabled>Choose subject</option>
               <?php
                                  $sql= "SELECT * FROM subjects where school_id='$schoolId'";
                                  $result = $conn->query($sql);
                                  if (mysqli_num_rows($result) > 0) {
                                  // output data of each row
                                  while($row = mysqli_fetch_assoc($result)) {
     
              ?>
            <option><?php echo $row['subject']?></option>
             <?php
                }
            }else{
                echo '<option>No subject available</option>';
            }
             ?>
             </select>
        </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">classroom</label>
            <textarea class="form-control" value="<?php ?>" name="classroom" id="classroom" required /></textarea>
          </div>
        
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" id="addexam" class="btn btn-primary">Add</button> -->
        <button type="button" id="updatexam" name="updatexam" class="btn btn-primary">Update</button>

      </div>
      </form>
    </div>
  </div>
</div>     
<?php      
// }
//         }else{
//            echo '<div class="bg-light p-5 text-center">
//             <h2></h2>
//             <p>You have no exam yet:</p>
//             <button class="btn btn-primary">Create Exam</button>
//             <button class="btn btn-success">Goback to admin page</button>
//           </div>';
//     }
?>




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
    header("location: ../schools/slogin.php");
}
?>

<script type="text/javascript">
    $(document).ready(function(){
      // when user click add exam
      $('#addexam').on('click', function(){
           var data = $("#addexam-form").serialize();   
            $.ajax({
                url: '../engine/addexam.php',
                type: 'post',
                async: false,
                data : data,
                 success: function(response){
                alert(response);
    
                }
            });
        }); 
        // when the user clicks on Edit exam
        $('.edit').on('click', function(){
           var postid = $(this).data('id');  
        //    alert(postid); 
            $.ajax({
                url: '../engine/edit_exam.php',
                type: 'post',
                async: false,
                data: {
                    'edit': 1,
                    'postid': postid
                     },
                     dataType: "json",
                 success: function(response){
                    // alert(JSON.parse(response.teacher_name));
                    $.each(response, function() {
                    $("#examid").val(this.examid);
                    $("#examdate").val(this.examdate);
                    $("#subject").val(this.subj);
                    $("#class").val(this.class);
                    $("#hall").val(this.classroom);
                    
                    });
                
               
    
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