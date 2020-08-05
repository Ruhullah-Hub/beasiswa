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
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert dan update
else {
	// insert data
	if ($_GET['act']=='insert') {
		if (isset($_POST['simpan'])) {
			// ambil data hasil submit dari form
			$nim            = $_POST['nim'];
			$nama_mahasiswa = $_POST['nama_mahasiswa'];
			$tempat_lahir   = $_POST['tempat_lahir'];
			
			$tanggal        = $_POST['tanggal_lahir'];
			$tgl            = explode('-',$tanggal);
			$tanggal_lahir  = $tgl[2]."-".$tgl[1]."-".$tgl[0];
			
			$jenis_kelamin  = $_POST['jenis_kelamin'];
			$alamat         = $_POST['alamat'];
			$telepon        = $_POST['telepon'];
			$prodi          = $_POST['prodi'];
			$ipk            = $_POST['ipk'];
			
			$nama_ortu      = $_POST['nama_ortu'];
			$pekerjaan_ortu = $_POST['pekerjaan_ortu'];
			$gaji_ortu      = $_POST['gaji_ortu'];
			
			$nama_file      = $_FILES['foto']['name'];
			$ukuran_file    = $_FILES['foto']['size'];
			$tipe_file      = $_FILES['foto']['type'];
			$tmp_file       = $_FILES['foto']['tmp_name'];

	        // tentuka extension yang diperbolehkan
            $allowed_extensions = array('jpg','jpeg','png');

            // Set path folder tempat menyimpan gambarnya
            $path_file = "../../images/mahasiswa/".$nama_file;

            // check extension
            $file = explode(".", $nama_file);
            $extension = array_pop($file);

			// ambil data dari session
			$user = $_SESSION['id_user'];

			try {
				// sql statement untuk seleksi nim dari tabel is_mahasiswa
				$query = "SELECT nim FROM is_mahasiswa WHERE nim=:nim";
				// membuat prepared statements
				$stmt = $pdo->prepare($query);

				// mengikat parameter
				$stmt->bindParam(':nim', $nim);

				// eksekusi query
				$stmt->execute();

				$count = $stmt->rowCount();
				// jika nim sudah ada
				if($count > 0) {
					// tampilkan pesan nim sudah ada
					header("location: ../../main.php?module=mahasiswa&nim=$nim&alert=4");
				}
				// jika nim belum ada
				else {
					// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
					if (in_array($extension, $allowed_extensions)) {
	                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
	                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
	                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
	                        // Proses upload
	                        if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                        		// Jika gambar berhasil diupload, Lakukan : 
                        		// sql statement untuk menyimpan data ke tabel is_mahasiswa
						        $query = "INSERT INTO is_mahasiswa(nim,nama_mahasiswa,tempat_lahir,tanggal_lahir,jenis_kelamin,alamat,telepon,prodi,ipk,foto,nama_ortu,pekerjaan_ortu,gaji_ortu,created_user,updated_user)	
										  VALUES(:nim,:nama_mahasiswa,:tempat_lahir,:tanggal_lahir,:jenis_kelamin,:alamat,:telepon,:prodi,:ipk,:foto,:nama_ortu,:pekerjaan_ortu,:gaji_ortu,:created_user,:updated_user)";
						        // membuat prepared statements
						        $stmt = $pdo->prepare($query);

						        // mengikat parameter
								$stmt->bindParam(':nim', $nim);
								$stmt->bindParam(':nama_mahasiswa', $nama_mahasiswa);
								$stmt->bindParam(':tempat_lahir', $tempat_lahir);
								$stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
								$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
								$stmt->bindParam(':alamat', $alamat);
								$stmt->bindParam(':telepon', $telepon);
								$stmt->bindParam(':prodi', $prodi);
								$stmt->bindParam(':ipk', $ipk);
								$stmt->bindParam(':foto', $nama_file);
								$stmt->bindParam(':nama_ortu', $nama_ortu);
								$stmt->bindParam(':pekerjaan_ortu', $pekerjaan_ortu);
								$stmt->bindParam(':gaji_ortu', $gaji_ortu);
								$stmt->bindParam(':created_user', $user);
								$stmt->bindParam(':updated_user', $user);

								// eksekusi query
						        $stmt->execute();

						        // jika berhasil tampilkan pesan berhasil delete data
								header("location: ../../main.php?module=mahasiswa&alert=1");

                            } else {
		                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
		                            header("location: ../../main.php?module=mahasiswa&alert=5");
		                    }
	                    } else {
	                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
	                        header("location: ../../main.php?module=mahasiswa&alert=6");
	                    }
	                } else {
	                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
	                    header("location: ../../main.php?module=mahasiswa&alert=7");
	                } 
				}

				// tutup koneksi database
		        $pdo = null;
			} catch (PDOException $e) {
				// tampilkan pesan kesalahan
		        echo "ada kesalahan pada query insert : ".$e->getMessage();
			}	
		}	
	}
	
	// update data
	elseif ($_GET['act']=='update') {
		if (isset($_POST['simpan'])) {
			if (isset($_POST['nim'])) {
				// ambil data hasil submit dari form
				$nim            = $_POST['nim'];
				$nama_mahasiswa = $_POST['nama_mahasiswa'];
				$tempat_lahir   = $_POST['tempat_lahir'];
				
				$tanggal        = $_POST['tanggal_lahir'];
				$tgl            = explode('-',$tanggal);
				$tanggal_lahir  = $tgl[2]."-".$tgl[1]."-".$tgl[0];
				
				$jenis_kelamin  = $_POST['jenis_kelamin'];
				$alamat         = $_POST['alamat'];
				$telepon        = $_POST['telepon'];
				$prodi          = $_POST['prodi'];
				$ipk            = $_POST['ipk'];
				
				$nama_ortu      = $_POST['nama_ortu'];
				$pekerjaan_ortu = $_POST['pekerjaan_ortu'];
				$gaji_ortu      = $_POST['gaji_ortu'];
				
				$nama_file      = $_FILES['foto']['name'];
				$ukuran_file    = $_FILES['foto']['size'];
				$tipe_file      = $_FILES['foto']['type'];
				$tmp_file       = $_FILES['foto']['tmp_name'];

		        // tentuka extension yang diperbolehkan
	            $allowed_extensions = array('jpg','jpeg','png');

	            // Set path folder tempat menyimpan gambarnya
	            $path_file = "../../images/mahasiswa/".$nama_file;

	            // check extension
	            $file = explode(".", $nama_file);
	            $extension = array_pop($file);

				// ambil data dari session
				$user = $_SESSION['id_user'];

				try {
					// jika foto diubah
					if (empty($_FILES['foto']['name'])) {
						// sql statement untuk mengubah data pada tabel is_mahasiswa
				        $query = "UPDATE is_mahasiswa SET nama_mahasiswa 	= :nama_mahasiswa,
				        								  tempat_lahir 		= :tempat_lahir,
				        								  tanggal_lahir 	= :tanggal_lahir,
				        								  jenis_kelamin 	= :jenis_kelamin,
				        								  alamat 			= :alamat,
				        								  telepon 			= :telepon,
				        								  prodi 			= :prodi,
				        								  ipk 				= :ipk,
				        								  nama_ortu 		= :nama_ortu,
				        								  pekerjaan_ortu 	= :pekerjaan_ortu,
				        								  gaji_ortu 		= :gaji_ortu,
													  	  updated_user 		= :updated_user
										  			WHERE nim				= :nim";

						// membuat prepared statements
				        $stmt = $pdo->prepare($query);

				        // mengikat parameter
						$stmt->bindParam(':nim', $nim);
						$stmt->bindParam(':nama_mahasiswa', $nama_mahasiswa);
						$stmt->bindParam(':tempat_lahir', $tempat_lahir);
						$stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
						$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
						$stmt->bindParam(':alamat', $alamat);
						$stmt->bindParam(':telepon', $telepon);
						$stmt->bindParam(':prodi', $prodi);
						$stmt->bindParam(':ipk', $ipk);
						$stmt->bindParam(':nama_ortu', $nama_ortu);
						$stmt->bindParam(':pekerjaan_ortu', $pekerjaan_ortu);
						$stmt->bindParam(':gaji_ortu', $gaji_ortu);
						$stmt->bindParam(':updated_user', $user);
					}
					// jika foto tidak diubah
					else {
						// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
						if (in_array($extension, $allowed_extensions)) {
		                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
		                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
		                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
		                        // Proses upload
		                        if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
	                        		// Jika gambar berhasil diupload, Lakukan : 
	                        		// sql statement untuk mengubah data pada tabel is_mahasiswa
							        $query = "UPDATE is_mahasiswa SET nama_mahasiswa 	= :nama_mahasiswa,
							        								  tempat_lahir 		= :tempat_lahir,
							        								  tanggal_lahir 	= :tanggal_lahir,
							        								  jenis_kelamin 	= :jenis_kelamin,
							        								  alamat 			= :alamat,
							        								  telepon 			= :telepon,
							        								  prodi 			= :prodi,
							        								  ipk 				= :ipk,
							        								  foto 				= :foto,
							        								  nama_ortu 		= :nama_ortu,
							        								  pekerjaan_ortu 	= :pekerjaan_ortu,
							        								  gaji_ortu 		= :gaji_ortu,
																  	  updated_user 		= :updated_user
													  			WHERE nim				= :nim";
							       
							        $stmt = $pdo->prepare($query);

							        // mengikat parameter
									$stmt->bindParam(':nim', $nim);
									$stmt->bindParam(':nama_mahasiswa', $nama_mahasiswa);
									$stmt->bindParam(':tempat_lahir', $tempat_lahir);
									$stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
									$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
									$stmt->bindParam(':alamat', $alamat);
									$stmt->bindParam(':telepon', $telepon);
									$stmt->bindParam(':prodi', $prodi);
									$stmt->bindParam(':ipk', $ipk);
									$stmt->bindParam(':foto', $nama_file);
									$stmt->bindParam(':nama_ortu', $nama_ortu);
									$stmt->bindParam(':pekerjaan_ortu', $pekerjaan_ortu);
									$stmt->bindParam(':gaji_ortu', $gaji_ortu);
									$stmt->bindParam(':updated_user', $user);

	                            } else {
			                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
			                            header("location: ../../main.php?module=mahasiswa&alert=5");
			                    }
		                    } else {
		                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
		                        header("location: ../../main.php?module=mahasiswa&alert=6");
		                    }
		                } else {
		                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
		                    header("location: ../../main.php?module=mahasiswa&alert=7");
		                } 
					}

					// eksekusi query
			        $stmt->execute();

			        // jika berhasil tampilkan pesan berhasil update data
					header("location: ../../main.php?module=mahasiswa&alert=2");

					// tutup koneksi database
			        $pdo = null;
				} catch (PDOException $e) {
					// tampilkan pesan kesalahan
			        echo "ada kesalahan pada query update : ".$e->getMessage();
				}
			}
		}
	}

	// delete data
	elseif ($_GET['act']=='delete') {
		if (isset($_GET['id'])) {
			try {
				$nim = $_GET['id'];

				// sql statement untuk menghapus data pada tabel is_mahasiswa
		        $query = "DELETE FROM is_mahasiswa WHERE nim=:nim";
		        // membuat prepared statements
				$stmt = $pdo->prepare($query);

				//mengikat parameter 
				$stmt->bindParam(':nim', $nim);

				// eksekusi query
				$stmt->execute();

		        // jika berhasil tampilkan pesan berhasil delete data
				header("location: ../../main.php?module=mahasiswa&alert=3");

				// tutup koneksi database
		        $pdo = null;
			} catch (PDOException $e) {
				// tampilkan pesan kesalahan
		        echo "ada kesalahan pada query delete : ".$e->getMessage();
			}
		}
	}		
}		
?>