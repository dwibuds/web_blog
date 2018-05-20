<?php
if($_SESSION['user_login']){
	echo '<div class="widget-title" style="background:#000; color:#FFF; border:1px solid #000;">.:: Control Panel ::.</div>';
	echo '<div class="widget-body" style="border:1px solid #000;">';
		echo '<a class="menu" href="user-main.php">Akun Setting</a>';
		echo '<a class="menu" href="user-category.php">Kelola Kategori</a>';
		echo '<a class="menu" href="user-blog.php">Kelola Blog/Artikel</a>';
		echo '<a class="menu" href="user-page.php">Kelola Halaman/Page</a>';
		echo '<a class="menu" href="logout.php">Logout</a>';
	echo '</div>';
}
?>