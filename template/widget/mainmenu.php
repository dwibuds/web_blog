<div class="widget-title">.:: Main Menu ::.</div>
<div class="widget-body">
	<?php
	if($_SESSION['user_login']){
		echo '<a class="menu" href="index.php">Home</a>';
		echo '<a class="menu" href="guestbook.php">Guestbook</a>';
	}else{
		echo '<a class="menu" href="index.php">Home</a>';
		echo '<a class="menu" href="guestbook.php">Guestbook</a>';
		echo '<a class="menu" href="register.php">Register</a>';
		echo '<a class="menu" href="login.php">Login</a>';
	}
	?>
</div>
