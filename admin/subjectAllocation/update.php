<?php
	include ("..\..\class\connect.php");
	include ("..\..\class\cls_sub_alloc.php");
	include ("..\..\class\alert.php");
	
	$retval=0;
	$errMsg="";

	$updateid = $_GET['updateid'];
    if(isset($_GET['updateid'])){
        $edit="SELECT * from tbl_subject_allocation where tbl_subject_allocation.ID='$updateid'";
        $updateQuery=mysqli_query($con,$edit);
        $row=mysqli_fetch_array($updateQuery);
		$facultyID  = $row['Faculty_ID'];
		$depID  = $row['Dep_ID'];
		$programID  = $row['Prog_ID'];
		$batchID  = $row['Batch_ID'];
		$subjectID  = $row['Subject_ID'];
		$semID  = $row['Sem_ID'];
    }

	if(isset($_POST['depID']))
	{
		$department = $_POST['depID'];
		$faculty = $_POST['faculty'];
        $program = $_POST['program'];
        $batch = $_POST['batch'];
        $subject = $_POST['subject'];
        $semester = $_POST['semester'];
        $SAobj= new SubjectAllocation();
		$retval=$SAobj->updateSubAlloc($department, $faculty, $program, $batch, $subject, $semester, $updateid);
		if($retval == 1) {
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
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../../css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../css/demo.css">
	


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
			<div class="bg-light content">
				<div class="col-md-12 ">
					<div class="card mt-4 bg-light">
						<div class="card-header bg-white">
							<div class="card-title"> 
								<h3 style="font-size: 30px; display: inline-block;">Subject Allocation</h3>
							</div>
						</div>
						<div class="card-body bg-white">
							<div class="col-md-5 mr-auto ml-auto ">
								<div class="card mt-4  bg-light">
									<div class="card-header bg-white">
										<div class="card-title">
											Edit Allocation
										</div>
									</div>
									<div class="card-body bg-white">
										<form action="" method="POST">
											<div class="form-group">
											<label for="exampleFormControlSelect1">Department</label>
													<select name="depID" id="progFetch" class="form-control">
														<?php 
															$sql =  "SELECT* FROM tbl_department where iStatus = 1";
															$result = mysqli_query($con,$sql);
																while($row2 = mysqli_fetch_assoc($result)) { 
														?>
														<option value="<?php echo $row2['ID']; ?>"<?php if($row2['ID']==$row['Dep_ID']) echo "selected" ?>><?php echo $row2['sName'];?></option>

														<?php } ?>
													</select>
													<!-- program select -->
													<div class="program-container">
														
													</div>
													<!-- batch select -->
													<div class="batch-container">
														
													</div>
													<!-- sem select -->
													<div class="sem-container">
														
													</div>
													<!-- faculty select -->
													<div class="fac-container">
														
													</div>
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
	<script src="../../js/plugin/datatables/datatables.min.js"></script>
	
	
	<?php
		if(isset($_SESSION['duplicateFlag']))
		{
			if(($_SESSION['duplicateFlag'])==1){
				custom_alert("Warning","Subject is already allocated","warning");
			}
			unset($_SESSION['duplicateFlag']);
		}
		?>

<script>
	$(document).ready(function(){
		 $("#progFetch").change(function(){
			var getDepartmentID = $("#progFetch").val();
			
			if(getDepartmentID !='')
			{
				$(".program-container").html("");
				$.ajax({
					type:'post',
					data:{department_id:getDepartmentID},
					url: 'ajaxget.php',
					success:function(returnData){
						$(".program-container").html(returnData);
						$(".batch-container").html("");
						$(".sem-container").html("");

						// For checking batch's under the specified program

						//$(document).ready(function(){
								$("#batchFetch").change(function(){
									var getProgramID = $("#batchFetch").val();
									
									if(getProgramID !='')
									{
										$(".batch-container").html("");
										$.ajax({
											type:'post',
											data:{program_id:getProgramID},
											url: 'ajaxget.php',
											success:function(returnData){
												$(".batch-container").html(returnData);

												// For selecting semesters under the specified batch

												//$(document).ready(function(){
														$("#semFetch").change(function(){
															var getSemID = $(this).val();
															
															if(getSemID !='')
															{
																$(".sem-container").html("");
																$.ajax({
																	type:'post',
																	data:{sem_id:getSemID},
																	url: 'ajaxget.php',
																	success:function(returnData){
																		$(".sem-container").html(returnData);																		
																	}
																});	
															}
															
														})
													//});
												
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

	

$(document).ready(function(){
		 //$("#progFetch").change(function(){
			var getDepartmentID = $("#progFetch").val();
			var getFacultyId=<?php echo $facultyID ;?>;
			var getProgramId=<?php echo $programID ;?>;
			var getBatchID = <?php echo $batchID ;?>;
			var getSubjectID= <?php echo $subjectID ;?>;				
			
			
			if(getDepartmentID !='')
			{
				$(".program-container").html("");
				$.ajax({
					type:'post',
					data:{department_id:getDepartmentID,faculty_id:getFacultyId,program_ID:getProgramId},
					url: 'ajaxget1.php',
					success:function(returnData){
						$(".program-container").html(returnData);

						// For checking batch's under the specified program

						$(document).ready(function(){
								//$("#batchFetch").change(function(){
									var getProgramID = $("#batchFetch").val();
									
									
									if(getProgramID !='')
									{
										$(".batch-container").html("");
										$.ajax({
											type:'post',
											data:{program_id:getProgramID,batch_id:getBatchID,subject_id:getSubjectID},
											url: 'ajaxget1.php',
											success:function(returnData){
												$(".batch-container").html(returnData);

												// For selecting semesters under the specified batch

												$(document).ready(function(){
														//$("#semFetch").change(function(){
															var getSemID = $("#semFetch").val();
															
															if(getSemID !='')
															{
																$(".sem-container").html("");
																$.ajax({
																	type:'post',
																	data:{sem_id:getSemID},
																	url: 'ajaxget1.php',
																	success:function(returnData){
																		$(".sem-container").html(returnData);																		
																	}
																});	
															}
															
														//})
													});
												
											}
										});	
									}
									
								//})
							});
						}
					});	
				}
				
			//})
		});








</script>

	

<script>
$(window).on('load', function () {
			var getFacultyId=<?php echo $facultyID ;?>;
			var getProgramId=<?php echo $programID ;?>;
			var getBatchID = <?php echo $batchID ;?>;
			var getSubjectID= <?php echo $subjectID ;?>;

								$("#batchFetch").change(function(){
									var getProgramID = $("#batchFetch").val();
									
									
									if(getProgramID !='')
									{
										$(".batch-container").html("");
										$.ajax({
											type:'post',
											data:{program_id:getProgramID,batch_id:getBatchID},
											url: 'ajaxget.php',
											success:function(returnData){
												$(".batch-container").html(returnData);
												$(".sem-container").html("");
												// For selecting semesters under the specified batch

												//$(window).on('load', function () {
														$("#semFetch").change(function(){
															var getSemID = $("#semFetch").val();
															
															if(getSemID !='')
															{
																$(".sem-container").html("");
																$.ajax({
																	type:'post',
																	data:{sem_id:getSemID},
																	url: 'ajaxget.php',
																	success:function(returnData){
																		$(".sem-container").html(returnData);																		
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



$(window).on('load', function () {
			$("#semFetch").change(function(){
				var getSemID = $("#semFetch").val();
				
				if(getSemID !='')
				{
					$(".sem-container").html("");
					$.ajax({
						type:'post',
						data:{sem_id:getSemID},
						url: 'ajaxget.php',
						success:function(returnData){
							$(".sem-container").html(returnData);																		
						}
					});	
				}
				
			})
		});


</script>


</body>
</html>