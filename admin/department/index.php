<?php
include ("..\..\class\connect.php");
include ("..\..\class\cls_dept.php");
include("..\..\class\alert.php");

if(isset($_POST['delete'])){
		$delid= $_POST['delete'];
		$deptobj= new Department();
		$retval=$deptobj->deleteDept($delid);
		
}
if(isset($_POST['deleteall'])){

	if(isset($_POST['checkbox'])){
	  foreach($_POST['checkbox'] as $deleteid){
		  $departmentobj= new Department();
		  $departmentobj->deleteDept($deleteid);
	  }
	}
   
  }

if(isset($_POST['publish'])){

	if(isset($_POST['checkbox'])){
	  foreach($_POST['checkbox'] as $pubid){
		$departmentobj= new Department();
		$departmentobj->publishDept($pubid);
	  }
	}
   
  }

if(isset($_POST['unpublish'])){

	if(isset($_POST['checkbox'])){
	  foreach($_POST['checkbox'] as $unpubid){
		$departmentobj= new Department();
		$departmentobj->unpublishDept($unpubid);
	  }
	}
   
  }
//pagination
  $resultPerPage=10;
  $qry1="SELECT * from tbl_department";
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
			<!-- End Logo Header -->

			<!-- Navbar and sidebar -->
			<?php include ("../../include/menu.php"); ?>
			<!-- End Navbar and sidebar -->

		<div  class="main-panel ">
			<div style="" class="content bg-light">





			<div class="col-md-12">
			<div class="card mt-4 bg-white">
			<div class="card-header">
                            <form action="" method="POST">
                            <div class="card-title"> 
                                <h3 style="font-size: 30px; display: inline-block;">Department</h3>
                            </div>
                        </div>
                        <div style="margin: 0px;" class="card-sub bg-white">
						<input type="button" value="Add" onClick="window.location='new.php';" class="btn btn-primary float-right ml-2">
									<input type="button" value="Delete" data-toggle="modal" title="" data-target="#deleteModal" data-original-title="Delete"class="btn btn-primary float-right ml-2">
									<input type="submit" value="Publish" name="publish"  class="btn btn-primary float-right ml-2">
									<input type="submit" value="Unpublish" name="unpublish" class="btn btn-primary float-right ml-2">
								<!---start of search---->
                            <input id="searchId" style="width:300px !important;" type="search" onkeyup="searchFunction()" class="form-control ml-auto float-left" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon"/>
                        </div>

								<!---end of search---->
								<div class="card-body">
			
									<div class="table-responsive">
										<table class="table table-bordered" id="tableId">
											<thead>
												<tr>
													<th>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input" id="select-all" type="checkbox" value="">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</th>
													<th>Department</th>
													<th class="text-center">Status</th>
													<th class="text-center">Edit</th>
													<th class="text-center">Delete</th>
												</tr>
											</thead>
											<tbody>
<?php
$pageNo=($page-1)*$resultPerPage;
$sql1="SELECT * from tbl_department order by ID desc limit $pageNo,$resultPerPage";
$s1=mysqli_query($con,$sql1);
while(($row=mysqli_fetch_array($s1))==TRUE)
{?>
												<tr>
													<th style="width:1%" scope="row">
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input" type="checkbox" name="checkbox[]" value="<?php echo $row['ID'];?>" type="checkbox" value="">
																<span class="form-check-sign"></span>
															</label>
														</div> 
													</th>
													<td><?php echo $row['sName'];?></td>
													<td class="text-center"><?php if($row['iStatus']==1) echo "<button class='btn btn-link btn-success btn-lg' style='cursor:context-menu;'><i class='fa fa-check fa-green'></i></button>"; else echo "<button class='btn btn-link btn-danger btn-lg' style='cursor:context-menu;'><i class='fa fa-times'></i></button";?></td>
													<td class="text-center"><a href="update.php?updateid=<?php echo $row['ID'];?>">
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
																<i class="fa fa-edit"></i>
															</button></a>
                                                    </td>
                                                    <td class="text-center">
														<button type="button" data-toggle="modal" title="" data-target="#exampleModal<?php echo $row['ID'];?>" class="btn btn-link btn-danger btn-lg" data-original-title="Delete">
																<i class="fa fa-trash-alt"></i>
															</button>
													</td>
												</tr>
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
	  	<input hidden type="text" value="<?php echo $row['ID'];?>" name="deletesingle">
        	<button type="submit" name="delete" value="<?php echo $row['ID'];?>" class="btn btn-primary">OK</button>
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

	<script>
	document.getElementById('select-all').onclick = function() {
			var checkboxes = document.getElementsByClassName('form-check-input');
			for (var checkbox of checkboxes) {
				checkbox.checked = this.checked;
				}
			}
	</script>
<?php
        if(isset($_SESSION['successFlag'])){
            if(($_SESSION['successFlag'])==1){
                custom_alert("Success..!","Department  added succesfully","success");
                unset($_SESSION['successFlag']);
            }
        }
		if(isset($_SESSION['updateFlag'])){
			if (($_SESSION['updateFlag'])==1){
				custom_alert("Success..!","Details updated successfully","success");
				unset($_SESSION['updateFlag']);
			}
		}
        if(isset($_SESSION['deleteFlag'])){
            if(($_SESSION['deleteFlag'])==1){
                custom_alert("Success..!","Department  deleted successfully","success");
                header("Location:index.php");
                unset($_SESSION['deleteFlag']);
            }
        }
		if(isset($_SESSION['pubFlag'])){
            if(($_SESSION['pubFlag'])==1){
                custom_alert("Success..!","Department  published successfully","success");
                header("Location:index.php");
                unset($_SESSION['pubFlag']);
            }
        }
		if(isset($_SESSION['unpubFlag'])){
            if(($_SESSION['unpubFlag'])==1){
                custom_alert("Success..!","Department  unpublished successfully","success");
                header("Location:index.php");
                unset($_SESSION['unpubFlag']);
            }
        }
    ?>
<script>
function searchFunction() {
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("searchId");
	filter = input.value.toUpperCase();
	table = document.getElementById("tableId");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		if (td) {
		txtValue = td.textContent || td.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			tr[i].style.display = "";
		} else {
			tr[i].style.display = "none";
				}
			}
		}
	}
</script>    

</body>
</html>