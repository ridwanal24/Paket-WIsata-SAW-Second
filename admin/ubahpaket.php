<?php 
$databus = array();

$ambil = $koneksi->query("SELECT * FROM tb_bus");
while ($tiap = $ambil->fetch_assoc()) 
{
	$databus[] = $tiap;
}
//echo "<pre>";
//print_r($databus);
//echo "</pre>";
?>

<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Paket</h6>
    </div>

    <div class="card-body">
<?php
$ambil=$koneksi->query("SELECT * FROM tb_paketwisata LEFT JOIN tb_bus ON tb_paketwisata.id_bus=tb_bus.id_bus WHERE id_paketwisata='$_GET[id]'");
$pecah=$ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Paket</label>
		<input type="text" class="form-control" name="nama_paket" value="<?php echo $pecah['nama_paketwisata']; ?>">
	</div>
	<div class="form-group">
		<label>Lama Tour</label>
		<input type="text" class="form-control" name="lama_tour" value="<?php echo $pecah['lama_paket']; ?>">
	</div>
	<div class="form-group">
		<label>Fasilitas</label>
		<textarea class="ckeditor" id="ckeditor" name="fasilitas" rows="10"> <?php echo $pecah['fasilitas']; ?></textarea>
	</div>
	<div class="form-group">
		<label>Nama Bus</label>
		<select class="form-control" name="id_bus">
			<option value="">--Pilih Bus--</option>
			<?php foreach ($databus as $key => $value): ?>
			<option value="<?php echo $value["id_bus"] ?>" <?php if ($pecah["id_bus"]==$value["id_bus"])echo "selected"; ?>>
				<?php echo $value["nama"]; ?>	
			</option>
		<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_paket']; ?>">
	</div>
	<button class="btn btn-primary" name="ubah">Simpan</button>
</form>
</div>
</div>
<script src="ckeditor/ckeditor.js"></script>

<?php
if (isset($_POST['ubah'])) 
{
	$koneksi->query("UPDATE tb_paketwisata set nama_paketwisata='$_POST[nama_paket]',lama_paket='$_POST[lama_tour]', fasilitas='$_POST[fasilitas]', id_bus='$_POST[id_bus]' harga_paket='$_POST[harga]' WHERE id_paketwisata='$_GET[id]'");
	echo "<div class='alert alert-info'>Data Berhasil Diubah</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=paketwisata'>";
}
?>