

<?php
session_start();
if (isset($_POST['submit'])) {
    require_once "../engine/database.php";
    $surname = htmlspecialchars($_POST['surname']);
    $studentNo = htmlspecialchars($_POST['studentno']); 

    $sql = "SELECT * FROM student WHERE lastname ='$surname' and student_regno='$studentNo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $srow = $result->fetch_assoc();
        if ($srow["lastname"] == $surname && $srow["student_regno"] == $studentNo) {
            $_SESSION["student_id"] = $srow["id"];
            $_SESSION["student_regno"] = $srow["student_regno"];
			$_SESSION["school_id"]= $srow["schoolID"];
			$_SESSION["class_id"]= $srow["class_id"];



        } 
		header("location: myPortal.php");

    } else {
        $error_message = "Email or Password is incorrect.";
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
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login to your Portal</h2>
				</div>
			</div>
			<?php
if (isset($error_message)) {
    echo '<div class="alert alert-danger">' . $error_message . '</div>';
}
?>

			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
				  
		      	<h3 class="text-center mb-4">Sign In</h3>
						<form method="POST" class="login-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" name="surname" placeholder="Surname" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left"  name="studentno" placeholder="Student Number" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
								</div>
	            </div>
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

