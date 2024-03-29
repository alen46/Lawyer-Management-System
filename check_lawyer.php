<?php
	session_start();
	if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){
		
		//session_start();
		include("db_con/dbCon.php");
		$conn = connect();
        $id = $_GET['id'];

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
            <link rel="stylesheet" href="css/check_lawyer.css">
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
										<li class="active">
											<a class="nav-link cus-a" href="#">Home <span class="sr-only">(current)</span></a>
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
						<div class="sidebar-heading">Admin Panel</div>
						<div class="list-group list-group-flush">
							<a href="admin_dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a><!--this page-->
							<a href="admin_lawyer.php" class="list-group-item list-group-item-action bg-light">See lawyers</a><!--admin_lawyer page-->
							<a href="admin_user.php" class="list-group-item list-group-item-action bg-light">See Users</a><!--admin_user page-->
						</div>
					</div>
					<!-- /#sidebar-wrapper -->
					
					<section class="bookingrqst">
						<div class="container">
							<div class="span7">   
								<div class="widget stacked widget-table action-table">
									
									<div class="widget-header">
										<i class="icon-th-list"></i>
									
									</div> <!-- /widget-header -->
                                    <div class="detailsSection">
                                        <h3>Details</h3>
									
                                    <?php
												include_once 'db_con/dbCon.php';
												$conn = connect();
												$result = mysqli_query($conn,"SELECT * FROM user INNER JOIN lawyer on user.u_id=lawyer.lawyer_id where lawyer.lawyer_id = '$id' ");
												while($row = mysqli_fetch_array($result)) {
												?>
											
														<?php echo $row["u_id"]; ?> <br>
														<?php echo $row["first_name"]; ?><br>
														<?php echo $row["last_name"]; ?><br>
														<?php echo $row["email"]; ?><br>
														<?php $enr = $row["enrollment"];  echo $enr; ?><br>
														<?php echo $row["about"]; ?><br>
														<?php echo $row["city"]; ?><br>
														<?php echo $row["degree"]; ?><br>
														<?php echo $row["experience"]; ?><br>
														<?php echo $row["speciality"]; ?><br><br>
														<?php if ($row['status']=='Pending'){ ?>
																<a class="btn btn-sm btn-success" href="approve_lawyer.php?unblock_id=<?=$row['u_id']?>"><i class="fas fa-hourglass"></i>&nbsp; Approve</a>
																<a class="btn btn-sm btn-danger" href="reject_lawyer.php?unblock_id=<?=$row['u_id']?>"><i class="fas fa-hourglass"></i>&nbsp; Reject</a>
															
														<?php }?>

										
													<?php
                                                }
                                                ?>
                                                </div>
                                                <div class="details2Section">
                                                <?php


                                                    $result1 = mysqli_query($conn,"SELECT * FROM `csv` WHERE enrolment = '$enr'");
                                                    if(mysqli_num_rows($result1) >0){
                                                        while($row1 = mysqli_fetch_array($result1)) {
                                                        
                                                        echo "<br>".$row1['name'];
                                                        echo "<br>".$row1['enrolment']; 
                                                        echo "<br>".$row1['city'];
                                                        echo "<br><br>";
                                                        }
                                                    }
                                                    else{
                                                        echo "<b>No Records Found</b>";
                                                    }
												?>
                                                </div>
										
                                            
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