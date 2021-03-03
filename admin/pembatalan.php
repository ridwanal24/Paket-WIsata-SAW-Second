<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pembatalan</h6>
    </div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Paket</th>
						<th>Tanggal Pesan</th>
						<th>Tanggal Tour</th>
						<th>Keterangan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $ambil=$koneksi->query("SELECT * FROM tb_pembatalan JOIN tb_pemesanan ON tb_pembatalan.id_pemesanan=tb_pemesanan.id_pemesanan JOIN tb_paketwisata ON tb_pemesanan.id_paketwisata=tb_paketwisata.id_paketwisata"); ?>
					<?php while($pecah = $ambil->fetch_assoc()){ ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_paketwisata']; ?></td>
						<td><?php echo date('d F Y', strtotime($pecah['tanggal_pesan'])) ?></td>
						<td><?php echo date('d F Y', strtotime($pecah['tanggal_tour'])) ?></td>
						<td><?php echo $pecah['keterangan'] ?></td>
						<td>
							<a href="index.php?page=detail&id=<?php echo $pecah['id_pemesanan']; ?>" class="btn btn-info">detail</a>

							<?php if ($pecah['status_pemesanan']!=="pending"): ?>
								<a href="index.php?page=pembayaran&id=<?php echo $pecah['id_pemesanan']; ?>" class="btn btn-success">Lihat Pembayaran</a>
							<?php endif ?>
						</td>
					</tr>
						<?php $nomor++; ?>
						<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>