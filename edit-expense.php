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
    echo $name;
    echo $user_id;

}

if(isset($_GET['id'])) {

$expense_id = $_GET['id'];


$expense = $conn->query("SELECT * FROM expenses WHERE expense_id='$expense_id'");


if ($expense) {
  // output data of each row
  $row = $expense->fetch_assoc();
  echo  $row["vendor"];
  echo  $row["amount"];
  //echo $totalExpense;
  
  
} else {
    echo "Error: " . $expense . "<br>" . $conn->error;
}

}
  
?>