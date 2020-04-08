<?php  
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login form</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<header>
		<nav class="navbar navbar-expand bg-dark">
			<a class="navbar-item" href="index.php">
				<img class="img-fluid img-thumbnail" src="img/logo.png" alt="logo" style="width: 40px;">
			</a>
			<ul class="navbar-item nav">
				<li class="nav-item"><a class="nav-link" href="index.php" style="color: white;">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="index.php" style="color: white;">Portfolio</a></li>
				<li class="nav-item"><a class="nav-link" href="index.php" style="color: white;">About us</a></li>
				<li class="nav-item"><a class="nav-link" href="index.php" style="color: white;">Contact</a></li>
			</ul>

			<div class="navbar-item">
				<?php 
					if(isset($_SESSION['username'])) {
						echo '<form class="form-inline my-2 my-lg-0" action="includes/logout.inc.php" method="post">
								<button class="btn btn-primary" type="submit" name="logout-submit">Log out</button>
								</form>';
					}
					else {
						echo '<form class="form-inline my-2 my-lg-0" action="includes/login.inc.php" method="post">
									<input class="form-control mr-sm-2" type="text" name="mailid" placeholder="Username/Email">
									<input class="form-control mr-sm-2" type="Password" name="pwd" placeholder="Password">
									<button class="btn btn-success" type="submit" name="login-submit">Login</button>
								</form>

								<a href="signup.php" style="color: white;">Sign up</a>';
					}
				?>	
			</div>
		</nav>
		</header>