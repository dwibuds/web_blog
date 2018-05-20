<?php
include'template/overall/header.php';
if(!$_SESSION['user_login']){
	header("Location: login.php");
}
?>

<div class="content-title">.:: Kelola Blog/Artikel ::.</div>
<div class="content-body">
    <p>
    <table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
    	<tr bgcolor="#CCC">
        	<th width="40">No.</th>
            <th width="100">Tgl. Tulis</th>
            <th>Oleh</th>
            <th>Judul Artikel</th>
            <th width="100">Aksi</th>
        </tr>
        <?php
		$sql = mysqli_query($koneksi, "SELECT * FROM tw_blog ORDER BY blog_id DESC");
		if(mysqli_num_rows($sql) != 0){
			$no = 1;
			while($data = mysqli_fetch_assoc($sql)){
				echo '<tr>';
				echo '<td align="center">'.$no.'</td>';
				echo '<td>'.$data['blog_date'].'</td>';
				echo '<td>'.$data['blog_user'].'</td>';
				echo '<td>'.$data['blog_title'].'</td>';
				echo '<td align="center">';
					echo '<a href="user-blog.php?aksi=edit&id='.$data['blog_id'].'">Edit</a> / ';
					echo '<a href="user-blog.php?aksi=delete&id='.$data['blog_id'].'" onclick="return confirm(\'Anda yakin?\');">Delete</a>';
				echo '</td>';
				echo '</tr>';
				$no++;
			}
		}else{
			echo '<tr><td colspan="3">Tidak ada data.</td></tr>';
		}
		?>
    </table>
    </p>
    
    <?php
	//tambah
	if(!$_GET['aksi']){
		if($_POST['tambah-blog']){
			$date	= date("Y-m-d");
			$user	= $_SESSION['user_login'];
			$kat	= $_POST['kat'];
			$judul	= $_POST['judul'];
			$konten	= $_POST['konten'];
			
			if($judul && $konten){
				$in = mysqli_query($koneksi, "INSERT INTO tw_blog VALUES(NULL, '$user', '$kat', '$date', '$judul', '$konten')");
				if($in){
					echo '<script language="javascript">alert("Artikel berhasil ditambahkan."); document.location="user-blog.php";</script>';
				}else{
					echo '<div class="error">ERROR: Gagal menambahkan artikel.</div>';
				}
			}else{
				echo '<div class="error">ERROR: Masukkan judul dan konten artikel.</div>';
			}
		}
		
		echo '<form action="" method="post">';
		echo '<h3>Tambah Artikel</h3>';
    	echo '<p>Judul:<br /><input type="text" name="judul" /></p>';
		echo '<p>Kategori:<br />';
		echo '<select name="kat">';
			$kategori = mysqli_query($koneksi, "SELECT * FROM tw_category ORDER BY cat_name ASC");
			while($dataKat = mysqli_fetch_assoc($kategori)){
				echo '<option value="'.$dataKat['cat_id'].'">'.$dataKat['cat_name'].'</option>';
			}
		echo '</select></p>';
		echo '<p>Konten Artikel:<br /><textarea name="konten" rows="8" cols="50"></textarea></p>';
        echo '<input type="submit" name="tambah-blog" value="Tambah" />';
    	echo '</form>';
	}
	
	//edit
	if($_GET['aksi'] == "edit"){
		$id = abs((int)$_GET['id']);
		$get = mysqli_query($koneksi, "SELECT * FROM tw_blog WHERE blog_id='$id'");
		$dataGet = mysqli_fetch_assoc($get);
		
		if($_POST['simpan-blog']){
			$kat	= $_POST['kat'];
			$judul	= $_POST['judul'];
			$konten	= $_POST['konten'];
			
			if($judul && $konten){
				$up = mysqli_query($koneksi, "UPDATE tw_blog SET blog_cat_id='$kat', blog_title='$judul', blog_body='$konten' WHERE blog_id='$id'");
				if($up){
					echo '<script language="javascript">alert("Artikel berhasil disimpan."); document.location="user-blog.php?aksi=edit&id='.$id.'";</script>';
				}else{
					echo '<div class="error">ERROR: Gagal menyimpan artikel.</div>';
				}
			}else{
				echo '<div class="error">ERROR: Masukkan judul dan konten artikel.</div>';
			}
		}
		
		echo '<form action="" method="post">';
		echo '<h3>Tambah Artikel</h3>';
    	echo '<p>Judul:<br /><input type="text" name="judul" value="'.$dataGet['blog_title'].'" /></p>';
		echo '<p>Kategori:<br />';
		echo '<select name="kat">';
			$kategori = mysqli_query($koneksi, "SELECT * FROM tw_category ORDER BY cat_name ASC");
			while($dataKat = mysqli_fetch_assoc($kategori)){
				echo '<option value="'.$dataKat['cat_id'].'"';
				if($dataKat['cat_id'] == $dataGet['blog_cat_id']){ echo 'selected'; }
				echo ' >'.$dataKat['cat_name'].'</option>';
			}
		echo '</select></p>';
		echo '<p>Konten Artikel:<br /><textarea name="konten" rows="8" cols="50">'.$dataGet['blog_body'].'</textarea></p>';
        echo '<input type="submit" name="simpan-blog" value="Simpan" />';
    	echo '</form>';
	}
	
	//delete
	if($_GET['aksi'] == "delete"){
		$id = abs((int)$_GET['id']);
		$cek = mysqli_query($koneksi, "SELECT * FROM tw_blog WHERE blog_id='$id'");
		if(mysqli_num_rows($cek) != 0){
			$del = mysqli_query($koneksi, "DELETE FROM tw_blog WHERE blog_id='$id'");
			if($del){
				echo '<script language="javascript">alert("Data berhasil dihapus."); document.location="user-blog.php";</script>';
			}else{
				echo '<script language="javascript">alert("Gagal menghapus data."); document.location="user-blog.php";</script>';
			}
		}else{
			echo '<script language="javascript">alert("Data tidak ditemukan."); document.location="user-blog.php";</script>';
		}
	}
	?>
</div>

<?php include'template/overall/footer.php'; ?>