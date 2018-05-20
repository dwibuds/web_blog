<div class="widget-title">.:: Kategori ::.</div>
<div class="widget-body">
    <?php
	$sql = mysqli_query($koneksi, "SELECT * FROM tw_category ORDER BY cat_name ASC");
	if(mysqli_num_rows($sql) != 0){
		while($data = mysqli_fetch_assoc($sql)){
			echo '<a class="menu" href="category.php?id='.$data['cat_id'].'">'.$data['cat_name'].'</a>';
		}
	}
	?>
</div>