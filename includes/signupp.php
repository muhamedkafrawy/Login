<?php

if (isset($_POST['submit'])) {
	include_once 'dbh.php';

	$first = mysqli_real_escape_string($conn,$_POST['first']);
	$last = mysqli_real_escape_string($conn,$_POST['last']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$uid = mysqli_real_escape_string($conn,$_POST['uid']);
	$pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

	// To check for empty fields
	if ( empty($first)|| empty($last)|| empty($email)|| empty($uid)|| empty($pwd)) {

		header("Location:../signup.php?signup=empty");
		exit();
	} else {
		// check if input charactrs are valid
		if (! preg_match("/^[a-zA-Z]*$/", $first)|| ! preg_match("/^[a-zA-Z]*$/", $last)) {
			header("Location:../signup.php?signup=invalid");
			exit();
		} else {
			// check email is valid
			if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location:../signup.php?signup=invalidEmail");
				exit();
			}else{
				// to confirm that the mail has entered only one time before
				$sql = "SELECT * FROM users WHERE user_uid= '$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				if ( $resultCheck > 0) {
					header("Location:../signup.php?signup=usernameistaken");
					exit();
				} else {
					// to encrypt the password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					// Insert Data Into DB
					$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)  VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
					$result = mysqli_query($conn, $sql);
					header("Location:../signup.php?signup=Success");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../signup.php");
	exit();
}