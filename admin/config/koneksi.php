<?php
	$host	= "localhost";
	$user	= "root";
	$pass	= "";
	$db		= "paket_wisata";
	
	// $kon = mysql_connect($host, $user, $pass);
	// $kondb = mysql_select_db($db, $kon);
	$mysqli = new mysqli( $host, $user, $pass, $db)
	
	//test koneksi
	
	/*if($kon){
		echo "Terkoneksi dengan MySQL";
		if($kondb){
			echo "DataBase $db yang dipilih";
		}else{
			echo "DataBase tidak ada";
		}
	}else{
		echo "Koneksi GAGAL";
	}
	*/
?>