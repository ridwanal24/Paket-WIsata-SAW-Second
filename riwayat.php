<?php

  session_start();
  //koneksi ke database
  include 'koneksi.php';

  //jika tidak ada session pelanggan (blm login)
  if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
  {
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
  }
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.png" />
    <title>PO Tami Jaya - Riwayat</title>
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
        <div class="row mb-5"></div>
        <h3>Riwayat Pemesanan <?php echo $_SESSION["pelanggan"]["nama"]; ?></h3><br>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Pesan</th>
              <th>Tanggal Tour</th>
              <th>Tanggal Selesai Tour</th>
              <th>Status</th>
              <th>Total</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php  
            $nomor=1;
            //mendapatkan id_pelanggan yang login dari session
            $id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];

            $ambil = $koneksi->query("SELECT * FROM tb_pemesanan WHERE id_pelanggan='$id_pelanggan'");
            while ($pecah = $ambil->fetch_assoc()) {
            ?>

            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo date('d F Y', strtotime($pecah["tanggal_pesan"])); ?></td>
              <td><?php echo date('d F Y', strtotime($pecah["tanggal_tour"])); ?></td>
              <td><?php echo date('d F Y', strtotime($pecah["tanggal_selesai_tour"])); ?></td>
              <td><?php echo $pecah["status_pemesanan"]; ?></td>
              <td>Rp. <?php echo number_format($pecah["total_pemesanan"]); ?></td>
              <td>
                <?php if ($pecah['status_pemesanan']=="pending"): ?>
                  <a class="small btn-link" href="pembayaran.php?id=<?php echo $pecah["id_pemesanan"] ?>">Input Pembayaran |</a> 
                <?php else: ?>
                  <a class="small btn-link" href="lihat_pembayaran.php?id=<?php echo $pecah["id_pemesanan"]; ?>">Lihat Pembayaran |</a>
                <?php endif ?>

                <?php if ($pecah['status_pemesanan']=="sudah kirim pembayaran"): ?>
                  <a class="small btn-link" href="nota.php?id=<?php echo $pecah["id_pemesanan"] ?>">Nota |</a> 
                  <a class="small btn-link" href="pembatalan.php?id=<?php echo $pecah["id_pemesanan"] ?>">Batalkan |</a>           
                <?php endif ?>                

              </td>
            </tr>
            
            <?php $nomor++; ?>
            <?php } ?>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-info">
              <p>
                Pembayaran hanya dapat dilakukan ke rekening berikut ini:<br>
                <strong> BANK MANDIRI 137-0001088-3276 AN. Arif Nur Rohman</strong>
              </p>
            </div>
          </div>
        </div>
        <div class="row mb-5"></div>
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