<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Pelanggan</h6>
    </div>

    <div class="card-body">
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="Nama">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="form-control" name="Alamat" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label>Telepon</label>
		<input type="number" class="form-control" name="Telepon">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="Email">
	</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="Username">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="text" class="form-control" name="Password">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
</div>
</div>

<?php
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO tb_pelanggan (nama, alamat, telepon, email, username, password) VALUES('$_POST[Nama]','$_POST[Alamat]','$_POST[Telepon]','$_POST[Email]','$_POST[Username]','$_POST[Password]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=pelanggan'>";
}
?>
