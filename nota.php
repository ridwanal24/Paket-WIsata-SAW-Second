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
    <title>PO Tami Jaya - Nota</title>
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
      <div id="printnota" class="container">
        <?php $ambil=$koneksi->query("SELECT * FROM tb_pemesanan JOIN tb_pelanggan ON tb_pemesanan.id_pelanggan=tb_pelanggan.id_pelanggan JOIN tb_paketwisata ON tb_pemesanan.id_paketwisata=tb_paketwisata.id_paketwisata WHERE id_pemesanan='$_GET[id]'"); ?>
        <?php $pecah = $ambil->fetch_assoc() ?>
        <!-- <a href="cetaknota1.php?id=<?php echo $pecah["id_pemesanan"] ?>" target="_blank" class="btn btn-primary" name="cetak"><i class="fas fa-print"></i>  PDF -->
        </a>
         
        <a class="no-print" href="javascript:printDiv('printnota');">Silahkan klik Di sini untuk mencetak nota!!!</a> 
        
        <div class="row mb-5"></div>
        <div class="row">
            <div class="col-md-4">
              <a class="navbar-brand"><img src="images/logo.png" width="180px" height="150px"></a>
            </div>
            <div class="heading-wrap text-center element-animate">
              <div class="col-md-12">
                <h1>PO TAMI JAYA</h1>
                <h2>PEMESANAN PAKET WISATA</h2>
                <h6>Alamat: JL. RE. Martadinata No. 84 Yogyakarta </h6>
              </div>
              <div class="col-md-12">
                <a class="p-2"><i class="fa fa-phone"></i> (0274) 618080 / 586742</a>
                <a class="p-2"><i class="fa fa-whatsapp"></i> 0811 250 136</a>
                <a class="p-2"><span class="fa fa-envelope-square"></span> po.tamijaya@rocketmail.com</a>
              </div>
            </div> 
        </div><hr /><br><br>
        <div class="text-center">
          <h4><u>Detail Pemesanan</h4><br></u>
        </div>
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
        
        <table border="1" class="table table-bordered">
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
              <td><?php echo $pecah['nama_paketwisata']; ?> (<?php echo $pecah['lama_paket']; ?>)</td>
              <td>Rp. <?php echo number_format($pecah['harga_paket']); ?></td>
              <td><?php echo $pecah['jumlah']; ?></td>
              <td>
                Rp. <?php echo number_format($pecah['harga_paket']*$pecah['jumlah']); ?>
              </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
          </tbody>
        </table><br><br>
        <h5>Sudah dikonfirmasi oleh:</h5>
        <h4>Kepala Bagian Operasional Paket Wisata</h4>
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
  <textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
  <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
  <script type="text/javascript">
    function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
    }
</script>
</html>