<?php

include('../inc/config.php');
//session_start();
include('../inc/session.php');

$msg = "";

$user = $_SESSION["user"];

$sql = $conn->query("SELECT * FROM users WHERE email='$user'");

if ($sql->num_rows > 0) {
                
    $data = $sql->fetch_array();

    $user_id = $data['id'];
    $name = $data['businessName'];
    $email = $data['email'];

}
  if(isset($_POST['vendor'])) {

  $vendor = $conn->real_escape_string($_POST['vendor']);
  $amount = $conn->real_escape_string($_POST['amount']);
  $date = $conn->real_escape_string($_POST['date']);
  $desc = $conn->real_escape_string($_POST['description']);

  if ($vendor == ""  || $amount == "") {
      echo "Please check your inputs!";
      $msg = "Please check your inputs!";
  }else {

      $query = "INSERT INTO expenses (users_id,vendor,amount,expenseDate,descript)
        VALUES ('$user_id', '$vendor', '$amount', '$date', '$desc')";

      if ($conn->query($query)) {
          echo "Expense Added to database!";
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