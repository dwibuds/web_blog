<?php
include'template/overall/header.php';
if(!$_SESSION['user_login']){
	header("Location: login.php");
}
?>

<div class="content-title">.:: Kelola Halaman::.</div>
<div class="content-body">
    <p>
    <table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
    	<tr bgcolor="#CCC">
        	<th width="40">No.</th>
            <th width="100">Tgl. Tulis</th>
            <th>Oleh</th>
            <th>Judul Halaman</th>
            <th>Menu Atas</th>
            <th width="100">Aksi</th>
        </tr>
        <?php
		$sql = mysqli_query($koneksi, "SELECT * FROM tw_page ORDER BY page_id DESC");
		if(mysqli_num_rows($sql) != 0){
			$no = 1;
			while($data = mysqli_fetch_assoc($sql)){
				echo '<tr>';
				echo '<td align="center">'.$no.'</td>';
				echo '<td>'.$data['page_date'].'</td>';
				echo '<td>'.$data['page_user'].'</td>';
				echo '<td>'.$data['page_title'].'</td>';
				echo '<td>'; if($data['page_top'] == 1){ echo 'Ya'; }else{ echo 'Tidak'; } echo '</td>';
				echo '<td align="center">';
					echo '<a href="user-page.php?aksi=edit&id='.$data['page_id'].'">Edit</a> / ';
					echo '<a href="user-page.php?aksi=delete&id='.$data['page_id'].'" onclick="return confirm(\'Anda yakin?\');">Delete</a>';
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
		if($_POST['tambah-page']){
			$date	= date("Y-m-d");
			$user	= $_SESSION['user_login'];
			$atas	= $_POST['atas'];
			$judul	= $_POST['judul'];
			$konten	= $_POST['konten'];

			if($judul && $konten){
				$in = mysqli_query($koneksi, "INSERT INTO tw_page VALUES(NULL, '$user', '$date', '$judul', '$konten', '$atas')");
				if($in){
					echo '<script language="javascript">alert("Halaman berhasil ditambahkan."); document.location="user-page.php";</script>';
				}else{
					echo '<div class="error">ERROR: Gagal menambahkan Halaman.</div>';
				}
			}else{
				echo '<div class="error">ERROR: Masukkan judul dan konten Halaman.</div>';
			}
		}

		echo '<form action="" method="post">';
		echo '<h3>Tambah Artikel</h3>';
    	echo '<p>Judul:<br /><input type="text" name="judul" /></p>';
		echo '<p>Menu Atas:<br />';
		echo '<select name="atas">';
			echo '<option value="1">Ya</option>';
			echo '<option value="0">Tidak</option>';
		echo '</select></p>';
		echo '<p>Konten:<br /><textarea name="konten" rows="8" cols="50"></textarea></p>';
        echo '<input type="submit" name="tambah-page" value="Tambah" />';
    	echo '</form>';
	}

	//edit
	if($_GET['aksi'] == "edit"){
		$id = abs((int)$_GET['id']);
		$get = mysqli_query($koneksi, "SELECT * FROM tw_page WHERE page_id='$id'");
		$dataGet = mysqli_fetch_assoc($get);

		if($_POST['simpan-page']){
			$atas	= $_POST['atas'];
			$judul	= $_POST['judul'];
			$konten	= $_POST['konten'];

			if($judul && $konten){
				$up = mysqli_query($koneksi, "UPDATE tw_page SET page_title='$judul', page_body='$konten', page_top='$atas' WHERE page_id='$id'");
				if($up){
					echo '<script language="javascript">alert("Halaman berhasil disimpan."); document.location="user-page.php?aksi=edit&id='.$id.'";</script>';
				}else{
					echo '<div class="error">ERROR: Gagal menyimpan Halaman.</div>';
				}
			}else{
				echo '<div class="error">ERROR: Masukkan judul dan konten Halaman.</div>';
			}
		}

		echo '<form action="" method="post">';
		echo '<h3>Tambah Artikel</h3>';
    	echo '<p>Judul:<br /><input type="text" name="judul" value="'.$dataGet['page_title'].'" /></p>';
		echo '<p>Menu Atas:<br />';
		echo '<select name="atas">';
			echo '<option value="1"'; if($dataGet['page_top'] == 1){ echo 'selected'; } echo ' >Ya</option>';
			echo '<option value="0"'; if($dataGet['page_top'] == 0){ echo 'selected'; } echo ' >Tidak</option>';
		echo '</select></p>';
		echo '<p>Konten:<br /><textarea name="konten" rows="8" cols="50">'.$dataGet['page_body'].'</textarea></p>';
        echo '<input type="submit" name="simpan-page" value="Simpan" /> <a href="user-page.php">Kembali</a>';
    	echo '</form>';
	}

	//delete
	if($_GET['aksi'] == "delete"){
		$id = abs((int)$_GET['id']);
		$cek = mysqli_query($koneksi, "SELECT * FROM tw_page WHERE page_id='$id'");
		if(mysqli_num_rows($cek) != 0){
			$del = mysqli_query("DELETE FROM tw_page WHERE page_id='$id'");
			if($del){
				echo '<script language="javascript">alert("Data berhasil dihapus."); document.location="user-page.php";</script>';
			}else{
				echo '<script language="javascript">alert("Gagal menghapus data."); document.location="user-page.php";</script>';
			}
		}else{
			echo '<script language="javascript">alert("Data tidak ditemukan."); document.location="user-page.php";</script>';
		}
	}
	?>
</div>

<?php include'template/overall/footer.php'; ?>
