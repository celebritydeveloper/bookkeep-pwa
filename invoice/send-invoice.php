<?php

include('../inc/config.php');
//session_start();
include('../inc/session.php');
  use PHPMailer\PHPMailer\PHPMailer;
  
  // require '../PHPMailer/Exception.php';
  // require '../PHPMailer/PHPMailer.php';
  // require '../PHPMailer/SMTP.php';
$msg = "";

$user = $_SESSION["user"];

$sql = $conn->query("SELECT * FROM users WHERE email='$user'");

if ($sql->num_rows > 0) {
                
    $data = $sql->fetch_array();

    $user_id = $data['id'];
    $name = $data['businessName'];
    $email = $data['email'];

}
  if(isset($_POST['amount'])) {

  $customer = $conn->real_escape_string($_POST['customer']);
  $amount = $conn->real_escape_string($_POST['amount']);
  $desc = $conn->real_escape_string($_POST['description']);

  if ($customer == ""  || $amount == "") {
      echo "Please check your inputs!";
      $msg = "Please check your inputs!";
  }else {

   
      $query = "INSERT INTO invoice (customer_id,users_id,amount,descript)
        VALUES ('$customer', '$user_id', '$amount', '$desc')";

      if ($conn->query($query)) {
        $sql_query = $conn->query("SELECT firstName, lastName, email FROM customers WHERE customer_id='$customer'");

        if ($sql_query->num_rows > 0) {      
            $result = $sql_query->fetch_array();
            $fname = $result['firstName'];
            $lname = $result['lastName'];
            $cEmail = $result['lastName'];
        }

                $mail = new PHPMailer();

                $mail->setFrom('hello@theboringcreatives.com');
                $mail->addAddress($cEmail, $fname);
                $mail->Subject = "Please verify email!";
                $mail->isHTML(true);
                $mail->Body = "
                    Please click on the link below:<br><br>
                    
                    Hello World;
                ";

            if($mail->send()) {
                echo "Invoice sent to $fname $lname New";
                $msg = "Expense Added to database!";
            }else {
                echo "Not Working";
            }

        echo "Invoice sent to $fname $lname";
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