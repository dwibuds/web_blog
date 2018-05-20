<?php
include'template/overall/header.php';

echo '<div class="content-title">.:: Blog &raquo; Single Article ::.</div>';
echo '<div class="content-body">';

$id = abs((int)$_GET['id']);
$sql = mysqli_query($koneksi, "SELECT * FROM tw_blog WHERE blog_id='$id'") or die(mysql_error());
if(mysqli_num_rows($sql) == 0){
	echo 'Blank...!';
}else{
	$data = mysqli_fetch_assoc($sql);
	$cat_id = $data['blog_cat_id'];
	$cat = mysqli_query($koneksi, "SELECT * FROM tw_category WHERE cat_id='$cat_id'");
	$data_cat = mysqli_fetch_assoc($cat);
	
	echo '<div id="blog">';
	//menampilkan data artikel
	echo '<div class="blog-title">'.$data['blog_title'].'</div>';
	echo '<div class="blog-desc">'.$data['blog_body'].'</div>';
	echo '<div class="blog-info">';
	echo $data['blog_user'].' | '.$data['blog_date'].' | '.$data_cat['cat_name'];
	echo '</div>';
	
	//menampilkan data komentar
	echo '<p class="blog-title">Komentar</p>';
	$com = mysqli_query($koneksi, "SELECT * FROM tw_comment WHERE com_blog_id='$id' ORDER BY com_id DESC");
	if(mysqli_num_rows($com) != 0){
		while($dataCom = mysqli_fetch_assoc($com)){
			echo '<p style="border-bottom:1px dashed #CCC; padding-bottom:10px">';
			echo '<b>Nama Lengkap:</b> '.$dataCom['com_name'].'<br />';
			echo '<b>Email:</b> '.$dataCom['com_email'].'<br />';
			echo '<b>Komentar:</b> '.$dataCom['com_body'];
			echo '</p>';
		}
	}else{
		echo '<p>Belum ada data.</p>';
	}
	
	//menampilkan form komentar
	echo '<p class="blog-title">Tulis Komentar</p>';
	
	if($_POST['submit']){
		$idblog	= abs((int)$_GET['id']);
		$date	= date("Y-m-d");
		$nama	= $_POST['nama'];
		$email	= $_POST['email'];
		$pesan	= $_POST['pesan'];
		
		if($nama && $email && $pesan){
			if(eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $email)){
				$in = mysqli_query($koneksi, "INSERT INTO tw_comment VALUES(NULL, '$idblog', '$date', '$nama', '$email', '$pesan')");
				if($in){
					echo '<script language="javascript">alert("Komentar Anda berhasil disimpan."); document.location="single.php?id='.$idblog.'";</script>';
				}else{
					echo '<p class="error">ERROR: Gagal menuliskan komentar Anda.</p>';
				}
			}else{
				echo '<p class="error">ERROR: Format Email tidak valid.</p>';
			}
		}else{
			echo '<p class="error">ERROR: Yang bertanda * tidak boleh kosong.</p>';
		}
	}
	
	echo '<form action="" method="post">';
	echo '<p>Nama Lengkap:*<br /><input type="text" name="nama" size="40" /></p>';
	echo '<p>Email:*<br /><input type="text" name="email" size="40" /></p>';
	echo '<p>Komentar:*<br /><textarea name="pesan" rows="5" cols="40"></textarea></p>';
	echo '<p><input type="submit" name="submit" value="Tulis Komentar" /></p>';
	echo '</form>';
	
	echo '</div>';
}
echo '</div>';

include'template/overall/footer.php';
?>