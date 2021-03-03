<?php
$ambil = $koneksi->query("SELECT * FROM tb_bus WHERE id_bus='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM tb_bus WHERE id_bus='$_GET[id]'");

echo "<script>alert('Data Terhapus');</script>";
echo "<script>location='index.php?page=bus';</script>";
?>