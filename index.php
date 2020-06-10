<?php

//session_start();

include('session.php');

// $con = new mysqli('localhost', 'rosmohrh_essien', 'Coding3719.', 'rosmohrh_bookkeep');

echo $_SESSION["user"];

// $sql = $con->query("SELECT * FROM users WHERE id='$user'");

// if ($sql->num_rows > 0) {
                
//     $data = $sql->fetch_array();

//     $name = $data['businessName'];
//     $email = $data['email'];

// }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookkeep PWA</title>
    <link rel="stylesheet" href="css/bootstrap-4.4.1/dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <a class="navbar-brand" href="#"><i class="icofont-notification"></i></a>
                
                  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                      <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="add-customer.php?id=<?php echo $user; ?>">Link</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                      </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                  </div>
                </nav>
                

            </div>
        </div>
    </div>

    <section class="container mt-5">
      <h5>Hello,  Welcome : <i><?php echo $_SESSION["user"]; ?></h5>
      <div>
        <p>Here is how is doing this week - May 3 - May 9th, 2020</p>
      </div>
    </section>

    <section class="container" style="width: 590px; overflow: hidden; overflow-x: scroll; border: 1px solid red;">
      <div class="row" >
        <div class="col">
          <div class="card">
            <div class="card-body">
              <span><i class="icofont-coins"></i></span>
              <h5 class="card-title">INCOME</h5>
              <p class="card-text">150,000 <span>NGN</span></p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <span><i class="icofont-coins"></i></span>
              <h5 class="card-title">INCOME</h5>
              <p class="card-text">150,000 <span>NGN</span></p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="toast" role="alert" data-delay="1500" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="..." class="rounded mr-2" alt="...">
    <strong class="mr-auto">Bootstrap</strong>
    <small class="text-muted">11 mins ago</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    <?php echo "Welcome ".$name; ?>
  </div>
</div>

<form >
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <button type="button" onclick="payWithPaystack()"> Pay </button> 
</form>


    
    <script src="css/bootstrap-4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
    $(".toast").toast('show');
});
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
