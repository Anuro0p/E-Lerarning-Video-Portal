<?php
	include ("..\..\class\connect.php");
	include ("..\..\class\cls_sub_alloc.php");
	include ("..\..\class\alert.php");

	// if(isset($_SESSION['username'])){

	// }
	// else {
	// 	header("location: ../login.php");
	// }

	if(isset($_POST['deleteSingle'])){
		$deleteid = $_POST['deleteSingle'];
		$SAobj= new SubjectAllocation();
		$retval=$SAobj->deleteSubAlloc($deleteid);
	}

	if(isset($_POST['delete'])){
		if(isset($_POST['check-box'])){
			foreach($_POST['check-box'] as $deleteid){
				$SAobj= new SubjectAllocation();
				$SAobj->deleteSubAlloc($deleteid);
			}
		}
	}
	
	if(isset($_POST['active'])){
		if(isset($_POST['check-box'])){
			foreach($_POST['check-box'] as $pubid){
				$SAobj= new SubjectAllocation();
				$SAobj->publishSubAlloc($pubid);
			}
		}
	}
	
	if(isset($_POST['inactive'])){
		if(isset($_POST['check-box'])){
			foreach($_POST['check-box'] as $pubid){
				$SAobj= new SubjectAllocation();
				$SAobj->unPublishSubAlloc($pubid);
			}
		}
	}

	// end of function: delete, single delete, publish, unpublish, and session check


	$resultPerPage=10;
	$qry1="SELECT * from tbl_subject_allocation";
	$result3=mysqli_query($con,$qry1);
	$rowcount=mysqli_num_rows($result3);
  
	if(!isset($_GET['page']))
		{
		  $page=1;
	  }
	else
	  {
		  if($_GET['page']<=1)
		  {
			  $page=1;
		  }
		  elseif($rowcount<(((($_GET['page'])-1)*$resultPerPage)+1)){
			  $page=($_GET['page'])-1;
		  }
		  else{
		  $page=$_GET['page'];
		  }
	  }

	  // end of pagination
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

		<div class="main-panel">
			<div class="content">
			<div class="col-md-12 ">
			<div class="card mt-4 bg-white">
						<div class="card-header ">
							<form action="" method="POST">
							<div class="card-title"> 
								<h3 style="font-size: 30px; display: inline-block;"> Subject Allocation </h3>
							</div>
                        </div>
						<div style="margin: 0px;" class="card-sub bg-white">
							<input type="button" value="Add" onClick="window.location='new.php';" class="btn btn-primary float-right ml-1">
							<input type="button" data-toggle="modal" data-target="#buttonDelete" value="Delete"  class="btn btn-primary float-right ml-1">
							<input type="submit" name="active" value="Publish" class="btn btn-primary float-right ml-1">
							<input type="submit" name="inactive" value="Unpublish" class="btn btn-primary float-right ml-1">
							
							<input id="searchId" style="width:300px; border-color: #ced4da; !important;" type="search" onkeyup="searchFunction()" class="form-control ml-auto float-left"  placeholder="Search" aria-label="Search"
							aria-describedby="search-addon"/>
                        </div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="tableId" class="table table-bordered">
											<thead>
												<tr>
													<th>
														<div class="form-check">
															<label class="form-check-label">
																<input id= "select-all" class="form-check-input checkbox" type="checkbox"  value="">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</th>
													<th class = "text-center">Department</th>
													<th class = "text-center">Program</th>
													<th class = "text-center">Batch</th>
													<th class = "text-center">Faculty</th>
													<th class = "text-center">Semester</th>
													<th class = "text-center">Subject</th>
													<th class = "text-center">Status</th>
													<th class = "text-center">Edit</th>
													<th class = "text-center">Delete</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												$pageNo=($page-1)*$resultPerPage;
												$sql="SELECT* FROM tbl_subject_allocation order by ID DESC limit $pageNo,$resultPerPage";	
												$result = mysqli_query($con,$sql);

													while($row = mysqli_fetch_assoc($result)) { 
														$deptID=$row['Dep_ID'];
														$progID=$row['Prog_ID'];
														$batchID=$row['Batch_ID'];
														$semID=$row['Sem_ID'];
														$subID=$row['Subject_ID'];
														$facID=$row['Faculty_ID'];
						
														$deptsql="SELECT sName from tbl_department where ID='$deptID'";
														$deptresult=mysqli_query($con,$deptsql);
														$deptrow=mysqli_fetch_array($deptresult);
						
														$progsql="SELECT sName from tbl_program where ID='$progID'";
														$progresult=mysqli_query($con,$progsql);
														$progrow=mysqli_fetch_array($progresult);

														$batchsql="SELECT sName from tbl_batch where ID='$batchID'";
														$batchresult=mysqli_query($con,$batchsql);
														$batchrow=mysqli_fetch_array($batchresult);
														
														$semsql="SELECT sName from tbl_semester where ID='$semID'";
														$semresult=mysqli_query($con,$semsql);
														$semrow=mysqli_fetch_array($semresult);

														$subsql="SELECT sName from tbl_subject where ID='$subID'";
														$subresult=mysqli_query($con,$subsql);
														$subrow=mysqli_fetch_array($subresult);

														$facsql="SELECT sName from tbl_faculty where ID='$facID'";
														$facresult=mysqli_query($con,$facsql);
														$facrow=mysqli_fetch_array($facresult);
												?>
												<tr>
													<th style="width:1%" scope="row">
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input check-all" type="checkbox" name="check-box[]" value="<?php echo $row['ID'];?>">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</th>
													<td class = "text-center"><?php echo $deptrow['sName']; ?></td>
													<td class = "text-center"><?php echo $progrow['sName']; ?></td>
													<td class = "text-center"><?php echo $batchrow['sName']; ?></td>
													<td class = "text-center"><?php echo $facrow['sName']; ?></td>
													<td class = "text-center"><?php echo $semrow['sName']; ?></td>
													<td class = "text-center"><?php echo $subrow['sName']; ?></td>
													<td class = "text-center"><?php 
														if($row['iStatus'] == 1) {
															echo "<button class='btn btn-link btn-success btn-lg' style='cursor:context-menu;'><i class='fa fa-check fa-green'></i></button>";
														}
														else echo "<button class='btn btn-link btn-danger btn-lg' style='cursor:context-menu;'><i class='fa fa-times'></i></button";
														?>
													</td>
													<td class = "text-center"><a href="update.php?updateid=<?php echo $row['ID'];?>"><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
														<i class="fa fa-edit"></i> </button></a></i>
													</td>
													<td class = "text-center">
														<button data-toggle="modal" type="button" data-target="#iconDelete<?php echo $row['ID'];?>" title="" class="btn btn-link btn-danger btn-lg" data-original-title="Delete">
														<i class="fa fa-trash-alt"></i></button></i>
													</td>
												</tr>
								<!--Button Modal -->
								<div class="modal fade" id="buttonDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										Are you sure you want to delete?
									</div>
									<div class="modal-footer">
											<button type="submit" name="delete" class="btn btn-primary">OK</button>
											<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
									</div>
									</div>
								</div>
								</div>
								<!--End of Button modal-->
								<!-- Icon Modal -->
								<div class="modal fade" id="iconDelete<?php echo $row['ID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										Are you sure you want to delete?
									</div>	
									<div class="modal-footer">
										<button type="submit" value="<?php echo $row['ID'];?>" name="deleteSingle" class="btn btn-primary">OK</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
									</div>
									</div>
								</div>
								</div>
								<!--End of Icon modal-->
													<?php } ?>
												</tbody>
											</table>
											<div class="d-flex justify-content-center mb-3">
												<a href="index.php?page=<?php echo ($page-1) ?>"><input type="button" class="btn btn-primary btn-border" value="<<"> </a>
												<button class="btn btn-primary btn-border mr-2 ml-2 "><?php echo ($page) ?></button>
												<a href="index.php?page=<?php echo ($page+1) ?>"><input type="button" class="btn btn-primary btn-border" value=">>"> </a>
											</div>
									</div>
								</div>
							</div>
						</div>
					</form>
			</div>
		 <footer class="footer bg-dark2">
					<div class="copyright ml-auto text-center">
						 Copyright  2021 &copy;<!--<i class="fa fa-heart heart text-danger"></i>--> Powered by <span  style= " font-weight: bolder;  color: rgb(255, 255, 255);" class="avatar-img  rounded-circle">Web Development Team SSTM</span>
					</div>				
			</footer> 


			<!--<footer  class=" bg-dark2 text-center text-lg-start">
				<!-- Copyright -->
				<!--<div class="text-center p-3" >
				  � 2020 Copyright:
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

	<script>
	document.getElementById('select-all').onclick = function() {
            var checkboxes = document.getElementsByClassName('check-all');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
                }
            }

			// function searchFunction() {
			// var input, filter, table, tr, td, i, txtValue;
			// input = document.getElementById("searchId");
			// filter = input.value.toUpperCase();
			// table = document.getElementById("tableId");
			// tr = table.getElementsByTagName("tr");
			// for (i = 0; i < tr.length; i++) {
			// 	td = tr[i].getElementsByTagName("td")[0];
			// 	if (td) {
			// 	txtValue = td.textContent || td.innerText;
			// 	if (txtValue.toUpperCase().indexOf(filter) > -1) {
			// 		tr[i].style.display = "";
			// 	} else {
			// 		tr[i].style.display = "none";
			// 			}
			// 		}       
			// 	}
			// }

		function searchFunction() {
			// Declare variables 
			var input = document.getElementById("searchId");
			var filter = input.value.toUpperCase();
			var table = document.getElementById("tableId");
			var trs = table.tBodies[0].getElementsByTagName("tr");

			// Loop through first tbody's rows
			for (var i = 0; i < trs.length; i++) {

			// define the row's cells
			var tds = trs[i].getElementsByTagName("td");

			// hide the row
			trs[i].style.display = "none";

			// loop through row cells
			for (var i2 = 0; i2 < tds.length; i2++) {

				// if there's a match
				if (tds[i2].innerHTML.toUpperCase().indexOf(filter) > -1) {

				// show the row
				trs[i].style.display = "";

				// skip to the next row
				continue;

				}
			}
			}

			}
	</script>

	<?php
	if(isset($_SESSION['successFlag'])){
		if(($_SESSION['successFlag'])==1){
			custom_alert("Success..!","Allocated subject successfully","success");
			unset($_SESSION['successFlag']);
		}
	}
	if(isset($_SESSION['deleteFlag'])){
		if(($_SESSION['deleteFlag'])==1){
			custom_alert("Success..!","Deleted allocated subject successfully","success");
			unset($_SESSION['deleteFlag']);
		}
	}
		if(isset($_SESSION['updateFlag'])){
		if (($_SESSION['updateFlag'])==1){
			custom_alert("Success..!","Subject allocated successfully","success");
			unset($_SESSION['updateFlag']);
		}
	}
		if(isset($_SESSION['pubFlag'])){
		if (($_SESSION['pubFlag'])==1){
			custom_alert("Success..!","Status published succesfully","success");
			unset($_SESSION['pubFlag']);
		}
	}
		if(isset($_SESSION['pubFlag'])){
		if (($_SESSION['pubFlag'])==2){
			custom_alert("Success..!","Status unpublished successfully","success");
			unset($_SESSION['pubFlag']);
		}
	}
	?>
</body>
</html>