<?php
	include ("..\class\connect.php");
	include ("..\class\cls_sub_alloc.php");
	include ("..\class\alert.php");

	if(isset($_SESSION['username'])){

	}
	else {
		header("location: ../index.php");
	}
//geting specific details
$id=$_SESSION['id'];
$email=$_SESSION['username'];
$idsql="SELECT Batch_ID,Prog_ID,Dep_ID from tbl_subject_Allocation where ID=$id";
$idresult=mysqli_query($con,$idsql);
$idrow=mysqli_fetch_array($idresult);
$batch=$idrow['Batch_ID'];
$program=$idrow['Prog_ID'];
$dept=$idrow['Dep_ID'];
//pagination
$resultPerPage=10;
$qry1="SELECT * FROM tbl_student s,tbl_department d,tbl_program p,tbl_batch b where s.Dep_ID=d.ID and s.Batch_ID=b.ID and s.Prog_ID=p.ID";
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
	<link rel="stylesheet" href="css/demo.css">
<style>
#ca:hover{box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);}
</style>
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
									<!-- <span class="user-level" onClick="location.href='index.php';" style=" margin-top:15px;"> Administrator</span> -->
										<span style=" margin-top:15px;" class="user-level fw-bold" onclick="hide(); return false">Faculty</span>
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
							<a href="index.php"><p style = "font-size: 1.1rem; color: black;">Home</p></a>
						</li>
						<li class="nav-item">
							<a href="video.php"><p style = "font-size: 1.1rem; color: black;">Video</p></a>
						</li>
						<li class="nav-item">
							<a href="student_list.php"><p style = "font-size: 1.1rem; color: black;">Student List</p></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!----End of sidebar---->
		<div  class="main-panel ">
			<div style="" class="content bg-light">


			<div class="col-md-12">
			<div class="card mt-4 bg-white">
			<div class="card-header">
                            <form action="" method="POST">
                            <div class="card-title"> 
                                <h3 style="font-size: 30px; display: inline-block;">Students</h3>
                            </div>
                        </div>
                        <div style="margin: 0px;" class="card-sub bg-white">
<?php
$sql1="SELECT * FROM tbl_student s,tbl_department d,tbl_program p,tbl_batch b where s.Dep_ID=d.ID and s.Batch_ID=b.ID and s.Prog_ID=p.ID and s.Dep_ID=$dept and s.Batch_ID=$batch and s.Prog_ID=$program order by s.ID DESC";
$s1=mysqli_query($con,$sql1);
$row=mysqli_fetch_array($s1);
?>
								<!---start of search---->
							<input id="searchid" style="width:300px !important;" type="search" onkeyup="search()" class="form-control ml-auto float-left" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon"/>
                        </div>
						<h4 class="text-center">Department: <?php echo $row[11];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program: <?php echo $row[14];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Batch: <?php echo $row[20];?> </h4>

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
													<th>Student</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Gender</th>
													<th class="text-center">Status</th>
												</tr>
											</thead>
											<tbody>
<?php
$pageNo=($page-1)*$resultPerPage;
$sql1="SELECT * FROM tbl_student s,tbl_department d,tbl_program p,tbl_batch b where s.Dep_ID=d.ID and s.Batch_ID=b.ID and s.Prog_ID=p.ID and s.Dep_ID=$dept and s.Batch_ID=$batch and s.Prog_ID=$program order by s.ID DESC limit $pageNo,$resultPerPage";
$s1=mysqli_query($con,$sql1);
while(($row=mysqli_fetch_array($s1))==TRUE)
{?>
												<tr>
													<th style="width:1%" scope="row">
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input" type="checkbox" name="checkbox[]" value="<?php echo $row[0];?>" type="checkbox" value="">
																<span class="form-check-sign"></span>
															</label>
														</div> 
													</th>
													<td><?php echo $row[4];?></td>
													<td><?php echo $row[5];?></td>
													<td><?php echo $row[7];?></td>
													<td><?php if($row[8]==0) echo "Male"; else if($row[8]==1) echo "Female"; else echo "Others";?></td>
													<td class="text-center"><?php if($row[9]==1) echo "<button class='btn btn-link btn-success btn-lg' style='cursor:context-menu;'><i class='fa fa-check fa-green'></i></button>"; else echo "<button class='btn btn-link btn-danger btn-lg' style='cursor:context-menu;'><i class='fa fa-times'></i></button";?></td>
												</tr>

<?php
}
?>
											</tbody>
										</table>
										<div class="d-flex justify-content-center">
										<a href="student_list.php?page=<?php echo ($page-1) ?>"><input type="button" class="btn btn-primary btn-border" value="<<"> </a>
										<button class="btn btn-primary btn-border mr-2 ml-2"><?php echo ($page) ?></button>
										<a href="student_list.php?page=<?php echo ($page+1) ?>"><input type="button" class="btn btn-primary btn-border" value=">>"> </a>
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
				 Copyright -->
				<!--<div class="text-center p-3" >
				  ï¿½ 2020 Copyright:
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
	<script src="../js/plugin/datatables/datatables.min.js"></script>

	<script>
    function search() {

// Declare variables 
var input = document.getElementById("searchid");
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

</body>
</html>