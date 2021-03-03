<?php 

// menghapus semua session
session_destroy();
echo "<script>alert('anda telah logout');</script>";
echo "<script>location='login.php';</script>";

// mengalihkan halaman sambil mengirim pesan logout
header("location:../index.php?pesan=logout");
?>