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
	<style>
		.danger{
			color:red;
		}
	</style>
</head>
<body>
	<!-- cek pesan notifikasi -->
	<br/>
	<br/>
		<h1>Sistem Pendukung Keputusan Pemesanan Paket Wisata <br/> PO Tami Jaya </h1>

		<div class="kotak_login">
		  <p class="tulisan_login">Silahkan login</p>

		  <form name="admin_login" method="post" action="login_cek.php" onsubmit="return validasiForm()">
		    <label>Username</label>
			<br><small class="user-alert danger">*Username wajib diisi</small>
		    <input type="text" name="user" class="form_login" name="user" value="<?php echo isset($_GET['user'])?$_GET['user']:''; ?>">

		    <label>Password</label>
			<br><small class="pass-alert danger">*Password wajib diisi</small>
		    <input type="password" name="pass" class="form_login" id="password"> 
		    
		    <input type="checkbox" id="show" onclick="toggle()"> Show Password

			<hr>
			<div class="form-group">
                  </div>
                  <div class="form-group">
                    <label>Masukan Captcha</label>
                   <input type="text" name="captcha" size="10" />&nbsp;<img src="captcha.php" style="margin-top: 1%">
			<br><small class="captcha-alert danger">*Captcha wajib diisi</small>
			<?php if(isset($_GET['captcha_salah'])){ ?>
			<br><small class="captcha-salah-alert danger">*Captcha salah</small>
			<?php } ?>
                  </div>
				  <br>
				  <br>
		    <input type="submit" name="login" value="Login" class="tombol_login">

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

		
	    <script src="vendor/jquery/jquery.js"></script>
	    <!-- Form Validation -->
		<script>
        $('.user-alert').hide();
        $('.pass-alert').hide();
        $('.captcha-alert').hide();
        function validasiForm(){
        // set kondisi awal //
        $('.user-alert').hide();
        $('.pass-alert').hide();
        $('.captcha-alert').hide();
        $('.captcha-salah-alert').hide();
        
        let status = true;
        let username = document.forms['admin_login']['user'].value;
        let password = document.forms['admin_login']['pass'].value;
        let captcha = document.forms['admin_login']['captcha'].value;
        
        if(username == ''){
        $('.user-alert').show();
          status = false;
        }
        if(password == ''){
        $('.pass-alert').show();
          status = false;
        }
        if(captcha == ''){
        $('.captcha-alert').show();
          status = false;
        }
        
        return status;
      }

    </script>
    <!-- --------------- -->

	<?php
		if(isset($_GET['captcha_salah'])){
			echo "<script> $('input[name=captcha]').focus(); </script>";
		}
	?>

</body>
</html>

