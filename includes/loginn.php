<?php
session_start();

if ( isset($_POST['submit'])) {

	include 'dbh.php';
	$uid = mysqli_real_escape_string($conn, $_POST ['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST ['pwd']);
	// chec if the fields of login are empty
	if ( empty($uid)|| empty($pwd)) {
		header("Location:../index.php?signin=Empty");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE user_uid='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ( $resultCheck < 1) {
			header("Location:../index.php?signin=Error");
			exit(); 
	}else {
		if ( $row = mysqli_fetch_assoc($result)) {
			// De Encryption the password
			$hashedPwdCheck = password_verify( $pwd, $row['user_pwd']);
			if ( $hashedPwdCheck == false) {
				header("Location:../index.php?signin=Empty");
				exit();
			}elseif ( $hashedPwdCheck == true) {
				// To login 
				$_SESSION['u_id'] = $row['user_id'];
				$_SESSION['u_first'] = $row['user_first'];
				$_SESSION['u_last'] = $row['user_last'];
				$_SESSION['u_email'] = $row['user_email'];
				$_SESSION['u_uid'] = $row['user_uid'];
				header("Location:../index.php?signin=Success");
				exit();
			}
		}
	}
}
}else {
	header("Location: ../index.php?login=error");
	exit();
}