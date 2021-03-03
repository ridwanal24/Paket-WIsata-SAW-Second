<?php
$ambil = $koneksi->query("SELECT * FROM tb_wisata WHERE id_wisata='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotowisata = $pecah['foto_wisata'];
if (file_exists("../foto_wisata/$fotowisata")) 
{
	unlink("../foto_wisata/$fotowisata");
}

$koneksi->query("DELETE FROM tb_wisata WHERE id_wisata='$_GET[id]'");

echo "<script>alert('Data Terhapus');</script>";
echo "<script>location='index.php?page=wisata';</script>";
?>