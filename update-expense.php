<?php

//session_start();

include('inc/session.php');
include('inc/config.php');


$user = $_SESSION["user"];

$sql = $conn->query("SELECT id FROM users WHERE email='$user'");

if ($sql->num_rows > 0) {
                
    $data = $sql->fetch_array();
    $user_id = $data['id'];
}

if(isset($_GET['id'])) {

$expense_id = $_GET['id'];

echo $expense_id;


if(isset($_POST['update-expense'])) {
    echo "Hi";
    $sql1 = $conn->query("UPDATE expenses SET vendor='$vendor', amount='$amount', expenseDate='$date', descript='$desc' WHERE expense_id='$expense_id'");

if ($sql1) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: ". $sql . $conn->error;
}
}



$expense = $conn->query("SELECT * FROM expenses WHERE expense_id='$expense_id'");


if ($expense) {
  // output data of each row
  $row = $expense->fetch_assoc();
  $vendor = $row["vendor"];
  $amount = $row["amount"];
  $date = $row["expenseDate"];
  $desc = $row["descript"];
} else {
    echo "Error: " . $expense . "<br>" . $conn->error;
}


$conn->close();
  
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
                <p class=""><i class="icofont-arrow-left icofont-lg"></i></p>
                <h5 class="text-center mb-4">Add New Expense</h5>
                <div class="alert" id="response"></div>
                <form id="expense-for" method="POST" action="update-expense.php">
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
                            <input type="text" class="form-control" id="amount" value="<?php echo $amount; ?>">
                          </div>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationServer02">Vendor Name</label>
                        <input type="text" class="form-control is-valid" id="vendor" value="<?php echo $vendor; ?>">
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
                            <input type="date" class="form-control" id="date" value="<?php echo $date; ?>">
                          </div>
                        <div class="invalid-feedback">
                          Please provide a valid city.
                        </div>
                      </div>
                      
                    </div>
                    <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationServer03">Description (optional)</label>
                        <textarea class="form-control" id="description" rows="3" value="<?php echo $desc; ?>"></textarea>
                        <div class="invalid-feedback">
                            Password must match
                        </div>
                    </div>
                      
                    </div>
                    <div class="form-row mt-3 mb-3">
                        <div class="col text-center">
                            <button class="btn btn-success btn-lg btn-wide" type="submit" name="update-expense">UPDATE EXPENSE</button>
                        </div>
                        
                    </div>
                  </form>
                    
            </div>
        </div>
    </div>
    <?php }else {
        echo "Error: " . $conn->error;
    } 
    
    
    ?>

    <script src="js/app.js"></script>
    <!--<script>

      const form = document.getElementById("expense-form");
      let ven = document.getElementById("vendor");
      let amount = document.getElementById("amount");
      let date = document.getElementById("date");
      let description = document.getElementById("description");
      let response = document.getElementById("response");

      name = JSON.stringify(ven);

      form.addEventListener('submit', addExpense);

      function addExpense(e) {
        e.preventDefault();

        // let param = "name="+ven;
        // const formData = new FormData();

        // formData.append("name", ven);

        let ajax = new XMLHttpRequest();
        
        ajax.open("POST", "./expenses/add-expense.php", true);
        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        ajax.onload = function() {
          console.log(this.responseText);
          response.classList.add("alert-success")
          response.textContent = this.responseText;
          
        }

        ajax.send(`vendor=${ven.value}&amount=${amount.value}&date=${date.value}&description=${description.value}`);
        if(addExpense) {
          form.reset();
        }
        
      }

    </script>-->
</body>
</html>