<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Kriteria</h6>
    </div>

    <div class="card-body">

		<?php

		$ambil=$koneksi->query("SELECT * FROM tb_kriteria WHERE id_kriteria='$_GET[id]'");
		$pecah=$ambil->fetch_assoc();

		?>


		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Kriteria</label>
				<input type="text" class="form-control" name="nama_kriteria" value="<?php echo $pecah['nama_kriteria']; ?>">
			</div>

			<div class="form-group">
				<label>Atribut</label>
				<select name="atribut" class="form-control">
					<?php if ($pecah['atribut']=='Cost'){
						echo "<option value='cost' selected>Cost</option>
							  <option value='benefit'>Benefit</option>";
					}else{
						echo "<option value='cost'>Cost</option>
							  <option value='benefit' selected>Benefit</option>";
					} 
					?>
				</select>
			</div>
			<button class="btn btn-primary" name="ubah">Simpan</button>
		</form>
	</div>
</div>

<?php
if (isset($_POST['ubah'])) 
{
	$koneksi->query("UPDATE tb_kriteria set nama_kriteria='$_POST[nama_kriteria]', atribut='$_POST[atribut]' WHERE id_kriteria='$_GET[id]'");
	echo "<div class='alert alert-info'>Data Berhasil Diubah</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=kriteria'>";
}
?>
