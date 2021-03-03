<?php
$ambil = $koneksi->query("SELECT * FROM tb_kriteria WHERE id_kriteria='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM tb_kriteria WHERE id_kriteria='$_GET[id]'");

echo "<script>alert('Data Terhapus');</script>";
echo "<script>location='index.php?page=kriteria';</script>";
?>