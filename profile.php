<?php

//session_start();

include('session.php');
include('config.php');


$user = $_SESSION["user"];

$sql = $conn->query("SELECT * FROM users WHERE email='$user'");

if ($sql->num_rows > 0) {
                
    $data = $sql->fetch_array();

    $name = $data['businessName'];
    $email = $data['email'];
    $user_id = $data['id'];

}

$expense = $conn->query("SELECT SUM(amount) as total_amount FROM expenses WHERE users_id='$user_id'");


if ($expense->num_rows > 0) {
  // output data of each row
  $row = $expense->fetch_assoc();
  $totalExpense = $row["total_amount"];
  $arrowUp = "icofont-arrow-up";
  
} else {
    $arrowDown = "icofont-arrow-down";
    echo $arrowDown;
    echo "0 results";
    echo "Error: " . $expense . "<br>" . $conn->error;
}
  
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookkeep PWA</title>
    <link rel="stylesheet" href="css/bootstrap-4.4.1/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css">
  </head>
  <body>
    <div class="container-fluid bg-light">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <!--<a class="navbar-brand" href="#"><i class="icofont-notification"></i></a>-->
                
                  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                      <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="add-customer.php">Customer</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="add-expense.html">Expense</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                      </li>
                    </ul>
                  </div>
                </nav>
                

            </div>
        </div>
    </div>

    <section class="container mt-5">
      <h5>Hello,  Welcome : <?php echo $name; ?></h5>
      <div>
        <p>Here is how <?php echo $name; ?> is doing this week - May 3 - May 9th, 2020</p>
      </div>
    </section>

    <section class="container">
      <div class="row" >
        <div class="col-md-4 col-sm-12">
          <div class="card">
            <div class="card-body">
              <span><i class="icofont-coins"></i></span>
              <h5 class="card-title">REVENUE</h5>
              <p class="card-text">150,000 <span>NGN</span></p>
              <a href="#" class="btn btn-primary btn-sm"><i class="icofont-arrow-up icofont-lg"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="card">
            <div class="card-body">
              <span><i class="icofont-credit-card"></i></span>
              <h5 class="card-title">PAYMENTS</h5>
              <p class="card-text">150,000 <span>NGN</span></p>
              <a href="#" class="btn btn-primary btn-sm"><i class="icofont-arrow-up icofont-lg"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="card">
            <div class="card-body">
              <span><i class="icofont-coins"></i></span>
              <h5 class="card-title">EXPENSES</h5>
              <p class="card-text"><?php echo $totalExpense ? $totalExpense : '0'; ?> <span>NGN</span></p>
              <a href="#" class="btn btn-primary btn-sm"><i class="icofont-arrow-up  icofont-lg"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--<form >
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <button type="button" onclick="payWithPaystack()"> Pay </button> 
    </form>-->

    <!-- Button trigger modal 
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>-->
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>



    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
     $('#myModal').on('shown.bs.modal', function (event) {
  $('#myInput').trigger('focus');
  let button = $(event.relatedTarget);
       let recipient = button.data('whatever');

       let modal = $(this);

       modal.find('.modal-title').text('New Message to' + recipient);
       modal.find('.modal-body input').val(recipient);
})
    </script>


<script>
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_live_133617b33f759471b002c34019b757a42b660d14',
      email: 'customer@email.com',
      plan: "PLN_d1zpfsoty0jctgh",
      ref: "",
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
          alert('successfully subscribed. transaction ref is ' + response.reference);
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
</script>
</script>
</body>
</html>
