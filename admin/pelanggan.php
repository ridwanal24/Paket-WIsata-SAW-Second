<a href="cetakpelanggan.php" class="btn btn-secondary" target="_blank"><i class="fas fa-print"></i>  Export PDF</a><br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
    </div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Telepon</th>
						<th>Email</th>
						<th>Username</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $ambil=$koneksi->query("SELECT * FROM tb_pelanggan"); ?>
					<?php while($pecah = $ambil->fetch_assoc()){ ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama']; ?></td>
						<td><?php echo $pecah['alamat']; ?></td>
						<td><?php echo $pecah['telepon']; ?></td>
						<td><?php echo $pecah['email']; ?></td>
						<td><?php echo $pecah['username']; ?></td>
						<td>
							<a href="index.php?page=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']?>" class="btn-danger btn"><i class="fas fa-trash"></i></a>
							<a href="index.php?page=ubahpelanggan&id=<?php echo $pecah['id_pelanggan']?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
						</td>
					</tr>
						<?php $nomor++; ?>
						<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>