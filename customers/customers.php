<?php 

include('../inc/config.php');
include('../inc/session.php');

$query = "SELECT * FROM customers";

$result = $conn->query($query);

if($result) {
     $user = $result->fetch_all(MYSQLI_ASSOC);
     echo json_encode($user);
}else {
    echo "Error: " . $query . "<br>" . $conn->error;
}


?>