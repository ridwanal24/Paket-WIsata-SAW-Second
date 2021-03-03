<?php
$id_pemesanan = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM tb_pembayaran 
    LEFT JOIN tb_pemesanan ON tb_pembayaran.id_pemesanan=tb_pemesanan.id_pemesanan 
    WHERE tb_pemesanan.id_pemesanan='$id_pemesanan'");
$pecah = $ambil->fetch_assoc();

//update data pemesanan dari menunggu konfirmasi admin menjadi sudah kirim pembayaran
$koneksi->query("UPDATE tb_pemesanan SET status_pemesanan='sudah kirim pembayaran' WHERE id_pemesanan='$id_pemesanan'");

echo "<script>alert('Konfirmasi Pembayaran Berhasil');</script>";
echo "<script>location='index.php?page=pemesanan';</script>";
?>