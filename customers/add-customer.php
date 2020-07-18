<?php

include('../inc/config.php');
//session_start();
include('../inc//session.php');

$msg = "";

$user = $_SESSION["user"];

$sql = $conn->query("SELECT * FROM users WHERE email='$user'");

if ($sql->num_rows > 0) {
                
    $data = $sql->fetch_array();

    $user_id = $data['id'];
    $name = $data['businessName'];
    $email = $data['email'];
}



  if(isset($_POST['email'])) {

  $firstName = $conn->real_escape_string($_POST['fname']);
  $lastName = $conn->real_escape_string($_POST['lname']);
  $email = $conn->real_escape_string($_POST['email']);
  $company = $conn->real_escape_string($_POST['company']);

  if ($firstName == ""  || $lastName == "" || $email == "") {
    echo "Please check your inputs!";
  }else {
    $sql = $conn->query("SELECT email FROM customers WHERE email='$email'");
    if ($sql->num_rows > 0) {
      echo  "Customer already exists in the database!";
    } else {
      $query = "INSERT INTO customers (users_id,firstName,lastName,email,companyName)
        VALUES ('$user_id', '$firstName', '$lastName', '$email', '$company')";

      if ($conn->query($query)) {
        echo "Customer Added to database!";
      }else {
        echo "It does not";
        echo "Error: " . $query . "<br>" . $conn->error;
      }


    $conn->close();
                  
    } 
  }

  }



?>