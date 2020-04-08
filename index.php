<?php
	require 'header.php';
?>

<main>

	<div class="row" style="margin-top: 50px;">
		<div class="col">
			<?php  
				if(isset($_SESSION['username'])) {
					echo '<h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;"><p>You are logged in!!</p></h3>';
				}
				else {
					echo '<h3 class="text-center" style="font-family: Arial, Helvetica, sans-serif;"><p>You are logged out!!</p></h3>';
				}
			?>
		</div>
	</div>
</main>

<?php
	require 'footer.php';
?>