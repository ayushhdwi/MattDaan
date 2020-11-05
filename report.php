<?php
	$otp = rand(1000,9999);
	$email = $_GET['email'];
	// echo $email.'<br>';

	use PHPMailer\PHPMailer\PHPMailer;

	if(isset($_GET['email'])) {
		$name = "MattDaan";
		$email = $_GET['email'];
		$body = 'Your One Time Verification Code is : '.$otp;

		require_once "PHPMailer/PHPMailer.php";
		require_once "PHPMailer/SMTP.php";
		require_once "PHPMailer/Exception.php";

		$mail = new PHPMailer();

		//smtp settings
		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = "ayushhdwi@gmail.com";
		$mail->Password = 'ospreview3';
		$mail->Port = 465;
		$mail->SMTPSecure = "ssl";

		//email settings
		$mail->isHTML(true);
		$mail->setFrom($email, $name);
		$mail->addAddress($_GET['email']);
		$mail->Subject = ("MattDaan OTP Verification");
		$mail->Body = $body;

		if($mail->send()){
			$status = "success";
			$response = "Email is sent!";
			// echo $response;
		}
		else
		{
			$status = "failed";
			$response = "Something is wrong: <br>" . $mail->ErrorInfo;
			// echo $response;
		}

		// exit(json_encode(array("status" => $status, "response" => $response)));
	}

	setcookie('otp',$otp);
	header('LOCATION: verify.php');
?>
