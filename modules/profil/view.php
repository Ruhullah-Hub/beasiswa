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
if (isset($_SESSION['id_user'])) {
	try {
		// sql statement untuk menampilkan data dari tabel is_users berdasarkan id_user
		$query = "SELECT id_user, username, nama_lengkap, email, telepon, foto, level, status FROM is_users WHERE id_user = :id_user";
		// membuat prepared statements
		$stmt = $pdo->prepare($query);

		//mengikat parameter 
		$stmt->bindParam(':id_user', $_SESSION['id_user']);

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
		$level        = $data['level'];
		$status       = $data['status'];

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
	        <h3 class="blank1"><i class="fa fa-user"></i> Profil User</h3>
			
			<?php 
			// fungsi untuk menampilkan pesan
			// jika alert = "" (kosong)
			// tampilkan pesan "" (kosong) 
			if (empty($_GET['alert'])) {
			    echo "";
			}  
			// jika alert = 1
			// tampilkan pesan Sukses "profil user berhasil diubah"
			elseif ($_GET['alert'] == 1) {
			    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
			            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			              		<span aria-hidden='true'>&times;</span>
			            	</button>
			            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> profil user berhasil diubah.
			          	</div>";
			}
			// jika alert = 2
			// tampilkan pesan Upload Gagal "pastikan file yang diupload sudah benar"
			elseif ($_GET['alert'] == 2) {
			echo "	<div class='alert alert-danger alert-dismissible' role='alert'>
			        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			          		<span aria-hidden='true'>&times;</span>
			        	</button>
			        	<strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> pastikan file yang diupload sudah benar.
			      	</div>";
			}
			// jika alert = 3
			// tampilkan pesan Upload Gagal "pastikan ukuran foto tidak lebih dari 1MB"
			elseif ($_GET['alert'] == 3) {
			echo "	<div class='alert alert-danger alert-dismissible' role='alert'>
			        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			          		<span aria-hidden='true'>&times;</span>
			        	</button>
			        	<strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> pastikan ukuran foto tidak lebih dari 1MB.
			      	</div>";
			}
			// jika alert = 4
			// tampilkan pesan Upload Gagal "pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
			elseif ($_GET['alert'] == 4) {
			echo "	<div class='alert alert-danger alert-dismissible' role='alert'>
			        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			          		<span aria-hidden='true'>&times;</span>
			        	</button>
			        	<strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG.
			      	</div>";
			}
			?>

	        <div class="tab-content bs-example1">
	            <div class="tab-pane active" id="horizontal-form">
	              	<form class="form-horizontal" method="POST" action="?module=form_profil" enctype="multipart/form-data">
	 					
	 					<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">
	                  		<?php  
							if ($foto=="") { ?>
								<img style="border: 1px solid #eaeaea;border-radius:50px" src="images/user/default_user.png">
							<?php
							}
							else { ?>
								<img style="border: 1px solid #eaeaea;border-radius:50px" src="images/user/<?php echo $foto; ?>">
							<?php
							}
							?>
	                  		</label>
	                  		<label style="text-align:left" class="col-sm-2 control-label"><b><?php echo $nama_lengkap; ?></b></label>
	                	</div>
						<hr>
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">username</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $username; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Email</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $email; ?></label>
	                	</div>
						
						<div class="form-group">
	                  		<label class="col-sm-2 control-label">Telepon</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $telepon; ?></label>
	                	</div>
						
						<div class="form-group">
	                  		<label class="col-sm-2 control-label">Level</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $level; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Status</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $status; ?></label>
	                	</div>

						<hr>
	                	<div class="form-group">
	              			<div class="col-sm-offset-2 col-sm-10">
	                			<input type="submit" class="btn btn-info btn-submit" name="ubah" value="Ubah">
	              			</div>
	            		</div>
	              	</form>
	            </div>
	        </div> 
	    </div>
	</div>
