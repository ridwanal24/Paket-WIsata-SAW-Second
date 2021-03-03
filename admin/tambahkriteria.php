<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Kriteria</h6>
    </div>

    <div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Kriteria</label>
				<input type="text" class="form-control" name="nama_kriteria">
			</div>

			<div class="form-group">
				<label class="control-label text-left">Atribut</label>
				<select class="form-control" title="Pilih Atribut" name="atribut">
					<option value="cost">Cost</option>
					<option value="benefit">Benefit</option>
				</select>
			</div>
			<button class="btn btn-primary" name="save">Simpan</button>
		</form>
	</div>
</div>

<?php
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO tb_kriteria (nama_kriteria, atribut) VALUES('$_POST[nama_kriteria]','$_POST[atribut]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=kriteria'>";
}
?>
						