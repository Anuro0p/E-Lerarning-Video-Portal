<?php
	session_start();

	

  $con=mysqli_connect("localhost","root","","elearning");

  if(isset($_GET['id'])){
    $ID=$_GET['id'];
  }
  else{
    header("location:index.php");
  }

  if(isset($_SESSION['username'])){
	  $studemail = $_SESSION['username'];
  }
  else{
		header("location:logout.php");
  }

  $studselect = "select * from tbl_student where sEmail = '$studemail'";
  $studresult = mysqli_query($con, $studselect);
  $studrow = mysqli_fetch_array($studresult);
  $studid = $studrow['ID'];


  if(isset($_POST['comment'])){
	$text = $_POST['cText'];
	$comment = "insert into tbl_comment (Vid_ID,Stud_ID,sComment,iStatus) values ($ID , $studid , '$text' , 1 )";
	$commentResult=mysqli_query($con,$comment);	
	if($commentResult==true){
		echo "Success" ;
	}
	else{
		echo "False" ;
	}
  }



  if(isset($_POST['replybtn'])){
	$rplytext = $_POST['replyText'];
	$comid = $_POST['commentid'];
	$rplyqry1 = "insert into tbl_reply_comment (Comment_ID,	Faculty_ID,Stud_ID,sReply,iStatus) values ($comid, 0 ,$studid , '$rplytext' , 1 )";
	$rplyResult=mysqli_query($con,$rplyqry1);	
	if($rplyResult==true){
		echo "Success" ;
	}
	else{
		echo "False" ;
	}
  }



  $videoSelect = "select * from tbl_video where ID=$ID";
  $videoResult=mysqli_query($con,$videoSelect);	
	$videoRow=mysqli_fetch_array($videoResult);

  $url = $videoRow['sUrl'];
  $title = $videoRow['sTitle'];
  $date_string = $videoRow['dtDate'];
  $date = date_create($date_string);
  $subID = $videoRow['Subject_ID'];
  $facid = $videoRow['Faculty_ID'];


  	$facQry = "select * from tbl_faculty where id = $facid";
	$facResult=mysqli_query($con,$facQry);
	$facRow=mysqli_fetch_array($facResult);
	$facName= $facRow['sName'];

	$year = date_format($date, "Y");
	$day = date_format($date, "d");
	$monthNum =date_format($date, "m");
	$dateObj   = DateTime::createFromFormat('!m', $monthNum);
	$monthName = $dateObj->format('F'); // March

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
    
	<link rel="stylesheet" href="../css/fontawesome.css"> 
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	
</head>
<body>
	
        <!-- Top navbar -->
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
                <a class="nav-link" style="color: #ffffffcc; font-size: 17px;" href="index.php" >Home</a>
              </li>
            </ul>
          </div>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 float-right" style="float: right;">
            <li class="nav-item float-right" style="float: right;" >
              <a class="nav-link" style="color: #ffffffcc; font-size: 17px;" href="logout.php">Logout</a>
            </li>
          </ul>
        </nav>
	<!-- Top navbar -->

	<!-- mobile top navbar -->
	<nav class="container-fluid fixed-top bg-white pt-3" id="top_nav_mobile">
		<div class="row">
			<div class="col-3 pl-4">
				<a class="navbar-brand" href="index.html"><img src="images/logo.jpg" class="mb-2"></a>
			</div>
			<div class="col-7">
				<form>
					<div class="input-group mb-3">
						<input type="text" class="form-control search" placeholder="Search">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Search!"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-2 text-right">
				<a href="login.html"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
			</div>
		</div>
	</nav>
	<!-- mobile top navbar -->

<!-- sidebar -->
 
