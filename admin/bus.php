<a href="index.php?page=tambahbus" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Bus</a>
<a href="cetakbus.php" target="_blank" class="btn btn-secondary" name=""><i class="fas fa-print"></i>  Export PDF</a><br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Bus</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Bus</th>
            <th>Fasilitas</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM tb_bus");?>
          <?php while($pecah = $ambil->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama']; ?></td>
            <td><?php echo $pecah['fasilitas_bus']; ?></td>
            <td>
              <a href="index.php?page=hapusbus&id=<?php echo $pecah['id_bus']?>" class="btn-danger btn"><i class="fas fa-trash"></i></a>
              <a href="index.php?page=ubahbus&id=<?php echo $pecah['id_bus']?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
            </td>
          </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>