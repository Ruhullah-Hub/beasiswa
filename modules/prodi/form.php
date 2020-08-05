<!-- Aplikasi Pengolahan Data Penerima Beasiswa
************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 24 Juli 2016
* Website      : http://www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<?php  
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?>
  	<!-- tampilkan form add data -->
	<div id="page-wrapper">
	    <div class="graphs">
	        <h3 class="blank1"><i class="fa fa-edit"></i> Input Program Studi</h3>

	        <div class="tab-content bs-example1">
	            <div class="tab-pane active" id="horizontal-form">
	              	<form class="form-horizontal" method="POST" action="modules/prodi/proses.php?act=insert">
	 
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Program Studi</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="prodi" autocomplete="off" required>
	                  		</div>
	                	</div>
						
						<hr>
	                	<div class="form-group">
	              			<div class="col-sm-offset-2 col-sm-10">
	                			<input type="submit" class="btn btn-info btn-submit" name="simpan" value="Simpan">
	                			<a href="?module=prodi" class="btn btn-warning btn-reset">Batal</a>
	              			</div>
	            		</div>
	              	</form>
	            </div>
	        </div> 
	    </div>
	</div>
<?php
}

// jika form edit data yang dipilih
elseif ($_GET['form']=='edit') { 
  	if (isset($_GET['id'])) {
	    try {
			// sql statement untuk menampilkan data dari tabel is_prodi berdasarkan id_prodi
			$query = "SELECT id_prodi, nama_prodi FROM is_prodi WHERE id_prodi = :id_prodi";
			// membuat prepared statements
			$stmt = $pdo->prepare($query);

			//mengikat parameter 
			$stmt->bindParam(':id_prodi', $_GET['id']);

			// eksekusi query
			$stmt->execute();

			// mengambil data
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			// nilai untuk mengisi form
			$id_prodi   = $data['id_prodi'];
			$nama_prodi = $data['nama_prodi'];

			// tutup koneksi database
			$pdo = null;
	    } catch (PDOException $e) {
			// tampilkan pesan kesalahan
			echo "ada kesalahan pada query : ".$e->getMessage();
	    }
  	}	
?>
	<!-- tampilkan form edit data -->
	<div id="page-wrapper">
	    <div class="graphs">
	        <h3 class="blank1"><i class="fa fa-edit"></i> Ubah Program Studi</h3>

	        <div class="tab-content bs-example1">
	            <div class="tab-pane active" id="horizontal-form">
	              	<form class="form-horizontal" method="POST" action="modules/prodi/proses.php?act=update">
	 					
	 					<input type="hidden" name="id_prodi" value="<?php echo $id_prodi; ?>">

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Program Studi</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="prodi" autocomplete="off" value="<?php echo $nama_prodi; ?>" required>
	                  		</div>
	                	</div>

						<hr>
	                	<div class="form-group">
	              			<div class="col-sm-offset-2 col-sm-10">
	                			<input type="submit" class="btn btn-info btn-submit" name="simpan" value="Simpan">
	                			<a href="?module=prodi" class="btn btn-warning btn-reset">Batal</a>
	              			</div>
	            		</div>
	              	</form>
	            </div>
	        </div> 
	    </div>
	</div>
<?php
}
?>