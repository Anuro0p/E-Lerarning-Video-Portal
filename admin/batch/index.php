<?php
include("../../class/connect.php");
include("../../class/alert.php");
include("../../class/cls_batch.php");
if(isset($_POST['deletesingle']))
{
	$did=$_POST['deletesingle'];
	$batchobj= new Batch();
	$delret=$batchobj->deleteBatch($did);
}

if(isset($_POST['premote']))
{
	$did=$_POST['premote'];
	$batchobj= new Batch();
	$delret=$batchobj->premoteBatch($did);
}
 
if(isset($_POST['deleteall'])){
  if(isset($_POST['checkbox'])){
    foreach($_POST['checkbox'] as $deleteid){
	
		$batchobj= new Batch();
		$batchobj->deleteBatch($deleteid);
    }
  }
 
}

if(isset($_POST['publish'])){
	if(isset($_POST['checkbox'])){
	  foreach($_POST['checkbox'] as $pubid){
		$batchobj= new Batch();
		$batchobj->publishBatch($pubid);
	  }
	}
   
  }

  if(isset($_POST['unpublish'])){
	if(isset($_POST['checkbox'])){
	  foreach($_POST['checkbox'] as $pubid){
		  $batchobj= new Batch();
		  $batchobj->unPublishBatch($pubid);
	  }
	}
   
  }

  $resultPerPage=10;
  $qry1="SELECT * from tbl_batch";
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
			<!-----side menu---->
	<?php
	include("../../include\menu.php");		
	?>

		<div  class="main-panel ">
			<div style="" class="content bg-light">





			<div class="col-md-12">
			<div class="card mt-4 bg-white">
								<div class="card-header">
								<form method='post' name="form1" action=''>
									<div class="card-title">
									<h3 style="font-size: 30px; display: inline-block;">Batch</h3>									</div>
								</div>
								<div style="margin: 0px;" class="card-sub bg-white">
									<input  type="button" value="Add" onClick="window.location='new.php';" class="btn btn-primary float-right ml-2">
									<input type="button" value="Delete" data-toggle="modal" title="" data-target="#deleteModal" data-original-title="Delete"class="btn btn-primary float-right ml-2">
									<input type="submit" value="Publish" name="publish"  class="btn btn-primary float-right ml-2">
									<input type="submit" value="Unpublish" name="unpublish"  class="btn btn-primary float-right ml-2">
									<input id="searchId" style="width:300px !important;" type="search" onkeyup="searchFunction()" class="form-control ml-auto float-left" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>	
								</div>

								<div class="card-body">
									
									<div class="table-responsive">
									
										<table id="tableId" class="display table table-bordered table-hover ">
											<thead>
												<tr>
													<th>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input" id="select-all" type="checkbox"  value="">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</th>
													<th>Batch</th>
													<th>Department</th>
													<th>Program</th>
													<th>Semester</th>
													<th>Start Year</th>
													<th>End Year</th>
													<th>Status</th>
													<th>Edit</th>
													<th>Delete</th>
													<th>Promote</th>
												</tr>
											</thead>
											<tbody>
					<?php
						
						$pageNo=($page-1)*$resultPerPage;
						$sql1="SELECT * from tbl_batch order by ID desc limit $pageNo,$resultPerPage ";
						$s1=mysqli_query($con,$sql1);
						
						while($row=mysqli_fetch_array($s1))
							{
								$deptID=$row['Dep_ID'];
								$progID=$row['Prog_ID'];

								$deptsql="SELECT sName from tbl_department where ID='$deptID'";
								$deptresult=mysqli_query($con,$deptsql);
								$deptrow=mysqli_fetch_array($deptresult);

								$progsql="SELECT sName from tbl_program where ID='$progID'";
								$progresult=mysqli_query($con,$progsql);
								$progrow=mysqli_fetch_array($progresult);
								?>
												<tr>
													<th style="width:1%" scope="row">
														<div class="form-check">
															<label class="form-check-label">
																<input class=" all  checkall" name="checkbox[]" value="<?php echo $row['ID'];?>" type="checkbox" >
																<span class="form-check-sign"></span>
															</label>
														</div> 
													</th>
													<td><?php echo $row['sName'];?></td>
													<td><?php echo $deptrow['sName'];?></td>
													<td><?php echo $progrow['sName'];?></td>
													<td><?php echo $row['iCurrentSem'];?></td>
													<td><?php $date=date_create($row['dFrom']); echo date_format($date,'Y') ;?></td>
													<td><?php $date=date_create($row['dTo']); echo date_format($date,'Y') ;?></td>
													<td ><?php if($row['iStatus']==1) echo "<button class='btn btn-link btn-success btn-lg' style='cursor:context-menu;'><i class='fa fa-check fa-green'></i></button>"; else echo "<button class='btn btn-link btn-danger btn-lg' style='cursor:context-menu;'><i class='fa fa-times'></i></button";?></td>
													<td  ><a href="update.php?uid=<?php echo $row['ID'];?>">
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
																<i class="fa fa-edit"></i>
															</button></i></a>
                                                    </td>
                                                    <td >
														<button type="button" data-toggle="modal" title="" data-target="#exampleModal<?php echo $row['ID'];?>" class="btn btn-link btn-danger btn-lg" data-original-title="Delete">
																<i class="fa fa-trash-alt"></i>
															</button></i>
													</td>
													<td >
														<button type="button" data-toggle="modal" title="" data-target="#premoteModal<?php echo $row['ID'];?>" class="btn btn-link btn-primary btn-lg" data-original-title="Delete">
																<i class="fas fa-angle-double-up"></i>
															</button></i>
													</td>
												</tr>

												
						<!-- promote model -->
						<div class="modal fade" id="premoteModal<?php echo $row['ID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">premote</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Are you sure you want to promote the batch?
							</div>
							<div class="modal-footer">

									<button type="submit" name="premote" value="<?php echo $row['ID'];?>" class="btn btn-primary">OK</button>
									<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
							</div>
							</div>
						</div>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="exampleModal<?php echo $row['ID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

									<button type="submit" name="deletesingle" value="<?php echo $row['ID'];?>" class="btn btn-primary">OK</button>
									<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
							</div>
							</div>
						</div>
						</div>
						<!--End of modal-->
						<!-- Modal -->
						<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
									
									<button type="submit" name="deleteall" class="btn btn-primary">OK</button>
									<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
							</div>
							</div>
						</div>
						</div>
						<!--End of modal-->

						<?php
						}
						?>
											</tbody>
										</table>
										<div class="d-flex justify-content-center">
										<a href="index.php?page=<?php echo ($page-1) ?>"><input type="button" class="btn btn-primary btn-border" value="<<"> </a>
										<button class="btn btn-primary btn-border mr-2 ml-2"><?php echo ($page) ?></button>
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
    <!--  -->
    <!-- jQuery Scrollbar -->
    <script src="../../js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Atlantis JS -->
    <script src="../../js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    
		
	<script>
		document.getElementById('select-all').onclick = function() {
            var checkboxes = document.getElementsByClassName('checkall');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
                }
            }
	</script>


	<?php
		// if(isset($_SESSION['successFlag'])){
		// 	if(($_SESSION['successFlag'])==1){
		// 		custom_alert("Success..!","Semester added succesfully","success");
		// 		unset($_SESSION['successFlag']);
		// 	}
		// }

		// if(isset($_SESSION['deleteFlag'])){
		// 	if(($_SESSION['deleteFlag'])==1){
		// 		custom_alert("Success..!","Semester deleted successfully","success");
		// 		header("Location:index.php");
		// 		unset($_SESSION['deleteFlag']);
		// 	}
			
		// }
	?>


	<?php
		if(isset($_SESSION['successFlag'])){
			if(($_SESSION['successFlag'])==1){
				custom_alert("Data inserted","Batch added successfully","success");
				unset($_SESSION['successFlag']);
			}
		}
		if(isset($_SESSION['deleteFlag'])){
			if(($_SESSION['deleteFlag'])==1){
				custom_alert("Success..!","Batch deleted successfully","success");

				unset($_SESSION['deleteFlag']);
			}
		}
			if(isset($_SESSION['updateFlag'])){
			if (($_SESSION['updateFlag'])==1){
				custom_alert("Success..!","Batch updated successfully","success");
				unset($_SESSION['updateFlag']);
			}
		}
			if(isset($_SESSION['pubFlag'])){
			if (($_SESSION['pubFlag'])==1){
				custom_alert("Success..!","Batch published successfully","success");
				unset($_SESSION['pubFlag']);
			}
		}
			if(isset($_SESSION['pubFlag'])){
			if (($_SESSION['pubFlag'])==2){
				custom_alert("Success..!","Batch unpublished successfully","success");
				unset($_SESSION['pubFlag']);
			}
		}
	?>

	<script>
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

    <!-- <script>
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});});
	</script> -->

	
	<script>
		//  $(document).ready(function () {
		//  	$('#basic-datatables').DataTable();
		//  	//$('.dataTables_length').addClass('bs-select');
		//  });

		

	</script>
<!-- <script src="../../js/plugin/datatables/datatables.min.js"></script> -->
</body>
</html>
