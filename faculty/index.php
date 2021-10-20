<?php
	include ("..\class\connect.php");
	include ("..\class\cls_sub_alloc.php");
	include ("..\class\alert.php");

	if(isset($_SESSION['username'])){

	}
	else {
		header("location: ../index.php");
	}
if(isset($_SESSION['id'])){
	unset($_SESSION['id']);
	}
	include ("..\class\connect.php");
$email=$_SESSION['username'];
$namesql="SELECT * from tbl_faculty where sEmail='$email'";
$nameresult=mysqli_query($con,$namesql);
$namerow=mysqli_fetch_array($nameresult);
$name=$namerow['sName'];
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
										<span style=" margin-top:15px;" class="user-level fw-bold" onclick="hide(); return false"><?php echo $name; ?></span>
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
	
					</ul>
				</div>
			</div>
		</div>
		<!----End of sidebar---->
		<div  class="main-panel ">
			<div style="" class="content bg-light"style="min-height:2000px;">


			<div class="col-md-12">
			<div class="card mt-4 bg-white">
			<div class="card-header">
                            <form action="" method="POST">
                            <div class="card-title"> 
                                <h3 style="font-size: 30px; display: inline-block;">Subjects</h3>

                            </div>
            </div>
            <div style="margin: 0px;" class="card-sub bg-white">
					<div class="card-body">
					<div class="row">
<?php 
$email=$_SESSION['username'];
$idsql="SELECT ID from tbl_faculty where sEmail='$email'";
$idresult=mysqli_query($con,$idsql);
$idrow=mysqli_fetch_assoc($idresult);
$id=$idrow['ID'];
$sql="SELECT * FROM tbl_subject_allocation where Faculty_ID=$id and iStatus=1";	
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
$subsql="SELECT sName,sCode from tbl_subject where ID='$subID'";
$subresult=mysqli_query($con,$subsql);
$subrow=mysqli_fetch_array($subresult);
$facsql="SELECT sName from tbl_faculty where ID='$facID'";
$facresult=mysqli_query($con,$facsql);
$facrow=mysqli_fetch_array($facresult);
?>
						<div class="col-md-4">
							<div class="card  text-center" id="ca">
							<a href="video.php?id=<?php echo $row['ID'];?>"  style="text-decoration:none;" title="<?php echo $subrow['sName']; ?>">
									<div class="card-header">
										<div class="card-title"><button class="btn btn-link btn-primary btn-lg" style="padding:0px;padding-right:5px;cursor:context-menu;"><i class='fas fa-book-open fa-green'></i></button>
										<?php echo $subrow['sName']; ?>
										</div>
									</div>
									<div class="card-body p-3">
									<?php echo $deptrow['sName']; ?> <?php echo $batchrow['sName']; ?><br>Semester <?php echo $semrow['sName']; ?><br><?php echo $subrow['sCode']; ?>
									</div>
								</a>
							</div>
						</div>
<?php
}
?>


						
						
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
	document.getElementById('select-all').onclick = function() {
            var checkboxes = document.getElementsByClassName('check-all');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
                }
            }

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
			
        // $(document).ready(function() {
        //     $('#basic-datatables').DataTable({
        //     });

        //     $('#multi-filter-select').DataTable( {
        //         "pageLength": 5,
        //         initComplete: function () {
        //             this.api().columns().every( function () {
        //                 var column = this;
        //                 var select = $('<select class="form-control"><option value=""></option></select>')
        //                 .appendTo( $(column.footer()).empty() )
        //                 .on( 'change', function () {
        //                     var val = $.fn.dataTable.util.escapeRegex(
        //                         $(this).val()
        //                         );

        //                     column
        //                     .search( val ? '^'+val+'$' : '', true, false )
        //                     .draw();
        //                 } );

        //                 column.data().unique().sort().each( function ( d, j ) {
        //                     select.append( '<option value="'+d+'">'+d+'</option>' )
        //                 } );
        //             } );
        //         }
        //     });});
	</script>

</body>
</html>