<?php
$ambil = $koneksi->query("SELECT * FROM tb_nilai WHERE id_nilai='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM tb_nilai WHERE id_nilai='$_GET[id]'");

echo "<script>alert('Data Terhapus');</script>";
echo "<script>location='index.php?page=nilai';</script>";
?>