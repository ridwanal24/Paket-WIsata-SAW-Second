<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Pelanggan</h6>
    </div>

    <div class="card-body">
<?php
$ambil=$koneksi->query("SELECT * FROM tb_pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah=$ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama_pelanggan" value="<?php echo $pecah['nama']; ?>">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="form-control" name="alamat" rows="10"> <?php echo $pecah['alamat']; ?></textarea>
	</div>
	<div class="form-group">
		<label>Telepon</label>
		<input type="number" class="form-control" name="telepon" value="<?php echo $pecah['telepon']; ?>">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="email" value="<?php echo $pecah['email']; ?>">
	</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" value="<?php echo $pecah['username']; ?>">
	</div>
	<button class="btn btn-primary" name="ubah">Simpan</button>
</form>
</div>
</div>

<?php
if (isset($_POST['ubah'])) 
{
	$koneksi->query("UPDATE tb_pelanggan set nama='$_POST[nama_pelanggan]',alamat='$_POST[alamat]', telepon='$_POST[telepon]', email='$_POST[email]',  username='$_POST[username]', password='$_POST[password]' WHERE id_pelanggan='$_GET[id]'");
	echo "<div class='alert alert-info'>Data Berhasil Diubah</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=pelanggan'>";
}
?>