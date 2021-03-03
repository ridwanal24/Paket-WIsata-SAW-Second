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
                <form method="post" action="rekomendasi_2_result.php" enctype="multipart/form-data">
                  <!--<div class="form-group">
                    <label>Harga (C1)</label>
                    <input type="number" class="form-control" name="bobot_hrg" required>
                  </div>

                  <div class="form-group">
                    <label>Jumlah Wisata (C2)</label>
                    <input type="number" class="form-control" name="bobot_jmlwisata" required>
                  </div>

                  <div class="form-group">
                    <label>Lama Tour(C3)</label>
                    <input type="number" class="form-control" name="bobot_lmtour" required>
                  </div>

                  <div class="text-right">
                     <button class="btn btn-primary" name="cari" value="Proses">Cari</button>
                  </div>-->
                  <div class="form-group">
                    <label>Paket Wisata Tujuan</label>
                    <select class="form-control" name="paket_wisata_grup">
                      <option value="">--Pilih Paket Wisata--</option>
                      <?php $query = $koneksi->query("SELECT * FROM tb_paketwisata_grup");
                        while ($row = $query->fetch_assoc()) { 
                      ?>
                      <option value="<?php echo $row["id_paketwisata_grup"] ?>"><?php echo $row["nama_paketwisata"]; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Prioritas Harga (C1)</label>
                    <select class="form-control" name="hrg">
                      <option value="">--Pilih Prioritas Harga--</option>
                      <option value="1">Murah</option>
                      <option value="3">Sedang</option>
                      <option value="5">Mahal</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Prioritas Jumlah Wisata (C2)</label>
                    <select class="form-control" name="jml_wisata">
                      <option value="">--Pilih Prioritas--</option>
                      <option value="1">Sedikit</option>
                      <option value="3">Sedang</option>
                      <option value="5">Banyak</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Prioritas Lama Tour (C3)</label>
                    <select class="form-control" name="lm_tour">
                      <option value="">--Pilih Prioritas--</option>
                      <option value="1">Sebentar</option>
                      <option value="3">Sedang</option>
                      <option value="5">Lama</option>
                    </select>
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
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

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
  </body>
</html>