<?php

	session_start();
	// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	//koneksi ke database
  	include ('../koneksi.php');

?>
<!DOCTYPE html>
<html>
<head>
	<!-- favicon -->
  	<link rel="shortcut icon" href="../images/logo.png" />
	<title>Login - PO Tami Jaya</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<!-- cek pesan notifikasi -->
	<br/>
	<br/>
	<form method="post" name="stmt">
		<h1>Sistem Pendukung Keputusan Pemesanan Paket Wisata <br/> PO Tami Jaya </h1>

		<div class="kotak_login">
		  <p class="tulisan_login">Silahkan login</p>

		  <form method="post" action="periksa_captcha.php">
		    <label>Username</label>
		    <input type="text" name="user" class="form_login" name="user" required>

		    <label>Password</label>
		    <input type="password" name="pass" class="form_login" id="password"> 
		    
		    <input type="checkbox" id="show" onclick="toggle()"> Show Password

			<hr>
			<div class="form-group">
                  </div>
                  <div class="form-group">
                    <label>Masukan Captcha</label>
                   <input type="text" name="captcha" size="10" required="required" />&nbsp;<img src="captcha.php" style="margin-top: 1%">
                  </div>
		    <input type="submit" name="login" value="Login" class="tombol_login" required>

		    <br/>
		    <br/>
		  </form>
		</div>

		<script>
			var state = false;
			function toggle() {
				if (state) {
					document.getElementById("password"). setAttribute("type", "password");
					document.getElementById("show").style.color='#7a797e';
					state = false;
				}
				else{
					document.getElementById("password"). setAttribute("type", "text");
					document.getElementById("show").style.color='#5887ef';
					state = true;
				}
			}
		</script>

		<?php
		  if (isset($_POST['login'])) 
		  {
		  	$captcha = $_POST['captcha'];

		  	$ambil = $koneksi->query("SELECT * FROM tb_user WHERE username='$_POST[user]' AND password = '$_POST[pass]'");
		  	$yangcocok = $ambil->num_rows;
		  	if ($yangcocok==1) 
		  	{
		  		$_SESSION['admin']=$ambil->fetch_assoc();
		  		echo "<script>alert('Login Sukses');</script>";
				echo "<meta http-equiv='refresh' content='1;url=index.php'>";
		  	}
		  	else
		  	{
		  		echo "<script>alert('Login Gagal');</script>";
				echo "<meta http-equiv='refresh' content='1;url=login.php'>";
		  	}
		  }
		  ?>	

	</form>
</body>
</html>

