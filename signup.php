<?php

  include('config.php');
  session_start();
  if(isset($_SESSION['user'])){
    echo $_SESSION['user'];
  header("location: profile.php");
  }
  $msg = "";
  $msgClass = "alert alert-";
  // use PHPMailer\PHPMailer\PHPMailer;
  
  // require 'PHPMailer/Exception.php';
  // require 'PHPMailer/PHPMailer.php';
  // require 'PHPMailer/SMTP.php';

	if (isset($_POST['submit'])) {

		$name = $conn->real_escape_string($_POST['name']);
		$email = $conn->real_escape_string($_POST['email']);
		$password = $conn->real_escape_string($_POST['password']);
		$cPassword = $conn->real_escape_string($_POST['cPassword']);
		$location = $conn->real_escape_string($_POST['location']);

		if ($name == "" || $email == "" || $password != $cPassword)
			$msg = "Please check your inputs!";
		else {
			$sql = $conn->query("SELECT id FROM users WHERE email='$email'");
			if ($sql->num_rows > 0) {
				$msg = "Email already exists in the database!";
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
                  $msg = "You have been registered! Please verify your email!";
                  echo "It works";
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookkeep PWA</title>
    <link
      rel="stylesheet"
      href="css/bootstrap-4.4.1/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://kit.fontawesome.com/9e1546c7fe.js" crossorigin="anonymous"></script>
  </head>
  <body class="bg-light">
    <div class="container">
      <div class="row mt-5">
        <div class="col text-center">
          <img src="images/bfaf-full-color.png" alt="" />
        </div>
      </div>
    </div>
    <div class="container mt-5 mb-4">
      <div class="row">
        <div class="form-bg col-md-5"></div>
        <div class="col-md-6 offset-md-1 offset-sm-0">
          <h5 class="h2">Create Your Account</h5>

          <?php if ($msg != "") echo $msg . "<br><br>" ?>

          <form id="egister-form" method="POST" action="signup.php">
            <div class="form-row">
              <div class="col-md-10 mb-3">
                <label for="businessName">Business Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="businessName"
                  value=""
                  name="name"
                />
                <div class="valid-feedback d-none" id="valid-feedback-1">
                  Looks good!
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-10 mb-3">
                <label for="businessEmail">Business Email Address</label>
                <input
                  type="text"
                  class="form-control"
                  id="businessEmail"
                  value=""
                  name="email"
                />
                <div class="valid-feedback d-none" id="valid-feedback-2">
                  Looks good!
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-10 mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span toggle="#password-field" onclick="myFunction()" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                <div class="invalid-feedback d-none" id="valid-feedback-3">
                  Password is too short.
                </div>
              </div>
              <!--<div class="col-md-1 mt-4">
                <input type="text" class="form-control" value="hi">
              <button type="button" onclick="myFunction()" title="Show Password"><span class="fa fa-eye-slash"></span> Hi</button>
              </div>-->
            </div>

            <div class="form-row">
              <div class="col-md-10 mb-3 d-none" id="confirm-password">
                <label for="confirmPassword">Confirm Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="confirmPassword"
                  name="cPassword"
                />
                <div class="invalid-feedback d-none" id="valid-feedback-4">
                  Password must match
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-10 mb-3">
                <label for="location">State</label>
                <select class="custom-select" id="location" name="location">
                  <option selected disabled value="">Choose a state...</option>
                  <option>...</option>
                </select>
                <div class="invalid-feedback d-none" id="valid-feedback-5">
                  Please select a valid state.
                </div>
              </div>
            </div>
            <small class="">
              By creating an account you agree to BOOKKEEP
              <a href="#">Terms</a> and <a href="#">Conditions</a>.
            </small>
            <div class="form-row mt-3">
              <div class="col-md-10 text-center">
                <button class="btn btn-success btn-lg btn-wide" type="submit" name="submit">
                  CREATE ACCOUNT
                </button>
              </div>
            </div>
            <p class="login--notify mt-2 text-center">
              Already have an account? <a href="login.php">Login</a>
            </p>
          </form>
        </div>
      </div>
    </div>

    <script src="js/registration.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
