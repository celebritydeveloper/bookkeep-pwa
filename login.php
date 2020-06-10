<?php

include('login-process.php'); // Includes Login Script
//session_start();

if(isset($_SESSION['user'])){
  echo $_SESSION['user'];
header("location: profile.php");
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

                <form id="login-for" method="POST" action="">
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