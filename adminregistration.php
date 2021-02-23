<?php 
	
$showAlert = false; 
$showError = false; 
$exists=false; 
	
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	
	// Include file which makes the 
	// Database Connection. 
	include 'regdbconnect.php'; 
	
	$username = $_POST["username"]; 
	$password = $_POST["password"]; 
	$cpassword = $_POST["cpassword"]; 
	$phone = $_POST["phone"];	
	$email = $_POST["email"];
	$FM = $_POST["FM"];
		
	
	$sql = "Select * from patient where username='$username'"; 
	
	$result = mysqli_query($conn, $sql); 
	
	$num = mysqli_num_rows($result); 
	
	// This sql query is use to check if 
	// the username is already present 
	// or not in our Database 
	if($num == 0) { 
		if(($password == $cpassword) && $exists==false) { 

			$hash = password_hash($password, 
								PASSWORD_DEFAULT); 
				
			// Password Hashing is used here. 
			$sql = "INSERT INTO `admin` ( `username`, 
				`password`, `phone`,`email`,`FM`, `date`) VALUES ('$username', 
				'$hash','$phone','$email','$FM',current_timestamp())"; 
	
			$result = mysqli_query($conn, $sql); 
	
			if ($result) { 
				$showAlert = true; 
			} 
		} 
		else { 
			$showError = "Passwords do not match"; 
		}	 
	}// end if 
	
if($num>0) 
{ 
	$exists="Username not available"; 
} 
	
}//end if 
	
?> 

<!DOCTYPE html>
<html lang="en">
<?php 
	
	if($showAlert) { 
	
		echo ' <div class="alert alert-success 
			alert-dismissible fade show" role="alert"> 
	
			<strong>Success!</strong> Your account is 
			now created and you can login. 
			<button type="button" class="close"
				data-dismiss="alert" aria-label="Close"> 
				<span aria-hidden="true">×</span> 
			</button> 
		</div> '; 
	} 
	
	if($showError) { 
	
		echo ' <div class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Error!</strong> '. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close"> 
			<span aria-hidden="true">×</span> 
	</button> 
	</div> '; 
} 
		
	if($exists) { 
		echo ' <div class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
	
		<strong>Error!</strong> '. $exists.'
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close"> 
			<span aria-hidden="true">×</span> 
		</button> 
	</div> '; 
	} 

?> 

	<head>
		<title>User Registration</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		
	</head>

	<body class="login">
		<!-- start: REGISTRATION -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<h2>Admin Registration</h2>
				</div>
				<!-- start: REGISTER BOX -->
				<div class="box-register">
					<form name="registration" id="registration"  method="post">
						<fieldset>
							<legend>
								Sign Up
							</legend>
							<p>
								Enter your personal details below:
							</p>
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="username" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="password" placeholder="password" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="cpassword" placeholder="cpassword" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="phone" placeholder="phone" required>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="email" required>
									<i class="fa fa-envelope"></i> </span>
									 <span id="user-availability-status1" style="font-size:12px;"></span>
							</div>
							<div class="form-group">
								<label class="block">
									Gender
								</label>
								<div class="clip-radio radio-primary">
									<input type="radio" id="rg-female" name="FM" value="female" >
									<label for="rg-female">
										Female
									</label>
									<input type="radio" id="rg-male" name="FM" value="male">
									<label for="rg-male">
										Male
									</label>
								</div>
							</div>
							
							
							
							<div class="form-group">
								<div class="checkbox clip-check check-primary">
									<input type="checkbox" id="agree" value="agree">
									<label for="agree">
										I agree
									</label>
								</div>
							</div>
							<div class="form-actions">
								<p>
									Already have an account?
									<a href="adminlogin.php">
										Log-in
									</a>
								</p>
								<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>	
		
	</body>
	<!-- end: BODY -->
</html>