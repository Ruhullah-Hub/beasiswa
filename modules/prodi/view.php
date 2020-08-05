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
        	<i class="fa fa-desktop"></i> Program Studi
        	<a class="btn btn-info pull-right" href="?module=form_prodi&form=add">
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
		// tampilkan pesan Sukses "program studi baru berhasil disimpan"
		elseif ($_GET['alert'] == 1) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> program studi baru berhasil disimpan.
		          	</div>";
		} 
		// jika alert = 2
		// tampilkan pesan Sukses "program studi berhasil diubah"
		elseif ($_GET['alert'] == 2) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> program studi berhasil diubah.
		          	</div>";
		}
		// jika alert = 3
		// tampilkan pesan Sukses "program studi berhasil dihapus"
		elseif ($_GET['alert'] == 3) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> program studi berhasil dihapus.
		          	</div>";
		}
		?>

        <div class="tab-content bs-example1">
            <div class="tab-pane active" id="horizontal-form">
              	<!-- tampilan tabel prodi -->
          		<table class="table table-striped table-hover" id="dataTables-example">
            		<!-- tampilan tabel header -->
		            <thead>
		              	<tr>
			                <th>No.</th>
			                <th>Program Studi</th>
			                <th></th>
		              	</tr>
		            </thead>   
            		<!-- tampilan tabel body -->
		            <tbody>
		            <?php
		            try {
		              	$no = 1;
		              	// sql statement untuk menampilkan data dari tabel is_prodi
		              	$query = "SELECT id_prodi, nama_prodi FROM is_prodi ORDER BY id_prodi DESC";
		              	// membuat prepared statements
		              	$stmt = $pdo->prepare($query);

		              	// eksekusi query
		              	$stmt->execute();

		              	// tampilkan data
		              	while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
		                	// menampilkan isi tabel dari database ke tabel di aplikasi
		                	echo "<tr>
			                        <td width='70' class='center'>$no</td>
			                        <td>$data[nama_prodi]</td>

		                        	<td width='100'>
			                          	<div>
			                          		<a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-info btn-sm' href='?module=form_prodi&form=edit&id=$data[id_prodi]'>
                              					<i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                            				</a>";
            		?>  
				                            <!-- tombol untuk menghapus data -->
				                            <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-warning btn-sm" href="modules/prodi/proses.php?act=delete&id=<?php echo $data['id_prodi'];?>" onclick="return confirm('Anda yakin ingin menghapus program studi <?php echo $data['nama_prodi']; ?>?');">
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