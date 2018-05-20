<?php
$sql = mysqli_query($koneksi, "SELECT * FROM tw_page WHERE page_top=1 ORDER BY page_id ASC");
if(mysqli_num_rows($sql) != 0){
	echo '<a href="index.php">Home</a>';
	while($data = mysqli_fetch_assoc($sql)){
		echo '<a href="page.php?id='.$data['page_id'].'">'.$data['page_title'].'</a>';
	}
}
?>