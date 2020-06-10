<?php

//session_start();

//include('session.php');
include('config.php');


// $user = $_SESSION["user"];
// echo $user;

$sql = $conn->query("SELECT * FROM users");

$row1 = $sql->fetch_all();

echo json_encode($row1);


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

    
} else {
    echo "0 results";
    echo "Error: " . $expense . "<br>" . $conn->error;
}
  
?>