<?php
include'template/overall/header.php';

$id = abs((int)$_GET['id']);
$sql = mysqli_query($koneksi,"SELECT * FROM tw_page WHERE page_id='$id'");
$data = mysqli_fetch_assoc($sql);
echo '<div class="content-title">.:: Halaman &raquo; '.$data['page_title'].' ::.</div>';
echo '<div class="content-body">';
if(mysqli_num_rows($sql) == 0){
	echo 'Blank...!';
}else{
	echo $data['page_body'];
}
echo '</div>';

include'template/overall/footer.php';
?>