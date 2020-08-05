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
	        <h3 class="blank1"><i class="fa fa-edit"></i> Input Data Mahasiswa</h3>

	        <div class="tab-content bs-example1">
	            <div class="tab-pane active" id="horizontal-form">
	              	<form class="form-horizontal" method="POST" action="modules/mahasiswa/proses.php?act=insert" enctype="multipart/form-data">
	 					<div class="form-group">
	                  		<label class="col-sm-2 control-label"><strong><i style="margin-right:7px" class="fa fa-user"></i> Data Pribadi</strong></label>
	                	</div>
						<hr>
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">NIM</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="nim" maxlength="10" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Nama Mahasiswa</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="nama_mahasiswa" autocomplete="off" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Tempat Lahir</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="tempat_lahir" autocomplete="off" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Tanggal Lahir</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1 date-picker" data-date-format="dd-mm-yyyy" name="tanggal_lahir" autocomplete="off" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Jenis Kelamin</label>
	                  		<div class="col-sm-5">
	                  			<div class="radio-inline">
	                  				<label><input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki</label>
	                  			</div>
	                  			<div class="radio-inline">
	                  				<label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
	                  			</div>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Alamat</label>
	                  		<div class="col-sm-5">
	                    		<textarea class="form-control-textarea" name="alamat" rows="3" required></textarea>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Telepon</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="telepon" maxlength="12" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Program Studi</label>
	                  		<div class="col-sm-5">
	                    		<select class="form-control1" name="prodi" placeholder="Pilih Program Studi" required>
			                  		<option value=""></option>
				                  	<?php
				                  	try {
				                  		// sql statement untuk menampilkan data dari tabel is_prodi
				                    	$query = "SELECT id_prodi, nama_prodi FROM is_prodi order by nama_prodi ASC";
				                    	// membuat prepared statements
						              	$stmt = $pdo->prepare($query);
						              	// eksekusi query
						              	$stmt->execute();
				                    	// tampilkan data
              							while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
				                        	echo"<option value=\"$data[id_prodi]\"> $data[nama_prodi] </option>";
				                    	}
								    } catch (PDOException $e) {
								      	// tampilkan pesan kesalahan
								      	echo "ada kesalahan pada query : ".$e->getMessage();
								    }
				                  	?>
			                	</select>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">IPK</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="ipk" maxlength="4" autocomplete="off" onKeyPress="return goodchars(event,'0123456789.',this)" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Foto</label>
	                  		<div class="col-sm-5">
	                    		<input type="file" name="foto" required>
	                    	</div>
	                    </div>

						<br/><br/>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label"><strong><i style="margin-right:7px" class="fa fa-user"></i> Data Orang Tua</strong></label>
	                	</div>
						<hr>
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Nama Orang Tua</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="nama_ortu" autocomplete="off" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Pekerjaan</label>
	                  		<div class="col-sm-5">
	                  			<select class="form-control1" name="pekerjaan_ortu" placeholder="Pilih Pekerjaan Orang Tua" required>
				                  	<option value=""></option>
				                  	<?php
				                  	try {
					                    // sql statement untuk menampilkan data dari tabel is_pekerjaan
					                    $query = "SELECT id_pekerjaan, nama_pekerjaan FROM is_pekerjaan order by nama_pekerjaan ASC";
					                    // membuat prepared statements
					                    $stmt = $pdo->prepare($query);
					                    // eksekusi query
					                    $stmt->execute();
					                    // tampilkan data
					                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
					                          echo"<option value=\"$data[id_pekerjaan]\"> $data[nama_pekerjaan] </option>";
					                    }
					                    // tutup koneksi database
					                    $pdo = null;
				                  	} catch (PDOException $e) {
					                    // tampilkan pesan kesalahan
					                    echo "ada kesalahan pada query : ".$e->getMessage();
				                  	}
				                  	?>
				                </select>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Gaji / Bulan</label>
	                  		<div class="col-sm-5">
	                  			<div class="input-group">							
									<span class="input-group-addon">Rp.</span>
	                    			<input type="text" class="form-control1" name="gaji_ortu" maxlength="10" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
	                    		</div>
	                  		</div>
	                	</div>
						
						<hr>
	                	<div class="form-group">
	              			<div class="col-sm-offset-2 col-sm-10">
	                			<input type="submit" class="btn btn-info btn-submit" name="simpan" value="Simpan">
	                			<a href="?module=mahasiswa" class="btn btn-warning btn-reset">Batal</a>
	              			</div>
	            		</div>


						<div class="clearfix"> </div>
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
			// sql statement untuk menampilkan data dari tabel is_mahasiswa, is_prodi dan is_pekerjaan berdasarkan nim
			$query = "SELECT a.nim,a.nama_mahasiswa,a.tempat_lahir,a.tanggal_lahir,a.jenis_kelamin,a.alamat,a.telepon,a.prodi,a.ipk,a.foto,a.nama_ortu,a.pekerjaan_ortu,a.gaji_ortu,
          			  b.nama_prodi,
          			  c.nama_pekerjaan
          			  FROM is_mahasiswa as a INNER JOIN is_prodi as b INNER JOIN is_pekerjaan as c
          			  ON a.prodi=b.id_prodi AND a.pekerjaan_ortu=c.id_pekerjaan
					  WHERE nim = :nim";
			// membuat prepared statements
			$stmt = $pdo->prepare($query);

			//mengikat parameter 
			$stmt->bindParam(':nim', $_GET['id']);

			// eksekusi query
			$stmt->execute();

			// mengambil data
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			// nilai untuk mengisi form
			$nim            = $data['nim'];
			$nama_mahasiswa = $data['nama_mahasiswa'];
			$tempat_lahir   = $data['tempat_lahir'];
			
			$tanggal        = $data['tanggal_lahir'];
			$tgl            = explode('-',$tanggal);
			$tanggal_lahir  = $tgl[2]."-".$tgl[1]."-".$tgl[0];
			
			$jenis_kelamin  = $data['jenis_kelamin'];
			$alamat         = $data['alamat'];
			$telepon        = $data['telepon'];
			$id_prodi       = $data['prodi'];
			$nama_prodi     = $data['nama_prodi'];
			$ipk            = $data['ipk'];
			$foto           = $data['foto'];
			$nama_ortu      = $data['nama_ortu'];
			$id_pekerjaan   = $data['pekerjaan_ortu'];
			$nama_pekerjaan = $data['nama_pekerjaan'];
			$gaji_ortu      = $data['gaji_ortu'];

	    } catch (PDOException $e) {
			// tampilkan pesan kesalahan
			echo "ada kesalahan pada query : ".$e->getMessage();
	    }
  	}	
