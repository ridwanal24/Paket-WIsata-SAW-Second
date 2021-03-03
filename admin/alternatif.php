<a href="index.php?page=tambahalternatif" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Alternatif</a>
<br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Alternatif</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Alternatif</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM tb_alternatif LEFT JOIN tb_paketwisata ON tb_alternatif.id_paketwisata=tb_paketwisata.id_paketwisata");?>
          <?php while($pecah = $ambil->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_paketwisata']; ?></td>
            <td>
              <a href="index.php?page=hapusalternatif&id=<?php echo $pecah['id_alternatif']?>" class="btn-danger btn"><i class="fas fa-trash"></i></a>
              <a href="index.php?page=ubahalternatif&id=<?php echo $pecah['id_alternatif']?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
              <a href="index.php?page=detailalternatif&id=<?php echo $pecah['id_alternatif']?>" class="btn btn-info">Lihat Detail</a>
            </td>
          </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>