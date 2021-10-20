<?php 
    require 'class/connect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        if(isset($_POST['resetpwd'])) {
            $sql2 = "SELECT DISTINCT sEmail FROM tbl_student UNION SELECT DISTINCT sEmail FROM tbl_faculty";
            $result = mysqli_query($con,$sql2);
            while($row = mysqli_fetch_array($result)) {

                if($_POST['resetEmail'] == $row['sEmail'] ){
                
                    $selector = bin2hex(random_bytes(8));
                    $token = random_bytes(32);
                    $userEmail = $_POST["resetEmail"];
                    $url = "http://localhost/elearningFP/newpassword.php?selector=" . $selector . "&validator=" . bin2hex($token) . "&email=" . $userEmail;
                    $expires = date("U") + 1800;

                    $sql = "DELETE FROM tbl_pwdreset WHERE pwd_reset_email = ?;";

                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        die("There was an error: prepared statements");
                    }
                    mysqli_stmt_bind_param($stmt, "s", $userEmail);
                    mysqli_stmt_execute($stmt);

                    $sql = "INSERT INTO tbl_pwdreset(pwd_reset_email, pwd_reset_selector, pwd_reset_token, pwd_reset_expires) VALUES (?,?,?,?);";
                    
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        die("There was an error: prepared statements");
                    } 
                    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_close($stmt);
                

                    $to =  $userEmail;
                    $subject = 'Reset your password for E-learning';
                    $message = '<p> We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email. </p>';
                    $message .= '<p>Password reset link: </br>';
                    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'thakathakatha123@gmail.com';           //SMTP username
                    $mail->Password   = 'thakthak123';                          //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('elearning', 'elearning');
                    $mail->addAddress($to);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    header("Location: forgotpassword.php?reset=success");
                    mysqli_close();
                }
                else header("Location: forgotpassword.php?reset=failed");
            }
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
                <h3 class="mb-0">Password Reset</h3>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="" >
                    <div class="form-group">
                        <label style="font-size: 15px !important;" for="inputResetPasswordEmail">Email</label>
                        <input type="email" name="resetEmail" class="form-control" id="inputResetPasswordEmail" required>
                        <span id="helpResetPasswordEmail" class="form-text small text-muted">
                            Password reset instructions will be sent to this email address.
                        </span>
                        <?php
                            if(isset($_GET['reset'])){
                                if($_GET['reset'] == "success") {
                                    echo '<p class="text-success">Reset link sent. Check your E-mail </p>';
                                }
                                if($_GET['reset'] == "failed") {
                                    echo '<p class="text-danger">Mail not registered with website</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="resetpwd" class="btn btn-success float-right">Reset</button>
                        <a style="text-decoration: none;" class="btn btn-secondary float-right mr-2 text-white" href="index.php">Go back</a>
                    </div>
                </form>
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