<a href="index.php?page=tambahkriteria" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kriteria</a>
<br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kriteria </h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kriteria</th>
            <th>Atribut</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM tb_kriteria");?>
          <?php while($pecah = $ambil->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_kriteria']; ?></td>
            <td><?php echo $pecah['atribut']; ?></td>
            <td>
              <a href="index.php?page=hapuskriteria&id=<?php echo $pecah['id_kriteria']?>" class="btn-danger btn"><i class="fas fa-trash"></i></a>
              <a href="index.php?page=ubahkriteria&id=<?php echo $pecah['id_kriteria']?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
            </td>
          </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>