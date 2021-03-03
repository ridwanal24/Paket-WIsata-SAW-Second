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
    <title>PO Tami Jaya - Login</title>
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
        <div class="row align-items-center">
          <div class="col-md-4">
            <div class="heading-wrap text-center element-animate">
              <h4 class="sub-heading">Enjoy with our destination</h4>
              <h2 class="heading">Login Pelanggan</h2>
              <div class="container">
                <form name="login_pelanggan" method="post" action="login_cek.php" onsubmit="return validasiForm()">
                  <div class="form-group">
                    <label>Username<sup class="text-danger">*</sup></label>
                      <br><small class="username-alert text-danger float-left">Username wajib diisi</small>
                      <input type="username" class="form-control" name="username">
                  </div>
                  <div class="form-group">
                    <label>Password<sup class="text-danger">*</sup></label>
                      <br><small class="password-alert text-danger float-left">Password wajib diisi</small>
                      <input type="password" class="form-control" name="password" id="password">
                  </div>
                  <div class="text-left">
                  <input type="checkbox" id="show" onclick="toggle()"> Show Password
                  </div>
                  <hr>

                  <div class="form-group">
                    <img src="captcha.php" alt="gambar">
                  </div>
                  <div class="form-group">
                    <label>Masukan Captcha<sup class="text-danger">*</sup></label>
                    <input name="kodecaptcha" value="" maxlength="5">
                      <small class="kodecaptcha-alert text-danger">Kode Captcha wajib diisi</small>
                    <?php if(isset($_GET['captcha_failed'])){ ?>
                      <small class="text-danger"> <b>Kode Captcha Salah</b></small>
                    <?php } ?>
                  </div>

                  <input type='submit' class="btn btn-primary" name="login" value="Login">
                  <div class="text-center">
                    <a class="small btn-link" href="buatakun.php">Buat Akun</a>
                  </div>
                </form>
              </div>
            </div>
            <script>
                var state = false;
                function toggle() {
                  if (state) {
                    document.getElementById("password"). setAttribute("type", "password");
                    document.getElementById("show").style.color='#7a797e';
                    state = false;
                  }
                  else{
                    document.getElementById("password"). setAttribute("type", "text");
                    document.getElementById("show").style.color='#5887ef';
                    state = true;
                  }
                }
              </script>
          </div>
          <div class="col-md-1"></div>
            <div class="col-md-7">
              <img src="images/foto2.jpg" alt="Image placeholder" class="img-md-fluid" width="755" height="600">
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
    
    <!-- Form Validation -->
    <script>
        $('.username-alert').hide();
        $('.password-alert').hide();
        $('.kodecaptcha-alert').hide();
      function validasiForm(){
        // set kondisi awal //
        $('.username-alert').hide();
        $('.password-alert').hide();
        $('.kodecaptcha-alert').hide();
        
        let status = true;
        let username = document.forms['login_pelanggan']['username'].value;
        let password = document.forms['login_pelanggan']['password'].value;
        let captcha = document.forms['login_pelanggan']['kodecaptcha'].value;
        
        if(username == ''){
        $('.username-alert').show();
          status = false;
        }
        if(password == ''){
        $('.password-alert').show();
          status = false;
        }
        if(captcha == ''){
        $('.kodecaptcha-alert').show();
          status = false;
        }
        
        return status;
      }

    </script>
    <!-- --------------- -->
  </body>
</html>