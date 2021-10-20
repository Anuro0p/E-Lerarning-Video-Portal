<?php
	include ("..\..\class\connect.php");
	include ("..\..\class\cls_student.php");
	
	$retval=1;
	$errMsg="";
    $updateid = $_GET['updateid'];
    if(isset($_GET['updateid'])){
        $edit="SELECT * FROM tbl_student s,tbl_department d,tbl_program p,tbl_batch b where s.Dep_ID=d.ID and s.Batch_ID=b.ID and s.Prog_ID=p.ID and s.ID=$updateid";
        $updateQuery=mysqli_query($con,$edit);
        $row3=mysqli_fetch_array($updateQuery);
    }
    if(isset($_POST['student'])){
		if (empty($_POST["student"])) {
			$errMsg="Field cannot be empty!";
		}
		else {
			$student=$_POST['student'];
			$deptid=$_POST['deptid'];	
			$programid=$_POST['programid'];
			$batchid=$_POST['batchid'];	
			$email=$_POST['email'];

			$phone=$_POST['phone'];
			$gender=$_POST['gender'];
			$studentobj= new Student();
		$retval=$studentobj->updateStudent($updateid,$student,$deptid,$programid,$batchid,$email,$phone,$gender);
		if($retval==1)
		{			
			$_SESSION['updateFlag']=1;
			header("Location: index.php");
		}
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

	<input hidden  type="button" id="prgrm" value=<?php echo $row3[14] ; ?>>
	<input hidden type="button" id="bth" value=<?php echo $row3[19] ; ?>>

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
				<button class="topbar-toggler  more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle btn-primary toggle-sidebar">
						<i class="fas fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar and sidebar -->
			<?php include ("../../include/menu.php"); ?>
			<!-- End Navbar and sidebar -->



		<div  class="main-panel align-middle ">
			<div style="" class="bg-light content">

			
			

				<div class="col-md-12 ">
					<div class="card mt-4 bg-white">
						<div class="card-header">
							<div class="card-title">
							<h3 style="font-size: 30px; display: inline-block;">Students</h3>
							</div>
						</div>
						<div class="card-body">
							<div class="col-md-5 mr-auto ml-auto ">
								<div class="card mt-4  bg-light">
									<div class="card-header bg-white">
										<div class="card-title">
										Edit Student
										</div>
									</div>
									<div class="card-body bg-white">
										<form method="POST" action="">
											<div class="form-group">
												<label for="exampleInputEmail1">Student</label>
												<input type="text" class="form-control" id="exampleInputEmail1" name="student" aria-describedby="emailHelp" placeholder="Enter Subject" value="<?php echo $row3[4]; ?>"required>
											</div>
											<div class="form-group">
											<label for="exampleInputEmail1">Department</label>
												<select class="form-control" name="deptid" id="dept" aria-describedby="emailHelp" required>
<?php
$sql2="SELECT * from tbl_department where iStatus=1";
$s2=mysqli_query($con,$sql2);
while(($row4=mysqli_fetch_array($s2))==TRUE)
{?>	
													<option value="<?php echo $row4['ID'];?>"<?php if($row4['sName']==$row3[11]) echo "selected" ?>><?php echo $row4['sName'];?></option>
<?php
}
?>
												</select>
											</div>
											<div class="form-group">
											<!-- program -->
											<label for="defaultSelect">Select Program</label>
											<select name="programid" class="form-control form-control prog" id="prog">
											</select>
											<!--End program -->
											</div>
											<div class="form-group">
											<!-- batch -->
												<div class="batch-container">
												</div>
											<!-- End Batch -->
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Email</label>
												<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter Email" value="<?php echo $row3[5]; ?>"required>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Phone</label>
												<input type="text" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" placeholder="Enter Phone" maxlength="10" pattern="[0-9]*" title="invalid phone" value="<?php echo $row3[7]; ?>"required>
											</div>
											<div class="form-group">
											<label for="exampleInputEmail1">Gender</label>
											<select name="gender" class="form-control" id="exampleFormControlSelect1">
                                                        <?php
                                                            if ($row3['iGender'] == 0) $genderFlag = 0;
                                                                else if ($row3['iGender'] == 1) $genderFlag = 1;
                                                                else $genderFlag = 2;

                                                        ?>
                                                        <option value="0"<?php if ($genderFlag == 0) echo "selected" ?>> Male</option>
                                                        <option value="1"<?php if ($genderFlag == 1) echo "selected" ?>> Female</option>
                                                        <option value="2"<?php if ($genderFlag == 2) echo "selected" ?>> Other</option>
                                                    </select>
											<button type="submit" name="submit" class="btn btn-primary ml-1 float-right">Submit</button>
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
				<!- Copyright -->
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
    if($retval==2){
?>
	<script>
$.notify({
    // options
    icon: 'glyphicon glyphicon-warning-sign',
    title: 'Duplicate entry..!',
    message: 'The Student you entered already exists..',
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
</script>
<?php
}
?>

<script>
$(document).ready(function(){
		 $("#prog").change(function(){
			var getProgID = $(this).val();
			
			
			if(getProgID !='')
			{
				$(".batch-container").html("");
				
				$.ajax({
					type:'post',
					data:{prog:getProgID},
					url: 'ajaxget.php',
					success:function(returnData){
						$(".batch-container").html(returnData);
					}
				});	
			}
			
		 })
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//  $("#dept").change(function(){
			var getDepartmentID = $("#dept").val();
			var getProgramId= $("#prgrm").val();
			var getBatchId= $("#bth").val();
			
			if(getDepartmentID !='')
			{
				// $(".prog").html("");
				
				$.ajax({
					type:'post',
					data:{'department_id':getDepartmentID,'prgm_id':getProgramId,'bch_id':getBatchId},
					url: 'ajaxget.php',
					success:function(returnData){
						$("#prog").html(returnData);
						
	//$(document).ready(function(){
		//  $("#prog").change(function(){
			var getProgID = $("#prog").val();
			var getBatchId= $("#bth").val();
			
			if(getProgID !='')
			{
				$(".batch-container").html("");
				
				$.ajax({
					type:'post',
					data:{'prog':getProgID,'bch_id':getBatchId},
					url: 'ajaxget.php',
					success:function(returnData){
						$(".batch-container").html(returnData);
					}
				});	
			}
			
		//  })
	//});
					}
				});	
			}
			
		//  })
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		 $("#dept").change(function(){
			var getDepartmentID = $("#dept").val();
			
			
			if(getDepartmentID !='')
			{
				$(".program-container").html("");
				
				$.ajax({
					type:'post',
					data:{department_id:getDepartmentID},
					url: 'ajaxget.php',
					success:function(returnData){
						$("#prog").html(returnData);
						$(".batch-container").html("");
	//$(document).ready(function(){
		 $("#prog").change(function(){
			var getProgID = $("#prog").val();
			
			
			if(getProgID !='')
			{
				$(".batch-container").html("");
				
				$.ajax({
					type:'post',
					data:{prog:getProgID},
					url: 'ajaxget.php',
					success:function(returnData){
						$(".batch-container").html(returnData);
					}
				});	
			}
			
		 })
	//});
					}
				});	
			}
			
		 })
	});

	
	


</script>
</body>
</html>