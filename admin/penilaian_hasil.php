<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Proses SPK</h1>
<p class="mb-4">
  Proses perhitungan Sistem Pendukung Keputusan berdasarkan kriteria dengan
  <tr align="right">
    <th></th>
    <th>Bobot :</th>
    <th>[<?php echo "(" .$_POST['hrg']. ")"; ?></th>
    <th><?php echo "(" .$_POST['jml_wisata']. ")"; ?></th>
    <th><?php echo "(" .$_POST['lm_tour']. ")"; ?>]</th>
  </tr>
</p>


<?php  
  $hasil = array($_POST['hrg'], $_POST['jml_wisata'], $_POST['lm_tour']);
  $totalArray = count($hasil);

  //echo "<pre>";
  //print_r($totalArray);
  //echo "</pre>";
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Acuan Bobot Kriteria</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Kriteria</th>
            <!--<th>Nilai Inputan</th>!-->
            <th>Bobot (%)</th>
            <th>Atribut</th>
          </tr>
        </thead>

        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");?>
          <?php while($pecah = mysqli_fetch_array($ambil)){ ?>
          <?php //for ($i=0; $i < $totalArray; $i++){?>
          <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $pecah['nama_kriteria']; ?></td>
            <!--<td><?php// echo $hasil[$i]; ?></td>!-->
            <td><?php echo $pecah['bobot']; ?></td>
            <td><?php echo $pecah['atribut']; ?></td> 
          </tr>
            <?php //} ?>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- /hover rows datatable inside panel -->
<!-- Cari nilai maximal dan minimal-->
<?php
#Cari nilai maximal
$carimax = mysqli_query($koneksi,"SELECT max(harga) as max1,
                max(jumlah_wisata) as max2,
                max(lama_tour) as max3
                FROM tb_alternatif");

$max = mysqli_fetch_assoc($carimax);

# Cari nilai minimal
$carimin = mysqli_query($koneksi,"SELECT min(harga) as min1,
                min(jumlah_wisata) as min2,
                min(lama_tour) as min3
                FROM tb_alternatif");
$min = mysqli_fetch_assoc($carimin);

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Hasil Perhitungan Normalisasi</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
          <?php $nomor=1; ?>
          <?php $ambil = mysqli_query($koneksi, "SELECT * FROM tb_paketwisata JOIN tb_alternatif ON tb_paketwisata.id_paketwisata=tb_alternatif.id_paketwisata");?>
          <?php while ($pecah = mysqli_fetch_array($ambil)) {?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_paketwisata']; ?></td>
            <td><?php echo round($min['min1']/$pecah['harga'],2);?></td>
            <td><?php echo round($pecah['jumlah_wisata']/$max['max2'],2);?></td>
            <td><?php echo round($pecah['lama_tour']/$max['max3'],2);?></td>
          </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- /hover rows datatable inside panel -->
<?php
  $bobot_harga        = $_POST['hrg'];
  $bobot_jumlahwisata = $_POST['jml_wisata'];  
  $bobot_lamatour     = $_POST['lm_tour'];
?>

<a href="cetakrekomendasi.php" target="_blank" class="btn btn-secondary" name=""><i class="fas fa-print"></i>  Export PDF</a><br><br>

<div class="row">
  <div class="col-lg-8">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekomendasi Paket Wisata Terbaik</h6>
        </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Nilai Total</th>
                <th>Ranking</th>
              </tr>
            </thead>
            <tbody>
              <?php $nomor=1; ?>
              <?php $ambil = mysqli_query($koneksi, "SELECT * FROM tb_paketwisata JOIN tb_alternatif ON tb_paketwisata.id_paketwisata=tb_alternatif.id_paketwisata");?>
              <?php while ($pecah = mysqli_fetch_array($ambil)) {?>
              <tr>
                <td><?php echo $nomor=$nomor; ?></td>
                <td><?php echo $pecah['nama_paketwisata']; ?></td>
                <td><?php echo round 
                  ((($min['min1']/$pecah['harga'])*$bobot_harga)+
                  (($pecah['jumlah_wisata']/$max['max2'])*$bobot_jumlahwisata)+
                  (($pecah['lama_tour']/$max['max3'])*$bobot_lamatour),2); ?></td>
              </tr>
                <?php $nomor++; ?>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php  
    $hasil = array(
    round 
      ((($min['min1']/$pecah['harga'])*$bobot_harga)+
      (($pecah['jumlah_wisata']/$max['max2'])*$bobot_jumlahwisata)+
      (($pecah['lama_tour']/$max['max3'])*$bobot_lamatour),2)); 
  ?>

  <!-- Kesimpulan -->
  <!-- <div class="col-lg-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kesimpulan</h6>
      </div>
      <div class="card-body">
        Dari hasil perhitungan rangking disamping, maka pemilihan paket wisata terbaik sesuai dengan kriteria adalah dengan nilai <?php echo max($hasil); ?>
      </div>
    </div>
  </div>  
</div>-->


