<?php		
		include("db_con/dbCon.php");
		$conn = connect();
		if(isset($_GET['unblock_id'])){
			
			$id = $_GET['unblock_id'];
			
			$sql = "UPDATE `booking` SET `status`='Rejected' WHERE booking_id='$id'";
			//echo $sql;
			$conn->query($sql);
			header("Location:lawyer_booking.php");
		}
	?>