<?php 

	$semuadata=array();
	$tgl_mulai="-";
	$tgl_selesai="-";
	$status ="";

	if (isset($_POST["kirim"])) 
	{
		$tgl_mulai = $_POST["tglm"];
		$tgl_selesai = $_POST["tgls"];
		$status = $_POST["status"];
		$ambil = $koneksi->query("SELECT * FROM tb_pemesanan pm LEFT JOIN tb_pelanggan pl ON 
			pm.id_pelanggan=pl.id_pelanggan WHERE status_pemesanan='$status' AND tanggal_pesan BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
		while ($pecah = $ambil->fetch_assoc()) 
		{
			$semuadata[]=$pecah;
		}
	}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Pemesanan dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></h6>
    </div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="post" action="">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Tanggal Mulai</label>
							<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Tanggal Selesai</label>
							<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="status">
								<option value="">Pilih Status</option>
								<option value="Pending" <?php echo $status=="Pending"?"selected":""; ?> >Pending</option>
								<option value="Menunggu Konfirmasi Admin" <?php echo $status=="Menunggu Konfirmasi Pembayaran"?"selected":""; ?> >Menunggu Konfirmasi Admin</option>
								<option value="Sudah Kirim Pembayaran" <?php echo $status=="Sudah Kirim Pembayaran"?"selected":""; ?> >Sudah Kirim Pembayaran</option>
								<option value="Pesanan Dibatalkan" <?php echo $status=="Pesanan Dibatalkan"?"selected":""; ?> >Pesanan Dibatalkan</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label>&nbsp;</label><br>
						<button class="btn btn-primary" name="kirim">Lihat</button>
					</div>
				</div>
			</form>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Pelanggan</th>
						<th>Tanggal Pesan</th>
						<th>Tanggal Tour</th>
						<th>Tanggal Selesai Tour</th>
						<th>Total</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $total=0; ?>
					<?php foreach ($semuadata as $key => $value): ?>
					<?php $total+=$value['total_pemesanan'] ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value["nama"]; ?></td>
						<td><?php echo date('d F Y', strtotime($value["tanggal_pesan"])); ?></td>
						<td><?php echo date('d F Y', strtotime($value["tanggal_tour"])); ?></td>
						<td><?php echo date('d F Y', strtotime($value["tanggal_selesai_tour"])); ?></td>
						<td>Rp. <?php echo number_format($value["total_pemesanan"]); ?></td>
						<td><?php echo $value["status_pemesanan"]; ?></td>
					</tr>
						<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">Total</th>
						<th>Rp. <?php echo number_format($total) ?></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
			<a href="download_laporan.php?tglm=<?php echo $tgl_mulai; ?>&tgls=<?php echo $tgl_selesai; ?>&status=<?php echo $status ?>" target="_blank">Download PDF</a>
		</div>
	</div>
</div>

