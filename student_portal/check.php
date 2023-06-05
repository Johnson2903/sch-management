

<?php
session_start();
if (isset($_POST['submit'])) {
    require_once "../engine/database.php";
    $cardpin = htmlspecialchars($_POST['cardpin']);
    $examNo = htmlspecialchars($_POST['examNo']); 

    $sql = "SELECT * FROM student WHERE exam_no ='$examNo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $srow = $result->fetch_assoc();
        $_SESSION["examNo"] = $srow["exam_no"];

        // check if pin is valid and active
      $sql2 = "SELECT * FROM scratch_cards WHERE pin_code ='$cardpin'";
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["is_used"] == 0) {
            // Update the is_used column to 1
            $updateSql = "UPDATE scratch_cards SET is_used = 1 WHERE pin_code = '$cardpin'";
            if ($conn->query($updateSql) === true) {
                // Pin marked as used successfully
                // $_SESSION["student_id"] = $srow["id"];
                header("location: examTaken.php");
            // $error_message = "Now you can check your result.";

            } else {
                $error_message = "Failed to mark the pin as used: " . $conn->error;
            }
        } else {
            $error_message = "This Pin has already been used.";
        }
    } else {
        $error_message = "Invalid Pin.";
    }
    
        // if ($srow[""] == $surname && $srow["student_regno"] == $studentNo) {
        // if ($srow["exam"] == $surname) {

        // } 
    } else {
        $error_message = "Examination Number not correct.";
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Login Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
    <?php
include "nav.php";
?>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<!-- <h2 class="heading-section">Login to your Portal</h2> -->
				</div>
			</div>
          
			<?php
if (isset($error_message)) {
    echo '<div class="alert alert-danger" style="text-align: center;">' . $error_message . '</div>';

}
?>

			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<!-- <span class="fa fa-user-o"></span> -->
		      	</div>
				  
		      	<h3 class="text-center mb-4">check your result</h3>
						<form method="POST" class="login-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" name="cardpin" placeholder="Enter Your Card pin" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="" class="form-control rounded-left"  name="examNo" placeholder="Examination Number" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3"> Check</button>
	            </div>
	            <!-- <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
								</div> -->
	            <!-- </div> -->
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

