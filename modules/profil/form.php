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
if (isset($_POST['id_user'])) {
	try {
		// sql statement untuk menampilkan data dari tabel is_users berdasarkan id_user
		$query = "SELECT id_user, username, nama_lengkap, email, telepon, foto FROM is_users WHERE id_user = :id_user";
		// membuat prepared statements
		$stmt = $pdo->prepare($query);

		//mengikat parameter 
		$stmt->bindParam(':id_user', $_POST['id_user']);

		// eksekusi query
		$stmt->execute();

		// mengambil data
		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		// nilai untuk mengisi form
		$id_user      = $data['id_user'];
		$username     = $data['username'];
		$nama_lengkap = $data['nama_lengkap'];
		$email        = $data['email'];
		$telepon      = $data['telepon'];
		$foto         = $data['foto'];

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
	        <h3 class="blank1"><i class="fa fa-edit"></i> Ubah Profil User</h3>

	        <div class="tab-content bs-example1">
	            <div class="tab-pane active" id="horizontal-form">
	              	<form class="form-horizontal" method="POST" action="modules/profil/proses.php?act=update" enctype="multipart/form-data">
	 					
	 					<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Username</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="username" autocomplete="off" value="<?php echo $username; ?>" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Password</label>
	                  		<div class="col-sm-5">
	                    		<input type="password" class="form-control1" name="password" autocomplete="off" placeholder="Kosongkan password jika tidak diubah">
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Nama Lengkap</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="nama_lengkap" autocomplete="off" value="<?php echo $nama_lengkap; ?>" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Email</label>
	                  		<div class="col-sm-5">
	                    		<input type="email" class="form-control1" name="email" autocomplete="off" value="<?php echo $email; ?>">
	                  		</div>
	                	</div>
						
						<div class="form-group">
	                  		<label class="col-sm-2 control-label">Telepon</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="telepon" autocomplete="off" maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $telepon; ?>">
	                  		</div>
	                	</div>

						<div class="form-group">
	                  		<label class="col-sm-2 control-label">Foto</label>
	                  		<div class="col-sm-5">
	                    		<input type="file" name="foto">
								<br/>
							<?php  
							if ($foto=="") { ?>
								<img style="border: 1px solid #eaeaea" src="images/user/default_user.png">
							<?php
							}
							else { ?>
								<img style="border: 1px solid #eaeaea" src="images/user/<?php echo $foto; ?>">
							<?php
							}
							?>
	                    		
	                  		</div>
	                	</div>

						<hr>
	                	<div class="form-group">
	              			<div class="col-sm-offset-2 col-sm-10">
	                			<input type="submit" class="btn btn-info btn-submit" name="simpan" value="Simpan">
	                			<a href="?module=profil" class="btn btn-warning btn-reset">Batal</a>
	              			</div>
	            		</div>
	              	</form>
	            </div>
	        </div> 
	    </div>
	</div>
