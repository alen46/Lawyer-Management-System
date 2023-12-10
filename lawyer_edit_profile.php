<?php
	session_start();
	if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){
		
		//session_start();
		include("db_con/dbCon.php");
		
		
	?>
	<!doctype html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			
			<!-- Bootstrap CSS -->
			<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> -->
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
			<link rel="stylesheet" href="css/all.css">
			<link rel="stylesheet" href="css/simple-sidebar.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/media.css">
			<title></title>
		</head>
		<body>
			<header class="customnav">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<nav class="navbar navbar-expand-lg ">
								<a class="navbar-brand cus-a" href="#">Lawyer Management System</a>
								
								
								<div class="collapse navbar-collapse" id="navbarSupportedContent">
									<ul class="navbar-nav ml-auto ">
										<li class="">
											<a class="nav-link cus-a" href="#">Full Name: <?php echo $_SESSION['first_Name'];?> <?php echo $_SESSION['last_Name'];?></a>
										</li>
										<li class="">
											<a class="nav-link cus-a" href="logout.php">Log Out</a>
										</li>
										
									</ul>
									
								</div>
							</nav>
						</div>
					</div>
				</div>
			</header>
			<body>
				
				<div class="d-flex" id="wrapper">
					
					<!-- Sidebar -->
					<div class="bg-light border-right" id="sidebar-wrapper">
						<div class="sidebar-heading">My Profile</div>
						<div class="list-group list-group-flush">
							<a href="lawyer_dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a><!--lawyer dashboard page-->
							<a href="lawyer_edit_profile.php" class="list-group-item list-group-item-action bg-light">Edit Profile</a><!--lawyer_edit_profile page-->
							<a href="lawyer_booking.php" class="list-group-item list-group-item-action bg-light">Booking requests</a><!--this page-->
							<a href="update_password_admin.php" class="list-group-item list-group-item-action bg-light">Update Password</a>
						</div>
					</div>
					<!-- /#sidebar-wrapper -->
					<section class="bookingrqst">
						<div class="container">
							<div class="span7">   
								<div class="">
									
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<?php if(isset($_GET['ok'])){
											echo "<div class='alert alert-success alert-dismissible fade show'>
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<strong>Sucessfully!</strong> update your Profile.
											</div>";
										}?>
									</div> <!-- /widget-header -->
									
									<div class="widget-content">
										<div class="row">
											<div class="col-md-1"></div>
											
											<?php
												$a=$_SESSION['lawyer_id'];
												$conn = connect();
												
												$result = mysqli_query($conn,"SELECT * FROM user,lawyer WHERE user.u_id=lawyer.lawyer_id AND user.status='Active' AND user.u_id='$a'");
												
												while($row = mysqli_fetch_array($result)) {
												?>
												<div class="col-md-10">
													<form  action="save_lawyer_edit_Profile.php"  method="post" enctype="multipart/form-data"  id="validateForm">
														<div class="form-row">
															<div class="form-group">
																<label for="fname">First Name</label>
																<input type="text" class="form-control" id="first_Name" name="first_Name" value="<?php echo $row["first_name"]; ?>">
															</div>
															<div class="form-group">
																<label for="lname">Last Name</label>
																<input type="text" class="form-control" id="lname" name="last_Name" value="<?php echo $row["last_name"]; ?>">
															</div>
														</div>
															<div class="form-group">
																<label for="degree">Degree</label>
																<select id="degree" name="degree" class="form-control">
																	<option value=" " selected>Choose...</option>
																	<option value="LLB" <?php if ($row['degree']=='LLB'){echo "selected";}?>>LLB</option>
																	<option value="LLM" <?php if ($row['degree']=='LLM'){echo "selected";}?>>LLM</option>
																</select>
															</div>
														
															<div class="form-group ">
																<label for="city">City</label>
																<select id="city" name="city" class="form-control">
																	<option value=" " selected>Choose...</option>
																	<option value="Ernakulam" <?php if ($row['city']=='Ernakulam'){echo "selected";}?>>Ernakulam</option>
																	<option value="Kottayam" <?php if ($row['city']=='Kottayam'){echo "selected";}?>>Kottayam</option>
																	<option value="Trissur" <?php if ($row['city']=='Trissur'){echo "selected";}?>>Trissur</option>
																	<option value="Kozhikode" <?php if ($row['city']=='Kozhikode'){echo "selected";}?>>Kozhikode</option>
																	<option value="Thiruvananthapuram" <?php if ($row['city']=='Thiruvananthapuram'){echo "selected";}?>>Thiruvananthapuram</option>
																	<option value="Alappuzha" <?php if ($row['city']=='Alappuzha'){echo "selected";}?>>Alappuzha</option>
																	<option value="Idukki" <?php if ($row['city']=='Idukki'){echo "selected";}?>>Idukki</option>
																</select>
															</div>
														
														<div class="form-group">
															<label for="practise">Experience</label>
															<select id="practise" name="practise_Length" class="form-control">
																<option value=" " selected>Choose...</option>
																<option value="1-5 years" <?php if ($row['experience']=='1-5 years'){echo "selected";}?>>1-5 years</option>
																<option value="6-10 years" <?php if ($row['experience']=='6-10 years'){echo "selected";}?>>6-10 years</option>
																<option value="11-15 years" <?php if ($row['experience']=='11-15 years'){echo "selected";}?>>11-15 years</option>
																<option value="16-20 years" <?php if ($row['experience']=='16-20 years'){echo "selected";}?>>16-20 years</option>
															</select>
														<div class="form-group">
															<label for="practise">My Speciality</label>
															<select id="practise" name="speciality" class="form-control">
																<option value=" " selected>Choose...</option>
																<option value="Criminal Law" <?php if ($row['speciality']=='Criminal Law'){echo "selected";}?>>Criminal law</option>
																<option value="Civil Law" <?php if ($row['speciality']=='Civil Law'){echo "selected";}?>>Civil law</option>
																<option value="IT Law" <?php if ($row['speciality']=='IT Law'){echo "selected";}?>>IT law</option>
																<option value="Family Law" <?php if ($row['speciality']=='Family Law'){echo "selected";}?>>Family law</option>
																<option value="Labour Law" <?php if ($row['speciality']=='Labour Law'){echo "selected";}?>>Labour law</option>
																
															</select>
														</div>
														<div class="form-group">
															
														</div>
														<input name="update" type="submit" class="btn btn-block btn-info" value="Update" />
														<!--after signup redirect lawyer dashboard page-->
													</form>
													
												</div>
												<?php
												}
											?>
											<div class="col-md-1"></div>
										</div>
										
										
									</div> <!-- /widget -->
								</div>
							</div>
						</section>
						
						
						
						
					</div>
					<!-- /#wrapper -->
					
					
					
				</div>
				
				
			</body>
			<footer class ="bgs">
				<div class="container">
					<div class="row">
						<div class="col">
							<h5>All rights reserved 2024</h5>
						</div>
					</div>
				</div>
			</footer>
			<!-- Optional JavaScript -->
			<!-- jQuery -->
			
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
		</body>
	</html>
	<?php
		
	}else 
	header('location:login.php?deactivate');
?>	