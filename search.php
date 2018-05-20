<?php include'template/overall/header.php'; ?>

<div class="content-title">.:: Hasil Pencarian ::.</div>
<div class="content-body">
	<?php
	$key = $_GET['keyword'];
	$sql = mysqli_query($koneksi, "SELECT * FROM tw_blog WHERE blog_title LIKE '%$key%' ORDER BY blog_id DESC");
	if(mysqli_num_rows($sql) == 0){
		echo 'Hasil pencarian tidak menemukan hasil.';
	}else{
		echo 'Hasil pencarian untu kata kunci <b>'.$key.'</b>:';
		while($data = mysqli_fetch_assoc($sql)){			
			echo '<div id="blog">';
			echo '<div class="blog-title">'.$data['blog_title'].'</div>';
			echo '<div class="blog-desc">'.substr($data['blog_body'],0,350).' [...]</div>';
			echo '<div class="blog-info">';
			echo $data['blog_user'].' | '.$data['blog_date'].' | '.$data_cat['cat_name'];
			echo '<a class="more" href="single.php?id='.$data['blog_id'].'">Readmore &raquo;</a>';
			echo '</div>';
			echo '</div>';
		}
	}
	?>
</div>

<?php include'template/overall/footer.php'; ?>