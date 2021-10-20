<?php
	session_start();

	

  $con=mysqli_connect("localhost","root","","elearning");

  if(isset($_GET['sub'])){
    $subID=$_GET['sub'];
  }
  else{
    header("location:index.php");
  }

  $subget="select * from tbl_subject where ID= $subID";
  $subres = mysqli_query($con,$subget);
  $subrow = mysqli_fetch_array($subres);
  $subname = $subrow['sName'];



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
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../../css/fonts.min.css']},
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
  .hvr:hover {
      cursor: pointer;
    }
  </style>
</head>
<body>

<header>
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
            </ul>
          </div>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 float-right" style="float: right;">
            <li class="nav-item float-right" style="float: right;" >
              <a class="nav-link" style="color: #ffffffcc; font-size: 17px;" href="logout.php">Logout</a>
            </li>
          </ul>
    </header>

    <main role="main">


      <div class="container-fluid p-4 marketing" style="background-color: rgb(255, 255, 255);">



        <div class="mt-5">

          <br>
          <br>
          <h1> <?php echo $subname; ?></h1>
          <br>

          
     
              <div class="row">
              <?php
                      $innerQry1 = "select * from tbl_video where Subject_ID= $subID";
                      $videoResult = mysqli_query($con,$innerQry1);
                      $count=0;
                      while($videoRow=mysqli_fetch_array($videoResult)){
                        
                        $title=$videoRow['sTitle'];
                        $url = $videoRow['sUrl'];
                        $id = $videoRow['ID'];

                    ?>
                          <div  id="p<?php echo $id; ?>"  class="col-md-2 pb-5 hvr">
                            <div class="card " style="border: 0px; ">
                              <iframe style="z-index:0" id="s<?php echo $id; ?>"  src="<?php echo $url; ?>?autoplay=0&showinfo=0&controls=0"
                                  frameborder="0" allow="" allowfullscreen> </iframe>
                                  <div class="hvr" style="position:absolute; width:100%; height:100%; background-color:rgba(240, 248, 255, 0); ; z-index:1000000"></div>
                                      <div class="card-body" >
                                        <h4 class="card-title"><?php echo $title; ?></h4>
                                      </div>
                            </div>
                        </div>

                <?php
                      }
                    ?>
              </div>
      
            </div>
            <!--/.First slide-->
      
            <!--Second slide-->


	
		</main>

        <footer class="footer bg-dark2 fixed-bottom">
					<div class="copyright ml-auto text-center">
						 Copyright  2021 &copy;<!--<i class="fa fa-heart heart text-danger"></i>--> Powered by <span  style= " font-weight: bolder;  color: rgb(255, 255, 255);" class="avatar-img  rounded-circle">Web Development Team SSTM</span>
					</div>				
			</footer>




	
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



  <?php
                      $innerQry1 = "select * from tbl_video where Subject_ID= $subID";
                      $videoResult = mysqli_query($con,$innerQry1);
                      $count=0;
                      while($videoRow=mysqli_fetch_array($videoResult)){
                        
                        $title=$videoRow['sTitle'];
                        $url = $videoRow['sUrl'];
                        $id = $videoRow['ID'];
                        $batchid=$videoRow['Batch_ID'];
                        $semid=$videoRow['Sem_ID'];

                    ?>
                            <script>
                              $("#p<?php echo $id; ?>").click(function(){
                                window.location = "watch.php?id=<?php echo $id; ?>&batch=<?php echo $batchid; ?>&sem=<?php echo $semid; ?>";
                                });
                            </script>

                   
                </div>

                <?php
                      }
                    ?>


<?php
                      $innerQry1 = "select * from tbl_video where Subject_ID= $subID";
                      $videoResult = mysqli_query($con,$innerQry1);
                      $count=0;
                      while($videoRow=mysqli_fetch_array($videoResult)){
                        
                        $title=$videoRow['sTitle'];
                        $url = $videoRow['sUrl'];
                        $id = $videoRow['ID'];
                        $batchid=$videoRow['Batch_ID'];
                        $semid=$videoRow['Sem_ID'];

                    ?>
                            <script>
                              $("#s<?php echo $id; ?>").click(function(){
                                window.location = "watch.php?id=<?php echo $id; ?>&batch=<?php echo $batchid; ?>&sem=<?php echo $semid; ?>";
                                });
                            </script>

                   
                </div>

                <?php
                      }
                    ?>



	

</body>
</html>