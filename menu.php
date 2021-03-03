<header role="banner">
      <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
          <a class="navbar-brand"><img src="images/logo.png" width="90px" height="80px"></a> 
          <a class="navbar-brand">Tami Jaya Tours</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
            <ul class="navbar-nav ml-auto pl-lg-5 pl-0">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="transaksi.php" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Paket Wisata</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <a class="dropdown-item" href="wisata.php">Daftar Wisata</a>
                  <a class="dropdown-item" href="rekomendasi.php">Rekomendasi Paket Wisata ?</a>
                  <a class="dropdown-item" href="rekomendasi_2_option.php">Rekomendasi Paket Wisata (new)</a>
                </div>
              </li>

              <!-- jika sudah login (ada session pelanggan) -->
              <?php if (isset($_SESSION["pelanggan"])): ?>
              <li class="nav-item">
                <a class="nav-link" href="profil.php">Kelola Profil</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="transaksi.php" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Transaksi</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <a class="dropdown-item" href="pemesanan.php">Pemesanan</a>
                  <a class="dropdown-item" href="riwayat.php">Riwayat</a>
                </div>
              </li>

              <li class="nav-item cta">
                <a class="nav-link" href="logout.php"><span>LOGOUT</span></a>
              </li>

              <!-- selain itu (blm login (blm ada session pelanggan) ) -->

              <?php else: ?>
              <li class="nav-item cta">
                <a class="nav-link" href="login.php"><span>LOGIN</span></a>
              </li>
              <?php endif ?>
            </ul>
            
          </div>

        </div>

      </nav>
    </header>