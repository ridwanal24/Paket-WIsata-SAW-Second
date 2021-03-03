<?php 

//koneksi ke database
include 'koneksi.php';
$idpem = $_GET["id"];

$tanggal = date("Y-m-d");

//simpan pembayaran
$koneksi->query("INSERT INTO tb_pembatalan(id_pemesanan,tanggal_pembatalan,keterangan) 
        VALUES ('$idpem','$tanggal','$Keterangan') ");

//update data pemesanan dari sudah kirim pembayaran menjadi pesanan dibatalkan
$koneksi->query("UPDATE tb_pemesanan SET status_pemesanan='pesanan dibatalkan' WHERE id_pemesanan='$idpem'");


echo "<script>alert('pesanan berhasil dibatalkan');</script>";
echo "<script>location='riwayat.php';</script>";
?>