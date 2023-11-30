<header>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
	
	<script>
		function MySucessFn(){
			swal({
				title: "Dera User...Your Registration Sucessfully Complete! Please Check Your Email",
				text: "",
				type: "success",
				
				showConfirmButton: true,
			},
			window.load = function(){
				window.location='http://localhost/lawyermanagementsystem/user_register.php';
			});
		}
		function MyCheckFn(){
			swal({
				title: "Sorry User!! This Email already exists..Please Fill up the form again",
				text: "",
				type: "warning",
				
				showConfirmButton: true,
			},
			window.load = function(){
				window.location='http://localhost/lawyermanagementsystem/user_register.php';
			});
		}
	</script>
</header>
<?php
	include_once 'db_con/dbCon.php';
	
	$okFlag = TRUE;
	if($okFlag){
		function generateRandomString()  {
            $characters = '0123456789';
            $length = 5;
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
			}
            return $randomString;
		}
		
		
		$u_id = uniqid('Client');
		$first_Name = $_REQUEST['first_Name'];
		$last_Name = $_REQUEST['last_Name'];
		$email = $_REQUEST['email'];
		$city = $_REQUEST['city'];
		$password = generateRandomString();
		
		include 'send_mail_client.php';
		$conn = connect();
		//Check duplicate value
        $duplicate=mysqli_query($conn,"select * from user where email='$email'");
        if (mysqli_num_rows($duplicate)>0)
        {
			echo "<script type= 'text/javascript'>MyCheckFn();</script>";
			//echo "Duplicate";
		}
        else
        {
            // sql query for inserting data into database
            $sql = "INSERT INTO `user`(`u_id`, `first_Name`, `last_Name`, `email`, `password`, `status`, `role`) VALUES ('$u_id','$first_Name', '$last_Name', '$email ', '$password ', 'Active', 'User');";
          //echo $sql;exit;
		   $result=mysqli_query($conn, $sql) or die(mysqli_error ($conn));
            if($result==1)
            {
                $sql2= "INSERT INTO `client` (`client_id`, `city`) VALUES ('$u_id', '$city');";
				
                $result2=mysqli_query($conn, $sql2) or die(mysqli_error ($conn));
                if ($result2==1)
                {
                    echo "<script type= 'text/javascript'>MySucessFn();</script>";
					
				}
			}
		}
	}
?>