<?php
include ("class\connect.php");
include ("class\cls_userlogin.php");

$retval = 0;
$remember = NULL;
$_SESSION['cookieUnset'] = 2;
if (isset($_POST['email'])){
	$user=$_POST['user'];
	$Email = $_POST['email'];
	$Pass = $_POST['pass'];
	if(isset($_POST['remember'])){
		$remember = 1;
	}
	$loginobj= new User();
	$retval=$loginobj->userlogin($Email,$Pass,$user,$remember);
	if($retval == 1){
		header("Location: faculty/index.php");}
	else if($retval == 2){
		header("Location: student/index.php");
	}
}
if(isset($_COOKIE['cookieEmail'])) {
		$_SESSION['cookieUnset'] = NULL;
		$cookieEmail = $_COOKIE['cookieEmail'];
		$cookiePass = $_COOKIE['cookiePass'];
		$cookieuser = $_COOKIE['cookieuser'];
		$cookieRem = $_COOKIE['remember'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>E-Learning System -Video Portal</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="img/png" href="img/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="POST">
					<span class="login100-form-title p-b-43">
						<img src=".\img\SCMS-logo2.jpg" alt="">
					</span>
					<div class="form-check ">
					<?php if(isset($cookieuser)){ ?>
						<input class="form-radio-input ml-4" type="radio" name="user" value="student"  <?php if($cookieuser=="student") echo"checked";?>>
						<span class="">Student</span>
						<input class="form-radio-input ml-4" type="radio" name="user" value="faculty"  <?php if($cookieuser=="faculty") echo"checked";?>>
						<span class="">Faculty</span>
						<?php } else { ?>
							<input class="form-radio-input ml-4" type="radio" name="user" value="student" checked>
						<span class="">Student</span>
						<input class="form-radio-input ml-4" type="radio" name="user" value="faculty">
						<span class="">Faculty</span>
						<?php } ?>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<?php if(isset($cookieEmail)){ ?>
							<input class="input100 has-val" type="text" name="email" value= "<?php echo $cookieEmail ?>">
						<?php } if(isset($_SESSION['cookieUnset'])) { ?>
							<input class="input100" type="text" name="email" ?>
						<?php }?>
						<span class="focus-input100"></span>
						<span class="label-input100" name = "email" >Email</span>
					</div>
						<?php if ($retval == -2) { ?>
							<span class ="text-danger">E-mail is incorrect or does not exist</span>
						<?php } ?>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<?php if(isset($cookiePass)){ ?>
							<input class="input100 has-val" type="password" name="pass" value= "<?php echo $cookiePass ?>">
						<?php } if(isset($_SESSION['cookieUnset'])) { ?>
							<input class="input100" type="password" name="pass">
						<?php }?>
						<span class="focus-input100"></span>
						<span class="label-input100" name= "pass" >Password</span>
					</div>
						<?php if ($retval == -1) { ?>
							<span class ="text-danger">Password is incorrect</span>
						<?php } ?>

					<div class="flex-sb-m w-full p-t-3 p-b-32 mt-3">
						<div class="contact100-form-checkbox">
						<?php if(isset($cookieRem)) { ?>
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" value="" checked>
						<?php } else { ?>
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" value="">
							<?php }?>
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="forgotpassword.php" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
					<button type="submit" name="submit" class="login100-form-btn">
							Login
						</button>
					</div>

				</form>

				<div class="login100-more" style="background-image: url('img/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>