<?php
	$ambil= $koneksi->query("SELECT * FROM tb_pemesanan JOIN tb_pelanggan ON tb_pemesanan.id_pelanggan=tb_pelanggan.id_pelanggan JOIN tb_pembayaran ON tb_pemesanan.id_pemesanan=tb_pembayaran.id_pemesanan WHERE tb_pemesanan.id_pemesanan='$_GET[id]'");
	$detail = $ambil->fetch_assoc();
?>

<a href="cetakdetail.php?page=detail&id=<?php echo $detail['id_pemesanan']; ?>" class="btn btn-secondary" target="_blank"><i class="fas fa-print"></i>  Export PDF</a><br><br>

<!-- <pre><?php //print_r($detail); ?></pre> -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pemesanan</h6>
    </div>
	<div class="card-body">
		<div class="table-responsive">
			<div class="row">
				<div class="col-md-4">
			        <h5>Pelanggan</h5>
					<strong> Nama: <?php echo $detail['nama']; ?></strong><br>
					<p>
					Alamat: <?php echo $detail['alamat']; ?> <br> 
					Telepon: <?php echo $detail['telepon']; ?> <br>
					Email: <?php echo $detail['email']; ?>
			        </p>
			     </div>

				<div class="col-md-4">
					<h5>Pemesanan</h5>
					<strong>No. Pemesanan: <?php echo $detail['id_pemesanan']; ?> </strong> <br>
					Tanggal Pesan: <?php echo date('d F Y', strtotime($detail['tanggal_pesan'])); ?> <br> 
					Tanggal Tour: <?php echo date('d F Y', strtotime($detail['tanggal_tour'])); ?> <br> 
					Tanggal Selesai Tour: <?php echo date('d F Y', strtotime($detail['tanggal_selesai_tour'])); ?> <br>
			    </div>

			    <div class="col-md-4">
					<h5>Pembayaran</h5>
					<strong>Total Pembayaran: Rp. <?php echo number_format($detail['total_pemesanan']); ?> <br></strong>
					Tanggal Bayar: <?php echo date('d F Y', strtotime($detail['tanggal'])); ?> 
			   	</div> 
			</div>
		</div>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Paket Wisata</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php $ambil=$koneksi->query("SELECT * FROM tb_pemesanan_paket JOIN tb_paketwisata ON tb_pemesanan_paket.id_paketwisata=tb_paketwisata.id_paketwisata 
				WHERE tb_pemesanan_paket.id_pemesanan='$_GET[id]'"); ?>
				<?php while ($pecah=$ambil->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah['nama_paketwisata']; ?> (<?php echo $pecah['lama_paket']; ?>)</td>
					<td>Rp. <?php echo number_format($pecah['harga_paket']); ?></td>
					<td><?php echo $pecah['jumlah']; ?></td>
					<td>
						Rp. <?php echo number_format($pecah['harga_paket']*$pecah['jumlah']); ?>
					</td>
				</tr>
				<?php $nomor++; ?>
				<?php } ?>
			</tbody>
		   </table>
  		</div>
	</div>
</div>