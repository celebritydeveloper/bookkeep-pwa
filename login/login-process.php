<?php
	session_start(); // Starting Session
	include('../inc/config.php');
	$msg = "";

	if (isset($_POST['submit'])) {
		$email = $conn->real_escape_string($_POST['email']);
		$password = $conn->real_escape_string($_POST['password']);

		if ($email == "" || $password == "")
			$msg = "Please check your inputs!";
		else {
			$sql = $conn->query("SELECT id, passcode, isEmailConfirmed FROM users WHERE email='$email'");
			if ($sql->num_rows > 0) {
                
                $data = $sql->fetch_array();
                
                if (password_verify($password, $data['passcode'])) {
                    if ($data['isEmailConfirmed'] == 0) {
                        $msg = "Please verify your email!";
                    } else {
                        $msg = "You have been logged in";
                        $_SESSION['user'] = $email; // Initializing Session
                        //header("Location: profile.php");
                    }
                } else {
                    $msg = "Your Email or Password is Wrong";
                }  
			} else {
				$msg = "User doesn't exisit";
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		$conn->close();
	}

?>