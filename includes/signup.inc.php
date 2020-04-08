<?php

if(isset($_POST['signup-submit'])){

	require 'dbh.inc.php';

	$username = $_POST['username'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];

	if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
		header("Location: ../signup.php?error=emptyfields&user=".$username."&mail=".$email);
		exit(); //if there is error above this stops the script below from running
	}
	//checking if email and username both are valid
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*&/", $username)){ 
		header("Location: ../signup.php?error=invalidemail");
		exit();
	}

	//checks if the email is valid
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
		header("Location: ../signup.php?error=invalidemail&user=".$username);
		exit();
	}
	
	// checks if the username is valid
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
		header("Location: ../signup.php?error=invalidusername&mail=".$email);
		exit();
	}

	else if($password !== $passwordRepeat){
		header("Location: ../signup.php?error=passwordcheck&user=".$username."&mail=".$email);
		exit();
	}

	else {

		//check if the username already exists in the datebase
		$sql = "SELECT username from users where username=?;";
		$stmt = mysqli_stmt_init($conn);

		//checks if database connection doen't exists
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}

		//if database connection exists checks if username already exists in the database
		else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0){
				header("Location: ../signup.php?error=usertaken&mail=".$email);
				exit();
			}

			else {
				$sql = "INSERT INTO users (username, email, password) VALUES ( ?, ?, ? )";
				$stmt = mysqli_stmt_init($conn);

				//checks if query and statement can work together
				if(!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../signup.php?error=sqlerror");
					exit();
				}
				else {
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
					mysqli_stmt_execute($stmt);
					
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else {
	header("Location: ../signup.php");
	exit();
}