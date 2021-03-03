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
    <title>PO Tami Jaya - Checkout</title>
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
        <h1>Keranjang Pemesanan</h1>

        <hr>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Paket</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Subharga</th>
            </tr>
          </thead>
          <tbody>

            <?php $nomor=1; ?>
            <?php $totalpembayaran = 0; ?>
            <?php foreach ($_SESSION["keranjang"] as $id_paketwisata => $jumlah):  ?>
            <!-- Menampilkan paket yang sedang diperulangkan berdasarkan id_paketwisata -->
            <?php
              $ambil = $koneksi->query("SELECT * FROM tb_paketwisata WHERE id_paketwisata='$id_paketwisata'");
              $pecah = $ambil->fetch_assoc();
              $subharga = $pecah["harga_paket"]*$jumlah;
            ?>

            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $pecah["nama_paketwisata"]; ?> (<?php echo $pecah['lama_paket']; ?>)</td>
              <td>Rp. <?php echo number_format($pecah["harga_paket"]); ?></td>
              <td><?php echo $jumlah; ?></td>
              <td>Rp. <?php echo number_format($subharga); ?></td>
            </tr>
              <?php $nomor++; ?>
              <?php $totalpembayaran+=$subharga; ?>
              <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="4">Total Pembayaran</th>
              <th>Rp. <?php echo number_format($totalpembayaran); ?> </th>
            </tr>
          </tfoot>
        </table>

        <?php  

        if (isset($_POST["lihat"])) 
        {
          foreach ($_SESSION["keranjang"] as $id_paketwisata => $jumlah):

            $tgl_tour = $_POST["tanggal_tour"];
            $newTanggalTour = strtotime("$tgl_tour");
        
            $ambil = $koneksi->query("SELECT lama_paket FROM tb_paketwisata WHERE id_paketwisata='$id_paketwisata'");
            $pecah = $ambil->fetch_assoc();

            $jumlah_hari = $pecah["lama_paket"];
            $new_jumlah_hari = 86400 * $jumlah_hari;

            $hasil_jumlah = $newTanggalTour+$new_jumlah_hari;
            $tampilhasil = date("Y-m-d", $hasil_jumlah);
          endforeach;
        }
        ?>

        <form method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" readonly value="<?php echo$_SESSION["pelanggan"]['nama'] ?>" class="form-control" >
              </div>
            </div>
         
            <div class="col-md-6">
              <div class="form-group">
                <label>Telepon</label>
                <input type="number" readonly value="<?php echo$_SESSION["pelanggan"]['telepon'] ?>" class="form-control" >
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" readonly value="<?php echo$_SESSION["pelanggan"]['alamat'] ?>" class="form-control" >
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text " readonly value="<?php echo$_SESSION["pelanggan"]['email'] ?>" class="form-control" >
              </div>
            </div>
        
            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal Tour</label>
                <input type="date" name="tanggal_tour" class="form-control" required value="<?php echo $tgl_tour ?>">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label>&nbsp;</label><br>
                <button class="btn btn-secondary" name="lihat">OK</button>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Selesai Tour</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="<?php echo $tampilhasil ?>"> 
              </div>
            </div>
        </div>
        <button class="btn btn-primary" name="checkout">Checkout</button>
        </form>
    
        <?php
        if (isset($_POST["checkout"])) 
        {
          $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
          $tanggal_pemesanan = date("Y-m-d");
          $tanggal_tour = $_POST["tanggal_tour"];
          $tanggal_selesai = $_POST["tanggal_selesai"];

          // 1. Menyimpan ke tabel pemesanan
          $koneksi->query("INSERT INTO tb_pemesanan (id_pelanggan, id_paketwisata, tanggal_pesan, tanggal_tour, tanggal_selesai_tour, total_pemesanan) VALUES ('$id_pelanggan', '$id_paketwisata', '$tanggal_pemesanan', '$tanggal_tour', '$tanggal_selesai', '$totalpembayaran') ");

          // mendapatkan id_pelanggan barusan terjadi
          $id_pemesanan_barusan = $koneksi->insert_id;

          foreach ($_SESSION["keranjang"] as $id_paketwisata => $jumlah) 
          {
            $koneksi->query("INSERT INTO tb_pemesanan_paket (id_pemesanan, id_paketwisata, jumlah) VALUES ('$id_pemesanan_barusan', '$id_paketwisata', '$jumlah') ");
          }

          // mengosongkan keranjang pemesanan
          unset($_SESSION["keranjang"]);

          //tampilan dialihkan ke halaman nota, nota dari pembelian yang barusan
          echo "<script>alert('pemesanan sukses');</script>";
          echo "<script>location='riwayat.php';</script>";
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