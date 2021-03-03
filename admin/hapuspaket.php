<?php
// cek ada/tidak paketwisata di tb_paketwisata
$ambil = $koneksi->query("SELECT * FROM tb_paketwisata WHERE id_paketwisata='$_GET[id]'");

// jika ada
while($pecah = $ambil->fetch_assoc()){
    // hapus paketwisata yang dimaksud di tb_paketwisata
    $koneksi->query("DELETE FROM tb_paketwisata WHERE id_paketwisata='$_GET[id]'");
    // cek apakah masih ada id_paketwisata_grup yang sama dengan data yang dihapus
    $query = $koneksi->query("SELECT * FROM tb_paketwisata WHERE id_paketwisata_grup='$pecah[id_paketwisata_grup]'");
    // jika tidak ada
    if(mysqli_num_rows($query) == 0){
        // hapus data di tb_paketwisata_grup
        $koneksi->query("DELETE FROM tb_paketwisata_grup WHERE id_paketwisata_grup='$pecah[id_paketwisata_grup]'");
    }
}

echo "<script>alert('Data Terhapus');</script>";
echo "<script>location='index.php?page=paketwisata';</script>";
?>