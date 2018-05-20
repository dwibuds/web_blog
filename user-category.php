<?php
include'template/overall/header.php';
if(!$_SESSION['user_login']){
	header("Location: login.php");
}
?>

<div class="content-title">.:: Kelola Kategori ::.</div>
<div class="content-body">
    <?php
	//tambah
	if(!$_GET['aksi']){
		if($_POST['tambah-kategori']){
			$kat = $_POST['kategori'];
			
			if($kat){
				$in = mysqli_query($koneksi, "INSERT INTO tw_category VALUES(NULL, '$kat')");
				if($in){
					echo '<script language="javascript">alert("Kategori berhasil ditambahkan."); document.location="user-category.php";</script>';
				}else{
					echo '<div class="error">ERROR: Gagal menambahkan kategori.</div>';
				}
			}else{
				echo '<div class="error">ERROR: Masukkan nama kategori.</div>';
			}
		}
		
		echo '<form action="" method="post">';
    	echo 'Tambah Kategori: <input type="text" name="kategori" />&nbsp;';
        echo '<input type="submit" name="tambah-kategori" value="Tambah" />';
    	echo '</form>';
	}
	
	//edit
	if($_GET['aksi'] == "edit"){
		$id = abs((int)$_GET['id']);
		$get = mysqli_query($koneksi, "SELECT * FROM tw_category WHERE cat_id='$id'");
		$dataGet = mysqli_fetch_assoc($get);
		
		if($_POST['simpan-kategori']){
			$kat = $_POST['kategori'];
			
			if($kat){
				$up = mysql_query("UPDATE tw_category SET cat_name='$kat' WHERE cat_id='$id'");
				if($up){
					echo '<script language="javascript">alert("Kategori berhasil disimpan."); document.location="user-category.php?aksi=edit&id='.$id.'";</script>';
				}else{
					echo '<div class="error">ERROR: Gagal menyimpan kategori.</div>';
				}
			}else{
				echo '<div class="error">ERROR: Masukkan nama kategori.</div>';
			}
		}
		
		echo '<form action="" method="post">';
    	echo 'Edit Kategori: <input type="text" name="kategori" value="'.$dataGet['cat_name'].'" />&nbsp;';
        echo '<input type="submit" name="simpan-kategori" value="Simpan" /> <a href="user-category.php">Kembali</a>';
    	echo '</form>';
	}
	
	//delete
	if($_GET['aksi'] == "delete"){
		$id = abs((int)$_GET['id']);
		$cek = mysqli_query($koneksi, "SELECT * FROM tw_category WHERE cat_id='$id'");
		if(mysqli_num_rows($cek) != 0){
			$del = mysqli_query($koneksi, "DELETE FROM tw_category WHERE cat_id='$id'");
			if($del){
				echo '<script language="javascript">alert("Data berhasil dihapus."); document.location="user-category.php";</script>';
			}else{
				echo '<script language="javascript">alert("Gagal menghapus data."); document.location="user-category.php";</script>';
			}
		}else{
			echo '<script language="javascript">alert("Data tidak ditemukan."); document.location="user-category.php";</script>';
		}
	}
	?>
    
    <p>
    <table border="1" cellpadding="5" style="border-collapse:collapse">
    	<tr bgcolor="#CCC">
        	<th width="40">No.</th><th width="200">Nama Kategori</th><th width="100">Aksi</th>
        </tr>
        <?php
		$sql = mysqli_query($koneksi, "SELECT * FROM tw_category ORDER BY cat_id DESC");
		if(mysqli_num_rows($sql) != 0){
			$no = 1;
			while($data = mysqli_fetch_assoc($sql)){
				echo '<tr>';
				echo '<td align="center">'.$no.'</td>';
				echo '<td>'.$data['cat_name'].'</td>';
				echo '<td align="center">';
					echo '<a href="user-category.php?aksi=edit&id='.$data['cat_id'].'">Edit</a> / ';
					echo '<a href="user-category.php?aksi=delete&id='.$data['cat_id'].'" onclick="return confirm(\'Anda yakin?\');">Delete</a>';
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
</div>

<?php include'template/overall/footer.php'; ?>