<?php
session_start();
include 'koneksi.php';

// data processing
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check username if exist
if(isset($_POST['cek_username'])){
    $query = $koneksi->query("SELECT * FROM tb_pelanggan WHERE username='$_POST[username]'");
    echo mysqli_num_rows($query);
}

// Check email if exist
if(isset($_POST['cek_email'])){
    $query = $koneksi->query("SELECT * FROM tb_pelanggan WHERE email='$_POST[email]'");
    echo mysqli_num_rows($query);
}

if (isset($_POST['save'])) {
    //mengambil isian nama, alamat, telepon, email, username, password
    $nama = test_input($_POST["nama"]);
    $alamat = test_input($_POST["alamat"]);
    $telepon = test_input($_POST["telepon"]);
    $email = test_input($_POST["email"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    // cek captcha
    if($_SESSION['code'] != $_POST['kodecaptcha']){
        $url = "location: buatakun.php?captcha_failed=true";
        header($url."&nama=".$nama."&alamat=".$alamat."&telepon=".$telepon."&email=".$email."&username=".$username);
    } else {
        
        // cek apakah email dan username sudah digunakan
        $cek_email = $koneksi->query("SELECT * FROM tb_pelanggan WHERE email='$email'");
        $cek_username = $koneksi->query("SELECT * FROM tb_pelanggan WHERE username='$username'");
        $matched_email = $cek_email->num_rows;
        $matched_username = $cek_username->num_rows;
        
        // cek email
        if ($matched_email >= 1) 
        {
            $url = "location: buatakun.php";
            echo "<script>alert('Pendaftaran Gagal, EMAIL sudah digunakan');</script>";
            header($url."?nama=".$nama."&alamat=".$alamat."&telepon=".$telepon."&username=".$username);
        }
        
        // cek username
        else if($matched_username >= 1){
            $url = "location: buatakun.php";
            echo "<script>alert('Pendaftaran Gagal, USERNAME sudah digunakan');</script>";
            header($url."?nama=".$nama."&alamat=".$alamat."&telepon=".$telepon."&email=".$email);
        
        // jika memenuhi syarat, masukkan data ke database
        } else {
            //query insert ke tabel pelanggan
            $koneksi->query("INSERT INTO tb_pelanggan (nama, alamat, telepon, email, username, password) VALUES ('$nama','$alamat','$telepon','$email','$username','$password')");
            echo "<script>alert('Pendaftaran berhasil, silahkan login');</script>";
            echo "<script>location='login.php';</script>";
        }
    }
}