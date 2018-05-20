<?php include'template/overall/header.php'; ?>

<div class="content-title">.:: Login ::.</div>
<div class="content-body">
	
    <?php
	if($_POST['login']){
		$user	= $_POST['username'];
		$pass	= $_POST['password'];
		
		if($user && $pass){
			$cek = mysqli_query($koneksi, "SELECT * FROM tw_user WHERE user_username='$user'");
			if(mysqli_num_rows($cek) != 0){
				$data = mysqli_fetch_assoc($cek);
				if($user == $data['user_username'] && md5($pass) == $data['user_password']){
					$_SESSION['user_login'] = $user;
					echo '<script language="javascript">alert("Anda berhasil Login."); document.location="user-main.php";</script>';
				}else{
					echo '<div class="error">ERROR: Login Gagal.</div>';
				}
			}else{
				echo '<div class="error">ERROR: Username tidak terdaftar.</div>';
			}
		}else{
			echo '<div class="error">ERROR: Yang bertanda * tidak boleh kosong.</div>';
		}
	}
	?>
    
	<form action="" method="post">
    	<table align="center">
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
            	<td></td>
                <td></td>
                <td><input type="submit" name="login" value="Login" /></td>
            </tr>
        </table>
    </form>
</div>

<?php include'template/overall/footer.php'; ?>