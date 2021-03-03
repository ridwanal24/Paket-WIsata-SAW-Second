<a href="index.php?page=tambahnilai" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Nilai</a>
<a href="cetaknilai.php" target="_blank" class="btn btn-secondary" name=""><i class="fas fa-print"></i>  Export PDF</a><br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Nilai </h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kriteria</th>
            <th>Nama Nilai</th>
            <th>Nilai</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM tb_nilai LEFT JOIN tb_kriteria ON tb_nilai.id_kriteria=tb_kriteria.id_kriteria");?>
          <?php while($pecah = $ambil->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_kriteria']; ?></td>
            <td><?php echo $pecah['nama']; ?></td>
            <td><?php echo $pecah['nilai']; ?></td>
            <td><?php echo $pecah['keterangan']; ?></td>
            <td>
              <a href="index.php?page=hapusnilai&id=<?php echo $pecah['id_nilai']?>" class="btn-danger btn"><i class="fas fa-trash"></i></a>
              <a href="index.php?page=ubahnilai&id=<?php echo $pecah['id_nilai']?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
            </td>
          </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>