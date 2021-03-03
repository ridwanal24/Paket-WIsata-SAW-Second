<a href="index.php?page=tambahpaket" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Paket Wisata</a>
<a href="cetakpaket.php" target="_blank" class="btn btn-secondary" name=""><i class="fas fa-print"></i>  Export PDF</a><br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Paket Wisata</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Paket</th>
            <th>Waktu</th>
            <th>Fasilitas</th>
            <th>Nama Bus</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM tb_paketwisata LEFT JOIN tb_bus ON tb_paketwisata.id_bus=tb_bus.id_bus");?>
          <?php while($pecah = $ambil->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_paketwisata']; ?></td>
            <td><?php echo $pecah['lama_paket']; ?></td>
            <td><?php echo $pecah['fasilitas']; ?></td>
            <td><?php echo $pecah['nama']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga_paket']); ?></td>
            <td>
              <a href="index.php?page=hapuspaket&id=<?php echo $pecah['id_paketwisata']?>" class="btn-danger btn"><i class="fas fa-trash"></i></a>
              <a href="index.php?page=ubahpaket&id=<?php echo $pecah['id_paketwisata']?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
            </td>
          </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>