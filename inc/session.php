<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include('config.php');
session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql = $conn->query("SELECT email FROM users WHERE email='$user_check'");

//$result = $conn->query($ses_sql);

$row = mysqli_fetch_row($ses_sql);



$login_session = $row;


if(!isset($login_session)){
$conn->close();; // Closing Connection
header('Location: ../login/login.php'); // Redirecting To Home Page
}

?>