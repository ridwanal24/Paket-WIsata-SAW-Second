<?php

  //koneksi ke database
  include 'koneksi.php';

  session_start();

  //jika tidak ada session pelanggan (blm login) maka diarahkan ke login.php
  if (!isset($_SESSION["pelanggan"])) 
  {
  echo "<script>alert('Silahkan login');</script>";
  echo "<script>location='login.php';</script>";
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.png" />
    <title>PO Tami Jaya</title>
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

    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/f_img_1.png);">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-12 text-center">

            <div class="mb-5 element-animate">
              <h1>Welcome To PO Tami Jaya Website</h1>
              <p>Discover our world's #1 Luxury Room For VIP.</p>
              <p><a href="pemesanan.php" class="btn btn-primary">Pesan Sekarang</a></p>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-5">Form Pemesanan</h2>
                <form action="#" method="post">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="nama">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" readonly value="<?php echo$_SESSION["pelanggan"]['nama'] ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="alamat">Alamat</label>
                      <textarea name="alamat" class="form-control" cols="30" rows="8" readonly value="<?php echo$_SESSION["pelanggan"]['alamat'] ?>"></textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="telepon">Telepon</label>
                      <input type="number" name="telepon" class="form-control" readonly value="<?php echo$_SESSION["pelanggan"]['telepon'] ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control" readonly value="<?php echo$_SESSION["pelanggan"]['email'] ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Nama Paket</label>
                      <select name="paket" class="form-control">
                        <option>-- Pilih Paket --</option>
                        <?php $ambil= $koneksi->query("SELECT nama_paketwisata FROM tb_paketwisata ORDER BY id_paketwisata ASC;"); ?>
                        <?php if (mysql_num_rows($ambil) > 0) { ?>
                          <?php while ($row = mysql_fetch_array($ambil)) { ?>
                          <option><?php echo $row['nama_paketwisata']; ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="">Tanggal Keberangkatan</label>
                          <div style="position: relative;">
                            <input type='date' name="tanggal" class="form-control" id='tgl_berangkat' />
                          </div>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="jumlah">Jumlah</label>
                      <input type="number" name="jumlah" class="form-control">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <button class="btn btn-primary" name="save">Lanjutkan Pembayaran</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-5">
                <h3 class="mb-5">Paket Wisata</h3>
                <div class="media d-block room mb-0">
              <figure>
                <img src="images/img_1.jpg" alt="Generic placeholder image" class="img-fluid">
                <div class="overlap-text">
                  <span>
                    Featured Room 
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                  </span>
                </div>
              </figure>
              <div class="media-body">
                <?php $ambil = $koneksi->query("SELECT * FROM tb_paketwisata WHERE id_paketwisata='$id_paketwisata'"); ?>
                <?php $pecah = $ambil->fetch_assoc(); ?>
                <h3 class="mt-0"><a href="#"><?php echo $pecah["nama_paketwisata"]; ?></a></h3>
                <ul class="room-specs">
                  <li><span class="ion-ios-people-outline"></span> 2 Guests</li>
                  <li><span class="ion-ios-crop"></span> 22 ft <sup>2</sup></li>
                </ul>
                <p>Nulla vel metus scelerisque ante sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. </p>
                <p><a href="#" class="btn btn-primary btn-sm">Book Now From $20</a></p>
              </div>
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