<!-- sidebar -->
	

	<!-- main content -->
	<div class="container-fluid watch_video " >
		<div class="row pt-4">
			<div class="col-md-12 video_box" >
				<iframe class="video_responsive" width="100%" height="769" src="<?php echo $url ;?>?modestbranding=1&rel=0" frameborder="0" rel="0" allow="  gyroscope; picture-in-picture" allowfullscreen></iframe>
				<div class="p-1 pt-3">
					<div class="title"><?php echo $title ; ?></div>
					<div class="row mt-2 border-bottom">
						<!-- date -->
						<div class="col-7">
							<div style="color:#606060;"><?php echo $monthName; ?> <?php echo $day; ?>, <?php echo $year; ?></div>
						</div>
						
					</div>
					<div class="row mt-4 border-bottom ">

						<div class="col-9 pl-5 ">
							<p style="color:#303030;">
								<b><?php echo $facName ; ?></b> <i class="fas fa-check-circle"></i><br>
							</p>
							<p><?php echo $videoRow['sDescription']; ?><span id="dots"></span>
							</p>
							<!-- <button onclick="myFunction()" id="myBtn" class="btn">SHOW MORE</button> -->
							<div class="col-12 m-4   hvr" id="myBtn" style="color: #303030; font-weight: bold" onclick="myFunction()">SHOW MORE </i></div>
						</div>

					</div>
					<div class="row mb-4 ">
						<div class="col-12 m-4 pl-4  hvr" onclick="comment()" style="color: #303030; font-weight: bold">10 Comments <i class="fas fa-angle-down"></i></div>

						<div class="col-11 pl-5">
							<form method="post">
							<div class="row">
								<div class="col-11">
									<textarea  type="text" name="cText" class="input_comment ml-4" placeholder="Add a public comment..."></textarea>
								</div>
								<div class="col-1">
									<input type="submit" class="btn btn-primary" name="comment" value="submit" >
								</div>
							 
							</div>
								
							</form>
						</div>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
	
	<div style="display: none; " class="border-bottom" id="cmnt"> 
		<div class=" mt-4 ml-5  ">

		<?php 
			$cmntSelect = "select * from tbl_comment where Vid_ID = $ID";
			$cmntResult = mysqli_query($con,$cmntSelect );

			while($cmntrow = mysqli_fetch_array($cmntResult)){
				$stid = $cmntrow['Stud_ID'];
				$cmnttxt = $cmntrow['sComment'];
				$cmntid = $cmntrow['ID'];

			$cmntstud = "select * from tbl_student where ID= $stid";
			$stresult = mysqli_query($con,$cmntstud );
			$strow = mysqli_fetch_array($stresult);
			$stName = $strow['sName'];
				
			
		?>

		<!-- comment  -->

		<div class="row mt-4 ml-5  ">
			<div class="col-12 pl-5 ">
				<p style="color:#303030;">
					<b><?php echo $stName ; ?></b> <br>
				</p>
				<p><?php echo $cmnttxt ; ?></p>
				<div class="col-12 m-2 hvr"  id="replys<?php echo $cmntid; ?>" style="color: #303030; font-weight: bold">Show Reply <i class="fas fa-angle-down"></i></div>
				
					<!-- REPLAY -->
					<div style="display: none;" class="col-9 pl-5 pt-3" id="rply<?php echo $cmntid; ?>">
					<?php
						$rply12Select = "select * from tbl_reply_comment where Comment_ID = $cmntid";
						$rply12Result = mysqli_query($con,$rply12Select );
						
						while($rplyrow = mysqli_fetch_array($rply12Result)){
							$studentid = $rplyrow['Stud_ID'];
							$rplytxtdisplay = $rplyrow['sReply'];

							$replystud = "select * from tbl_student where ID= $studentid";
							$strplyresult = mysqli_query($con,$replystud );
							$strprow = mysqli_fetch_array($strplyresult);
							$strpName = $strprow['sName'];

					?>
						<div>
						<p style="color:#303030;">
							<b><?php echo $strpName ?></b> <br>
						</p>
						<p><?php echo $rplytxtdisplay ; ?></p>
						</p>
						</div>

					<?php } ?>
						

						<form method="post">
							<div class="row pt-4">
								<div class="col-11">
									<input type="text" hidden name = "commentid" value="<?php echo $cmntid; ?>">
									<textarea  type="text" name="replyText" class="input_comment ml-0 " placeholder="Add Reply..."></textarea>
								</div>
								<div class="col-1">
									<input type="submit" class="btn btn-primary " name="replybtn" value="submit" >
								</div>							 
							</div>	
						</form>
						
					</div>
			</div>

		</div>

		<?php } ?>

	</div>

