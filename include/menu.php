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
										<a class="dropdown-item" href="..\changepassword.php">Change password</a>
											<a type="submit" href="..\logout.php"  name="logout" class="dropdown-item" value="">Logout</a>
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
									<!-- <span class="user-level" onClick="location.href='..\index.php';" style=" margin-top:15px;"> Administrator</span> -->
									<a class="user-level" href="..\index.php">
										<span style=" margin-top:15px;" class="user-level fw-bold" onclick="hide(); return false">Administrator</span>
									</a>
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
							<a href="..\student\index.php"><p style = "font-size: 1.1rem; color: black;">Students</p></a>
						</li>
						<li class="nav-item">
							<a href="..\department\index.php"><p style = "font-size: 1.1rem; color: black;">Department</p></a>
						</li>
						<li class="nav-item">
							<a href="..\semester\index.php"><p style = "font-size: 1.1rem; color: black;">Semester</p></a>
						</li>
						<li class="nav-item">
							<a href="..\program\index.php"><p style = "font-size: 1.1rem; color: black;">Program</p></a>
						</li>
						<li class="nav-item">
							<a href="..\subject\index.php"><p style = "font-size: 1.1rem; color: black;">Subject</p></a>
						</li>
						<li class="nav-item">
							<a href="..\faculty\index.php"><p style = "font-size: 1.1rem; color: black;">Faculty</p></a>
						</li>
						<li class="nav-item">
							<a href="..\batch\index.php"><p style = "font-size: 1.1rem; color: black;">Batch</p></a>
						</li>
						<li class="nav-item">
							<a href="..\subjectAllocation\index.php"><p style = "font-size: 1.1rem; color: black;">Subject allocation</p></a>
						</li>
					</ul>
				</div>
			</div>
		</div>