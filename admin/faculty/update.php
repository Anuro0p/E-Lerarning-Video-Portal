<?php
	include ("..\..\class\connect.php");
	include ("..\..\class\cls_faculty.php");
	include ("..\..\class\alert.php");
	
    $updateid = $_GET['updateid'];
    if(isset($_GET['updateid'])){
        $edit="SELECT * from tbl_faculty,tbl_department where tbl_faculty.Dep_ID = tbl_department.ID and tbl_faculty.ID='$updateid'";
        $updateQuery=mysqli_query($con,$edit);
        $row=mysqli_fetch_array($updateQuery);
    }

    if(isset($_POST['fname'])){
        $fac = $_POST['fname'];
        $desi = $_POST['desi'];
        $quali = $_POST['quali'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $depID = $_POST['depID'];
		$editid= $updateid;
		$facobj= new Faculty();
		$retval=$facobj->updateFac($editid,$fac, $desi, $quali, $email, $gender, $phone, $depID);
		if($retval == 1){
			header("Location: index.php");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Elearning</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../../img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../../js/plugin/webfont/webfont.min.js"></script>
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
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../../css/demo.css">
</head>
<body>
<div class="wrapper">
<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header bg-light" >
				
				<a href="https://www.scmsgroup.org/" class="logo">
					<img width="190"  src="../../img/scms.png" alt="navbar brand" class="navbar-brand">
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
			<!-- Navbar and sidebar -->
			<?php include ("../../include/menu.php"); ?>
			<!-- End Navbar and sidebar -->

		<div  class="main-panel align-middle ">
			<div style="" class="bg-light content">

				<div class="col-md-12 ">
					<div class="card mt-4 bg-white">
						<div class="card-header">
						<div class="card-title"> 
								<h3 style="font-size: 30px; display: inline-block;">Faculty </h3>
							</div>
						</div>
						<div class="card-body">
							<div class="col-md-5 mr-auto ml-auto ">
								<div class="card mt-4">
								<div class="card-header">
										<div class="card-title">
											Edit Faculty
										</div>
									</div>
									<div class="card-body bg-white">
										<form action="" method="POST">
											<div class="form-group">
												<label for="exampleInputEmail1">Faculty</label>
												<!-- row[2] display sName from tbl_faculty -->		 
												<input type="text" name="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" value="<?php echo $row[2]; ?>"> 
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Designation</label>
												<input type="text" name="desi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Designation" value="<?php echo $row['sDesignation']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Qualification</label>
												<input type="text" name="quali" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Qualification" value="<?php echo $row['sQualification']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">E-mail</label>
												<input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo $row['sEmail']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleFormControlSelect1">Gender</label>
													<select name="gender" class="form-control" id="exampleFormControlSelect1">
														<?php 																	
															if ($row['sGender'] == 0) $genderFlag = 0;
																else if ($row['sGender'] == 1) $genderFlag = 1;
																else $genderFlag = 2;
														?>
														<option value="0"<?php if ($genderFlag == 0) echo "selected" ?>> Male</option>
														<option value="1"<?php if ($genderFlag == 1) echo "selected" ?>> Female</option>
														<option value="2"<?php if ($genderFlag == 2) echo "selected" ?>> Other</option>
													</select>
											</div>
											<div class="form-group">
												<label for="exampleFormControlSelect1">Multiple Departments</label>
													<select name="gender" class="form-control" id="exampleFormControlSelect1">
														<?php 																	
															if ($row['iCommon_Dep'] == 1) $CommonDep = 1;
																else $CommonDep = 0;
														?>
														<option value="0"<?php if ($CommonDep == 0) echo "selected" ?>> No</option>
														<option value="1"<?php if ($CommonDep == 1) echo "selected" ?>> Yes</option>
													</select>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Phone</label>
												<input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone" value="<?php echo $row['iPhone']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleFormControlSelect1">Department</label>
													<select name="depID" class="form-control" id="exampleFormControlSelect1">
														<?php 
															$sql =  "SELECT* FROM tbl_department where iStatus = 1";
															$result = mysqli_query($con,$sql);
																while($row2 = mysqli_fetch_assoc($result)) { 
														?>
											<option value="<?php echo $row2['ID'];?>"<?php if($row2['sName']==$row['sName']) echo "selected" ?>><?php echo $row2['sName'];?></option>


														<?php } ?>
													</select>
											</div>
											<button name="submit" type="submit" class="btn btn-primary ml-3 float-right">Submit</button>
											<a href="index.php"><input type="button" value="Cancel" class="btn btn-danger float-right"></a>
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
	<script src="../../js/core/jquery.3.2.1.min.js"></script>
    <script src="../../js/core/popper.min.js"></script>
    <script src="../../js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="../../js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../../js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- Bootstrap Notify -->
    <script src="../../js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../../js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Atlantis JS -->
    <script src="../../js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="../../js/setting-demo2.js"></script>

	<?php
		if(isset($_SESSION['duplicateFlag']))
		{
			if(($_SESSION['duplicateFlag'])==1){
				custom_alert("Warning..!","Faculty already exists","warning");
			}
			unset($_SESSION['duplicateFlag']);
		}
	?>

</body>
</html>