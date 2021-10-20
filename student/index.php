<?php
	session_start();
	if(isset($_SESSION['username'])){
		 
	}
	else {
		header("location: login.php");
	}


  $con=mysqli_connect("localhost","root","","elearning");

  if(isset($_SESSION['username'])){
    $studentEmail = $_SESSION['username'];
  }
  $selectStudent = "select * from tbl_student where sEmail = '$studentEmail' ";
  $studentResult=mysqli_query($con,$selectStudent);	
	$studentRow=mysqli_fetch_array($studentResult);

  $batch = $studentRow['Batch_ID'];
 
  

  $selectBatch = "select * from tbl_batch where ID=$batch";
  $batchResult=mysqli_query($con,$selectBatch);	
	$batchRow=mysqli_fetch_array($batchResult);

  $program = $batchRow['Prog_ID'];
  $sem = $batchRow['iCurrentSem'];
  if(isset($_GET['sem'])){
    $sem = $_GET['sem'];
  }
  $cursem = $batchRow['iCurrentSem'];

  $selectSubject = "select * from tbl_subject_allocation where Batch_ID=$batch and Prog_ID=$program and Sem_ID = $sem";
  $subjectResult=mysqli_query($con,$selectSubject);	
	


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

  <style>
    .zoom  {
      transition: transform .2s all ease-in-out; /* Animation */
    }

    .zoom:hover {
      transform: scale(1.06) ; /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }

    .bord{
      border-left: 5px solid #FF8800;
    }
    .hvr:hover {
      cursor: pointer;
    }

    .shadows{
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
</style>


    
</head>
<body class="bg-white">

      <nav class="navbar navbar-expand-lg navbar-dark  bg-dark fixed-top navbar-dark d-lg-block" style="z-index: 2000; background: linear-gradient(360deg, #191030 0%, #201341 100%);">
        <div class="container-fluid">
          <!-- Navbar brand -->
          <a class="navbar-brand nav-link" href="index.php">
           <h3 style="font-size: 26px" class="font-weight-normal">E-LEARN</h3>
          </a>
          <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
            aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" style="color: #ffffffcc; font-size: 17px;" href="index.php">Home</a>
              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: #ffffffcc; font-size: 17px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Semesters
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php 
                  $n=$cursem;
                  while($n>0){?>
                    <a class="dropdown-item"  href="index.php?sem=<?php echo $n; ?>">Semester <?php echo $n; ?></a>
                  
                  <?php $n--; } ?>
                  
                  
                </div>
              </li>
            </ul>
          </div>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 float-right" style="float: right;">
            <li class="nav-item float-right" style="float: right;" >
              <a class="nav-link" style="color: #ffffffcc; font-size: 17px;" href="logout.php" >Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    
    
<div class="container-fluid">
    <div class=" pt-5 pb-5 mt-5" style="background-color: rgb(255, 255, 255);">
      <div>
        <h3 class="display-2 text-center mb-4">Subjects</h3>
      </div>
      <div class="row">
      
        <div class="col-lg-2 col-sm-1"></div>
        <div class="card-columns mb-5 col-lg-8 col-sm-10">
          <?php
            while($subjectRow=mysqli_fetch_array($subjectResult))
              {
                $subID = $subjectRow['Subject_ID'];
                $innerQry = "select * from tbl_subject where id = $subID";
                $nameResult=mysqli_query($con,$innerQry);
                $nameRow=mysqli_fetch_array($nameResult);
                $name= $nameRow['sName'];
                $idd= $subjectRow['ID'];
                $facid = $subjectRow['Faculty_ID'];


                $facQry = "select * from tbl_faculty where id = $facid";
                $facResult=mysqli_query($con,$facQry);
                $facRow=mysqli_fetch_array($facResult);
                $facName= $facRow['sName'];
              	
          ?>
          <a href="subject.php?sub=<?php echo $subID; ?>&facid=<?php echo $facid; ?>">
            <div id="s<?php echo $idd ; ?>" class="hvr shadows card text-center mb-3 mt-3 bg-white zoom bord">
              <div class="card-body">
                <h4 style="font-size: 27px;" class="card-title"><?php echo $name ; ?></h4>
                <h5 class="pt-3">Faculty: <?php echo $facName ; ?></h5>
              </div>
            </div>
            </a>
            <?php } ?>
                
        </div>
        <div class="col-lg-2 col-sm-1"></div>
      </div>
      </div>
    <footer class="footer bg-dark2 fixed-bottom">
        <div class="copyright ml-auto text-center">
            Copyright  2021 &copy;<!--<i class="fa fa-heart heart text-danger"></i>--> Powered by <span  style= " font-weight: bolder;  color: rgb(255, 255, 255);" class="avatar-img  rounded-circle">Web Development Team SSTM</span>
        </div>				
    </footer>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
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


  



                
</body>         
</html>