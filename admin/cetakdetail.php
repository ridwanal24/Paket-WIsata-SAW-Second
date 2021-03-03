<?php
include '../koneksi.php';
// Require composer autoload
require_once '../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

	$id_pemesanan = $_GET["id"];

	$ambil= $koneksi->query("SELECT * FROM tb_pemesanan JOIN tb_pelanggan ON tb_pemesanan.id_pelanggan=tb_pelanggan.id_pelanggan JOIN tb_pembayaran ON tb_pemesanan.id_pemesanan=tb_pembayaran.id_pemesanan WHERE tb_pemesanan.id_pemesanan='$_GET[id]'");
	$detail = $ambil->fetch_assoc();

$content = '<!DOCTYPE html>
<html>
<head>
	<title>Detail Pemesanan/title>
</head>
<body>
<style>
  table, th, td {
    font-size: 18px;
    border: 5px solid black;
    border-collapse:collapse;
    padding: 8px;
  }
  </style>

  <img src="../images/logo.png" style="float: left; height: 90px">

  <div style="margin-left: 20px">
    <strong>Detail Pemesanan</strong><br>
    PO. Tami Jaya<br>
    Alamat: JL. RE. Martadinata No. 84 Yogyakarta <br>
    <div style="font-size:12px">
      Telepon: (0274) 618080 / 586742
      Handphone: 0811 250 136
      Email: po.tamijaya@rocketmail.com
    </div>
  </div> 

  <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;">

  <div style="font-size: 12px;">&nbsp; Tanggal CETAK: '.date("d-m-Y").'</div>

  <div align="center" style="font-size: 20px; margin-left: 10px;">&nbsp; Detail Pemesanan</div>';

		$no = 1;
		$content .= '
      			<h4>Pelanggan</h4>
      			<strong> Nama: '. $detail['nama'] .' </strong><br>
        			Alamat: '. $detail['alamat'] .' <br> 
        			Telepon: '. $detail['telepon'] .' <br>
        			Email: '. $detail['email'] .'
      			<h4>Pemesanan</h4>
      			<strong>No. Pemesanan: '. $detail['id_pemesanan'] .' </strong> <br>
      				Tanggal Pesan: '. date('d F Y', strtotime($detail['tanggal_pesan'])) .' <br> 
      				Tanggal Tour: '. date('d F Y', strtotime($detail['tanggal_tour'])) .' <br> 
      				Tanggal Selesai Tour: '. date('d F Y', strtotime($detail['tanggal_selesai_tour'])) .' <br>

      			<h4>Pembayaran</h4>
      			<strong>Total Pembayaran: Rp. '. number_format($detail['total_pemesanan']) .' </strong><br>
      				Tanggal Bayar: '. date('d F Y', strtotime($detail['tanggal'])) .' <br> <br>

<table border="1" cellpadding="10" cellspacing="15">
			<tr>
				<th>No.</th>
            	<th>Nama Paket Wisata</th>
            	<th>Harga</th>
            	<th>Jumlah</th>
            	<th>Subtotal</th>
			</tr>';

	$no = 1;
	$ambil=$koneksi->query("SELECT * FROM tb_pemesanan_paket JOIN tb_paketwisata ON tb_pemesanan_paket.id_paketwisata=tb_paketwisata.id_paketwisata 
	WHERE tb_pemesanan_paket.id_pemesanan='$_GET[id]'");
	while($pecah = $ambil->fetch_assoc()){
		$content .= '<tr align="center">
			<td>'. $no++ .'</td>
			<td>'. $pecah["nama_paketwisata"] .'</td>
			<td>Rp.'. number_format($pecah["harga_paket"]) .'</td>
			<td>'. $pecah["jumlah"] .'</td>
			<td>
				Rp. '. number_format($pecah["harga_paket"]*$pecah["jumlah"]) .'
			</td>
		</tr>';
	}

$content .= '</table>

</body>
</html>';

// Write some HTML code:
$mpdf->WriteHTML($content);

// Output a PDF file directly to the browser
$mpdf->Output("cetakpaket.pdf","I");
?>
