<?php
//mengambil data kriteria berdasarkan id_kriteria
$ambil = $koneksi->query("SELECT * FROM tb_kriteria
    LEFT JOIN tb_subkriteria ON tb_kriteria.id_kriteria=tb_subkriteria.id_kriteria");
$pecah = $ambil->fetch_assoc();
?>

<a href="index.php?page=tambahsubkriteria" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Sub Kriteria</a>
<br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Sub Kriteria </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kriteria</th>
              <th>Nama Sub Kriteria</th>
              <th>Bobot</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor=1; ?>
            <?php $ambil=$koneksi->query("SELECT * FROM tb_subkriteria JOIN tb_kriteria ON tb_subkriteria.id_kriteria=tb_kriteria.id_kriteria");?>
            <?php while($pecah = $ambil->fetch_assoc()){ ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $pecah['nama_kriteria']; ?></td>
              <td><?php echo $pecah['nama']; ?></td>
              <td><?php echo $pecah['bobot_subkriteria']; ?></td>
              <td>
                <a href="index.php?page=hapussubkriteria&id=<?php echo $pecah['id_subkriteria']?>" class="btn-danger btn"><i class="fas fa-trash"></i></a>
                <a href="index.php?page=ubahsubkriteria&id=<?php echo $pecah['id_subkriteria']?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
              </td>
            </tr>
              <?php $nomor++; ?>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
</div>