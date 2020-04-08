<?php
	require 'header.php';
?>
<main>
	<div class="container" style="margin-top: 10px;">
		<div class="row">
			<div class="col-12">
				<h1 class="text-center font-weight-lighter" style="margin-bottom: 15px;">Sign Up</h1>
			</div>
		</div>
	

		<div class="row">
			<div class="col-4">
			</div>
		
			<div class="col-4">
				
					<?php  
						if(isset($_GET["error"])) {
							if($_GET["error"] == "emptyfields") {
								echo '<p style="color: red;">Fill in the blanks!!</p>';
							}
							else if($_GET["error"] == "invalidemail") {
								echo '<p style="color: red;">Invalid E-Mail Address!!</p>';
							}
							else if($_GET["error"] == "invalidusername") {
								echo '<p style="color: red;">Username is not Valid!!</p>';
							}
							else if($_GET["error"] == "passwordcheck") {
								echo '<p style="color: red;">Password do not match!!</p>';
							}
							else if($_GET["error"] == "usertaken") {
								echo '<p style="color: red;">User name already exists!!</p>';
							}
						}
						else if(isset($_GET["signup"]) == "success") {
							echo '<p style="color: green;">Signup Successful!!</p>';
						}	
					?>

				<form class="form-group" action="includes/signup.inc.php" method="post">
					<input class="form-control" type="text" name="username" placeholder="Username"><br>
					<input class="form-control" type="text" name="mail" placeholder="Email"><br>
					<input class="form-control" type="Password" name="pwd" placeholder="Password"><br>
					<input class="form-control" type="Password" name="pwd-repeat" placeholder="Repeat Password"><br>
					<button class="btn btn-primary" type="submit" name="signup-submit">Sign up</button>
				</form>
			</div>

			<div class="col-4">
			</div>
		</div>
	</div>
</main>


<?php
	require 'footer.php';
?>