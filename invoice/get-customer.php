<?php

include('../inc/session.php');
include('../inc/config.php');


$user = $_SESSION["user"];

$sql1 = $conn->query("SELECT id, businessName, email FROM users WHERE email='$user'");

$user_id = "";
if ($sql1->num_rows > 0) {
                
    $data = $sql1->fetch_array();

    $name = $data['businessName'];
    $email = $data['email'];
    $user_id = $data['id'];

}else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
 }


$sql = "SELECT * FROM customers WHERE users_id='$user_id'";

$result = $conn->query($sql);
if($result) {
    $query = $result->fetch_all(MYSQLI_ASSOC);
   //  echo $user['users_id'];
   //  echo $user['vendor'];
   //  echo $user['amount'];
   //  echo $user['descript'];
    echo json_encode($query);
}else {
   echo "Error: " . $result . "<br>" . $conn->error;
}


?>