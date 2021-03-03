<?php  
	//mendapatkan id_alternatif dari url
	$id_alternatif = $_GET['id'];

	$ambil = $koneksi->query("SELECT * FROM tb_alternatif JOIN tb_paketwisata ON tb_alternatif.id_paketwisata=tb_paketwisata.id_paketwisata WHERE id_alternatif='$_GET[id]'");

	$pecah = $ambil->fetch_assoc();

	//echo "<pre>";
	//print_r($pecah);
	//echo "</pre>";
?>

<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Alternatif</h6>
    </div>

    <div class="card-body">
		<form method="post" enctype="multipart/form-data">

			<div class="form-group">
				<label>Nama Alternatif</label>
				<select class="form-control" name="id_paketwisata" disabled>
					<option value="">--Pilih Paket--</option>
					<?php 
						$datapaketwisata = array();

						$ambil = $koneksi->query("SELECT * FROM tb_paketwisata");
						while ($tiap = $ambil->fetch_assoc()) 
						{
							$datapaketwisata[] = $tiap;
						}
						//echo "<pre>";
						//print_r($datapaketwisata);
						//echo "</pre>";
					?>
					<?php foreach ($datapaketwisata as $key => $value): ?>
					<option value="<?php echo $value["id_paketwisata"] ?>" <?php if ($pecah["id_paketwisata"]==$value["id_paketwisata"])echo "selected"; ?>>
						
						<?php echo $value["nama_paketwisata"]; ?>
							
					</option>
				<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label>Harga (C1)</label>
				<select class="form-control" name="hrg" disabled>
					<option value="">--Pilih Harga--</option>
					<?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='1' order by id_subkriteria asc;");
						while ($setiap = $ambil2->fetch_assoc()) { 
						//echo "<pre>";
						//print_r($setiap);
						//echo "</pre>";
					?>
					<option value="<?php echo $setiap["bobot_subkriteria"] ?>" <?php if ($pecah["harga"]==$setiap["bobot_subkriteria"])echo "selected"; ?>>
						
						<?php echo $setiap["nama"]; ?>
							
					</option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label>Jumlah Wisata (C2)</label>
				<select class="form-control" name="jml_wisata" disabled>
					<option value="">--Pilih Jumlah Wisata--</option>
					<?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='3' order by id_subkriteria asc;");
						while ($setiap = $ambil2->fetch_assoc()) { 
					?>
					<option value="<?php echo $setiap["bobot_subkriteria"] ?>" <?php if ($pecah["jumlah_wisata"]==$setiap["bobot_subkriteria"])echo "selected"; ?>>
						
						<?php echo $setiap["nama"]; ?>
							
					</option>
					<?php } ?>
				</select>
			</div>
			
			<div class="form-group">
				<label>Lama Tour (C3)</label>
				<select class="form-control" name="lm_tour" disabled>
					<option value="">--Pilih Lama Tour --</option>
					<?php $ambil2 = $koneksi->query("SELECT * FROM tb_subkriteria where id_kriteria='4' order by id_subkriteria asc;");
						while ($setiap = $ambil2->fetch_assoc()) { 
					?>
					<option value="<?php echo $setiap["bobot_subkriteria"] ?>" <?php if ($pecah["lama_tour"]==$setiap["bobot_subkriteria"])echo "selected"; ?>>
						
						<?php echo $setiap["nama"]; ?>
							
					</option>
					<?php } ?>
				</select>
			</div>
			<a href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; } ?>">Kembali</a>
		</form>
	</div>
</div>
