<?php 
$datapaketwisata = array();

$ambil = $koneksi->query("SELECT * FROM tb_paketwisata");
while ($tiap = $ambil->fetch_assoc()) 
{
	$datapaketwisata[] = $tiap;
}
//echo "<pre>";
//print_r($datapaketwisata);
//echo "</pre>";

$error_nama = "";

$nama_wisata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (empty($_POST["nama_wisata"])) 
	{
		$error_nama = "Nama tidak boleh kosong";
	}
	else
	{
		$nama_wisata = cek_input($_POST["nama_wisata"]);
		if (!preg_match("/^[a-zA-Z]*$/",$nama_wisata)) 
		{
			$error_nama = "Inputan hanya boleh huruf dan spasi";
		}
	}
}

function cek_input($data)
{
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<style>
	.warning {color: #FF0000;}
</style>

<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Wisata</h6>
    </div>

    <div class="card-body">
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="form-group">
		<label>Nama Paket</label>
		<select class="form-control" name="id_paketwisata">
			<option value="">--Pilih Paket--</option>
			<?php foreach ($datapaketwisata as $key => $value): ?>
			<option value="<?php echo $value["id_paketwisata"] ?>"><?php echo $value["nama_paketwisata"]; ?></option>
		<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Nama Wisata</label>
		<input type="text" class="form-control <?php echo($error_nama !="" ? "is-invalid": ""); ?>" name="nama_wisata"><span class="warning"><?php echo $error_nama; ?></span>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
</div>
</div>

<?php  
	echo "<h2>Your Input:</h2>";
	echo "Nama = ".$nama_wisata;
	echo "<br>";
?>

<?php
if (isset($_POST['save'])) 
{
	$nama = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../foto_wisata/".$nama);
	$koneksi->query("INSERT INTO tb_wisata (id_paketwisata, nama, foto) 
		VALUES('$_POST[id_paketwisata]','$_POST[nama_wisata]','$nama')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=wisata'>";
}
?>