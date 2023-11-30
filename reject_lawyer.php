<?php
	include("db_con/dbCon.php");
	$conn = connect();
	if(isset($_GET['unblock_id'])){
		
		$id = $_GET['unblock_id'];
	
		$sql = "UPDATE `user` SET `status`='Rejected' WHERE u_id='$id'";
		//echo $sql;
		$conn->query($sql);
		header("Location:admin_lawyer.php");
	}
?>