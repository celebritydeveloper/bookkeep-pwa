<?php

include('config.php');
//session_start();
include('session.php');

$msg = "";

$user = $_SESSION["user"];

$sql = $conn->query("SELECT * FROM users WHERE email='$user'");

if ($sql->num_rows > 0) {
                
    $data = $sql->fetch_array();

    $user_id = $data['id'];
    $name = $data['businessName'];
    $email = $data['email'];

    echo $user_id;

}

echo $name;


  if(isset($_POST['add-customer'])) {

  $firstName = $conn->real_escape_string($_POST['firstName']);
  $lastName = $conn->real_escape_string($_POST['lastName']);
  $email = $conn->real_escape_string($_POST['email']);
  $company = $conn->real_escape_string($_POST['company']);

  if ($firstName == ""  || $lastName == "" || $email == "") {
    $msg = "Please check your inputs!";
  }else {
    $sql = $conn->query("SELECT email FROM customers WHERE email='$email'");
    if ($sql->num_rows > 0) {
      $msg = "Customer already exists in the database!";
    } else {
      $query = "INSERT INTO customers (users_id,firstName,lastName,email,companyName)
        VALUES ('$user_id', '$firstName', '$lastName', '$email', '$company')";

      if ($conn->query($query)) {
        echo "It works";
        $msg = "Customer added successfully to database!";
      }else {
        echo "It does not";
        echo "Error: " . $query . "<br>" . $conn->error;
      }


    $conn->close();
                  
    } 
  }

  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookkeep PWA</title>
    <link rel="stylesheet" href="css/bootstrap-4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css">
</head>
<body class="bg-light">
    <div class="container">
        
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <p class=""><i class="icofont-arrow-left icofont-lg"></i></p>
                <h5 class="text-center mb-4">Add New Customer</h5>

                <?php if ($msg != "") echo $msg . "<br><br>" ?>

                <form id="register-for" method="POST" action="add-customer.php">
                    <div class="form-row">
                        
                        <div class="col-md-6 mb-3">
                            <label for="validationServer02">First Name</label>
                            <input type="text" class="form-control is-valid" name="firstName" id="validationServer02">
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label for="validationServer02">Last Name</label>
                            <input type="text" class="form-control is-valid" name="lastName" id="validationServer02">
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                    </div>

                    <div class="form-row">
                      <div class="col-md-6 mb-3">
                        <label for="validationServer02">Email Address</label>
                        <input type="email" class="form-control is-valid" name="email" id="validationServer02">
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="validationServer02">Company Name (optional)</label>
                        <input type="text" class="form-control is-valid" name="company" id="validationServer02">
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>

                    </div>
                    <div class="form-row mt-2 mb-3">
                        <div class="col text-center">
                            <button class="btn btn-success btn-lg btn-wide" type="submit" name="add-customer">ADD CUSTOMER</button>
                        </div>
                        
                    </div>
                  </form>

            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
</body>
</html>