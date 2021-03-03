<?php  
include '../koneksi.php';
// Require composer autoload
require_once '../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

//echo "<pre>";
//print_r($_GET);
//echo "</pre>";

$tgl_mulai=$_GET["tglm"];
$tgl_selesai=$_GET["tgls"];
$status =$_GET["status"];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM tb_pemesanan pm LEFT JOIN tb_pelanggan pl ON 
			pm.id_pelanggan=pl.id_pelanggan WHERE status_pemesanan='$status' AND tanggal_pesan BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
while ($pecah = $ambil->fetch_assoc()) 
{
	$semuadata[]=$pecah;
}

$isi.= "<img src='../images/logo.png' style='float: left; height: 90px'>";

  $isi.= "<div style='margin-left: 20px'>";
    $isi.= "<div style='font-size:18px'>Laporan Pemesanan ".$status."</div>";
    $isi.= "<div style='font-size:20px'> PO. Tami Jaya</div>";
    $isi.= "<div style='font-size:18px'> Alamat: JL. RE. Martadinata No. 84 Yogyakarta</div>";
    $isi.= "<div style='font-size:14px'>
      Telepon : (0274) 618080 / 586742
      Handphone : 0811 250 136
      Email : po.tamijaya@rocketmail.com";
    $isi.= "</div>";
  $isi.= "</div>";

  $isi.= "<hr style='border: 0.5px solid black; margin: 10px 5px 10px 5px;'>";

  $isi.= "<div style='font-size: 12px; margin-left: 10px;'>&nbsp; Tanggal CETAK: ".date('d-m-Y')."</div>";

$isi.= "<h3>Laporan Pemesanan ".$status."</h3>";
$isi.= "<h3>Mulai ".date("d F Y",strtotime($tgl_mulai))." hingga ".date("d F Y", strtotime($tgl_selesai))."</h3>";
$isi.= "<table class='table table-bordered' border='1'>";
	$isi.= "<thead>";
		$isi.= "<tr>";
			$isi.= "<th>No</th>";
			$isi.= "<th>Pelanggan</th>";
			$isi.= "<th>Tanggal Pesan</th>";
			$isi.= "<th>Tanggal Tour</th>";
			$isi.= "<th>Tanggal Selesai Tour</th>";
			$isi.= "<th>Total</th>";
			$isi.= "<th>Status</th>";
		$isi.= "</tr>";
	$isi.= "</thead>";
	$isi.= "<tbody>";
	$total=0;
	foreach ($semuadata as $key => $value):
	$total+=$value['total_pemesanan'];
	$nomor = $key+1;
		$isi.= "<tr>";
			$isi.= "<td>".$nomor." </td>";
			$isi.= "<td>".$value["nama"]."</td>";
			$isi.= "<td>".date('d F Y', strtotime($value["tanggal_pesan"]))."</td>";
			$isi.= "<td>".date('d F Y', strtotime($value["tanggal_tour"]))."</td>";
			$isi.= "<td>".date('d F Y', strtotime($value["tanggal_selesai_tour"]))."</td>";
			$isi.= "<td>Rp. ".number_format($value["total_pemesanan"])."</td>";
			$isi.= "<td>".$value["status_pemesanan"]."</td>";
		$isi.= "</tr>";
		endforeach;
	$isi.= "</tbody>";
	$isi.= "<tfoot>";
		$isi.= "<tr>";
			$isi.= "<th colspan='5'>Total</th>";
			$isi.= "<th>Rp. ".number_format($total)."</th>";
			$isi.= "<th></th>";
		$isi.= "</tr>";
	$isi.= "</tfoot>";
$isi.= "</table>";

// Write some HTML code:
$mpdf->WriteHTML($isi);

// Output a PDF file directly to the browser
$mpdf->Output("laporan.pdf","I");

?>