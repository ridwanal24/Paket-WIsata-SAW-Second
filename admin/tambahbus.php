<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Bus</h6>
    </div>

    <div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Bus</label>
				<input type="text" class="form-control" name="nama_bus">
			</div>
			<div class="form-group">
				<label>Fasilitas Bus</label>
				<textarea class="ckeditor" id="ckeditor" name="fasilitas" rows="10"></textarea>
			</div>
			<button class="btn btn-primary" name="save">Simpan</button>
		</form>
	</div>
</div>
<script src="ckeditor/ckeditor.js"></script>

<?php
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO tb_bus (nama, lama_paket, fasilitas_bus) VALUES('$_POST[nama_bus]','$_POST[fasilitas]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=bus'>";
}
?>
