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

}
  if(isset($_POST['add-expense'])) {

  $vendor = $conn->real_escape_string($_POST['vendor']);
  $amount = $conn->real_escape_string($_POST['amount']);
  $date = $conn->real_escape_string($_POST['date']);
  $desc = $conn->real_escape_string($_POST['description']);

  if ($vendor == ""  || $amount == "") {
    $msg = "Please check your inputs!";
  }else {

      $query = "INSERT INTO expenses (users_id,vendor,amount,expenseDate,descript)
        VALUES ('$user_id', '$vendor', '$amount', '$date', '$desc')";

      if ($conn->query($query)) {
        $msg = "Expense Added to database!";
      }else {
        echo "It does not";
        echo "Error: " . $query . "<br>" . $conn->error;
        $msg = "Not working";
      }


    $conn->close();
                  
    //} 
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
            <div class="col">
                <p class=""><a href="profile.php"><i class="icofont-arrow-left icofont-lg"></i></a></p>
                <h5 class="text-center mb-4">Add New Expense</h5>
                <?php if ($msg != "") echo $msg . "<br><br>" ?>

                <form id="register-for" method="POST" action="add-expense.php">
                    <div class="form-row">
                        <!--<div class="col-md-3 mb-3">
                            <label for="validationServer04">Category</label>
                            <select class="custom-select is-invalid" id="validationServer04" required>
                              <option selected disabled value="">Choose a state...</option>
                              <option>...</option>
                            </select>
                            <div class="invalid-feedback">
                              Please select a valid state.
                            </div>
                          </div>-->
                      <div class="col-md-4 mb-3">
                        <label for="validationServer01">Amount</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text  bg-primary">NGN </div>
                            </div>
                            <input type="number" class="form-control" id="inlineFormInputGroup" name="amount" placeholder="Username">
                          </div>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationServer02">Vendor Name</label>
                        <input type="text" class="form-control is-valid" id="validationServer02" name="vendor">
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="validationServer03">Date</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text  bg-primary"><i class="icofont-calendar"></i> </div>
                            </div>
                            <input type="date" class="form-control" id="inlineFormInputGroup" name="date" placeholder="Username">
                          </div>
                        <div class="invalid-feedback">
                          Please provide a valid city.
                        </div>
                      </div>
                      
                    </div>
                    <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationServer03">Description (optional)</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                        <div class="invalid-feedback">
                            Password must match
                        </div>
                    </div>
                      
                    </div>
                    <div class="form-row mt-3 mb-3">
                        <div class="col text-center">
                            <button class="btn btn-success btn-lg btn-wide" type="submit" name="add-expense">ADD EXPENSE</button>
                        </div>
                        
                    </div>
                  </form>

            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
</body>
</html>