<?php

  session_start();
  //koneksi ke database
  include 'koneksi.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <style>
      .warning {color: #FF0000;}
    </style>

    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.png" />
    <title>PO Tami Jaya - Buat Akun</title>
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
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-5">Buat Akun Baru</h2>
                <form name="validasi_register" method="post" action="buatakun_cek.php" onsubmit="return validasiRegister()">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="nama">Nama Lengkap<sup class="text-danger">*</sup></label>
                      <input type="text" name="nama" class="form-control" value="<?php echo isset($_GET['nama'])? $_GET['nama']:''; ?>">
                      <p class="text-danger nama-kosong-alert">*Nama wajib diisi</p>
                      <p class="text-danger nama-karakter-alert">*Nama hanya boleh mengandung karakter huruf dan spasi</p>
                      <br>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="alamat">Alamat<sup class="text-danger">*</sup></label>
                      <textarea name="alamat" class="form-control " cols="30" rows="8"><?php echo isset($_GET['alamat'])? $_GET['alamat']:''; ?></textarea>
                      <p class="text-danger alamat-kosong-alert">*Alamat wajib diisi</p>
                      <br>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="telepon">Telepon<sup class="text-danger">*</sup></label>
                      <input type="text" name="telepon" class="form-control" value="<?php echo isset($_GET['telepon'])? $_GET['telepon']:''; ?>">
                      <p class="text-danger telepon-kosong-alert">*Nomor Telepon wajib diisi</p>
                      <p class="text-danger telepon-karakter-alert">*Nomor Telepon hanya boleh angka</p>
                      <br>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="email">Email<sup class="text-danger">*</sup></label>
                      <input type="text" name="email" class="form-control" value="<?php echo isset($_GET['email'])? $_GET['email']:''; ?>">
                      <p class="text-danger email-kosong-alert">*Email wajib diisi</p>
                      <p class="text-danger email-karakter-alert">*Format email salah</p>
                      <p class="text-danger email-exist-alert">*Email sudah digunakan</p>
                      <br>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="username">Username<sup class="text-danger">*</sup></label>
                      <input type="username" name="username" class="form-control" value="<?php echo isset($_GET['username'])? $_GET['username']:''; ?>">
                      <p class="text-danger username-kosong-alert">*Username wajib diisi</p>
                      <p class="text-danger username-exist-alert">*Username sudah digunakan</p>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="password">Password<sup class="text-danger">*</sup></label>
                      <input type="password" name="password" class="form-control" value="">
                      <input type="checkbox" name="show_password"> Tampilkan Password
                      <br><p class="text-danger password-kosong-alert">*Password wajib diisi</p>
                    </div>
                  </div>

                  <div class="row mt-5">
                    <div class="col"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <center><img src="captcha.php" alt="gambar"></center>
                      </div>
                      <div class="form-group">
                        <center><label>Masukan Captcha<sup class="text-danger">*</sup></label></center>
                        <center><input name="kodecaptcha" value="" maxlength="5"></center>
                          <center><p class="kodecaptcha-kosong-alert text-danger">*Kode Captcha wajib diisi</p></center>
                        <?php if(isset($_GET['captcha_failed'])){ ?>
                          <center><p class="text-danger kodecaptcha-salah-alert"> <b>*Kode Captcha Salah</b></p></center>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input class="btn btn-primary" name="save" type="submit" value="simpan">
                    </div>
                  </div>
                </form>
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
    <script src="js/validateRegister.js"></script>
    <?php
    if(isset($_GET['captcha_failed'])){ 
      echo "<script> $('input[name=kodecaptcha]').focus(); </script>";
    }
    ?>
  </body>
</html>