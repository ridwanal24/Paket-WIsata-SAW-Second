<?php
//mendapatkan id_pemesanan dari url
$id_pemesanan = $_GET['id'];

//mengambil data pembayaran berdasarkan id_pemesanan
$ambil = $koneksi->query("SELECT * FROM tb_pembayaran 
    LEFT JOIN tb_pemesanan ON tb_pembayaran.id_pemesanan=tb_pemesanan.id_pemesanan 
    WHERE tb_pemesanan.id_pemesanan='$id_pemesanan'");
$pecah = $ambil->fetch_assoc();
?>

<a href="cetakpembayaran.php?page=pembayaran&id=<?php echo $pecah['id_pemesanan']; ?>" class="btn btn-secondary" target="_blank"><i class="fas fa-print"></i>  Export PDF</a><br><br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
    </div>
	<div class="card-body">
		<div class="table-responsive">
			<div class="row">
				<div class="col-md-6">
					<table class="table" id="dataTable" width="100%" cellspacing="0">
						<tr>
							<th>Nama</th>
							<td><?php echo $pecah['nama']; ?></td>
						</tr>
						<tr>
							<th>Jumlah</th>
							<td>Rp. <?php echo number_format($pecah['jumlah_bayar']); ?></td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td><?php echo date('d F Y', strtotime($pecah['tanggal'])); ?></td>
						</tr>
						<tr>
							<th></th>
							<td></td>
						</tr>
					</table>
					<?php if ($pecah['status_pemesanan']=="menunggu konfirmasi admin"): ?>
						<a href="index.php?page=konfirmasi_pembayaran&id=<?php echo $pecah['id_pemesanan']?>" class="btn btn-primary" name="konfirmasi_pembayaran">Konfirmasi Pembayaran</a>
					<?php endif ?>
					
				</div>
				<div class="col-md-6">
					<img src="../bukti_pembayaran/<?php echo $pecah['bukti_transfer'] ?>" alt="" width="450" height="500">
				</div>
			</div>
		</div>
	</div>
</div>