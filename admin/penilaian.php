<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Masukan Nilai Bobot Masing - Masing Kriteria</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <form method="post" action="index.php?page=penilaianhasil" onsubmit="return penilaianCheck()">
        <?php
        $query = $koneksi->query("SELECT * FROM tb_paketwisata_grup");
        ?>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Paket Wisata Tujuan</label>
              <small class="text-danger paket-kosong">*Pilihan wajib diisi</small>
              <select name="paket_tujuan" class="form-control">
                <option value=""> -- Pilih Wisata Tujuan -- </option>

                <?php
                while ($row = $query->fetch_assoc()) { ?>

                  <option value="<?php echo $row['id_paketwisata_grup']; ?>"><?php echo $row['nama_paketwisata']; ?></option>
                <?php
                }
                ?>

              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>C1. Harga Paket Wisata</label>
              <small class="text-danger harga-kosong">*Pilihan wajib diisi</small>
              <select class="form-control" name="hrg">
                <option value=""> -- Pilih Harga -- </option>
                <?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='1' order by id_subkriteria asc;");
                while ($setiap = $ambil2->fetch_assoc()) {
                ?>
                  <option value="<?php echo $setiap["bobot_subkriteria"] . '|' . $setiap['nama'] ?>"><?php echo $setiap["nama"]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>C2. Jumlah Wisata</label>
              <small class="text-danger jumlah-kosong">*Pilihan wajib diisi</small>
              <select class="form-control" name="jml_wisata">
                <option value=""> -- Pilih Jumlah Wisata -- </option>
                <?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='3' order by id_subkriteria asc;");
                while ($setiap = $ambil2->fetch_assoc()) {
                ?>
                  <option value="<?php echo $setiap["bobot_subkriteria"] . '|' . $setiap['nama'] ?>"><?php echo $setiap["nama"]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>C3. Lama Tour</label>
              <small class="text-danger lama-kosong">*Pilihan wajib diisi</small>
              <select class="form-control" name="lm_tour">
                <option value=""> -- Pilih Lama Tour -- </option>
                <?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='4' order by id_subkriteria asc;");
                while ($setiap = $ambil2->fetch_assoc()) {
                ?>
                  <option value="<?php echo $setiap["bobot_subkriteria"] . '|' . $setiap['nama'] ?>"><?php echo $setiap["nama"]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary" value="Proses" name="lihat">Proses</button><br><br>
          </div>
        </div>
    </div>
    </form>
  </div>
</div>
</div>