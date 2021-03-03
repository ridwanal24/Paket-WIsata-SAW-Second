<?php

  session_start();
  //koneksi ke database
  include 'koneksi.php';

  //mendapatkan id_pemesanan dari url
  $idpem = $_GET["id"];
  $ambil = $koneksi->query("SELECT * FROM tb_pemesanan WHERE id_pemesanan='$idpem'");
  $detpem = $ambil->fetch_assoc();
    
  //mendapatkan id_pelanggan yang pesan
  $id_pelanggan_pesan = $detpem["id_pelanggan"];
  //mendapatkan id_pelanggan yang login
  $id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

  if ($id_pelanggan_login !== $id_pelanggan_pesan) 
  {
    echo "<script>alert('jangan nakal');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.png" />
    <title>PO Tami Jaya - Input Pembayaran</title>
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

    <div class="site-section">
    <div class="container">
      <div class="row mb-5"></div>
      <h2>Konfirmasi Pembayaran</h2>
      <p>kirim bukti pembayaran Anda disini</p>
      <div class="alert alert-info">Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pemesanan"]); ?></strong></div>

      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Nama Penyetor</label>
          <input type="text" class="form-control" name="nama">
        </div>
        <div class="form-group">
          <label>Total Pembayaran</label>
          <input type="number" class="form-control" name="total">
        </div>
        <div class="form-group">
          <label>Bukti Tranfer</label>
          <input type="file" class="form-control" name="bukti">
          <p class="text-danger">hanya dapat mengirim berupa foto</p>
        </div> 
        <button class="btn btn-primary" name="kirim">Kirim</button>
      </form>
      <div class="row mb-5"></div>
    </div>

    <?php 

    //jika ada tombol kirim
    if (isset($_POST["kirim"])) 
    {
      //upload dulu foto bukti
      $namabukti = $_FILES["bukti"]["name"];
      $lokasibukti = $_FILES["bukti"]["tmp_name"];
      $namafiks = date(YmdHis).$namabukti;
      move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

      $nama = $_POST["nama"];
      $jumlah_bayar =  $_POST["total"];
      $tanggal = date("Y-m-d");

      //simpan pembayaran
      $koneksi->query("INSERT INTO tb_pembayaran(id_pemesanan,nama,jumlah_bayar,tanggal,bukti_transfer) 
        VALUES ('$idpem','$nama','$jumlah_bayar','$tanggal','$namafiks') ");

      //update data pemesanan dari pending menjadi sudah kirim pembayaran
      $koneksi->query("UPDATE tb_pemesanan SET status_pemesanan='menunggu konfirmasi admin' WHERE id_pemesanan='$idpem'");

      echo "<script>alert('terimakasih sudah mengirimkan bukti pembayaran, tunggu konfirmasi admin dulu ya');</script>";
      echo "<script>location='riwayat.php';</script>";
      exit();

    }
    ?>
  </div>

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