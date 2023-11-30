<?php
    $first_Name=$first_Name;
    $last_Name=$last_Name;
    $password=$password;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	$mailto = $email;
    $mailSub = "Notification For Account Information";
	$message="
	
	<table border='1' width='590' align='center' cellpadding='2px' cellspacing='2' >
			<tr>
				<td align='left' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
				<!-- section text ======-->
				<h2 style=''>
					Dear ".$first_Name." <hr/>
					Your Account informatiom
					
				</h2>
				
				<h6 style=''>
					<b> First Name : </b>".$first_Name."
				</h6>
				<h6 style=''>
					<b> Last Name : </b>".$last_Name."
				</h6>
				<h6 style=''>
					<b> Full Name : </b>".$first_Name." ".$last_Name."
				</h6>
				<h6 style=''>
					<b> Your Email Address: </b>".$mailto."
				</h6>
				<h6 style=''>
					<b> Your  Password: </b>".$password."
				</h6>
				<p>Now You can easily Login & Upadte your password</p>
				<a href='http://localhost/lawyermanagementsystem/login.php'>Login Here</a>
			</td>
		</tr>
	</table>

	
	"
	;
    $mailMsg = $message;
	require 'vendor/autoload.php';
	
	$mail = new PHPMailer(true);
	
	$mail->SMTPOptions = array(
    'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
    )
	);
	$mail ->IsSmtp();
	$mail ->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail ->SMTPAuth = true;
	$mail ->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail ->Host = "smtp-relay.brevo.com";
	$mail ->Port = 587; 
	$mail ->IsHTML(true);
	$mail ->Username = "lawyermanagementsystembot@gmail.com";
	$mail ->Password = "6mQRsjUOIWS95hrg";
	$mail->setFrom('lawyermanagementsystembot@gmail.com', 'Account Information');
	$mail->addReplyTo('lawyermanagementsystembot@gmail.com', 'Reply');
	$mail ->Subject = $mailSub;
	$mail ->Body = $mailMsg;
	$mail ->AddAddress($mailto);
	
	if(!$mail->Send())
	{
		echo "Mail Not Sent";
	}
	else
	{
		echo "Mail Sent";
	}	
