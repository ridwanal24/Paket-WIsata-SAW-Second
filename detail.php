<?php
  
  session_start();

  //koneksi ke database
  include 'koneksi.php';

  //mendapatkan id_paketwisata dari url
  $id_paketwisata = $_GET["id"];

  //query ambil data
  $ambil = $koneksi->query("SELECT * FROM tb_paketwisata JOIN tb_bus ON tb_paketwisata.id_bus=tb_bus.id_bus WHERE id_paketwisata='$id_paketwisata'");
  $detail = $ambil->fetch_assoc();

  // print_r($detail);
  // die();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.png" />
    <title>PO Tami Jaya - Detail</title>
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
          <div class="col-md-1"></div>
          <div class="col-md-5">
            <div class="heading-wrap text-center element-animate">
              <h3><?php echo $detail["nama_paketwisata"]; ?> (<?php echo $detail['lama_paket']; ?>)</h3>
              <h4>Rp. <?php echo number_format($detail["harga_paket"]); ?>/bus</h4>
              <div class="container">
                <form method="post">
              <div class="form-group">
                <div class="input-group">
                  <input type="number" min="1" class="form-control" name="jumlah" required>
                  <div class="input-group-btn">
                    <button class="btn btn-primary" name="pesan">Pesan</button>
                  </div>
                </div>
              </div>
            </form>
              </div>
            </div>
          </div>
           <?php 
              //jika ada tombol pesan
            if (isset($_POST["pesan"])) 
            {
              //mendapatkan jumlah yang diinputkan
              $jumlah = $_POST["jumlah"];
              //masukan di keranjang pemesanan
              $_SESSION["keranjang"][$id_paketwisata] = $jumlah;

              echo "<script>alert('paket telah masuk ke keranjang pemesanan');</script>";
              echo "<script>location='pemesanan.php';</script>";
            }
            ?>
          <div class="col-md-1"></div>
            <div class="col-md-4"><h3>Fasilitas: </h3>
              <p><?php echo $detail["fasilitas"]; ?></p>
              <p><?php echo $detail["nama"]; ?>: <?php echo $detail["fasilitas_bus"]; ?></p>
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