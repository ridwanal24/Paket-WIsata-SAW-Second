<?php
$ambil = $koneksi->query("SELECT * FROM tb_subkriteria WHERE id_subkriteria='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM tb_subkriteria WHERE id_subkriteria='$_GET[id]'");

echo "<script>alert('Data Terhapus');</script>";
echo "<script>location='index.php?page=subkriteria';</script>";
?>