<?php

//session_start();

include('inc/session.php');
include('inc/config.php');


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
  echo $totalExpense;
  echo $name;
  $arrowUp = "icofont-arrow-up";
  
} else {
    $arrowDown = "icofont-arrow-down";
    echo $arrowDown;
    echo "0 results";
    echo "Error: " . $expense . "<br>" . $conn->error;
}
  
?>