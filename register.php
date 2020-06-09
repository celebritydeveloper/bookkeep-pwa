<?php
echo  "You have been registered! Please verify your email!";
	$msg = "";
	use PHPMailer\PHPMailer\PHPMailer;

	if (isset($_POST['submit'])) {
		$con = new mysqli('localhost', 'root', '', 'bookkeep');

		$name = $con->real_escape_string($_POST['name']);
		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);
		$cPassword = $con->real_escape_string($_POST['cPassword']);
		$location = $con->real_escape_string($_POST['location']);

		if ($name == "" || $email == "" || $password != $cPassword || $location)
			$msg = "Please check your inputs!";
		else {
			$sql = $con->query("SELECT id FROM users WHERE email='$email'");
			if ($sql->num_rows > 0) {
				$msg = "Email already exists in the database!";
			} else {
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);

				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

				$con->query("INSERT INTO users (businessName,email,password,location,isEmailConfirmed,token)
					VALUES ('$name', '$email', '$hashedPassword', 'location', '0', '$token');
				");

                include_once "PHPMailer/PHPMailer.php";

                $mail = new PHPMailer();
                $mail->setFrom('hello@codingpassiveincome.com');
                $mail->addAddress($email, $name);
                $mail->Subject = "Please verify email!";
                $mail->isHTML(true);
                $mail->Body = "
                    Please click on the link below:<br><br>
                    
                    <a href='http://theboringcreatives.com/Bookkeep/confirm.php?email=$email&token=$token'>Click Here</a>
                ";

                if ($mail->send()){
					$msg = "You have been registered! Please verify your email!";
					echo "You have been registered! Please verify your email!";
				}else{
                
					$msg = "Something wrong happened! Please try again!";
					echo "Not have been registered! Please verify your email!";
				}
			}
		}
	}
	
?>