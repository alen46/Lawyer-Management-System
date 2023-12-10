
<?php
	session_start();
	include_once 'db_con/dbCon.php';
	$a=$_SESSION['lawyer_id'];
	$okFlag = TRUE;
	if($okFlag){
		$first_Name = $_POST['first_Name'];
		$last_Name = $_POST['last_Name'];
		$degree = $_POST['degree'];
		$city = $_POST['city'];
		$practise_Length = $_POST['practise_Length'];
		$speciality = $_POST['speciality'];
		
		$conn = connect();
		$sql = "UPDATE `user` SET first_name ='$first_Name',last_name='$last_Name' WHERE u_id='$a'";
		$fresult=mysqli_query($conn, $sql) or die(mysqli_error ($conn));
		if($fresult==1)
		{
			$sql2= "UPDATE lawyer SET degree='$degree',city='$city',experience='$practise_Length',speciality='$speciality' WHERE lawyer_id='$a'";
			
			$fresult2=mysqli_query($conn, $sql2) or die(mysqli_error ($conn));
			if ($fresult2==1)
			{
				header('location:lawyer_edit_profile.php?ok');
				
			}
		}
		
	}
?>