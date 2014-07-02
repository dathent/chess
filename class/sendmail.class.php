<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/PHPMailer/PHPMailerAutoload.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Sendmail{
	
	function send($email_user, $name_user, $subject, $message){
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = SMTP_HOST;
		$mail->Port =  SMTP_PORT;
		$mail->SMTPSecure = SMTP_MODE;
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth = true;
		$mail->Username = EMAIL_LOGIN;
		$mail->Password = EMAIL_PASSWORD;
		$mail->setFrom(EMAIL_FROM, 'Chess Game');
		$mail->addAddress($email_user, $name_user);
		$mail->Subject = $subject;
		$mail->msgHTML($message);
		$mail->send();
	}
	
	function activate_mail($email, $user_name, $code){
		
		$text = "<!doctype html>
				<html>
					<head>
						<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
						<title>Confirm register</title>
					</head>
					<body>
						<p>Activate for link: <a href='".URL."login/?email=$email&confirm=$code'>activate acaunt</a></p>
						<p>Your activate code: $code</p>
					</body>
				</html>";
	
		$this->send($email, $user_name, 'Confirm register', $text);
	}
	function recovery($email, $user_name, $code, $login){
		
		$text = "<!doctype html>
				<html>
					<head>
						<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
						<title>New password</title>
					</head>
					<body>
						<p>Your login: $login</p>
						<p>Your new password: $code</p>
						<p><a href='".URL."login/'>Login</a></p>
					</body>
				</html>";
	
		$this->send($email, $user_name, 'New password', $text);
	}
	
}