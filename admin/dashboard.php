<?php
  
  //koneksi ke database
  include '../koneksi.php';

  $ambil1 = $koneksi->query("SELECT * FROM tb_paketwisata");
  $ambil2 = $koneksi->query("SELECT * FROM tb_wisata");
  $ambil3 = $koneksi->query("SELECT * FROM tb_pemesanan");
  $ambil4 = $koneksi->query("SELECT * FROM tb_pembayaran");
  $ambil5 = $koneksi->query("SELECT * FROM tb_pembatalan");
  $ambil6 = $koneksi->query("SELECT * FROM tb_pelanggan");

  $jml_paketwisata = mysqli_num_rows($ambil1);
  $jml_wisata = mysqli_num_rows($ambil2);
  $jml_pemesanan = mysqli_num_rows($ambil3);
  $jml_pembayaran = mysqli_num_rows($ambil4);
  $jml_pembatalan = mysqli_num_rows($ambil5);
  $jml_pelanggan = mysqli_num_rows($ambil6);

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <marquee><h6 class="m-0 font-weight-bold text-primary">Selamat Datang Administrator</h6></marquee>
    </div>
    
    <div class="card-body">

    <!-- Content Row -->
    <div class="row">

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Paket</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_paketwisata,0,",","."); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
        	</div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
		    <div class="card border-left-success shadow h-100 py-2">
    		  <div class="card-body">
            <div class="row no-gutters align-items-center">
             	<div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Wisata</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_wisata,0,",","."); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
        	</div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pemesanan</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format($jml_pemesanan,0,",","."); ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
              	<div class="col mr-2">
                	<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pembayaran</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_pembayaran,0,",","."); ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
              </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pembatalan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_pembatalan,0,",","."); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pelanggan Daftar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_pelanggan,0,",","."); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>