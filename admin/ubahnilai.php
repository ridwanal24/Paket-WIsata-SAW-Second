<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Nilai</h6>
    </div>

    <div class="card-body">
<?php
$ambil=$koneksi->query("SELECT * FROM tb_nilai WHERE id_nilai='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

//echo "<pre>";
//print_r($pecah);
//echo "</pre>";
?>

<?php 
$datakriteria = array();

$ambil = $koneksi->query("SELECT * FROM tb_kriteria");
while ($tiap = $ambil->fetch_assoc()) 
{
	$datakriteria[] = $tiap;
}
//echo "<pre>";
//print_r($datakriteria);
//echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Kriteria</label>
		<select class="form-control" name="id_kriteria">
			<option value="">--Pilih Kriteria--</option>
			<?php foreach ($datakriteria as $key => $value): ?>
			<option value="<?php echo $value["id_kriteria"] ?>" <?php if ($pecah["id_kriteria"]==$value["id_kriteria"])echo "selected"; ?>>
				<?php echo $value["nama_kriteria"]; ?>
			</option>
			<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Nama Nilai</label>
		<input type="text" class="form-control" name="nama_nilai" value="<?php echo $pecah['nama'] ?>">
	</div>
	<div class="form-group">
		<label>Nilai</label>
		<input type="text" class="form-control" name="nilai" value="<?php echo $pecah['nilai'] ?>">
	</div>
	<div class="form-group">
		<label>Keterangan</label>
		<input type="text" class="form-control" name="keterangan" value="<?php echo $pecah['keterangan'] ?>">
	</div>
	<button class="btn btn-primary" name="ubah">Simpan</button>
</form>
</div>
</div>

<?php
if (isset($_POST['ubah'])) 
{

	$koneksi->query("UPDATE tb_nilai SET nama='$_POST[nama_nilai]', nilai='$_POST[nilai]', keterangan='$_POST[keterangan]' id_nilai=$_POST[id_nilai] WHERE id_kriteria='$_GET[id]'");
	
	echo "<script>alert('Data nilai telah diubah');</script>";
	echo "<script>location='index.php?page=nilai';</script>";
}
?>
