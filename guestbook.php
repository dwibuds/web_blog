<?php include'template/overall/header.php'; ?>

<div class="content-title">.:: Komentar ::.</div>
<div class="content-body">

    <?php
	if($_POST['submit']){
		$date	= date("Y-m-d");
		$nama	= mysqli_real_escape_string($_POST['nama']);
		$email	= mysqli_real_escape_string($_POST['email']);
		$web	= mysqli_real_escape_string($_POST['web']);
		$pesan	= mysqli_real_escape_string($_POST['komentar']);

		if($nama && $email && $pesan){
			if(eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $email)){
				$in = mysqli_query($koneksi, "INSERT INTO tw_guestbook VALUES(NULL, '$date', '$nama', '$email', '$web', '$pesan')");
				if($in){
					echo '<script language="javascript">alert("Pesan/Komentar Anda berhasil disimpan."); document.location="guestbook.php";</script>';
				}else{
					echo '<div class="error">ERROR: Gagal menyimpan data.</div>';
				}
			}else{
				echo '<div class="error">ERROR: Format Email tidak valid.</div>';
			}
		}else{
			echo '<div class="error">ERROR: Yang bertanda * tidak boleh kosong.</div>';
		}
	}
	?>

	<form action="" method="post">
    	<table align="center">
        	<tr>
            	<td>Nama Lengkap*</td>
                <td>:</td>
                <td><input type="text" name="nama" /></td>
            </tr>
            <tr>
            	<td>Email*</td>
                <td>:</td>
                <td><input type="text" name="email" /></td>
            </tr>
            <tr>
            	<td>Website</td>
                <td>:</td>
                <td><input type="text" name="web" /></td>
            </tr>
            <tr>
            	<td>Komentar*</td>
                <td>:</td>
                <td><textarea name="komentar" rows="4" cols="30"></textarea></td>
            </tr>
            <tr>
            	<td></td>
                <td></td>
                <td><input type="submit" name="submit" value="Kirim" /></td>
            </tr>
        </table>
    </form>
</div>

<?php include'template/overall/footer.php'; ?>
