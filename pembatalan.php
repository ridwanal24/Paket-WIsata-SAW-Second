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
    <title>PO Tami Jaya - Pembatalan</title>
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

    <! -- konten -->
    <section class="site-section">
      <div class="container">
        <div class="row mb-5"></div>
        <h2>Detail Pemesanan</h2><br>
        <?php
          $ambil= $koneksi->query("SELECT * FROM tb_pemesanan JOIN tb_pelanggan ON tb_pemesanan.id_pelanggan=tb_pelanggan.id_pelanggan JOIN tb_pembayaran ON tb_pemesanan.id_pemesanan=tb_pembayaran.id_pemesanan WHERE tb_pemesanan.id_pemesanan='$_GET[id]'");
          $detail = $ambil->fetch_assoc();
        ?>

        <!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota orang lain -->
        <!-- pelanggan yang beli harus pelanggan yang login -->
        <?php 
        //mendapatkan id_pelanggan yang pesan
        $id_pelangganyangpesan = $detail["id_pelanggan"];

        //mendapatkan id_pelanggan yang login
        $id_pelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

        if ($id_pelangganyangpesan!==$id_pelangganyanglogin) 
        {
          echo "<script>alert('jangan nakal');</script>";
          echo "<script>location='riwayat.php';</script>";
          exit();
        }
        ?>

        <div class="row">
          <div class="col-md-4">
            <h5>Pelanggan</h5>
            <strong> Nama: <?php echo $detail['nama']; ?></strong><br>
            <p>
              Alamat: <?php echo $detail['alamat']; ?> <br> 
              Telepon: <?php echo $detail['telepon']; ?> <br>
              Email: <?php echo $detail['email']; ?>
            </p>
          </div>

          <div class="col-md-4">
            <h5>Pemesanan</h5>
            <strong>No. Pemesanan: <?php echo $detail['id_pemesanan']; ?> </strong> <br>
            Tanggal Pesan: <?php echo date('d F Y', strtotime($detail['tanggal_pesan'])); ?> <br> 
            Tanggal Tour: <?php echo date('d F Y', strtotime($detail['tanggal_tour'])); ?> <br> 
            Tanggal Selesai Tour: <?php echo date('d F Y', strtotime($detail['tanggal_selesai_tour'])); ?> <br>
          </div>

          <div class="col-md-4">
            <h5>Pembayaran</h5>
            <strong>Total Pembayaran: Rp. <?php echo number_format($detail['total_pemesanan']); ?> <br></strong>
            Tanggal Bayar: <?php echo date('d F Y', strtotime($detail['tanggal'])); ?> 
          </div>
        </div>

        <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Paket Wisata</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM tb_pemesanan_paket JOIN tb_paketwisata ON tb_pemesanan_paket.id_paketwisata=tb_paketwisata.id_paketwisata 
            WHERE tb_pemesanan_paket.id_pemesanan='$_GET[id]'"); ?>
          <?php while ($pecah=$ambil->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_paketwisata']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga_paket']); ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>
              Rp. <?php echo number_format($pecah['harga_paket']*$pecah['jumlah']); ?>
            </td>
          </tr>
          <?php $nomor++; ?>
          <?php } ?>
        </tbody>
    </table>
    <form method="post">
    	<div class="form-group">
          <label>Keterangan Pembatalan</label>
          <input type="text" class="form-control" name="keterangan" required>
        </div>
    <button class="btn btn-primary" name="batal">Batalkan Pesanan</button><br><br>
    <div class="alert alert-info">Pesanan hanya dapat dibatalkan SATU BULAN sebelum tanggal <strong><?php echo $detpem["tanggal_tour"]; ?> atau tidak ada pengembalian uang.</strong></div>
	</form>

    <?php
    //jika ada tombol kirim
    if (isset($_POST["batal"])) 
    {
    	$tanggal = date("Y-m-d");
    	$Keterangan = $_POST["keterangan"];

      //simpan pembatalan
      $koneksi->query("INSERT INTO tb_pembatalan(id_pemesanan,tanggal_pembatalan,keterangan) 
        VALUES ('$idpem','$tanggal','$Keterangan') ");

      //update data pemesanan dari pending menjadi sudah kirim pembayaran
      $koneksi->query("UPDATE tb_pemesanan SET status_pemesanan='pesanan dibatalkan' WHERE id_pemesanan='$idpem'");

      echo "<script>alert('pesanan berhasil dibatalkan');</script>";
      echo "<script>location='riwayat.php';</script>";
      exit();
    }
    ?>

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