<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "../engine/database.php";
if(isset( $_SESSION["student_regno"])){
    // $_SESSION["student_regno"] 
    // $_SESSION["school_id"]
    $schoolName=$_SESSION["school_name"];
    $classid=$_SESSION["class_id"];
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

</head>
<style>
      body {
    background: #03045e;
}
</style>
<body>
<?php
include "nav.php";
?>
<br>
<p class="text-center">
  <strong class="text-white"><?php echo $schoolName; ?></strong>
  <strong class="text-white"><?php  echo $classid; ?></strong>

  
</p>
<div class="container-fluid">

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
                        <th>Time</th>

                        <th>Subject</th>
                        <th>Hall</th>
                        <th>Class</th>
                        <!-- <th>Count Down</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Exam date</th>
                        <th>Time</th>

                        <th>Subject</th>
                        <th>Hall</th>
                        <th>Class</th>
                   <!-- <th>Count Down</th> -->
                        <th>Action</th>

                    </tr>
                </tfoot>
                <tbody>
          <?php
          $sql= "SELECT * FROM examtimetable where schoolID='$schoolId' and class_id='$classid' ";
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
  <td id="examd"><?php echo date("F j, Y", strtotime($row["examdate"])) ?></td>
  <td class="fw-bold text-primary examt"><?php echo date("h:i A", strtotime($row["examTime"])); ?></td>
  <td id="subj"><?php echo $row["subj"]?></td>
  <td id="classr"><?php echo $row["classroom"]?></td>
  <td id="clas"><?php echo $row2["class_name"]?></td>
  <!-- <td><span class="countdown"></span></td> -->
  <td>
    <div class="input-group">
  

      <button class="questions btn btn-secondary" type="button" data-bs-toggle="" data-bs-target="" data-bs-whatever="@getbootstrap" data-id="<?php echo $row['examid']?>">
        Start Exam
      </button>
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
                <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Examination Timetable</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <!-- Table content -->
            </table>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" onclick="downloadTable()">Download Timetable</button>
    </div>
</div>
            <!-- </table> -->
        </div>
    </div>
<!-- </div> -->
<!-- </div> -->
      
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->






</body>
<script src="https://unpkg.com/html-docx-js/dist/html-docx.js"></script>
<script src="https://unpkg.com/html-docx-js/dist/html-docx.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.0/html2canvas.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/canvas2jpeg/1.0.0/canvas2jpeg.min.js"></script> -->

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


// function downloadTable() {
//   // Get the table element
//   var table = document.getElementById("dataTable");

//   // Use html2canvas to capture the table as a canvas
//   html2canvas(table).then(function(canvas) {
//     // Convert the canvas to a data URL containing a JPEG image
//     var dataURL = canvas.toDataURL("image/jpeg");

//     // Create a link element to trigger the download
//     var link = document.createElement("a");
//     link.href = dataURL;
//     link.download = "table.jpg";
//     link.click();
//   });
// }
function downloadTable() {
  // Get the table element
  var table = document.getElementById("dataTable");

  // Create an empty document
  var doc = new HTMLDocx();

  // Convert the table to HTML string
  var tableHtml = table.outerHTML;

  // Generate the Word document from the HTML
  doc.fromHTML(tableHtml);

  // Save the document as a blob
  var blob = doc.getBlob();

  // Create a link element to trigger the download
  var link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = "table.doc";
  link.click();
}



    $(document).ready(function(){
   
   

// when user click on questions
$('.questions').on('click', function() {
    var postid = $(this).data('id');  
    console.log(postid); 
    $.ajax({
        url: 'getexam.php',
        type: 'post',
        data: {
            'questions': 1,
            'postid': postid
        },
        dataType: "json",
        success: function(response) {
            // alert(response);
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
                    // "<div class='modal-body'>" + create + "</div>" +

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
        // error: function(xhr, status, error) {
        //     console.log(error);
        // }
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle error
            console.log(jqXHR.responseText);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
});







 });

    function closeModal() {
    $('#exampleModal').modal('hide');
    $('.modal-backdrop').remove();
}


  // Update all countdowns
  function updateCountdowns() {
    // Get the current time
    var currentTime = new Date().getTime();
// console.log(currentTime);
    // Iterate over examt elements
    document.querySelectorAll('.examt').forEach(function(examtElement) {
      // Get the target time
      var targetTime = new Date(examtElement.textContent).getTime();
    //   console.log(targetTime);
      // Calculate the remaining time in milliseconds
      var remainingTime = targetTime - currentTime;

      // Find the corresponding countdown element
      var countdownElement = document.getElementsByClassName("countdown" + targetTime)[0];

      // If the countdown element exists
      if (countdownElement) {
        // Calculate days, hours, minutes, and seconds
        var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

        // Display the countdown
        countdownElement.innerHTML = `
          <div class="row">
            <div class="col">
              <span class="fw-bold">${days}</span> days
            </div>
            <div class="col">
              <span class="fw-bold">${hours}</span> hours
            </div>
            <div class="col">
              <span class="fw-bold">${minutes}</span> minutes
            </div>
            <div class="col">
              <span class="fw-bold">${seconds}</span> seconds
            </div>
          </div>
        `;
// console.log(countdownElement.innerHTML)
        // If the countdown is finished, remove the countdown element
        if (remainingTime <= 0) {
          countdownElement.remove();
        }
      }
    });

    // If there are no more countdowns, clear the interval
    if (document.querySelectorAll('.examt').length === 0) {
      clearInterval(countdownInterval);
    }
  }

  // Update the countdowns every second
  var countdownInterval = setInterval(updateCountdowns, 1000);

  // Initial update of countdowns
 


</script>