</div>

<div class="container-fluid p-5">
	<div class="mt-1">
		<h4> Up next</h4>
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
                          <div   class="col-md-2 pb-5">
                            <div class="card " style="border: 0px; ">
                              <iframe style="z-index:0" id="s<?php echo $id; ?>"  src="<?php echo $url; ?>?autoplay=0&showinfo=0&controls=0"
                                  frameborder="0" allow="" allowfullscreen> </iframe>
                                  <div class="hvr" id="vis<?php echo $id; ?>" style="position:absolute; width:100%; height:100%; background-color:rgba(240, 248, 255, 0); ; z-index:1000000"></div>
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


	


			<div class="container-fluid">
				
			</div>
		<!-- main content -->





			  

		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
			});

function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "SHOW MORE"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "SHOW LESS"; 
    moreText.style.display = "inline";
  }
}


function comment(){
	var cmnt = document.getElementById("cmnt");
	if(cmnt.style.display==="none"){
		cmnt.style.display="block";
	} else {
		cmnt.style.display="none";
	}
}

function reply(){
	var cmnt = document.getElementById("rply");
	if(cmnt.style.display==="none"){
		cmnt.style.display="block";
	} else {
		cmnt.style.display="none";
	}
}



</script>





			










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


		<?php 
			$cmntSelect = "select * from tbl_comment where Vid_ID = $ID";
			$cmntResult = mysqli_query($con,$cmntSelect );

			while($cmntrow = mysqli_fetch_array($cmntResult)){
				$stid = $cmntrow['Stud_ID'];
				$cmnttxt = $cmntrow['sComment'];
				$cmntid = $cmntrow['ID'];

			$cmntstud = "select * from tbl_student where ID= $stid";
			$stresult = mysqli_query($con,$cmntstud );
			$strow = mysqli_fetch_array($stresult);
			$stName = $strow['sName'];
				
			
		?>

		$(document).ready(function(){
		 	$("#replys<?php echo $cmntid; ?>").click(function(){

				if($('#rply<?php echo $cmntid; ?>').css('display') == 'none')
				{
					$("#rply<?php echo $cmntid; ?>").css("display","block");
				}
				else{
					$("#rply<?php echo $cmntid; ?>").css("display","none");
				}

			 })
		});
<?php } ?>




</script>



<?php
		$innerQry2 = "select * from tbl_video where Subject_ID= $subID";
		$videoResult1 = mysqli_query($con,$innerQry2);
		while($videoRow1=mysqli_fetch_array($videoResult1)){
		$id1 = $videoRow1['ID'];
		$batchid1=$videoRow1['Batch_ID'];
		$semid1=$videoRow1['Sem_ID'];

	?>
			<script>
				$("#vis<?php echo $id1; ?>").click(function(){
				
				window.location = "watch.php?id=<?php echo $id1; ?>&batch=<?php echo $batchid1; ?>&sem=<?php echo $semid1; ?>";
				});
			</script>

	


<?php
		}
	?>	


<?php
		$innerQry2 = "select * from tbl_video where Subject_ID= $subID";
		$videoResult1 = mysqli_query($con,$innerQry2);
		while($videoRow1=mysqli_fetch_array($videoResult1)){
		$id1 = $videoRow1['ID'];
		$batchid1=$videoRow1['Batch_ID'];
		$semid1=$videoRow1['Sem_ID'];
		

	?>
			<script>
				$("#vis<?php echo $id1; ?>").click(function(){
				
				window.location = "watch.php?id=<?php echo $id1; ?>&batch=<?php echo $batchid1; ?>&sem=<?php echo $semid1; ?>";
				});
			</script>

	


<?php
		}
	?>	

</body>
</html>