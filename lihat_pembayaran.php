<?php
  
  session_start();

  //koneksi ke database
  include 'koneksi.php';

  $id_pemesanan = $_GET["id"];

  $ambil = $koneksi->query("SELECT * FROM tb_pembayaran 
    LEFT JOIN tb_pemesanan ON tb_pembayaran.id_pemesanan=tb_pemesanan.id_pemesanan 
    WHERE tb_pemesanan.id_pemesanan='$id_pemesanan'");
  $detbay = $ambil->fetch_assoc();

  //jika belum ada data pembayaran
  if (empty($detbay)) 
  {
    echo "<script>alert('Anda tidak berhak')</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
  }

  //jika data pelanggan yang bayar tidak sesuai dengan yang login
  if ($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"]) 
  {
    echo "<script>alert('Anda tidak berhak melihat pembayaran orang lain')</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.png" />
    <title>PO Tami Jaya - Lihat Pembayaran</title>
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
      <h3>Lihat Pembayaran</h3><br>
      <div class="row">
        <div class="col-md-6">
          <table class="table">
            <tr>
              <th>Nama</th>
              <td><?php echo $detbay["nama"]; ?></td>
            </tr>
            <tr>
              <th>Jumlah</th>
              <td>Rp. <?php echo number_format($detbay["jumlah_bayar"]); ?></td>
            </tr>
            <tr>
              <th>Tanggal Bayar</th>
              <td><?php echo date('d F Y', strtotime($detbay["tanggal"])); ?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <img src="bukti_pembayaran/<?php echo $detbay["bukti_transfer"] ?>" alt="" width="400" height="400">
        </div>
      </div>
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