<?php

require_once("session.php");

$error = "";
$msg = "";
include("./dbconn.php");

if($session->get("userArray")){
	header("Location:index.php");
}

if (isset($_REQUEST['login'])) {

	$email = isset($_REQUEST['email']) && !empty($_REQUEST['email']) ? $_REQUEST['email'] :  "";
	$pass = isset($_REQUEST['pass']) && !empty($_REQUEST['pass']) ? $_REQUEST['pass'] : "";

	if (!empty($email) && !empty($pass)) {
		$password = base64_encode($pass);
		$sql = "SELECT * FROM user where uemail='$email' && upass='$password'";
		$row = $conn->fetch_raw($sql);
	
		// Deleting Previous Session Variables If Any Existing 
		foreach ($_SESSION as $key => $value) {
			$session->remove($key); // Remove all session variables
		}
	
		if ($row) {
			$userArray = array();
			foreach ($row as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $k => $v) {
						$userArray[$k] = $v;
					}
				} else {
					$userArray[$key] = $value;
				}
			}
			$utype = $userArray["utype"];
	
			// Getting Property details for Respective User
			$userID = $userArray['uid'];
			$sql  = "SELECT * FROM property WHERE iUID = $userID";
			$propertyData = $conn->fetch_raw($sql);
			// Set session variables
			$session->set('userArray', $userArray);
			$session->set('propertyData', $propertyData);
			$type = $userArray["utype"];
			if($type == "buyer"){
				$action = "buy";
			}
			else if($type =="seller"){
				$action = "yourproperty";
			}
			header("location:sellerdashboard.php?userID=$userID&action=yourproperty&type=$utype");
		} else {
			$error = "<p class='alert alert-warning'>Login Not Successfully</p> ";
		}
	} else {
		$error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
	}
	
}

?>

<div>
	<!-- <div class="row"> -->
	<!--	Header start  -->
	<?php include("include/header.php"); ?>
	<!--	Header end  -->




	<div class="page-wrappers login-body full-row bg-gray">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>Login</h1>
							<p class="account-subtitle">Access to our dashboard</p>
							<?php echo $error; ?><?php echo $msg; ?>
							<!-- Form -->
							<form method="post">
								<div class="form-group">
									<input type="email" name="email" class="form-control" placeholder="Your Email*">
								</div>
								<div class="form-group">
									<input type="password" name="pass" class="form-control" placeholder="Your Password">
								</div>

								<button class="btn btn-primary" name="login" value="Login" type="submit">Login</button>

							</form>

							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<!-- Social Login -->
							<div class="social-login">
								<span>Login with</span>
								<a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
								<a href="#" class="google"><i class="fab fa-google"></i></a>
								<a href="#" class="facebook"><i class="fab fa-twitter"></i></a>
								<a href="#" class="google"><i class="fab fa-instagram"></i></a>
							</div>
							<!-- /Social Login -->

							<div class="text-center dont-have">Don't have an account? <a href="register.php">Register</a></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--	login  -->


	<!--	Footer   start-->
	<?php include("include/footer.php"); ?>
	<!--	Footer   start-->

	<!-- Scroll to top -->
	<a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>
	<!-- End Scroll To top -->
	<!-- </div> -->
</div>