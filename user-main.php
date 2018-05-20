<?php
include'template/overall/header.php';
if(!$_SESSION['user_login']){
	header("Location: login.php");
}
?>

<div class="content-title">.:: Data User ::.</div>
<div class="content-body">
	<?php echo $_SESSION['user_login']; ?>
</div>

<?php include'template/overall/footer.php'; ?>
