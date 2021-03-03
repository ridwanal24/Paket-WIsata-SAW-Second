<?php 
session_start();
include 'koneksi.php';

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if (isset($_POST["login"])) 
    {
      if($_SESSION['code'] != $_POST['kodecaptcha']){
        header('location: login.php?captcha_failed=true');
      } else{
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);

        //lakukan query ngecek akun di tabel pelanggan di database 
        $ambil = $koneksi->query("SELECT * FROM tb_pelanggan WHERE username='$username' AND password='$password'");

        // ngitung akun yang terambil
        $akunyangcocok = $ambil->num_rows;

        //jika 1 akun yang cocok, maka akan diloginkan
        if ($akunyangcocok==1) 
        {
          //anda sukses login
          //mendapatkan akun dalam bentuk array
          $akun = $ambil->fetch_assoc();
          //simpan di session pelanggan
          $_SESSION["pelanggan"] = $akun;
          echo "<script>alert('anda sukses login');</script>";

          //jika sudah belanja
          if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
          {
            echo "<script>location='checkout.php';</script>";
          }
          else
          {
            echo "<script>location='riwayat.php';</script>";
          }
        }
        else
        {
        //anda gagal login
        echo "<script>alert('anda gagal login, periksa akun Anda');</script>";
        echo "<script>location='login.php';</script>";
        }
      }
    }