<?php

session_start();

//koneksi ke database
include 'koneksi.php';
$query = $koneksi->query("SELECT * FROM tb_paketwisata_grup WHERE id_paketwisata_grup='$_POST[paket_wisata_grup]'");
$row = $query->fetch_assoc();
$nama_paket = $row['nama_paketwisata'];
$query = $koneksi->query("SELECT * FROM tb_kriteria");
$kriteria = [];
while ($data = $query->fetch_assoc()) {
  $kriteria[] = $data['bobot'];
}
$c1 = $kriteria[0] / 100;
$c2 = $kriteria[1] / 100;
$c3 = $kriteria[2] / 100;

?>

<!doctype html>
<html lang="en">

<head>
  <!-- favicon -->
  <link rel="shortcut icon" href="images/logo.png" />
  <title>PO Tami Jaya - Rekomendasi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900|Rubik:300,400,700" rel="stylesheet">

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <!-- Theme Style -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php include 'menu.php'; ?>

  <section class="site-hero overlay site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/home1.jpg);">
    <div class="container">
      <div class="row align-items-center site-hero-inner justify-content-center">
        <div class="col-md-12 text-center">
          <div class="mb-5 element-animate">
            <h1>Welcome To PO Tami Jaya Website</h1>
            <p>We Love To Trip With You.</p>
            <p><a href="about.php" class="btn btn-primary">About</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->

  <section class="site-section">
    <div class="container">
      <div class="grid fluid">
        <div class="border padding50 untuk-print-pdf">

          <div class="row mb-5">
            <div class="col-md-12 heading-wrap text-center mt-3">
              <h4 class="sub-heading">Our Tour</h4>
              <h2 class="heading">Hasil Rekomendasi Paket Wisata</h2>
              <h4 class="sub-heading"><?php echo $nama_paket; ?></h4>
            </div>
          </div>
          <!-- Hover rows datatable inside panel -->
          <div class="panel panel-default ml-5 mb-3 mr-5">
            <div class="panel-heading">
              <h6 class="panel-title">
                <tr align="right">
                  <th></th>
                  <th>Bobot :</th>
                  <th><?php echo "(" . $c1 . ")"; ?></th>
                  <th><?php echo "(" . $c2 . ")"; ?></th>
                  <th><?php echo "(" . $c3 . ")"; ?></th>
                </tr>
              </h6>
            </div>
            <div class="panel-heading">
              <h6 class="panel-title">Rating Kecocokan</h6>
            </div>
            <div class="datatable">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket Wisata</th>
                    <th>C1. Harga (Cost)</th>
                    <th>C2. Jumlah Wisata (Benefit)</th>
                    <th>C3. Lama Tour (Benefit)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomor = 0;
                  $ambil = mysqli_query($koneksi, "SELECT * FROM tb_paketwisata JOIN tb_alternatif ON tb_paketwisata.id_paketwisata=tb_alternatif.id_paketwisata WHERE id_paketwisata_grup='$_POST[paket_wisata_grup]'");
                  while ($pecah = mysqli_fetch_array($ambil)) {
                    // $ambil = mysqli_query($koneksi,"SELECT * FROM tb_paketwisata");
                    // while ($pecah = mysqli_fetch_array($ambil)) {
                  ?>
                    <tr>
                      <td><?php echo $nomor = $nomor + 1; ?></td>
                      <td><?php echo $pecah['nama_paketwisata']; ?></td>
                      <td><?php echo $pecah['harga']; ?></td>
                      <td><?php echo $pecah['jumlah_wisata']; ?></td>
                      <td><?php echo $pecah['lama_tour']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div><br>

          <!-- /hover rows datatable inside panel -->
          <!-- Cari nilai maximal dan minimal-->
          <?php
          #Cari nilai maximal
          $carimax = mysqli_query($koneksi, "SELECT max(ta.harga) as max1,
                max(ta.jumlah_wisata) as max2,
                max(ta.lama_tour) as max3
                FROM tb_alternatif as ta
                JOIN tb_paketwisata as tpw on ta.id_paketwisata=tpw.id_paketwisata
                WHERE tpw.id_paketwisata_grup='$_POST[paket_wisata_grup]'");

          $max = mysqli_fetch_assoc($carimax);

          # Cari nilai minimal
          $carimin = mysqli_query($koneksi, "SELECT min(ta.harga) as min1,
                min(ta.jumlah_wisata) as min2,
                min(ta.lama_tour) as min3
                FROM tb_alternatif as ta
                JOIN tb_paketwisata as tpw on ta.id_paketwisata=tpw.id_paketwisata
                WHERE tpw.id_paketwisata_grup='$_POST[paket_wisata_grup]'");
          $min = mysqli_fetch_assoc($carimin);

          ?>

          <div class="panel panel-default ml-5 mb-3 mr-5">
            <div class="panel-heading">
              <h6 class="panel-title">Normalisasi</h6>
            </div>
            <div class="datatable">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket Wisata</th>
                    <th>C1. Harga (Cost)</th>
                    <th>C2. Jumlah Wisata (Benefit)</th>
                    <th>C3. Lama Tour (Benefit)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $nomor = 1; ?>
                  <?php $ambil = mysqli_query($koneksi, "SELECT * FROM tb_paketwisata JOIN tb_alternatif ON tb_paketwisata.id_paketwisata=tb_alternatif.id_paketwisata WHERE id_paketwisata_grup='$_POST[paket_wisata_grup]'"); ?>
                  <?php while ($pecah = mysqli_fetch_array($ambil)) { ?>
                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><?php echo $pecah['nama_paketwisata']; ?></td>
                      <td><?php echo round($min['min1'] / $pecah['harga'], 2); ?></td>
                      <td><?php echo round($pecah['jumlah_wisata'] / $max['max2'], 2); ?></td>
                      <td><?php echo round($pecah['lama_tour'] / $max['max3'], 2); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div><br>

          <!-- /hover rows datatable inside panel -->
          <?php
          // $bobot_harga    = $_POST['bobot_hrg'];
          // $bobot_jumlahwisata = $_POST['bobot_jmlwisata'];
          // $bobot_lamatour     = $_POST['bobot_lmtour'];


          // $bobot_harga    = $_POST['hrg'];
          // $bobot_jumlahwisata = $_POST['jml_wisata'];
          // $bobot_lamatour     = $_POST['lm_tour'];

          // == EDIT KE DUA == //

          $bobot_harga = $c1;
          $bobot_jumlahwisata = $c2;
          $bobot_lamatour = $c3;
          ?>

          <div class="panel panel-default ml-5 mb-3 mr-5">
            <div class="panel-heading">
              <h6 class="panel-title">Perangkingan</h6>
            </div>
            <div class="datatable">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket Wisata</th>
                    <th>Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $nomor = 1; ?>
                  <?php $ambil = mysqli_query($koneksi, "SELECT * FROM tb_paketwisata JOIN tb_alternatif ON tb_paketwisata.id_paketwisata=tb_alternatif.id_paketwisata WHERE id_paketwisata_grup='$_POST[paket_wisata_grup]'"); ?>
                  <?php while ($pecah = mysqli_fetch_array($ambil)) { ?>
                    <tr>
                      <td><?php echo $nomor = $nomor; ?></td>
                      <td><?php echo $pecah['nama_paketwisata']; ?></td>
                      <td><?php echo round((($min['min1'] / $pecah['harga']) * $bobot_harga) +
                            (($pecah['jumlah_wisata'] / $max['max2']) * $bobot_jumlahwisata) +
                            (($pecah['lama_tour'] / $max['max3']) * $bobot_lamatour), 2); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                  <?php } ?>
                </tbody>

              </table>
            </div>
          </div>
        </div>
        <div class="text-right mt-5">
          <button class="btn btn-primary" name="cetakPDF" value="Proses">Cetak PDF</button>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->

  <?php include 'footer.php'; ?>

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" />
    </svg></div>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.0.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>

  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/magnific-popup-options.js"></script>

  <script src="js/main.js"></script>

  <script>
    $('[name=cetakPDF]').click(function() {
      $('[name=cetakPDF]').attr('disabled', true);
      $('[name=cetakPDF]').html('Sedang Diproses');
      $.ajax({
        method: 'POST',
        url: 'rekomendasi_2_cetak.php',
        data: {
          content: document.querySelector('.untuk-print-pdf').innerHTML
        },
        success: data => {
          $('[name=cetakPDF]').attr('disabled', false);
          $('[name=cetakPDF]').html('Print PDF');
          window.location = 'rekomendasi_2_cetak.php?id_cetak=' + data;
        }
      });
    });
  </script>

</body>

</html>