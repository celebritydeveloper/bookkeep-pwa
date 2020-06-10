<?php

  include('config.php');
  session_start();
  if(isset($_SESSION['user'])){
    echo $_SESSION['user'];
  //header("location: profile.php");
  echo "<script>window.location.assign('profile.php')</script>";
  }
  $msg = "";
  $msgClass = "alert alert-";
  // use PHPMailer\PHPMailer\PHPMailer  ;
  
  // require 'PHPMailer/Exception.php';
  // require 'PHPMailer/PHPMailer.php';
  // require 'PHPMailer/SMTP.php';

	if (isset($_POST['name'])) {

		$name = $conn->real_escape_string($_POST['name']);
		$email = $conn->real_escape_string($_POST['email']);
		$password = $conn->real_escape_string($_POST['password']);
		//$cPassword = $conn->real_escape_string($_POST['cPassword']);
		$location = $conn->real_escape_string($_POST['location']);

		if ($name == "" || $email == "" || $password == "")
            echo "Please check your inputs!";
		else {
			$sql = $conn->query("SELECT id FROM users WHERE email='$email'");
			if ($sql->num_rows > 0) {
                $msg = "Email already exists!";
                echo "Email already exists!";
			} else {
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);

				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

				$result = "INSERT INTO users (businessName,email,passcode,location,isEmailConfirmed,token)
					VALUES ('$name', '$email', '$hashedPassword', '$location', '0', '$token');
				";

                // include_once "PHPMailer/PHPMailer.php";

                // $mail = new PHPMailer();

                // SMTP Settings
                // $mail->isSMTP();
                // $mail->Host = "smtp.gmail.com";
                // $mail->SMTPAuth = true;
                // $mail->Username = "essiensaviour.a@gmail.com";
                // $mail->Password = "Coding3719.";
                // $mail->Port = 465;
                // $mail->SMTPsecure = "ssl";
                
                // $mail->setFrom('hello@theboringcreatives.com');
                // $mail->addAddress($email, $name);
                // $mail->Subject = "Please verify email!";
                // $mail->isHTML(true);
                // $mail->Body = "
                //     Please click on the link below:<br><br>
                    
                //     <a href='http://theboringcreatives.com/Bookkeep/confirm.php?email=$email&token=$token'>Click Here</a>
                // ";

                if ($conn->query($result)) {
                  echo "You have been registered! Please verify your email!";
                }else {
                  $msg = "Something wrong happened! Please try again!";
                  echo "There was a problem";
                  echo "Error: " . $result . "<br>" . $conn->error;

                }

                $conn->close();
                    
			}
		}
  }

?>