<?php

session_start();

//koneksi ke database
include 'koneksi.php';


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

  <section class="site-section bg-light">
    <div class="container">
      <div class="grid fluid">
        <div class="border padding50">
          <div class="row mb-5 mt-3">
            <div class="col-md-12 heading-wrap text-center">
              <h4 class="sub-heading">Package Recommendations</h4>
              <h2 class="heading">Rekomendasi Paket</h2>
            </div>
          </div>


          <div class="card-body">
            <form method="post" action="rekomendasi_2_result.php" enctype="multipart/form-data" onsubmit="return check()">
              <div class="form-group">
                <label>Paket Wisata Tujuan</label>
                <small class="text-danger paket-wisata-kosong"> *Paket Wisata Tujuan harap diisi.</small>
                <select class="form-control" name="paket_wisata_grup">
                  <option value=""> -- Pilih Paket Wisata -- </option>
                  <?php $query = $koneksi->query("SELECT * FROM tb_paketwisata_grup");
                  while ($row = $query->fetch_assoc()) {
                  ?>
                    <option value="<?php echo $row["id_paketwisata_grup"] ?>"><?php echo $row["nama_paketwisata"]; ?></option>
                  <?php } ?>
                </select>
              </div>


              <div class="form-group">
                <label>Opsi Harga</label>
                <small class="text-danger harga-kosong"> *Harga harap diisi.</small>
                <select class="form-control" name="opsi_harga">
                  <option value=""> -- Pilih Harga -- </option>
                  <?php $query = $koneksi->query("SELECT * FROM tb_subkriteria WHERE id_kriteria=1");
                  while ($row = $query->fetch_assoc()) {
                  ?>
                    <option value="<?php echo $row['bobot_subkriteria']; ?>"><?php echo $row['nama'] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label>Opsi Jumlah Wisata</label>
                <small class="text-danger jumlah-wisata-kosong"> *Jumlah Wisata harap diisi.</small>
                <select class="form-control" name="opsi_jml_wisata">
                  <option value=""> -- Pilih Jumlah Wisata -- </option>
                  <?php $query = $koneksi->query("SELECT * FROM tb_subkriteria WHERE id_kriteria=3");
                  while ($row = $query->fetch_assoc()) {
                  ?>
                    <option value="<?php echo $row['bobot_subkriteria']; ?>"><?php echo $row['nama'] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label>Opsi Lama Tour</label>
                <small class="text-danger lama-tour-kosong"> *Lama Tour harap diisi.</small>
                <select class="form-control" name="opsi_lama_tour">
                  <option value=""> -- Pilih Lama Tour -- </option>
                  <?php $query = $koneksi->query("SELECT * FROM tb_subkriteria WHERE id_kriteria=4");
                  while ($row = $query->fetch_assoc()) {
                  ?>
                    <option value="<?php echo $row['bobot_subkriteria']; ?>"><?php echo $row['nama'] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>

              <!-- Captcha -->
              <div class="form-group text-center">
                <img src="captcha.php" alt="gambar">
              </div>
              <div class="form-group mt-4 text-center">
                <label>Masukan Captcha<sup class="text-danger"></sup></label>
                <input name="kodecaptcha" value="" maxlength="5">
                <small class="kodecaptcha-alert text-danger">Kode Captcha wajib diisi</small>
                <?php if (isset($_GET['captcha_failed'])) { ?>
                  <small class="text-danger"> <b>Kode Captcha Salah</b></small>
                <?php } ?>
              </div>


              <div class="text-right">
                <button class="btn btn-primary" name="cari" value="Proses">Cari</button>
              </div>

            </form>
          </div>
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
    $(".paket-wisata-kosong").hide();
    $(".jumlah-wisata-kosong").hide();
    $(".lama-tour-kosong").hide();
    $(".harga-kosong").hide();
    $(".kodecaptcha-alert").hide();

    let status = false;
    let status_paket;
    let status_harga;
    let status_jumlah;
    let status_lama;
    let status_captcha;
    let check = function() {
      if ($('select[name=paket_wisata_grup]').val() == "") {
        status_paket = false;
        $(".paket-wisata-kosong").show();
        console.log("status_paket ", status_paket);
      } else {
        $(".paket-wisata-kosong").hide();
        status_paket = true;
        console.log("status_paket ", status);
      }

      if ($('select[name=opsi_harga]').val() == "") {
        status_harga = false;
        $(".harga-kosong").show();
        console.log("status_harga ", status_harga);
      } else {
        $(".harga-kosong").hide();
        status_harga = true;
        console.log("status_harga ", status_harga);
      }

      if ($('select[name=opsi_jml_wisata]').val() == "") {
        status_jumlah = false;
        $(".jumlah-wisata-kosong").show();
        console.log("status_jumlah ", status_jumlah);
      } else {
        $(".jumlah-wisata-kosong").hide();
        status_jumlah = true;
        console.log("status_jumlah ", status_jumlah);
      }

      if ($('select[name=opsi_lama_tour]').val() == "") {
        status_lama = false;
        $(".lama-tour-kosong").show();
        console.log("status_lama ", status_lama);
      } else {
        $(".lama-tour-kosong").hide();
        status_lama = true;
        console.log("status_lama ", status_lama);
      }

      if ($('[name=kodecaptcha]').val() == "") {
        status_captcha = false;
        $(".kodecaptcha-alert").show();
        console.log("status_captcha ", status_captcha);
      } else {
        $(".kodecaptcha-alert").hide();
        status_captcha = true;
        console.log("status_captcha ", status_captcha);
      }

      status = status_paket && status_harga && status_jumlah && status_lama && status_captcha;

      return status;
    }
  </script>
</body>

</html>