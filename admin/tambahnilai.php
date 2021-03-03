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

<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Nilai</h6>
    </div>

    <div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Kriteria</label>
				<select class="form-control" name="id_kriteria">
					<option value="">--Pilih Kriteria--</option>
					<?php foreach ($datakriteria as $key => $value): ?>
					<option value="<?php echo $value["id_kriteria"] ?>"><?php echo $value["nama_kriteria"]; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label>Nama Nilai</label>
				<input type="text" class="form-control" name="nama_nilai">
			</div>
			<div class="form-group">
				<label>Nilai</label>
				<input type="text" class="form-control" name="nilai">
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" class="form-control" name="keterangan">
			</div>
			<button class="btn btn-primary" name="save">Simpan</button>
		</form>
	</div>
</div>

<?php
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO tb_nilai (id_kriteria, lama_paket, fasilitas, harga) VALUES('$_POST[nama_kriteria]','$_POST[nama_nilai]','$_POST[nilai]','$_POST[keterangan]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=nilai'>";
}
?>
