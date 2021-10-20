<?php
session_start();
include ("..\class\connect.php");
include ("..\class\cls_login.php");
include("..\class\alert.php");
$retval=1;
$errmsg="";
$email=$_SESSION['username']; 
if(isset($_POST['submit']))
{
    $oldpassword=md5($_POST['oldpassword']);
    $password=md5($_POST['password']);
	$loginobj= new adminLogin();
	$retval=$loginobj->changepassword($email,$oldpassword,$password);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Elearning</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../css/demo.css">
</head>
<body>

	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header bg-light" >
				
				<a href="https://www.scmsgroup.org/" class="logo">
					<img width="190"  src="../img/scms.png" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i  class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler  more"><i  class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar and sidebar -->
			<nav  class="navbar navbar-header bg-dark  navbar-expand-lg"  >
				
				<div class="container-fluid">
					
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<span  style= " font-weight: bolder;  color: rgb(255, 255, 255);" class="avatar-img  rounded-circle">Logout</span>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<a class="dropdown-item" href="changepassword.php">Change password</a>
											<a type="submit" href="logout.php"  name="logout" class="dropdown-item" value="">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div style="background-color: rgb(255, 255, 255);" class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div style="border-bottom: 0px solid black ;" class="user">
						<div class="avatar-sm float-left mr-2">
						<object class="avatar-img rounded-circle" data="..\..\img\depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" type="image/png">
							<img src="..\img\depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" class="avatar-img rounded-circle">
						</object>
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<!-- <span class="user-level" onClick="location.href='..\index.php';" style=" margin-top:15px;"> Administrator</span> -->
									<a class="user-level" href="..\index.php">
										<span style=" margin-top:15px;" class="user-level fw-bold" onclick="hide(); return false">Administrator</span>
									</a>
								</span>
							</a>
							<!--<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>-->
						</div>
					</div>
					<ul class="nav nav-primary">
						
						<li style="background-color: rgb(204, 204, 204);" class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">  </h4>
						</li>
						<li class="nav-item">
							<a href="student\index.php"><p style = "font-size: 1.1rem; color: black;">Students</p></a>
						</li>
						<li class="nav-item">
							<a href="department\index.php"><p style = "font-size: 1.1rem; color: black;">Department</p></a>
						</li>
						<li class="nav-item">
							<a href="semester\index.php"><p style = "font-size: 1.1rem; color: black;">Semester</p></a>
						</li>
						<li class="nav-item">
							<a href="program\index.php"><p style = "font-size: 1.1rem; color: black;">Program</p></a>
						</li>
						<li class="nav-item">
							<a href="subject\index.php"><p style = "font-size: 1.1rem; color: black;">Subject</p></a>
						</li>
						<li class="nav-item">
							<a href="faculty\index.php"><p style = "font-size: 1.1rem; color: black;">Faculty</p></a>
						</li>
						<li class="nav-item">
							<a href="batch\index.php"><p style = "font-size: 1.1rem; color: black;">Batch</p></a>
						</li>
						<li class="nav-item">
							<a href="subjectAllocation/index.php"><p style = "font-size: 1.1rem; color: black;">Subject allocation</p></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
			<!-- End Navbar and sidebar -->



		<div  class="main-panel align-middle ">
			<div style="" class="bg-light content">

				<div class="col-md-12 ">
					<div class="card mt-4 bg-light">
						<div class="card-header">
							<div class="card-title">
							<h3 style="font-size: 30px; display: inline-block;">Change Password</h3>
							</div>
						</div>
						<div class="card-body">
							<div class="col-md-5 mr-auto ml-auto ">
								<div class="card mt-4  bg-light">
									<div class="card-header">
										<div class="card-title">
                                            Change Password
										</div>
									</div>
									<div class="card-body">
										<form method="POST" action="" name="f1" onsubmit="return validateform()">
											<div class="form-group">
												<label for="exampleInputEmail1">Old password</label>
												<input type="password" class="form-control" id="exampleInputEmail1" name="oldpassword" aria-describedby="emailHelp" placeholder="Enter existing password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : '');" required>
												<p style = "color: red;"><?php echo $errmsg; ?></p>
											</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">New password</label>
												<input type="password" class="form-control" id="exampleInputEmail1" name="password" aria-describedby="emailHelp" placeholder="Enter New Password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : '');" required>
												<p style = "color: red;"><?php echo $errmsg; ?></p>
											</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Confirm new password</label>
												<input type="password" class="form-control" id="exampleInputEmail1" name="cpassword" aria-describedby="emailHelp"placeholder="Confirm New Password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : '');" required>
												<p style = "color: red;"><?php echo $errmsg; ?></p>
											</div>
											<button type="submit" name="submit" class="btn btn-primary ml-1 float-right">Submit</button>
										</form>
									</div>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
		 <footer class="footer bg-dark2">
				
					
					<div class="copyright ml-auto text-center">
						 Copyright  2021 &copy;<!--<i class="fa fa-heart heart text-danger"></i>--> Powered by <span  style= " font-weight: bolder;  color: rgb(255, 255, 255);" class="avatar-img  rounded-circle">Web Development Team SSTM</span>
					</div>				
				
			</footer> 


			<!--<footer  class=" bg-dark2 text-center text-lg-start">
				<!-- Copyright -->
				<!--<div class="text-center p-3" >
				  © 2020 Copyright:
				  <a class="text-light" href="">Web development team SSTM</a>
				</div>-->
				<!-- Copyright -->
			 <!-- </footer>-->

		</div>
		
		<!-- Custom template | don't include it in your project! -->
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
    <script src="../js/core/jquery.3.2.1.min.js"></script>
    <script src="../js/core/popper.min.js"></script>
    <script src="../js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="../js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- Bootstrap Notify -->
    <script src="../js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Atlantis JS -->
    <script src="../js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="../js/setting-demo2.js"></script>


	<script>
    function passwordsame()
{
$.notify({
    // options
    icon: 'glyphicon glyphicon-warning-sign',
    title: 'Warning..!',
    message: 'Password must be same..',
    target: '_blank'
},{
    // settings
    element: 'body',
    position: null,
    type: "info",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
        from: "top",
        align: "center"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 5000,
    timer: 2000,
    url_target: '_blank',
    mouse_over: null,
    animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: 'class',
    template: '<div style="background-color:#fff5c8" data-notify="container" class="col-xs-11 col-sm-3 alert alert-warning" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span style="color:#4d2e1a" data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
    '</div>' 
});
}
</script>

<script>
function validateform()
        {
            var a=document.f1.cpassword.value;
            var b=document.f1.password.value;
            if(a==b){
                return true;
            }
            else{
                passwordsame();
                return false;
            }

        }
</script>
<?php
if(isset($_SESSION['successFlag'])){
    if(($_SESSION['successFlag'])==1){
        custom_alert("Success..!","Password changed successfully","success");
        unset($_SESSION['successFlag']);
    }
}
if(isset($_SESSION['passwordFlag'])){
    if(($_SESSION['passwordFlag'])==1){
        custom_alert("Warning..!","Old Password entered is incorrect","warning");
        unset($_SESSION['passwordFlag']);
    }
}
if(isset($_SESSION['errorFlag'])){
    if(($_SESSION['errorFlag'])==1){
        custom_alert("Warning..!","Error in changing","warning");
        unset($_SESSION['errorFlag']);
    }
}
?>
</body>
</html>