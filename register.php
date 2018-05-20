<?php include'template/overall/header.php'; ?>

<div class="content-title">.:: Register ::.</div>
<div class="content-body">

	<?php
	if($_POST['register']){
		$date	= date("Y-m-d");
		$nama	= $_POST['nama'];
		$email	= $_POST['email'];
		$user	= $_POST['username'];
		$pass	= $_POST['password'];
		$pass2	= $_POST['password2'];

		if($nama && $user && $pass){
				$cek = mysqli_query($koneksi, "SELECT * FROM tw_user WHERE user_username='$user'");
				if(mysqli_num_rows($cek) == 0){
					if($pass == $pass2){
						if(strlen($pass) >=5){
							$newPass = md5($pass);
							$reg = mysqli_query($koneksi, "INSERT INTO tw_user VALUES(NULL, '$date', '$user', '$newPass', '$nama', '$email', '1')");
							if($reg){
								echo '<script language="javascript">alert("Anda berhasil Register, sekarang Anda bisa Login."); document.location="login.php";</script>';
							}else{
								echo '<div class="error">ERROR: Gagal melakukan register.</div>';
							}
						}else{
							echo '<div class="error">ERROR: Password minimal 5 karakter.</div>';
						}
					}else{
						echo '<div class="error">ERROR: Password harus sama.</div>';
					}
				}else{
					echo '<div class="error">ERROR: Username sudah terdaftar.</div>';
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
            	<td>Username*</td>
                <td>:</td>
                <td><input type="text" name="username" /></td>
            </tr>
            <tr>
            	<td>Password*</td>
                <td>:</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
            	<td>Ulangi Password*</td>
                <td>:</td>
                <td><input type="password" name="password2" /></td>
            </tr>
            <tr>
            	<td></td>
                <td></td>
                <td><input type="submit" name="register" value="Register" /></td>
            </tr>
        </table>
    </form>
</div>

<?php include'template/overall/footer.php'; ?>
