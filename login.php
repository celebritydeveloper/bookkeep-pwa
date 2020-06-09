<?php
session_start();
	$msg = "";

	if (isset($_POST['submit'])) {
		$con = new mysqli('localhost', 'rosmohrh_essien', 'Coding3719.', 'rosmohrh_bookkeep');

		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);

		if ($email == "" || $password == "")
			$msg = "Please check your inputs!";
		else {
			$sql = $con->query("SELECT id, password, isEmailConfirmed FROM users WHERE email='$email'");
			if ($sql->num_rows > 0) {
                
                $data = $sql->fetch_array();
                $_SESSION["user_id"] = $data['id'];
                if (password_verify($password, $data['password'])) {
                    if ($data['isEmailConfirmed'] == 0) {
                        $msg = "Please verify your email!";
                    } else {
                        $msg = "You have been logged in";
                        header("Location: index.php");
                        $_SESSION["favcolor"] = "Welcome";
                    }
                } else {
                    $msg = "Your Email or Password is Wrong";
                }  
			} else {
				$msg = "User doesn't exisit";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bookkeep PWA</title>
    <link rel="stylesheet" href="css/bootstrap-4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row mt-5">
            <div class="col text-center">
                <img src="images/bfaf-full-color.png" alt="">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h5 class="mb-3">Login</h5>
                <?php if ($msg != "") echo $msg . "<br><br>" ?>

                <form id="login-for" method="POST" action="login.php">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control " id="email" name="email" >
                        <div class="valid-feedback d-none" id="valid-feedback">
                          Looks good!
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control " id="password" name="password">
                        <div class="invalid-feedback d-none" id="valid-feedback-2">
                          Please provide a valid password.
                        </div>
                      </div>
                      
                    </div>
                    <small class="">
                        <a href="#">Forgot Password?
                      </small>
                    <div class="form-row mt-3">
                        <div class="col text-center">
                            <button class="btn btn-success btn-lg btn-wide" type="submit" name="submit">LOGIN</button>
                        </div>
                        
                    </div>
                    <p class="login--notify mt-2 text-center">
                        New to BOOKKEEP? <a href="signup.html">Sign Up</a> 
                      </p>
                  </form>

            </div>
        </div>
    </div>

    

</body>
<script src="js/login.js"></script>
<script src="css/bootstrap-4.4.1/js/src/util.js"></script>
<script src="css/bootstrap-4.4.1/dist/js/bootstrap.min.js"></script>
</html>