?>
	<!-- tampilkan form edit data -->
	<div id="page-wrapper">
	    <div class="graphs">
	        <h3 class="blank1"><i class="fa fa-edit"></i> Ubah Data Mahasiswa</h3>

	        <div class="tab-content bs-example1">
	            <div class="tab-pane active" id="horizontal-form">
	              	<form class="form-horizontal" method="POST" action="modules/mahasiswa/proses.php?act=update" enctype="multipart/form-data">
	 					
	 					<div class="form-group">
	                  		<label class="col-sm-2 control-label"><strong><i style="margin-right:7px" class="fa fa-user"></i> Data Pribadi</strong></label>
	                	</div>
						<hr>
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">NIM</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="nim" value="<?php echo $nim; ?>" readonly>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Nama Mahasiswa</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="nama_mahasiswa" autocomplete="off" value="<?php echo $nama_mahasiswa; ?>" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Tempat Lahir</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="tempat_lahir" autocomplete="off" value="<?php echo $tempat_lahir; ?>" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Tanggal Lahir</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1 date-picker" data-date-format="dd-mm-yyyy" name="tanggal_lahir" autocomplete="off" value="<?php echo $tanggal_lahir; ?>" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Jenis Kelamin</label>
	                  		<div class="col-sm-5">
	                  		<?php  
	                  		if ($jenis_kelamin=="Laki-laki") { ?>
	                  			<div class="radio-inline">
	                  				<label><input type="radio" name="jenis_kelamin" value="Laki-laki" checked=""> Laki-laki</label>
	                  			</div>
	                  			<div class="radio-inline">
	                  				<label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
	                  			</div>
	                  		<?php
	                  		}
	                  		else { ?>
								<div class="radio-inline">
	                  				<label><input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki</label>
	                  			</div>
	                  			<div class="radio-inline">
	                  				<label><input type="radio" name="jenis_kelamin" value="Perempuan" checked=""> Perempuan</label>
	                  			</div>
	                  		<?php
	                  		}
	                  		?>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Alamat</label>
	                  		<div class="col-sm-5">
	                    		<textarea class="form-control-textarea" name="alamat" rows="3" required><?php echo $alamat; ?></textarea>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Telepon</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="telepon" maxlength="12" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $telepon; ?>" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Program Studi</label>
	                  		<div class="col-sm-5">
	                    		<select class="form-control1" name="prodi" placeholder="Pilih Program Studi" required>
			                  		<option value="<?php echo $id_prodi; ?>"><?php echo $nama_prodi; ?></option>
				                  	<?php
				                  	try {
				                  		// sql statement untuk menampilkan data dari tabel is_prodi
				                    	$query = "SELECT id_prodi, nama_prodi FROM is_prodi order by nama_prodi ASC";
				                    	// membuat prepared statements
						              	$stmt = $pdo->prepare($query);
						              	// eksekusi query
						              	$stmt->execute();
				                    	// tampilkan data
              							while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
				                        	echo"<option value=\"$data[id_prodi]\"> $data[nama_prodi] </option>";
				                    	}
								    } catch (PDOException $e) {
								      	// tampilkan pesan kesalahan
								      	echo "ada kesalahan pada query : ".$e->getMessage();
								    }
				                  	?>
			                	</select>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">IPK</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="ipk" maxlength="4" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $ipk; ?>" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Foto</label>
	                  		<div class="col-sm-5">
	                    		<input type="file" name="foto">
								<br/>
							<?php  
							if ($foto=="") { ?>
								<img style="border: 1px solid #eaeaea" src="images/mahasiswa/default_user.png" width="110" height="150">
							<?php
							}
							else { ?>
								<img style="border: 1px solid #eaeaea" src="images/mahasiswa/<?php echo $foto; ?>" width="110" height="150">
							<?php
							}
							?>
	                    	</div>
	                    </div>

						<br/><br/>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label"><strong><i style="margin-right:7px" class="fa fa-user"></i> Data Orang Tua</strong></label>
	                	</div>
						<hr>
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Nama Orang Tua</label>
	                  		<div class="col-sm-5">
	                    		<input type="text" class="form-control1" name="nama_ortu" autocomplete="off" value="<?php echo $nama_ortu; ?>" required>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Pekerjaan</label>
	                  		<div class="col-sm-5">
	                  			<select class="form-control1" name="pekerjaan_ortu" placeholder="Pilih Pekerjaan Orang Tua" required>
				                  	<option value="<?php echo $id_pekerjaan; ?>"><?php echo $nama_pekerjaan; ?></option>
				                  	<?php
				                  	try {
					                    // sql statement untuk menampilkan data dari tabel is_pekerjaan
					                    $query = "SELECT id_pekerjaan, nama_pekerjaan FROM is_pekerjaan order by nama_pekerjaan ASC";
					                    // membuat prepared statements
					                    $stmt = $pdo->prepare($query);
					                    // eksekusi query
					                    $stmt->execute();
					                    // tampilkan data
					                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
					                          echo"<option value=\"$data[id_pekerjaan]\"> $data[nama_pekerjaan] </option>";
					                    }
					                    // tutup koneksi database
					                    $pdo = null;
				                  	} catch (PDOException $e) {
					                    // tampilkan pesan kesalahan
					                    echo "ada kesalahan pada query : ".$e->getMessage();
				                  	}
				                  	?>
				                </select>
	                  		</div>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Gaji / Bulan</label>
	                  		<div class="col-sm-5">
	                  			<div class="input-group">							
									<span class="input-group-addon">Rp.</span>
	                    			<input type="text" class="form-control1" name="gaji_ortu" maxlength="10" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $gaji_ortu; ?>" required>
	                    		</div>
	                  		</div>
	                	</div>

						<hr>
	                	<div class="form-group">
	              			<div class="col-sm-offset-2 col-sm-10">
	                			<input type="submit" class="btn btn-info btn-submit" name="simpan" value="Simpan">
	                			<a href="?module=mahasiswa" class="btn btn-warning btn-reset">Batal</a>
	              			</div>
	            		</div>
	              	</form>
	            </div>
	        </div> 
	    </div>
	</div>
