<?php

  session_start();
  //koneksi ke database
  include 'koneksi.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <style>
      .warning {color: #FF0000;}
    </style>

    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.png" />
    <title>PO Tami Jaya - Buat Akun</title>
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

    <?php  
      $namaErr = "";
      $alamatErr = "";
      $teleponErr = "";
      $emailErr = "";
    
      $nama = "";
      $alamat = "";
      $telepon = "";
      $email = "";
      $username = "";
      $password = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nama"])) 
        {
          $namaErr = "Nama harus diisi";
        }
        else
        {
          $nama = test_input($_POST["nama"]);
          if (!preg_match("/^[a-zA-Z]*$/",$nama))
          {
            $namaErr = "Nama hanya boleh huruf dan spasi";
          }
        }

        if (empty($_POST["alamat"])) {
          $alamatErr = "Alamat harus diisi";
        } else {
          $alamat = test_input($_POST["alamat"]);
        }

        if (empty($_POST["telepon"])) {
          $teleponErr = "Telepon harus diisi";
        } else{
          $telepon = test_input($_POST["telepon"]);
          if (!is_numeric($telepon)) {
            $teleponErr = "Telepon hanya boleh angka";
          }
        }

        if (empty($_POST["email"])) {
          $emailErr = "Email harus diisi";
        } else{
          $nama = test_input($_POST["email"]);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email salah";
          }
        }

        if (empty($_POST["username"])) {
          $username = "";
        } else {
          $username = test_input($_POST["username"]);
        }

        if (empty($_POST["password"])) {
          $password = "";
        } else {
          $password = test_input($_POST["password"]);
        }

      }

      function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-5">Buat Akun Baru</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="nama">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control <?php echo ($namaErr !="" ? "is-invalid" : ""); ?>" value="<?php echo $nama; ?>">
                      <span class="warning">* <?php echo $namaErr; ?></span>
                      <br><br>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="alamat">Alamat</label>
                      <textarea name="alamat" class="form-control " cols="30" rows="8"><?php echo $alamat; ?></textarea>
                      <br><br>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="telepon">Telepon</label>
                      <input type="number" name="telepon" class="form-control" value="<?php echo $telepon; ?>">
                      <span class="error">* <?php echo $teleponErr; ?></span>
                      <br><br>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                      <span class="error">* <?php echo $emailErr; ?></span>
                      <br><br>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="username">Username</label>
                      <input type="username" name="username" class="form-control" value="<?php echo $username; ?>">
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <button class="btn btn-primary" name="save" type="submit">Simpan</button>
                    </div>
                  </div>
                </form>

                <?php  
                  echo "<h2>Your Input:</h2>";
                  echo $nama;
                  echo "<br>";
                  echo $alamat;
                  echo "<br>";
                  echo $telepon;
                  echo "<br>";
                  echo $email;
                  echo "<br>";
                  echo $username;
                  echo "<br>";
                  echo $password;
                  echo "<br";
                ?>

                <?php
                  if (isset($_POST['save'])) 
                  {
                    //mengambil isian nama, alamat, telepon, email, username, password
                    $nama = $_POST["nama"];
                    $alamat = $_POST["alamat"];
                    $telepon = $_POST["telepon"];
                    $email = $_POST["email"];
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    //cek apakah email sudah digunakan
                    $ambil = $koneksi->query("SELECT * FROM tb_pelanggan WHERE email='$email'");
                    $yangcocok = $ambil->num_rows;
                    if ($yangcocok==1) 
                    {
                      echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
                      echo "<script>location='buatakun.php';</script>";
                    }
                    else
                    {
                      //query insert ke tabel pelanggan
                      $koneksi->query("INSERT INTO tb_pelanggan (nama, alamat, telepon, email, username, password) VALUES ('$nama','$alamat','$telepon','$email','$username','$password')");
                      echo "<script>alert('pendaftaran berhasil, silahkan login');</script>";
                      echo "<script>location='login.php';</script>";
                    }
                  }
                ?> 
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