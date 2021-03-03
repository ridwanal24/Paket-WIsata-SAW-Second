<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Wisata</h6>
    </div>

    <div class="card-body">
<?php
$ambil=$koneksi->query("SELECT * FROM tb_wisata WHERE id_wisata='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

//echo "<pre>";
//print_r($pecah);
//echo "</pre>";
?>

<?php 
$datapaketwisata = array();

$ambil = $koneksi->query("SELECT * FROM tb_paketwisata");
while ($tiap = $ambil->fetch_assoc()) 
{
	$datapaketwisata[] = $tiap;
}
echo "<pre>";
print_r($datapaketwisata);
echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Paket</label>
		<select class="form-control" name="id_paketwisata">
			<option value="">--Pilih Paket--</option>
			<?php foreach ($datapaketwisata as $key => $value): ?>
			<option value="<?php echo $value["id_paketwisata"] ?>" <?php if ($pecah["id_paketwisata"]==$value["id_paketwisata"])echo "selected"; ?>>
				
				<?php echo $value["nama_paketwisata"]; ?>
					
			</option>
		<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Nama Wisata</label>
		<input type="text" class="form-control" name="nama_wisata" value="<?php echo $pecah['nama']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_wisata/<?php echo $pecah['foto'] ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="ubah">Simpan</button>
</form>
</div>
</div>

<?php
if (isset($_POST['ubah'])) 
{
	$nama = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	//jika foto diubah
	if (!empty($lokasi)) 
	{
		move_uploaded_file($lokasi, "../foto_wisata/".$nama);
		$koneksi->query("UPDATE tb_wisata SET nama='$_POST[nama_wisata]', foto='$nama', id_paketwisata=$_POST[id_paketwisata] WHERE id_wisata='$_GET[id]'");
	}
	else 
	{
		$koneksi->query("UPDATE tb_wisata SET nama='$_POST[nama_wisata]', id_paketwisata=$_POST[id_paketwisata] WHERE id_wisata='$_GET[id]'");
	}
	echo "<script>alert('Data wisata telah diubah');</script>";
	echo "<script>location='index.php?page=wisata';</script>";
}
?>
