<?php

	session_start();
	function redirectHome() {
		header('Location: signup.php');
		exit();
	}

	function redirectLogin() {
		header('Location: login.php');
		exit();
	}


	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		redirectLogin();
	} else {
		$con = new mysqli('localhost', 'rosmohrh_essien', 'Coding3719.', 'rosmohrh_bookkeep');

		$email = $con->real_escape_string($_GET['email']);
		$token = $con->real_escape_string($_GET['token']);

		$sql = $con->query("SELECT id FROM users WHERE email='$email' AND token='$token' AND isEmailConfirmed=0");

		if ($sql->num_rows > 0) {
			$con->query("UPDATE users SET isEmailConfirmed=1, token='' WHERE email='$email'");
			$_SESSION['confirmed'] = 'Your email has been verified! You can log in now!';
			redirectLogin();
		} else {
			redirectHome();
		}
			
	}
?>