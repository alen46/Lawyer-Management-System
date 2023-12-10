<?php
	session_start();
	if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){
		
		//session_start();
		include("db_con/dbCon.php");
		$conn = connect();
		if (isset($_POST['send'])) {
		$msg = $_POST['message'];
        $id = $_POST['id'];
		$result = mysqli_query($conn,"UPDATE `booking` SET `usermsg`='$msg' where `booking_id` = '$id' ");

		}
	?>
	<!doctype html>
	<html lang="en">
		<head>
			<!-- Required meta tags -->
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
			<style>
				.message{
					padding-inline:1em;
					background: inherit;
					border: 1px solid #555555;
					border-radius: 3px;
				}
				.message:focus, .message-focus-visible {
					
					outline:1px solid ;
					
				}
			</style>
		</head>
		<body>
			<header class="customnav">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<nav class="navbar navbar-expand-lg ">
								<a class="navbar-brand cus-a" href="index.php">Lawyer Management System</a>
								
								
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
							<a href="user_dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a><!--this page-->
							<a href="user_booking.php" class="list-group-item list-group-item-action bg-light">My booking requests</a><!--booking page-->
							<a href="update_password.php" class="list-group-item list-group-item-action bg-light">Update Password</a>
						</div>
					</div>
					<!-- /#sidebar-wrapper -->
					
					<section class="bookingrqst">
						<div class="container">
							<div class="span7">   
								<div class="widget stacked widget-table action-table">
									
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Booking Request</h3>
									</div> <!-- /widget-header -->
									
									<div class="widget-content">
										
										<table class="table table-striped table-bordered  table-success table-responsive">
											<thead>
												<tr>
													<th>No.</th>
													<th>Date</th>
													<th>Lawyer Name</th>
													<th>Status</th>
													<th>Message</th>
													<th>Reply</th>
													<th>Action</th>
												</tr>
											</thead>
											<?php
												include_once 'db_con/dbCon.php';
												$a=$_SESSION['client_id'];
												$conn = connect();
												$result = mysqli_query($conn,"SELECT booking_id,first_Name,last_Name,date,lawyermsg,usermsg,booking.status as statuss
												FROM booking,lawyer,user 
												WHERE booking.lawyer_id=lawyer.lawyer_id 
												AND lawyer.lawyer_id=user.u_id 
												
												and booking.client_id='$a'
												");
												$counter = 0;
												while($row = mysqli_fetch_array($result)) {
												?>
												<tbody id="myTable">
													<tr>
														<td><?php echo ++$counter ;?></td>
														<td><?php echo $row["date"]; ?></td>
														<td><?php echo $row["first_Name"]; ?> <?php echo $row["last_Name"]; ?></td>
														 <?php if($row['statuss']=='Accepted'){?>
															<td>
																<span style="color: green;"><b>Accepted</b></span>
															</td>
														<?php }
														else if($row['statuss']=='Rejected'){?>
															<td>
															<span style="color: red;"><b>Rejected</b></span>
															</td>
															<?php }
															else if($row['statuss']=='Pending') {?>
															<td><span style="color: blue;"><b>Pending</b></span> </td> <?php } ?>
														<td><form action="" method="post"><input class="message" type="text" size = "50" name ="message" value="<?php echo $row["usermsg"]; ?>"></td>
														<td><?php echo $row["lawyermsg"]; ?></td>
														
														<td><input type="hidden" name="id" value=" <?php echo $row["booking_id"]; ?>" ><input name="send" type="submit" value="send" class="btn btn-sm btn-info"></form></td>
													</tr>
													<?php
													}
												?>
											</table>
											
										</div> <!-- /widget-content -->
										
									</div> <!-- /widget -->
								</div>
							</div>
						</section>
						
					</div>
					<!-- /#wrapper -->
				
				
				
				</body>
				<footer class="bg">
				<div class="container">
				<div class="row">
				<div class="col">
				<h5>All rights reserved 2022</h5>
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