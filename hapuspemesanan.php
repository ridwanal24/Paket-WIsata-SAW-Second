<?php 
session_start();
$id_paketwisata=$_GET["id"];
unset($_SESSION["keranjang"][$id_paketwisata]);

echo "<script>alert('paket dihapus dari keranjang pemesanan');</script>";
echo "<script>location='pemesanan.php';</script>";
?>