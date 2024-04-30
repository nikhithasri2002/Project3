<?php
include("dbconn.php");
$error = "";
$msg = "";


	if (isset($_REQUEST['reg'])) {
		$target_dir = "uploads/";
		if(!file_exists($target_dir)){
			mkdir($target_dir, 0777, true);
		}

		$name = isset($_POST["name"]) ? $_POST["name"] : "";
		$email = isset($_POST["email"]) ? $_POST["email"] : "";
		$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
		$pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
		$utype = isset($_POST["utype"]) ? $_POST["utype"] : "";
		$uimage = isset($_FILES["uimage"]["name"]) ? $_FILES["uimage"]["name"] : "";

		// Sanitize inputs before using in SQL query
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$phone = filter_var($phone, FILTER_SANITIZE_STRING);
		$pass = filter_var($pass, FILTER_SANITIZE_STRING);
		$utype = filter_var($utype, FILTER_SANITIZE_STRING);

		// Check if email already exists
		$fetc_sql = "SELECT * FROM `user` WHERE `uemail` = '$email'";
		$data = $conn->fetch_raw($fetc_sql);
		if (!empty($data)) {
			$error = "<p class='alert alert-warning'>Email Id already Exist</p> ";
		}

		// Check if all fields are filled
		if (empty($name) || empty($email) || empty($phone) || empty($pass)) {
			$error = "* Please Fill all the Fields";
		} else {
			// Insert data into database
			$password = base64_encode($pass);
			$sql = "INSERT INTO `user`(`uname`, `uemail`, `uphone`, `upass`, `utype`, `uimage` , `subscriptionStatus`) VALUES ('$name' , '$email' , '$phone', '$password' , '$utype' , '$uimage' , 'free')";
			$insertID = $conn->insert_raw($sql);
			if ($insertID > 0) {
				$msg = "<p class='alert alert-success'>Register Successfully</p> ";

				// Upload image file
				$tmp_name = isset($_FILES["uimage"]["tmp_name"]) ? $_FILES["uimage"]["tmp_name"] : "";
				// echo $tmp_name;exit;
				if (!empty($tmp_name)) {
					if (move_uploaded_file($tmp_name, $target_dir . '/' . $uimage)) {
						chmod($target_dir . '/' . $uimage, 0777);
						$msg .=  "File uploaded successfully.";
					} else {
						$error .= "Error uploading file.";
					}
				}
				header("location:login.php");
			}
		}
	}


?>



<div>
	<div class="row">
		<!--	Header start  -->
		<?php include("include/header.php"); ?>
		<!--	Header end  -->




		<div class="page-wrappers login-body full-row bg-gray">
			<div class="login-wrapper">
				<div class="container">
					<div class="loginbox">
						<div class="login-right">
							<div class="login-right-wrap">
								<h1>Register</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								<p class="text-danger"><?php $error ?></p>
								<p class="text-sucess"><?php $msg ?></p>

								<!-- Form -->
								<form method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>">
									<div class="form-group">
										<input type="text" name="name" class="form-control" placeholder="Your Name*">
									</div>
									<div class="form-group">
										<input type="email" name="email" class="form-control" placeholder="Your Email*">
									</div>
									<div class="form-group">
										<input type="text" name="phone" class="form-control" placeholder="Your Phone*" maxlength="10">
									</div>
									<div class="form-group">
										<input type="password" name="pass" class="form-control" placeholder="Your Password*">
									</div>

									<div class="form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="utype" value="buyer" checked>User
										</label>
									</div>
									<div class="form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="utype" value="agent">Agent
										</label>
									</div>
									<div class="form-check-inline disabled">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="utype" value="seller">Seller
										</label>
									</div>

									<div class="form-group">
										<label class="col-form-label"><b>User Image</b></label>
										<input class="form-control" name="uimage" type="file">
									</div>

									<button class="btn btn-primary" name="reg" value="Register" type="submit">Register</button>

								</form>

								<div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div>

								<!-- Social Login -->
								<div class="social-login">
									<span>Register with</span>
									<a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
									<a href="#" class="google"><i class="fab fa-google"></i></a>
									<a href="#" class="facebook"><i class="fab fa-twitter"></i></a>
									<a href="#" class="google"><i class="fab fa-instagram"></i></a>
								</div>
								<!-- /Social Login -->

								<div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>

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
	</div>
</div>
<!-- Wrapper End -->


</body>

</html>