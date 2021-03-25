<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Paket Wisata</h6>
	</div>

	<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<!--	
		Select ini berfungsi untuk melakukan switch, apakah mau menambah paket wisata baru atau menambah variasi pilihan
		dari paket yang sudah ada.
	 -->
			<div class="form-group">
				<label>Opsi</label>
				<select class="form-control" name="pilihan-paket">
					<option value="paket-baru">Tambah Paket Wisata Baru</option>
					<option value="pilihan-baru">Tambah Paket Wisata Yang Sudah Ada</option>
				</select>
			</div>
			<!-- =========================================================================== -->

			<!--
		Select ini berfungsi untuk mengambil data dari table paket wisata grup
		Hanya akan tampil jika memilih "Tambah Paket Wisata Yang Sudah Ada" pada opsi diatas
	-->
			<div class="form-group nama-11">
				<label>Nama</label>
				<select class="form-control" name="nama_paket_yang_ada">
					<?php
					$query = $koneksi->query("SELECT * FROM tb_paketwisata_grup");
					while ($row = $query->fetch_assoc()) {
					?>
						<option value="<?php echo $row['id_paketwisata_grup']; ?>"><?php echo $row['nama_paketwisata']; ?></option>
					<?php } ?>
				</select>
			</div>
			<!-- =========================================================================== -->

			<!--
		Input ini berfungsi untuk mengambil data dari table paket wisata grup
		Hanya akan tampil jika memilih Tambah Paket Wisata Baru
	-->
			<div class="form-group nama-22">
				<label>Nama</label>
				<input type="text" class="form-control" name="nama_paket">
			</div>
			<!-- =========================================================================== -->

			<div class="form-group">
				<label>Lama Tour</label>
				<input type="text" class="form-control" name="lama_tour">
			</div>
			<div class="form-group">
				<label>Fasilitas</label>
				<textarea class="ckeditor" id="ckeditor" name="fasilitas" rows="10"></textarea>
			</div>
			<div class="form-group">
				<label>Harga (Rp)</label>
				<input type="number" class="form-control" name="harga">
			</div>
			<button class="btn btn-primary" name="save">Simpan</button>
		</form>
	</div>
</div>
<script src="ckeditor/ckeditor.js"></script>

<!--
	-- Mekanisme --
	Saat tombol save di klik :
	- Jika Memilih Tambah Paket Baru
	  - Memasukan nama paket wisata ke tb_paketwisata_grup
	  - Ambil id dari data yang baru dimasukan ke tb_paketwisata_grup tadi
	  - Memasukan data ke tb_paketwisata beserta id dari tb_paketwisata_grup

	- Jika Memilih Tambah Paket Yang Sudah Ada
	  - Ambil data nama_paketwisata dari tb_paketwisata berdasarkan id_paketwisata_grup
	    (Mengambil 1 baris data yang sesuai .id_paketwisata_grup terakhir berdasar sorting nama_paketwisata)
	  - Jika di akhir nama_paketwisata tidak ada nomor, maka nama_paketwisata ditambah nomor 2
	  - Jika di akhir ada nomor/urutan, maka nama_paketwisata akan mengganti nomor terakhir dengan nomor selanjutnya
	  - Seluruh data yang sudah diinputkan dari form dimasukan ke tb_paketwisata
-->
<?php
if (isset($_POST['save'])) {
	if ($_POST['pilihan-paket'] == 'paket-baru') {
		$koneksi->query("INSERT INTO tb_paketwisata_grup (nama_paketwisata) VALUES('$_POST[nama_paket]')");
		$query = $koneksi->query("SELECT * from tb_paketwisata_grup WHERE nama_paketwisata='$_POST[nama_paket]'");
		while ($row = $query->fetch_assoc()) {
			$koneksi->query("INSERT INTO tb_paketwisata (nama_paketwisata, lama_paket, fasilitas, harga_paket, id_paketwisata_grup) VALUES('$_POST[nama_paket]','$_POST[lama_tour]','$_POST[fasilitas]','$_POST[harga]','$row[id_paketwisata_grup]')");
		}
	} else if ($_POST['pilihan-paket'] == 'pilihan-baru') {
		$query = $koneksi->query("SELECT * FROM tb_paketwisata WHERE id_paketwisata_grup='$_POST[nama_paket_yang_ada]' ORDER BY nama_paketwisata DESC LIMIT 1");
		while ($row = $query->fetch_assoc()) {
			$nama = $row['nama_paketwisata'];
			$cek = preg_match("/.+[\s]+([0-9]+)$/", $nama, $result);
			if ($cek) {
				$old = $result[1];
				$new = $result[1] + 1;
				$nama = str_replace(" " . $old, " " . $new, $nama);
				$koneksi->query("INSERT INTO tb_paketwisata (nama_paketwisata, lama_paket, fasilitas, harga_paket, id_paketwisata_grup) VALUES('$nama','$_POST[lama_tour]','$_POST[fasilitas]','$_POST[harga]','$_POST[nama_paket_yang_ada]')");
			} else {
				$nama .= " 2";
				$koneksi->query("INSERT INTO tb_paketwisata (nama_paketwisata, lama_paket, fasilitas, harga_paket, id_paketwisata_grup) VALUES('$nama','$_POST[lama_tour]','$_POST[fasilitas]','$_POST[harga]','$_POST[nama_paket_yang_ada]')");
			}
		}
	}

	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?page=paketwisata'>";
}
?>
<!-- // ============================================ // -->