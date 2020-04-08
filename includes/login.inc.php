<?php

if(isset($_POST['login-submit'])) {

	require 'dbh.inc.php';

	$userid = $_POST['mailid'];
	$password = $_POST['pwd'];

	if(empty($userid) || empty($password)) {
		header("Location: ../index.php?error=emptyfields");
	exit();
	}
	else {
		$sql = "SELECT * FROM users WHERE username=? OR email=?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../index.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "ss", $userid, $userid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($password, $row['password']);
				if($pwdCheck == false) {
					header("Location: ../index.php?error=Wrongpassword");
					exit();
				}
				else if ($pwdCheck == true) {
					session_start();
					$_SESSION['userId'] = $row['user_id'];
					$_SESSION['username'] = $row['username'];

					header("Location: ../index.php?login=success");
					exit();

				}
				else {
					header("Location: ../index.php?error=Wrongpassword");
					exit();
				}
			}
			else{
				header("Location: ../index.php?error=NoUser");
				exit();
			}
		}
	}

}
else {
	header("Location: ../index.php");
	exit();
}