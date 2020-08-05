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
			// fungsi untuk membuat id prodi
			try {
				// sql statement untuk menampilkan data dari tabel is_prodi berdasarkan id_prodi
				$query = "SELECT max(id_prodi) as kode FROM is_prodi";
				// membuat prepared statements
				$stmt = $pdo->prepare($query);

				// eksekusi query
				$stmt->execute();

				// mengambil data
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				// nilai untuk mengisi form
				$id_prodi = $data['kode'] + 1;

			} catch (PDOException $e) {
				// tampilkan pesan kesalahan
				echo "ada kesalahan pada query id prodi : ".$e->getMessage();
			}

			// ambil data hasil submit dari form
			$nama_prodi = $_POST['prodi'];

			// ambil data dari session
			$user = $_SESSION['id_user'];

			try {
				// sql statement untuk menyimpan data ke tabel is_prodi
		        $query = "INSERT INTO is_prodi(id_prodi,nama_prodi,created_user,updated_user)	
						  VALUES(:id_prodi,:nama_prodi,:created_user,:updated_user)";
		        // membuat prepared statements
		        $stmt = $pdo->prepare($query);

		        // mengikat parameter
				$stmt->bindParam(':id_prodi', $id_prodi);
				$stmt->bindParam(':nama_prodi', $nama_prodi);
				$stmt->bindParam(':created_user', $user);
				$stmt->bindParam(':updated_user', $user);

				// eksekusi query
		        $stmt->execute();

		        // jika berhasil tampilkan pesan berhasil delete data
				header("location: ../../main.php?module=prodi&alert=1");

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
			if (isset($_POST['id_prodi'])) {
				// ambil data hasil submit dari form
				$id_prodi   = $_POST['id_prodi'];
				$nama_prodi = $_POST['prodi'];

				// ambil data dari session
				$user = $_SESSION['id_user'];

				try {
					// sql statement untuk mengubah data pada tabel is_prodi
			        $query = "UPDATE is_prodi SET nama_prodi 	= :nama_prodi,
												  updated_user 	= :updated_user
									  		WHERE id_prodi		= :id_prodi";

					// membuat prepared statements
			        $stmt = $pdo->prepare($query);

			        // mengikat parameter
					$stmt->bindParam(':id_prodi', $id_prodi);
					$stmt->bindParam(':nama_prodi', $nama_prodi);
					$stmt->bindParam(':updated_user', $user);


					// eksekusi query
			        $stmt->execute();

			        // jika berhasil tampilkan pesan berhasil update data
					header("location: ../../main.php?module=prodi&alert=2");

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
				$id_prodi = $_GET['id'];

				// sql statement untuk menghapus data pada tabel is_prodi
		        $query = "DELETE FROM is_prodi WHERE id_prodi=:id_prodi";
		        // membuat prepared statements
				$stmt = $pdo->prepare($query);

				//mengikat parameter 
				$stmt->bindParam(':id_prodi', $id_prodi);

				// eksekusi query
				$stmt->execute();

		        // jika berhasil tampilkan pesan berhasil delete data
				header("location: ../../main.php?module=prodi&alert=3");

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