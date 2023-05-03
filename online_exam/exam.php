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
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Exams</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Examination Timetable</h6>
    </div>
    
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<section class="bg-light py-5">
            <div class="container px-5 my-5 px-5">
                <div class="text-center mb-5">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                    <h2 class="fw-bolder">Get in touch</h2>
                    <p class="lead mb-0">We'd love to hear from you</p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                    
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>






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
        // when the user clicks on Update
//     $('#updatexam').on('click', function() {
//   let data = $("#updatexam-form").serialize();  

//   $.ajax({
//     url: '../engine/update_exam.php',
//     type: 'post',
//     data: data,
//     success: function(response) {
//       try {
//         let data = JSON.parse(response);
//         $("#examdate").val(data[0].examdate);
//         $("#subject").val(data[0].subj);
//         $("#class").val(data[0].class);
//         $("#hall").val(data[0].classroom);
//         alert('EXAM updated successfuly');
//       } catch (e) {
//         console.log('Error parsing JSON response: ' + response);
//       }           
//     },
//     error: function(xhr, status, error) {
//       console.log('Error: ' + error);
//     }
//   });
// });
        // $('#updatexam').on('click', function(){
        //    let data = $("#updatexam-form").serialize();  
        // //    let updateteacher= $("#updateteacher").data('id');             
        // //    alert(data); 
        //     $.ajax({
        //         url: '../engine/update_exam.php',
        //         type: 'post',
        //         async: false,
        //         data:data,
        //         dataType: "json",
        //          success: function(response){
        //              $.each(response, function() {
        //                 alert(response);
        //             $("#examdate").val(this.examdate);
        //             $("#subject").val(this.subj);
        //             $("#class").val(this.class);
        //             $("#hall").val(this.classroom);
        //             // alert('EXAM updated successfuly');
        //             });            
    
        //         }
        //     });
        // });
        // when the user clicks on delete
        $('.delete').on('click', function(){
           var subjectid = $(this).data('id');  
           // alert(teacherid); 
            $.ajax({
                url: '../engine/edit_subject.php',
                type: 'post',
                async: false,
                data: {
                    'delete': 1,
                    'subjectid': subjectid
                     },
                     dataType: "json",
                 success: function(response){
                    // alert(JSON.parse(response.teacher_name));
                    $.each(response, function() {
                    $("#sname").text(this.subject);

                    // $("#tsubject").text(this.teacher_subject);
                    // $("#tname").text(this.teacher_name);
                    // $("#temail").text(this.teacher_email);
                    // $("#tphone").text(this.teacher_phone);
                    // $("#taddress").text(this.teacher_adddress);
                    alert(this.subject);
                    });
                
               
    
                },
            });
        });
    });
</script>