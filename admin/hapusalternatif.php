<?php
$ambil = $koneksi->query("SELECT * FROM tb_alternatif WHERE id_alternatif='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM tb_alternatif WHERE id_alternatif='$_GET[id]'");

echo "<script>alert('Data Terhapus');</script>";
echo "<script>location='index.php?page=alternatif';</script>";
?>