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
    <title>PO Tami Jaya - About</title>
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
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="site-section">
      <div class="container">
        <div class="grid fluid">
            <div class="border padding50">
              <div class="row mb-5 mt-3">
                  <div class="col-md-12 heading-wrap text-center">
                    <h4 class="sub-heading">About</h4>
                    <h2 class="heading">Tentang Kami</h2>
                  </div>
              </div>
              <div class="row ml-5 mb-3 mr-5">
                <div class="col-md-12">
                <h3>Lingkup Pekerjaan: </h3>
                <p>PO Tami Jaya telah terbiasa melakukan pekerjaan pelayanan umum yang antara lain meliputi bidang:</p>
                <p>
                  <ul>
                    <li>Penyedia jasa bus pariwisata kapasitas 31 - 60 seat</li>
                    <li>Pelayanan bus malam cepat tujuan Jogja - Solo - Denpasar - Padang - Bali</li>
                    <li>Melayani berbagai paket wisata yang meliputi:</li>
                    <ul>
                      <li>Tour Domestik (Sumatera, Jawa, Bali, Lombok)</li>
                      <li>Study Tour</li>
                      <li>Company Visit</li>
                      <li>Family Gathering</li>
                      <li>Outbond</li>
                      <li>Family Tour</li>
                    </ul>
                  </ul>
                </p>

                <p> <h3>Penawaran Kerjasama:</h3></p>
                <p>Dengan menyadari sepenuhnya atas kemampuan profesional yang kami miliki selama ini, Tami Jaya Tours mencoba menawarkan kerjasama yang berkelanjutan untuk memandu kegiatan study tour sekolah yang Bapak/Ibu pimpin dalam rangka mensukseskan acara tersebut, kami sampaikan beberapa penawaran terbaik paket study tour yang semoga bisa menjadi referensi dan pertimbangan Bapak/Ibu dalam melaksanakan kegiatan study tour.</p>
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