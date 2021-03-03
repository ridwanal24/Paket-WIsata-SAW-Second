<?php
  
  session_start();

  //koneksi ke database
  include 'koneksi.php';

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
    <title>PO Tami Jaya - Kelola Profil</title>
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
      <h3>Profil Pelanggan</h3><br>
      <div class="row">
        <div class="col-md-8">
          <table class="table">
            <?php  
              //mendapatkan id_pelanggan yang login dari session
              $id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];

              $ambil = $koneksi->query("SELECT * FROM tb_pelanggan WHERE id_pelanggan='$id_pelanggan'");
              while ($pecah = $ambil->fetch_assoc()) {
            ?>
            <tr>
              <th>Nama</th>
              <td><?php echo $pecah['nama'] ?></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td><?php echo $pecah["alamat"] ?></td>
            </tr>
            <tr>
              <th>Telepon</th>
              <td><?php echo $pecah["telepon"] ?></td>
            </tr>
             <tr>
              <th>Email</th>
              <td><?php echo $pecah["email"] ?></td>
            </tr>
             <tr>
              <th>Username</th>
              <td><?php echo $pecah["username"] ?></td>
            </tr>
             <tr>
              <th>Password</th>
              <td><?php echo $pecah["password"] ?></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <a href="ubahprofil.php" class="btn btn-primary">Ubah</a>
    </div>
  </section>
   
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