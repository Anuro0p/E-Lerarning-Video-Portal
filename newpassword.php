<?php 

require 'class/connect.php';
    if(isset($_GET['selector']) && isset($_GET['validator'])){

        if(isset($_POST['resetpwd'])){

            $pwd = $_POST["pwd"];
            $repeatpwd = ($_POST["repeatpwd"]);
            if($pwd != $repeatpwd){
                $errMsg = "Password does not match.";
            } else {

                    $selector = $_POST["selector"];
                    $validator = $_POST["validator"];
                    $userEmail = $_GET["email"];

                    $currentDate = date("U");

                    $sql = "SELECT * FROM tbl_pwdreset WHERE pwd_reset_selector = ? AND pwd_reset_expires >= ?";

                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        die("There was an error: prepared statements");
                    }
                    mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);
                    if(!$row = mysqli_fetch_assoc($result)){
                        die("There was an error: result error[Link might have expired]");
                    }
                    else {
                        $tokenBin = hex2bin($validator);
                        // echo $row['pwd_reset_token'];
                        // echo $tokenBin;
                        // exit();
                        $tokenCheck = password_verify($tokenBin, $row['pwd_reset_token']);
                        if($tokenCheck == false) { 
                            die("There was an error: token error");
                        }
                        else if($tokenCheck == true){
                            $facultyCheck = "SELECT * from tbl_faculty where sEmail = '$userEmail'";
                            $result=mysqli_query($con,$facultyCheck);
                            $row=mysqli_fetch_assoc($result);
                            $hashedPass = md5($pwd);
                            if($row['sEmail'] == $userEmail){
                                $facultyUpdate = "UPDATE tbl_faculty SET sPassword = '$hashedPass' where sEmail = '$userEmail'";
                                if(mysqli_query($con,$facultyUpdate)){
                                    echo '<script>alert("Password changed successfully. Click ok to login again.");  window.location.href="index.php";</script>';
                                } else die("There was an error: Faculty password change error"); 
                            } else {
                                $studentUpdate = "UPDATE tbl_student SET sPassword = '$pwd' where sEmail = '$userEmail'";
                                $result=mysqli_query($con,$studentUpdate);
                                if(mysqli_query($con,$studentUpdate)){
                                    echo '<script>alert("Password changed successfully. Click ok to login again.");  window.location.href="index.php";</script>';
                                } else die("There was an error: Student password change error");
                            }
                            $deleteToken = "DELETE from tbl_pwdreset where pwd_reset_email = '$userEmail'";
                            $result=mysqli_query($con,$deleteToken);
                        }
                    }
                 }

            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning</title>

    <!-- Fonts and icons -->
	<script src="js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="css/demo.css">

</head>
<body>
    <div class="container d-flex justify-content-center">
        <div style="margin-top: 12.5rem" class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0">New password</h3>
            </div>
            <div class="card-body">
                <?php 
                    $selector = $_GET['selector'];
                    $validator = $_GET['validator'];

                    if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){

                ?>
                <form class="form" method="post" action="" >
                    <div class="form-group">
                        <!-- <label style="font-size: 15px !important;" for="inputResetPasswordEmail">Email</label> -->

                        <input type="hidden" name="selector"  value="<?php echo $selector; ?>">
                        <input type="hidden" name="validator"  value="<?php echo $validator; ?>">

                        <input type="password" name="pwd" class="form-control" placeholder="Enter new password" required>
                        <input type="password" name="repeatpwd" class="form-control mt-2" placeholder="Repeat password" required>
                        <span class="form-text small text-muted">
                           Try to add UPPERCASE, NUMBERS and SYMBOLS to secure your account
                        </span>
                        <?php if(isset($errMsg)){ ?>
                        <span class="form-text small text-muted text-danger">
                            <?php echo $errMsg?>
                        </span>
                        <?php } ?>
                        <?php
                            if(isset($_GET['reset'])){
                                if($_GET['reset'] == "success") {
                                    echo '<p class="text-success">Reset link sent. Check your E-mail </p>';
                                }
                                if($_GET['reset'] == "failed") {
                                    echo '<p class="text-danger">Mail not registered with website</p>';
                                }
                                if($_GET['pass'] == "nomatch") {
                                    echo '<p class="text-warning">Password does not match. Try again.</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="resetpwd" class="btn btn-success float-right">Reset</button>
                    </div>
                </form>
             <?php  } ?>
            </div>
        </div>
    </div>

	<!--   Core JS Files   -->
    <script src="js/core/jquery.3.2.1.min.js"></script>
    <script src="js/core/popper.min.js"></script>
    <script src="js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- Bootstrap Notify -->
    <script src="js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!--  -->
    <!-- jQuery Scrollbar -->
    <script src="js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Atlantis JS -->
    <script src="js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->

</body>
</html>

<?php } else header('Location: index.php'); ?>