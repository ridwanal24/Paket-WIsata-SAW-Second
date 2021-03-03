<?php
  include '../koneksi.php';

  $tgl_mulai = $_GET["tglm"];
  $tgl_selesai = $_GET["tgls"];

  $ambil = $koneksi->query("SELECT * FROM tb_pemesanan pm LEFT JOIN tb_pelanggan pl ON 
    pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pesan BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");


$content = '<!DOCTYPE html>
<html>
<head>
  <title>Laporan Pemesanan Paket Wisata</title>
</head>
<body>
  <style>
  table, th, td {
    font-size: 12px;
    border: 1px solid black;
    border-collapse:collapse;
    padding: 8px;
  }
  </style>

  <img src="../images/logo.png" style="float: left; height: 90px">

  <div style="margin-left: 20px">
    <div style="font-size:18px"> Laporan Transaksi Pemesanan Paket Dari <b>'.date('d F Y', strtotime($tgl_mulai)).'</b> Hingga <b>'.date('d F Y', strtotime($tgl_selesai)).'</b> </div>
    <div style="font-size:20px"> PO. Tami Jaya</div>
    <div style="font-size:18px"> Alamat: JL. RE. Martadinata No. 84 Yogyakarta</div>
    <div style="font-size:14px">
      Telepon : (0274) 618080 / 586742
      Handphone : 0811 250 136
      Email : po.tamijaya@rocketmail.com
    </div>
  </div> 

  <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;">

  <div style="font-size: 12px; margin-left: 10px;">&nbsp; Tanggal CETAK: '.date("d-m-Y").'</div> 

  <table border="1" cellpadding="10" cellspacing="0" width="100%">
      <tr align="center">
        <th width="5%">No</th>
        <th width="13%">Pelanggan</th>
        <th width="20%">Tanggal Pesan</th>
        <th width="20%">Tanggal Tour</th>
        <th width="20%">Tanggal Selesai Tour</th>
        <th width="20%">Total</th>
        <th width="15%">Status</th>
      </tr>';
  
  $total=0;
  $no = 1;
  while($pecah = $ambil->fetch_assoc()){
    $total+=$pecah["total_pemesanan"];
    $content .= '<tr align="center">
      <td>'. $no++ .'</td>
      <td>'. $pecah["nama"] .'</td>
      <td>'. date('d F Y', strtotime($pecah["tanggal_pesan"])) .'</td>
      <td>'. date('d F Y', strtotime($pecah["tanggal_tour"])) .'</td>
      <td>'. date('d F Y', strtotime($pecah["tanggal_selesai_tour"])) .'</td>
      <td>Rp. '. number_format($pecah["total_pemesanan"]) .'</td>
      <td>'. $pecah["status_pemesanan"] .'</td>
    </tr>';
  }
    $content .= '<tr align="center">
      <th colspan="5">Total</th>
      <th>Rp. '. number_format($total) .'</th>
      <th></th>
    </tr>';

$content .= '</table>
</body>
</html>';

  require_once('../html2pdf/html2pdf.class.php');
  $html2pdf = new HTML2PDF('P','A4','en');
  $html2pdf->WriteHTML($content);
  $html2pdf->Output('laporan.pdf');
?>
