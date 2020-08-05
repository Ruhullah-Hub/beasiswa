<!-- Aplikasi Pengolahan Data Penerima Beasiswa
************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 24 Juli 2016
* Website      : http://www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">
        	<i class="fa fa-users"></i> Data Mahasiswa

        	<a class="btn btn-warning pull-right" href="modules/mahasiswa/export.php">
	            <i style="margin-right:5px" class="fa fa-file-excel-o"></i> Export
	        </a>

        	<a style="margin-right: 10px" class="btn btn-info pull-right" href="?module=form_mahasiswa&form=add">
	            <i class="fa fa-plus"></i> Tambah
	        </a>
        </h3>

		<?php 
		// fungsi untuk menampilkan pesan
		// jika alert = "" (kosong)
		// tampilkan pesan "" (kosong) 
		if (empty($_GET['alert'])) {
		    echo "";
		} 
		// jika alert = 1
		// tampilkan pesan Sukses "Mahasiswa baru berhasil disimpan"
		elseif ($_GET['alert'] == 1) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> mahasiswa baru berhasil disimpan.
		          	</div>";
		} 
		// jika alert = 2
		// tampilkan pesan Sukses "Mahasiswa berhasil diubah"
		elseif ($_GET['alert'] == 2) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> mahasiswa berhasil diubah.
		          	</div>";
		}
		// jika alert = 3
		// tampilkan pesan Sukses "Mahasiswa berhasil dihapus"
		elseif ($_GET['alert'] == 3) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> mahasiswa berhasil dihapus.
		          	</div>";
		}
		// jika alert = 4
		// tampilkan pesan Gagal "NIM sudah ada"
		elseif ($_GET['alert'] == 4) {
		    echo "	<div class='alert alert-danger alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-times-circle'></i> Gagal!</strong> NIM $_GET[nim] sudah ada.
		          	</div>";
		}
		// jika alert = 5
		// tampilkan pesan Upload Gagal "pastikan file yang diupload sudah benar"
		elseif ($_GET['alert'] == 5) {
		echo "	<div class='alert alert-danger alert-dismissible' role='alert'>
		        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		          		<span aria-hidden='true'>&times;</span>
		        	</button>
		        	<strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> pastikan file yang diupload sudah benar.
		      	</div>";
		}
		// jika alert = 6
		// tampilkan pesan Upload Gagal "pastikan ukuran foto tidak lebih dari 1MB"
		elseif ($_GET['alert'] == 6) {
		echo "	<div class='alert alert-danger alert-dismissible' role='alert'>
		        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		          		<span aria-hidden='true'>&times;</span>
		        	</button>
		        	<strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> pastikan ukuran foto tidak lebih dari 1MB.
		      	</div>";
		}
		// jika alert = 7
		// tampilkan pesan Upload Gagal "pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
		elseif ($_GET['alert'] == 7) {
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
              	<!-- tampilan tabel mahasiswa -->
          		<table class="table table-striped table-hover" id="dataTables-example">
            		<!-- tampilan tabel header -->
		            <thead>
		              	<tr>
			                <th>No.</th>
			                <th>Foto</th>
			                <th>NIM</th>
			                <th>Nama</th>
			                <th>L/P</th>
			                <th>Alamat</th>
			                <th>Telepon</th>
			                <th>Program Studi</th>
			                <th>IPK</th>
			                <th></th>
		              	</tr>
		            </thead>   
            		<!-- tampilan tabel body -->
		            <tbody>
		            <?php
		            try {
		              	$no = 1;
		              	// sql statement untuk menampilkan data dari tabel is_mahasiswa dan is_prodi
		              	$query = "SELECT a.nim,a.nama_mahasiswa,a.jenis_kelamin,a.alamat,a.telepon,a.prodi,a.ipk,a.foto,
		              			  b.nama_prodi
		              			  FROM is_mahasiswa as a INNER JOIN is_prodi as b
		              			  ON a.prodi=b.id_prodi
		              			  ORDER BY nim DESC";
		              	// membuat prepared statements
		              	$stmt = $pdo->prepare($query);

		              	// eksekusi query
		              	$stmt->execute();

		              	// tampilkan data
		              	while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
		              		if ($data['jenis_kelamin']=="Laki-laki") { 
		              			$jenis_kelamin = "L";
	                        } else { 
	                        	$jenis_kelamin = "P";
	                        }
		                	// menampilkan isi tabel dari database ke tabel di aplikasi
		                	echo "<tr>
			                        <td width='20' class='center'>$no</td>";

			                        if ($data['foto']=="") { ?>
			                        	<td><img class='img-mahasiswa' src='images/mahasiswa/default_user.png' width='45'></td>
			                        <?php
			                        } else { ?>
			                        	<td><img class='img-mahasiswa' src='images/mahasiswa/<?php echo $data['foto']; ?>' width='45'></td>
			                        <?php
			                        }

			                echo "	<td width='60'>$data[nim]</td>
			                        <td width='120'><a href='?module=form_mahasiswa&form=detail&id=$data[nim]'>$data[nama_mahasiswa]</a></td>
			                        <td>$jenis_kelamin</td>
			                        <td width='180'>$data[alamat]</td>
			                        <td width='60'>$data[telepon]</td>
			                        <td width='120'>$data[nama_prodi]</td>
			                        <td>$data[ipk]</td>

		                        	<td width='85'>
			                          	<div>
			                          		<a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-info btn-sm' href='?module=form_mahasiswa&form=edit&id=$data[nim]'>
                              					<i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                            				</a>";
            		?>  
				                            <!-- tombol untuk menghapus data -->
				                            <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-warning btn-sm" href="modules/mahasiswa/proses.php?act=delete&id=<?php echo $data['nim'];?>" onclick="return confirm('Anda yakin ingin menghapus mahasiswa <?php echo $data['nama_mahasiswa']; ?>?');">
				                              	<i style="color:#fff" class="glyphicon glyphicon-trash"></i>
				                            </a>
            		<?php
                		echo "    		</div>
                        			</td>
                      			</tr>";
                		$no++;
		            }

		             	// tutup koneksi database
		              	$pdo = null;
		            } catch (PDOException $e) {
		              	// tampilkan pesan kesalahan
		              	echo "ada kesalahan pada query : ".$e->getMessage();
		            }
		            ?>
		            </tbody>           
          		</table>
            </div>
        </div> 
    </div>
</div>