<header class = "bg-success">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
	
	<script>
		function MySucessFn(){
			swal({
				title: "Dear Lawyer...Your Registration Sucessfully Complete! Please Wait for Approval",
				text: "",
				type: "success",
				
				showConfirmButton: true,
			},
			window.load = function(){
				window.location='http://localhost/lawyermanagementsystem/lawyer_register.php';
			});
		}
		function MyCheckFn(){
			swal({
				title: "Sorry Lawyer!! This Email already exists..Please Fill up the form again",
				text: "",
				type: "warning",
				
				showConfirmButton: true,
			},
			window.load = function(){
				window.location='http://localhost/lawyermanagementsystem/lawyer_register.php';
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
            $length = 8;
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
			}
            return $randomString;
		}
		if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"] != ''){
			//echo 123;exit;
			$target_dir = "images/upload/";
			$newName = date('YmdHis_');
			$newName .= basename($_FILES["fileToUpload"]["name"]);
			$target_file = $target_dir . $newName;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
				} else {
				$uploadOk = 0;
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 5000000) {
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "JPG" &&$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$checkFlag = FALSE;
				// if everything is ok, try to upload file
				} else {
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					} else {
					$checkFlag = FALSE;
				}
			}
			//echo $newName;exit;
			}else{
			$newName = $_POST['image'];
			//echo $newName;exit;
		}
		
		$u_id = uniqid('Lawyer');
		$first_Name = $_REQUEST['first_Name'];
		$last_Name = $_REQUEST['last_Name'];
		$enrollment = $_REQUEST['enrollment'];
		$email = $_REQUEST['email'];
		$degree = $_REQUEST['degree'];
		$about = $_REQUEST['about'];
		$city = $_REQUEST['city'];
		$experience = $_REQUEST['experience'];
		$speciality = $_REQUEST['speciality'];
		$password = generateRandomString();
		
		include 'send_mail_lawyer.php';
		
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
            $sql = "INSERT INTO `user`(`u_id`, `first_name`, `last_name`, `email`, `password`, `status`, `role`) values ('$u_id','$first_Name', '$last_Name','$email ', '$password ', 'Pending', 'Lawyer')";
          //echo $sql;exit;
		   $result=mysqli_query($conn, $sql) or die(mysqli_error ($conn));
            if($result==1)
            {
                $sql2= "INSERT INTO `lawyer`(`lawyer_id`, `enrollment`, `degree`, `city`, `experience`, `speciality`, `image`, `about`)
				VALUES ('$u_id', '$enrollment', '$degree', '$city','$experience', '$speciality', '$newName', '$about')";
				
                $result2=mysqli_query($conn, $sql2) or die(mysqli_error ($conn));
                if ($result2==1)
                {
                    echo "<script type= 'text/javascript'>MySucessFn();</script>";
					
				}
			}
		}
	}
?>