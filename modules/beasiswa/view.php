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
        	<i class="fa fa-graduation-cap"></i> Data Penerima Beasiswa

        	<a class="btn btn-warning pull-right" href="modules/beasiswa/export.php">
	            <i style="margin-right:5px" class="fa fa-file-excel-o"></i> Export
	        </a>
        </h3>
		
		<div class='alert alert-info alert-dismissible' role='alert'>
        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          		<span aria-hidden='true'>&times;</span>
        	</button>
        	Data mahasiswa penerima beasiswa yang diseleksi berdasarkan <strong>IPK diatas 3.50</strong> dan <strong>gaji orang tua dibawah Rp. 1.500.000</strong>.
      	</div>

        <div class="tab-content bs-example1">
            <div class="tab-pane active" id="horizontal-form">
              	<!-- tampilan tabel beasiswa -->
          		<table class="table table-striped table-hover" id="dataTables-example">
            		<!-- tampilan tabel header -->
		            <thead>
		              	<tr>
			                <th>No.</th>
			                <th>Foto</th>
			                <th>NIM</th>
			                <th>Nama</th>
			                <th>Program Studi</th>
			                <th>IPK</th>
			                <th>Gaji Orang Tua</th>
		              	</tr>
		            </thead>   
            		<!-- tampilan tabel body -->
		            <tbody>
		            <?php
		            try {
		              	$no = 1;
		              	// sql statement untuk menampilkan data dari tabel is_mahasiswa dan is_prodi
		              	$query = "SELECT a.nim,a.nama_mahasiswa,a.jenis_kelamin,a.prodi,a.ipk,a.foto,a.gaji_ortu,
		              			  b.nama_prodi
		              			  FROM is_mahasiswa as a INNER JOIN is_prodi as b
		              			  ON a.prodi=b.id_prodi
		              			  WHERE a.ipk>'3.50' AND a.gaji_ortu<'1500000'
		              			  ORDER BY nim DESC";
		              	// membuat prepared statements
		              	$stmt = $pdo->prepare($query);

		              	// eksekusi query
		              	$stmt->execute();

		              	// tampilkan data
		              	while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
	                        $gaji_ortu = format_rupiah($data['gaji_ortu']);
		                	// menampilkan isi tabel dari database ke tabel di aplikasi
		                	echo "<tr>
			                        <td width='50' class='center'>$no</td>";

			                        if ($data['foto']=="") { ?>
			                        	<td width="70"><img class='img-mahasiswa' src='images/mahasiswa/default_user.png' width='45'></td>
			                        <?php
			                        } else { ?>
			                        	<td width="70"><img class='img-mahasiswa' src='images/mahasiswa/<?php echo $data['foto']; ?>' width='45'></td>
			                        <?php
			                        }

			                echo "	<td width='100'>$data[nim]</td>
			                        <td width='180'><a href='?module=form_beasiswa&form=detail&id=$data[nim]'>$data[nama_mahasiswa]</a></td>
			                        <td width='150'>$data[nama_prodi]</td>
			                        <td width='80'>$data[ipk]</td>
			                        <td width='150'>Rp. $gaji_ortu</td>
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