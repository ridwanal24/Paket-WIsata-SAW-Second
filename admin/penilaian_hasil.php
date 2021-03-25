<?php
$query = $koneksi->query("SELECT * FROM tb_kriteria");
$bobot = [];

while ($row = $query->fetch_assoc()) {
  $bobot[] = $row['bobot'];
}
?>
<div class="print">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Proses SPK</h1>
  <p class="mb-4">
    Proses perhitungan Sistem Pendukung Keputusan berdasarkan kriteria dengan
    <tr align="right">
      <th></th>
      <th><br>Bobot : [</th>
      <?php foreach ($bobot as $b) { ?>
        <th><?php echo "(" . $b / array_sum($bobot) . ")"; ?></th>
      <?php } ?>
      <th>]</th>
    </tr>
  </p>


  <?php
  $bobot_sub = array('harga' => explode('|', $_POST['hrg'])[0], 'jumlah' => explode('|', $_POST['jml_wisata'])[0], 'lama' => explode('|', $_POST['lm_tour'])[0]);
  $nama_sub = array(explode('|', $_POST['hrg'])[1], explode('|', $_POST['jml_wisata'])[1], explode('|', $_POST['lm_tour'])[1]);
  // print_r($nama_sub);
  // die();

  // $totalArray = count($hasil);

  // echo "<pre>";
  // print_r($totalArray);
  // echo "</pre>";
  ?>

  <a href="#" class="btn btn-secondary" name="cetakPDF"><i class="fas fa-print"></i> Export PDF</a><br><br>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Acuan Bobot Kriteria</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
          <thead>
            <tr>
              <th>No</th>
              <th>Kriteria</th>
              <th>Sub Kriteria</th>
              <th>Bobot</th>
              <th>Bobot (%)</th>
              <th>Atribut</th>
            </tr>
          </thead>

          <tbody>
            <?php $nomor = 1; ?>
            <?php $ambil = mysqli_query($koneksi, "SELECT * FROM tb_kriteria"); ?>
            <?php while ($pecah = mysqli_fetch_array($ambil)) { ?>
              <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_kriteria']; ?></td>
                <td><?php echo $nama_sub[$nomor - 1]; ?></td>
                <td><?php echo $pecah['bobot'] / array_sum($bobot); ?></td>
                <td><?php echo ($pecah['bobot'] / array_sum($bobot)) * 100; ?>%</td>
                <td><?php echo $pecah['atribut']; ?></td>
              </tr>
            <?php $nomor++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- /hover rows datatable inside panel -->
  <!-- Cari nilai maximal dan minimal-->
  <?php
  #Cari nilai maximal
  $carimax = mysqli_query($koneksi, "SELECT max(harga) as max1,
                max(jumlah_wisata) as max2,
                max(lama_tour) as max3
                FROM tb_alternatif
                JOIN tb_paketwisata
                ON tb_alternatif.id_paketwisata=tb_paketwisata.id_paketwisata
                WHERE id_paketwisata_grup=" . $_POST['paket_tujuan']);
  // .
  // " AND tb_alternatif.harga=" . $bobot_sub['harga'] .
  // " AND tb_alternatif.lama_tour=" . $bobot_sub['lama'] .
  // " AND tb_alternatif.jumlah_wisata=" . $bobot_sub['jumlah']);

  $max = mysqli_fetch_assoc($carimax);
  // print_r($max);
  // die();
  # Cari nilai minimal
  $carimin = mysqli_query($koneksi, "SELECT min(harga) as min1,
  min(jumlah_wisata) as min2,
  min(lama_tour) as min3
  FROM tb_alternatif
  JOIN tb_paketwisata
  ON tb_alternatif.id_paketwisata=tb_paketwisata.id_paketwisata
  WHERE id_paketwisata_grup=" . $_POST['paket_tujuan']);
  // .
  //   " AND tb_alternatif.harga=" . $bobot_sub['harga'] .
  //   " AND tb_alternatif.lama_tour=" . $bobot_sub['lama'] .
  //   " AND tb_alternatif.jumlah_wisata=" . $bobot_sub['jumlah']);

  $min = mysqli_fetch_assoc($carimin);
  // print_r($min);
  // die();
  ?>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Nilai Setiap Alternatif</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Alternatif</th>
              <th>Harga</th>
              <th>Jumlah Wisata</th>
              <th>Lama Tour</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor = 1; ?>
            <?php $ambil = mysqli_query($koneksi, "SELECT pw.nama_paketwisata, a.harga, a.jumlah_wisata,a.lama_tour
            FROM tb_paketwisata as pw 
            JOIN tb_alternatif as a 
            ON pw.id_paketwisata=a.id_paketwisata 
            JOIN tb_paketwisata_grup as pwg 
            ON pw.id_paketwisata_grup=pwg.id_paketwisata_grup 
            WHERE pwg.id_paketwisata_grup=" . $_POST['paket_tujuan']);
            // .
            //   " AND a.harga=" . $bobot_sub['harga'] .
            //   " AND a.lama_tour=" . $bobot_sub['lama'] .
            //   " AND a.jumlah_wisata=" . $bobot_sub['jumlah']);
            ?>

            <?php while ($pecah = mysqli_fetch_array($ambil)) { ?>
              <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_paketwisata']; ?></td>
                <td><?php echo $pecah['harga']; ?></td>
                <td><?php echo $pecah['jumlah_wisata']; ?></td>
                <td><?php echo $pecah['lama_tour']; ?></td>
              </tr>
              <?php $nomor++; ?>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>



  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Hasil Perhitungan Normalisasi</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Alternatif</th>
              <th>Harga</th>
              <th>Jumlah Wisata</th>
              <th>Lama Tour</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor = 1; ?>
            <?php
            // $ambil = mysqli_query($koneksi, "SELECT pw.nama_paketwisata, a.harga, a.jumlah_wisata,a.lama_tour FROM tb_paketwisata as pw JOIN tb_alternatif as a ON pw.id_paketwisata=a.id_paketwisata JOIN tb_paketwisata_grup as pwg ON pw.id_paketwisata_grup=pwg.id_paketwisata_grup WHERE pwg.id_paketwisata_grup=" . $_POST['paket_tujuan'] . " AND a.id_alternatif IN(" . $id_subk['harga'] . "," . $id_subk['lama'] . "," . $id_subk['jumlah'] . ")");
            $ambil = mysqli_query($koneksi, "SELECT pw.nama_paketwisata, a.harga, a.jumlah_wisata,a.lama_tour FROM tb_paketwisata as pw JOIN tb_alternatif as a ON pw.id_paketwisata=a.id_paketwisata JOIN tb_paketwisata_grup as pwg ON pw.id_paketwisata_grup=pwg.id_paketwisata_grup WHERE pwg.id_paketwisata_grup=" . $_POST['paket_tujuan']);
            ?>
            <?php while ($pecah = mysqli_fetch_array($ambil)) { ?>
              <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_paketwisata']; ?></td>
                <td><?php echo round($min['min1'] / $pecah['harga'], 2); ?></td>
                <td><?php echo round($pecah['jumlah_wisata'] / $max['max2'], 2); ?></td>
                <td><?php echo round($pecah['lama_tour'] / $max['max3'], 2); ?></td>
              </tr>
              <?php $nomor++; ?>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- /hover rows datatable inside panel -->
  <?php
  $bobot_harga        = $bobot_sub['harga'] / array_sum($bobot_sub);
  $bobot_jumlahwisata = $bobot_sub['jumlah'] / array_sum($bobot_sub);
  $bobot_lamatour     = $bobot_sub['lama'] / array_sum($bobot_sub);

  $ambil = mysqli_query($koneksi, "SELECT * FROM tb_paketwisata JOIN tb_alternatif ON tb_paketwisata.id_paketwisata=tb_alternatif.id_paketwisata WHERE tb_paketwisata.id_paketwisata_grup=" . $_POST['paket_tujuan']);

  $rekomendasi = array();
  while ($pecah = mysqli_fetch_array($ambil)) {
    if ($pecah['harga'] == $bobot_sub['harga'] && $pecah['lama_tour'] == $bobot_sub['lama'] || $pecah['jumlah_wisata'] == $bobot_sub['jumlah']) {
      $rekomendasi[] = [
        'nama_paket' => $pecah['nama_paketwisata'],
        'lama_tour' => round($pecah['lama_tour'] / $max['max3'] * $bobot_lamatour, 2),
        'jumlah_wisata' => round($pecah['jumlah_wisata'] / $max['max2'] * $bobot_jumlahwisata, 2),
        'harga' => round($min['min1'] / $pecah['harga'] * $bobot_harga, 2),
        // 'lama_tour' => round($pecah['lama_tour'] / $max['max3'], 2) . 'x' . $bobot_lamatour,
        // 'jumlah_wisata' => round($pecah['jumlah_wisata'] / $max['max2'], 2) . 'x' . $bobot_jumlahwisata,
        // 'harga' => round($min['min1'] / $pecah['harga'], 2) . 'x' . $bobot_harga,
        'nilai' => round((($min['min1'] / $pecah['harga']) * $bobot_harga) +
          (($pecah['jumlah_wisata'] / $max['max2']) * $bobot_jumlahwisata) +
          (($pecah['lama_tour'] / $max['max3']) * $bobot_lamatour), 2)
      ];
    }
  }
  if (count($rekomendasi) != 0) {
    usort($rekomendasi, function ($a, $b) {
      return $a['nilai'] < $b['nilai'];
    });
  }

  ?>


  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Rekomendasi Paket Wisata Terbaik</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Paket</th>
                  <th>Harga</th>
                  <th>Jumlah Wisata</th>
                  <th>Lama Tour</th>
                  <th>Nilai Total</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $nomor = 1;
                if (count($rekomendasi) != 0) {
                  foreach ($rekomendasi as $item) { ?>
                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><?php echo $item['nama_paket']; ?></td>
                      <td><?php echo $item['harga']; ?></td>
                      <td><?php echo $item['jumlah_wisata']; ?></td>
                      <td><?php echo $item['lama_tour']; ?></td>
                      <td><?php echo $item['nilai']; ?></td>
                    </tr>
                <?php
                    $nomor++;
                  }
                } else {
                  echo '<tr><td colspan="6"><center><i>Pilihan Paket Tidak Tersedia, Silahkan Coba Opsi Yang Lain</i></center></td></tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Kesimpulan -->
    <div class="col-lg">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Kesimpulan</h6>
        </div>
        <div class="card-body">
          <?php
          if (count($rekomendasi) != 0) { ?>
            Dari hasil perhitungan diatas, maka pemilihan paket wisata terbaik sesuai dengan kriteria adalah <?php echo '<b>' . $rekomendasi[0]['nama_paket'] . '</b>'; ?> dengan nilai <?php print($rekomendasi[0]['nilai']); ?>
          <?php
          } else {
            echo 'Hasil tidak tersedia';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>