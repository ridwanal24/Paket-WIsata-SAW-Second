<?php
session_start();
include '../koneksi.php';

if (isset($_POST['login'])) 
{
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $captcha = $_POST['captcha'];

    if($captcha != $_SESSION['vercode']){
        header('location: login.php?captcha_salah=hehe&user='.$username);
    } else {
        $ambil = $koneksi->query("SELECT * FROM tb_user WHERE username='$username' AND password = '$password'");
        $yangcocok = $ambil->num_rows;
        if ($yangcocok==1) 
        {
            $_SESSION['admin']=$ambil->fetch_assoc();
            echo "<script>alert('Login Sukses');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php'>";
        }
        else
        {
            echo "<script>alert('Login Gagal');</script>";
            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
        }
    }
}