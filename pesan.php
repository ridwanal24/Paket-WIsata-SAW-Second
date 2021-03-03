<?php
session_start();
// mendapatkan id_paketwisata dari url
$id_paketwisata = $_GET['id'];

// jika sudah ada paket itu dikeranjang, maka paket itu jumlahnya di +1
if (isset($_SESSION['keranjang'][$id_paketwisata])) 
{
	$_SESSION['keranjang'][$id_paketwisata]+=1;
}
// selain itu (blm ada di keranjang), maka paket itu dianggap dibeli 1
else 
{
	$_SESSION['keranjang'][$id_paketwisata] = 1;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

//larikan ke halaman keranjang
echo "<script>alert('paket telah masuk ke pemesanan');</script>";
echo "<script>location='pemesanan.php';</script>";

?>