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
        	<i class="fa fa-user"></i> Manajemen User
        	<a class="btn btn-info pull-right" href="?module=form_user&form=add">
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
		// tampilkan pesan Sukses "data user baru berhasil disimpan"
		elseif ($_GET['alert'] == 1) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> data user baru berhasil disimpan.
		          	</div>";
		} 
		// jika alert = 2
		// tampilkan pesan Sukses "data user berhasil diubah"
		elseif ($_GET['alert'] == 2) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> data user berhasil diubah.
		          	</div>";
		}
		// jika alert = 3
		// tampilkan pesan Sukses "user berhasil diaktifkan"
		elseif ($_GET['alert'] == 3) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> user berhasil diaktifkan.
		          	</div>";
		}
		// jika alert = 4
		// tampilkan pesan Sukses "user berhasil diblokir"
		elseif ($_GET['alert'] == 4) {
		echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		          		<span aria-hidden='true'>&times;</span>
		        	</button>
		        	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> user berhasil diblokir.
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
              	<!-- tampilan tabel user -->
          		<table class="table table-striped table-hover" id="dataTables-example">
            		<!-- tampilan tabel header -->
		            <thead>
		              	<tr>
			                <th>No.</th>
			                <th>Foto</th>
			                <th>Username</th>
			                <th>Nama Lengkap</th>
			                <th>Level</th>
			                <th>Status</th>
			                <th></th>
		              	</tr>
		            </thead>   
            		<!-- tampilan tabel body -->
		            <tbody>
		            <?php
		            try {
		              	$no = 1;
		              	// sql statement untuk menampilkan data dari tabel is_users
		              	$query = "SELECT id_user, username, nama_lengkap, foto, level, status FROM is_users 
		                          ORDER BY id_user DESC";
		              	// membuat prepared statements
		              	$stmt = $pdo->prepare($query);

		              	// eksekusi query
		              	$stmt->execute();

		              	// tampilkan data
		              	while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
		                	// menampilkan isi tabel dari database ke tabel di aplikasi
		                	echo "<tr>
			                        <td width='70' class='center'>$no</td>";

			                        if ($data['foto']=="") { ?>
			                        	<td><img class='img-user' src='images/user/default_user.png' width='45'></td>
			                        <?php
			                        } else { ?>
			                        	<td><img class='img-user' src='images/user/<?php echo $data['foto']; ?>' width='45'></td>
			                        <?php
			                        }

			                echo "  <td>$data[username]</td>
			                        <td>$data[nama_lengkap]</td>
			                        <td>$data[level]</td>
			                        <td>$data[status]</td>

		                        	<td width='100'>
			                          	<div>";

			                          	if ($data['status']=='aktif') { ?>
			                            	<a data-toggle="tooltip" data-placement="top" title="Blokir" style='margin-right:5px' class="btn btn-warning btn-sm" href="modules/user/proses.php?act=off&id=<?php echo $data['id_user'];?>">
			                              		<i style="color:#fff" class="glyphicon glyphicon-off"></i>
			                            	</a>
		                <?php
			                          	} 
			                          	else { ?>
			                            	<a data-toggle="tooltip" data-placement="top" title="Aktifkan" style='margin-right:5px' class="btn btn-warning btn-sm" href="modules/user/proses.php?act=on&id=<?php echo $data['id_user'];?>">
			                              		<i style="color:#fff" class="glyphicon glyphicon-ok"></i>
			                            	</a>
		                <?php
		                          		}

		                	echo " 			<a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-info btn-sm' href='?module=form_user&form=edit&id=$data[id_user]'>
				                              	<i style='color:#fff' class='glyphicon glyphicon-edit'></i>
				                            </a>
			                          	</div>
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