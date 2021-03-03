<?php 
$datapaketwisata = array();

// $ambil = $koneksi->query("SELECT * FROM tb_paketwisata"); // Yang Asli
$ambil = $koneksi->query("SELECT * FROM tb_paketwisata WHERE id_paketwisata NOT IN(SELECT id_paketwisata FROM tb_alternatif)"); // Edited
while ($tiap = $ambil->fetch_assoc()) 
{
	$datapaketwisata[] = $tiap;
}
//echo "<pre>";
//print_r($datasubkriteria);
//echo "</pre>";
?>

<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Alternatif</h6>
    </div>

    <div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Alternatif</label>
				<select class="form-control" name="id_paketwisata">
					<option value="">--Pilih Paket--</option>
					<?php foreach ($datapaketwisata as $key => $value): ?>
					<option value="<?php echo $value["id_paketwisata"] ?>"><?php echo $value["nama_paketwisata"]; ?></option>
					<?php endforeach ?>
				</select>
			</div>


			<div class="form-group">
				<label>Harga (C1)</label>
				<select class="form-control" name="hrg">
					<option value="">--Pilih Harga--</option>
					<?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='1' order by id_subkriteria asc;");
						while ($setiap = $ambil2->fetch_assoc()) { 
					?>
					<option value="<?php echo $setiap["bobot_subkriteria"] ?>"><?php echo $setiap["nama"]; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label>Jumlah Wisata (C2)</label>
				<select class="form-control" name="jml_wisata">
					<option value="">--Pilih Jumlah Wisata--</option>
					<?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='3' order by id_subkriteria asc;");
						while ($setiap = $ambil2->fetch_assoc()) { 
					?>
					<option value="<?php echo $setiap["bobot_subkriteria"] ?>"><?php echo $setiap["nama"]; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label>Lama Tour (C3)</label>
				<select class="form-control" name="lm_tour">
					<option value="">--Pilih Lama Tour --</option>
					<?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='4' order by id_subkriteria asc;");
						while ($setiap = $ambil2->fetch_assoc()) { 
					?>
					<option value="<?php echo $setiap["bobot_subkriteria"] ?>"><?php echo $setiap["nama"]; ?></option>
					<?php } ?>
				</select>
			</div>
			<button class="btn btn-primary" name="save">Simpan</button>
		</form>
	</div>
</div>

<?php
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO tb_alternatif (id_paketwisata, harga, jumlah_wisata, lama_tour) VALUES('$_POST[id_paketwisata]','$_POST[hrg]','$_POST[jml_wisata]','$_POST[lm_tour]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=alternatif'>";
}
?>
