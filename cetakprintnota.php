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
  <body>
    <! -- konten -->
    <section class="site-section">
      <div class="container">
        <?php $ambil=$koneksi->query("SELECT * FROM tb_pemesanan JOIN tb_pelanggan ON tb_pemesanan.id_pelanggan=tb_pelanggan.id_pelanggan JOIN tb_paketwisata ON tb_pemesanan.id_paketwisata=tb_paketwisata.id_paketwisata WHERE id_pemesanan='$_GET[id]'"); ?>
        <?php $pecah = $ambil->fetch_assoc() ?>
        <a href="cetaknota1.php?id=<?php echo $pecah["id_pemesanan"] ?>" target="_blank" class="btn btn-primary" name="cetak"><i class="fas fa-print"></i>  PDF
        </a>
         <a href="cetakprintnota.php?id=<?php echo $pecah["id_pemesanan"] ?>" target="_blank" class="btn btn-primary" name="cetak"><i class="fas fa-print"></i>  Cetak
        </a>
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
              <td><?php echo $pecah['nama_paketwisata']; ?> (<?php echo $pecah['lama_paket']; ?>)</td>
              <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
              <td><?php echo $pecah['jumlah']; ?></td>
              <td>
                Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah']); ?>
              </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
          </tbody>
        </table><br><br>
        <h5>Sudah dikonfirmasi oleh:</h5>
        <h4>Kepala Bagian Operasional Paket Wisata</h4>
        <div class="row mb-5"></div>
    
  </body>
</html>
<script type="text/javascript">
      window.print();
    </script>