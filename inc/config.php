<?php
$servername = "localhost";
$username = "rosmohrh_essien";
$password = "Coding3719.";
$database = "rosmohrh_bookkeep";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>