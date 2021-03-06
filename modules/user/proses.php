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
			// fungsi untuk membuat id user
			try {
				// sql statement untuk menampilkan data dari tabel is_users berdasarkan id_user
				$query = "SELECT max(id_user) as kode FROM is_users";
				// membuat prepared statements
				$stmt = $pdo->prepare($query);

				// eksekusi query
				$stmt->execute();

				// mengambil data user
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				// nilai untuk mengisi form
				$id_user = $data['kode'] + 1;

			} catch (PDOException $e) {
				// tampilkan pesan kesalahan
				echo "ada kesalahan pada query id user : ".$e->getMessage();
			}

			// ambil data hasil submit dari form
			$username     = trim($_POST['username']);
			$password     = md5(trim($_POST['password']));
			$nama_lengkap = trim($_POST['nama_lengkap']);

			try {
				// sql statement untuk menyimpan data ke tabel is_users
		        $query = "INSERT INTO is_users(id_user,username,nama_lengkap,password)	
						  VALUES(:id_user,:username,:nama_lengkap,:password)";
		        // membuat prepared statements
		        $stmt = $pdo->prepare($query);

		        // mengikat parameter
				$stmt->bindParam(':id_user', $id_user);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':nama_lengkap', $nama_lengkap);
				$stmt->bindParam(':password', $password);

				// eksekusi query
		        $stmt->execute();

		        // jika berhasil tampilkan pesan berhasil delete data
				header("location: ../../main.php?module=user&alert=1");

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
			if (isset($_POST['id_user'])) {
				// ambil data hasil submit dari form
				$id_user      = $_POST['id_user'];
				$username     = trim($_POST['username']);
				$password     = md5(trim($_POST['password']));
				$nama_lengkap = trim($_POST['nama_lengkap']);
				$email        = trim($_POST['email']);
				$telepon      = trim($_POST['telepon']);

				$nama_file   = $_FILES['foto']['name'];
	            $ukuran_file = $_FILES['foto']['size'];
	            $tipe_file   = $_FILES['foto']['type'];
	            $tmp_file    = $_FILES['foto']['tmp_name'];

	            // tentuka extension yang diperbolehkan
                $allowed_extensions = array('jpg','jpeg','png');

                // Set path folder tempat menyimpan gambarnya
                $path_file = "../../images/user/".$nama_file;

                // check extension
                $file = explode(".", $nama_file);
                $extension = array_pop($file);

				try {
					// jika password tidak diisi dan foto tidak diubah
					if (empty($_POST['password']) && empty($_FILES['foto']['name'])) {
						// sql statement untuk mengubah data pada tabel is_users
				        $query = "UPDATE is_users SET username 		= :username,
													  nama_lengkap 	= :nama_lengkap,
													  email 		= :email,
													  telepon		= :telepon
										  		WHERE id_user 		= :id_user";

				        // membuat prepared statements
				        $stmt = $pdo->prepare($query);

				        // mengikat parameter
						$stmt->bindParam(':id_user', $id_user);
						$stmt->bindParam(':username', $username);
						$stmt->bindParam(':nama_lengkap', $nama_lengkap);
						$stmt->bindParam(':email', $email);
						$stmt->bindParam(':telepon', $telepon);
					}
					// jika password diisi dan foto tidak diubah
					elseif (!empty($_POST['password']) && empty($_FILES['foto']['name'])) {
						// sql statement untuk mengubah data pada tabel is_users
				        $query = "UPDATE is_users SET username 		= :username,
													  nama_lengkap 	= :nama_lengkap,
													  password 		= :password,
													  email 		= :email,
													  telepon		= :telepon
										  		WHERE id_user 		= :id_user";

				        // membuat prepared statements
				        $stmt = $pdo->prepare($query);

				        // mengikat parameter
						$stmt->bindParam(':id_user', $id_user);
						$stmt->bindParam(':username', $username);
						$stmt->bindParam(':nama_lengkap', $nama_lengkap);
						$stmt->bindParam(':password', $password);
						$stmt->bindParam(':email', $email);
						$stmt->bindParam(':telepon', $telepon);
					}
					// jika password tidak diisi dan foto diubah
					elseif (empty($_POST['password']) && !empty($_FILES['foto']['name'])) {
						// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
						if (in_array($extension, $allowed_extensions)) {
		                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
		                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
		                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
		                        // Proses upload
		                        if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                            		// Jika gambar berhasil diupload, Lakukan : 
                            		// sql statement untuk mengubah data pada tabel is_users
							        $query = "UPDATE is_users SET username 		= :username,
																  nama_lengkap 	= :nama_lengkap,
																  email 		= :email,
																  telepon		= :telepon,
																  foto			= :foto
													  		WHERE id_user 		= :id_user";

							        // membuat prepared statements
							        $stmt = $pdo->prepare($query);

							        // mengikat parameter
									$stmt->bindParam(':id_user', $id_user);
									$stmt->bindParam(':username', $username);
									$stmt->bindParam(':nama_lengkap', $nama_lengkap);
									$stmt->bindParam(':email', $email);
									$stmt->bindParam(':telepon', $telepon);
									$stmt->bindParam(':foto', $nama_file);
                            	} else {
		                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
		                            header("location: ../../main.php?module=user&alert=5");
		                        }
		                    } else {
		                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
		                        header("location: ../../main.php?module=user&alert=6");
		                    }
		                } else {
		                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
		                    header("location: ../../main.php?module=user&alert=7");
		                } 
					}
					// jika password diisi dan foto diubah
					else {
						// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
						if (in_array($extension, $allowed_extensions)) {
		                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
		                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
		                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
		                        // Proses upload
		                        if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                            		// Jika gambar berhasil diupload, Lakukan : 
                            		// sql statement untuk mengubah data pada tabel is_users
							        $query = "UPDATE is_users SET username 		= :username,
																  nama_lengkap 	= :nama_lengkap,
																  password 		= :password,
																  email 		= :email,
																  telepon		= :telepon,
																  foto 			= :foto
													  		WHERE id_user		= :id_user";

									// membuat prepared statements
							        $stmt = $pdo->prepare($query);

							        // mengikat parameter
									$stmt->bindParam(':id_user', $id_user);
									$stmt->bindParam(':username', $username);
									$stmt->bindParam(':nama_lengkap', $nama_lengkap);
									$stmt->bindParam(':password', $password);
									$stmt->bindParam(':email', $email);
									$stmt->bindParam(':telepon', $telepon);
									$stmt->bindParam(':foto', $nama_file);
                            	} else {
		                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
		                            header("location: ../../main.php?module=user&alert=5");
		                        }
		                    } else {
		                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
		                        header("location: ../../main.php?module=user&alert=6");
		                    }
		                } else {
		                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
		                    header("location: ../../main.php?module=user&alert=7");
		                } 
					}

					// eksekusi query
			        $stmt->execute();

			        // jika berhasil tampilkan pesan berhasil update data
					header("location: ../../main.php?module=user&alert=2");

					// tutup koneksi database
			        $pdo = null;
				} catch (PDOException $e) {
					// tampilkan pesan kesalahan
			        echo "ada kesalahan pada query update : ".$e->getMessage();
				}
			}
		}
	}

	// update status menjadi aktif
	elseif ($_GET['act']=='on') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$id_user = $_GET['id'];

			$status = "aktif";

			try {
				// sql statement untuk mengubah data pada tabel is_users
		        $query = "UPDATE is_users SET status 	   = :status
								  		WHERE id_user 	   = :id_user";

				// membuat prepared statements
		        $stmt = $pdo->prepare($query);

		        // mengikat parameter
				$stmt->bindParam(':id_user', $id_user);
				$stmt->bindParam(':status', $status);

				// eksekusi query
		        $stmt->execute();

		        // jika berhasil tampilkan pesan berhasil update data
				header("location: ../../main.php?module=user&alert=3");

				// tutup koneksi database
		        $pdo = null;
			} catch (PDOException $e) {
				// tampilkan pesan kesalahan
		        echo "ada kesalahan pada query update status : ".$e->getMessage();
			}
		}
	}

	// update status menjadi blokir
	elseif ($_GET['act']=='off') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$id_user = $_GET['id'];

			$status = "blokir";

			try {
				// sql statement untuk mengubah data pada tabel is_users
		        $query = "UPDATE is_users SET status 	   = :status
								  		WHERE id_user 	   = :id_user";

				// membuat prepared statements
		        $stmt = $pdo->prepare($query);

		        // mengikat parameter
				$stmt->bindParam(':id_user', $id_user);
				$stmt->bindParam(':status', $status);

				// eksekusi query
		        $stmt->execute();

		        // jika berhasil tampilkan pesan berhasil update data
				header("location: ../../main.php?module=user&alert=4");

				// tutup koneksi database
		        $pdo = null;
			} catch (PDOException $e) {
				// tampilkan pesan kesalahan
		        echo "ada kesalahan pada query update status : ".$e->getMessage();
			}
		}
	}		
}		
?>