<?php
}

// jika form detail data yang dipilih
elseif ($_GET['form']=='detail') { 
  	if (isset($_GET['id'])) {
	    try {
			// sql statement untuk menampilkan data dari tabel is_mahasiswa, is_prodi dan is_pekerjaan berdasarkan nim
			$query = "SELECT a.nim,a.nama_mahasiswa,a.tempat_lahir,a.tanggal_lahir,a.jenis_kelamin,a.alamat,a.telepon,a.prodi,a.ipk,a.foto,a.nama_ortu,a.pekerjaan_ortu,a.gaji_ortu,
          			  b.nama_prodi,
          			  c.nama_pekerjaan
          			  FROM is_mahasiswa as a INNER JOIN is_prodi as b INNER JOIN is_pekerjaan as c
          			  ON a.prodi=b.id_prodi AND a.pekerjaan_ortu=c.id_pekerjaan
					  WHERE nim = :nim";
			// membuat prepared statements
			$stmt = $pdo->prepare($query);

			//mengikat parameter 
			$stmt->bindParam(':nim', $_GET['id']);

			// eksekusi query
			$stmt->execute();

			// mengambil data
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			// nilai untuk mengisi form
			$nim            = $data['nim'];
			$nama_mahasiswa = $data['nama_mahasiswa'];
			$tempat_lahir   = $data['tempat_lahir'];
			
			$tanggal        = $data['tanggal_lahir'];
			$tgl            = explode('-',$tanggal);
			$tanggal_lahir  = $tgl[2]."-".$tgl[1]."-".$tgl[0];
			
			$jenis_kelamin  = $data['jenis_kelamin'];
			$alamat         = $data['alamat'];
			$telepon        = $data['telepon'];
			$id_prodi       = $data['prodi'];
			$nama_prodi     = $data['nama_prodi'];
			$ipk            = $data['ipk'];
			$foto           = $data['foto'];
			$nama_ortu      = $data['nama_ortu'];
			$id_pekerjaan   = $data['pekerjaan_ortu'];
			$nama_pekerjaan = $data['nama_pekerjaan'];
			$gaji_ortu      = $data['gaji_ortu'];

	    } catch (PDOException $e) {
			// tampilkan pesan kesalahan
			echo "ada kesalahan pada query : ".$e->getMessage();
	    }
  	}	
?>
	<!-- tampilkan form edit data -->
	<div id="page-wrapper">
	    <div class="graphs">
	        <h3 class="blank1"><i class="fa fa-edit"></i> Detail Mahasiswa</h3>

	        <div class="tab-content bs-example1">
	            <div class="tab-pane active" id="horizontal-form">
	              	<form class="form-horizontal">
	 					
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">
	                  		<?php  
							if ($foto=="") { ?>
								<img class="img-mahasiswa" src="images/mahasiswa/default_user.png" width="110" height="150">
							<?php
							}
							else { ?>
								<img class="img-mahasiswa" src="images/mahasiswa/<?php echo $foto; ?>" width="110" height="150">
							<?php
							}
							?>
	                  		</label>
	                  		<label style="text-align:left;font-size:20px" class="col-sm-5 control-label"><b><?php echo $nama_mahasiswa; ?></b></label><br><br>
	                  		<label style="text-align:left;margin-top:-15px" class="col-sm-2 control-label"><b><?php echo $nim; ?></b></label>
	                	</div>
						<hr>
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $tempat_lahir; ?>, <?php echo $tanggal_lahir; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Jenis Kelamin</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $jenis_kelamin; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Alamat</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $alamat; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Telepon</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $telepon; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Program Studi</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $nama_prodi; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">IPK</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $ipk; ?></label>
	                	</div>

						<br/><br/>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label"><strong><i style="margin-right:7px" class="fa fa-user"></i> Data Orang Tua</strong></label>
	                	</div>
						<hr>
	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Nama Orang Tua</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $nama_ortu; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Pekerjaan</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : <?php echo $nama_pekerjaan; ?></label>
	                	</div>

	                	<div class="form-group">
	                  		<label class="col-sm-2 control-label">Gaji / Bulan</label>
	                  		<label style="text-align:left" class="col-sm-5 control-label"> : Rp. <?php echo format_rupiah($gaji_ortu); ?></label>
	                	</div>

						<hr>
	                	<div class="form-group">
	              			<div class="col-sm-offset-2 col-sm-10">
	                			<a href="?module=form_mahasiswa&form=edit&id=<?php echo $nim; ?>" class="btn btn-info btn-submit" >Ubah</a>
	                			<a href="?module=mahasiswa" class="btn btn-warning btn-reset">Kembali</a>
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