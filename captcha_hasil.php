php

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cek Hasil CAPTCHA</title>
</head>
	<body>
	  <h2 align="center">Berikut detail Login anda:</h2>
	 <p align="center">

	<?php
	$nama = $_POST["username"];
	$pwd = $_POST["password"]; 
	    //memanggil lagi session untuk dimulai 
	    session_start();
	    //mengecek apakah user menginput captcha dengan benar
	    //jika captcha salah, maka akan menjalankan yang pertama
	    if ($_SESSION["code"] != $_POST["kodecaptcha"]) {
		    echo "Username anda adalah <b>$nama</b>"; echo "<br />";
		    echo "Password anda adalah <b>$pwd</b>"; echo "<br />"; echo "<br/>";
		    echo "Kode CAPTCHA anda salah";
		} else { // jika captcha benar, maka perintah yang bawah akan dijalankan
			echo "Username anda <b>$nama</b>"; echo "<br/>";
			echo "Password anda <b>$pwd</b>"; echo "<br/>"; echo "<br/>";
			echo "Kode CAPTCHA anda benar";
		}
	?>
	  </p>
	</body>
</html>