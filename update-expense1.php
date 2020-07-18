<?php

//session_start();

include('inc/session.php');
include('inc/config.php');


$user = $_SESSION["user"];

$sql = $conn->query("SELECT id FROM users WHERE email='$user'");

if ($sql->num_rows > 0) {
    $data = $sql->fetch_array();
    $user_id = $data['id'];
    echo $user_id;
}

if(isset($_GET['?id'])) {

$expense_id = $_GET['?id'];

echo $expense_id;

$user2 = json_decode($expense_id);
echo $user2;
}else {
    echo "Null";

    $conn->close();
}


// if(isset($_POST['update-expense'])) {
//     echo "Hi";
//     $sql1 = $conn->query("UPDATE expenses SET vendor='$vendor', amount='$amount', expenseDate='$date', descript='$desc' WHERE expense_id='$expense_id'");

// if ($sql1) {
//     echo "Record updated successfully";
// } else {
//     echo "Error updating record: ". $sql . $conn->error;
// }
// }



// $expense = $conn->query("SELECT * FROM expenses WHERE expense_id='$expense_id'");


// if ($expense) {
//   // output data of each row
//   $row = $expense->fetch_assoc();
//   $vendor = $row["vendor"];
//   $amount = $row["amount"];
//   $date = $row["expenseDate"];
//   $desc = $row["descript"];
// } else {
//     echo "Error: " . $expense . "<br>" . $conn->error;
// }




?>