<?php 

include('config.php');

$query = "SELECT * FROM expenses";

$sresult = $conn->query($query);

if($sresult) {
     $user = $sresult->fetch_all(MYSQLI_ASSOC);
    //  echo $user['users_id'];
    //  echo $user['vendor'];
    //  echo $user['amount'];
    //  echo $user['descript'];
     echo json_encode($user);
}else {
    echo "Error: " . $query . "<br>" . $conn->error;
}


?>