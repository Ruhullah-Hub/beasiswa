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

// Panggil file database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk ubah password
else {
	if (isset($_POST['simpan'])) {
		if (isset($_SESSION['id_user'])) {
			// ambil data hasil submit dari form
			$old_pass    = md5(trim($_POST['old_pass']));
			$new_pass    = md5(trim($_POST['new_pass']));
			$retype_pass = md5(trim($_POST['retype_pass']));

			// ambil data hasil session user
			$id_user = $_SESSION['id_user'];

			try {
				// sql statement untuk seleksi password dari tabel user untuk dicek
				$sql = "SELECT password FROM is_users WHERE id_user = :id_user";
				// membuat prepared statements
				$stmt = $pdo->prepare($sql);

				// mengikat parameter
				$stmt->bindParam(':id_user', $id_user);

				// eksekusi query
				$stmt->execute();

				// mengambil data user
          		$data = $stmt->fetch(PDO::FETCH_ASSOC);

          		// fungsi untuk pengecekan password sebelum diubah 
				// jika input password lama tidak sama dengan password di database, 
				// alihkan ke halaman ubah password dan tampilkan pesan = 1
				if ($old_pass != $data['password']){
					header("Location: ../../main.php?module=password&alert=1");
				}

				// jika input password lama sama dengan password didatabase, jalankan perintah untuk pengecekan selanjutnya
				else {

					// jika input password baru tidak sama dengan input ulangi password baru, 
					// alihkan ke halaman ubah password dan tampilkan pesan = 2 
					if ($new_pass != $retype_pass){
							header("Location: ../../main.php?module=password&alert=2");
					}

					// selain itu, jalankan perintah update password
					else {
						try {
							// sql statement untuk mengubah data pada tabel is_users
							$query = "UPDATE is_users SET password = :password
													WHERE id_user  = :id_user";
							// membuat prepared statements
		        			$stmt = $pdo->prepare($query);

		        			// mengikat parameter
							$stmt->bindParam(':id_user', $id_user);
							$stmt->bindParam(':password', $new_pass);

							// eksekusi query
		        			$stmt->execute();

		        			// jika berhasil tampilkan pesan berhasil update data
							header("location: ../../main.php?module=password&alert=3");

							// tutup koneksi database
					        $pdo = null;
						} catch (Exception $e) {
							// tampilkan pesan kesalahan
	        				echo "ada kesalahan pada query update : ".$e->getMessage();
						}	
					}
				}
			} catch (Exception $e) {
				// tampilkan pesan kesalahan
        		echo "ada kesalahan pada query seleksi password : ".$e->getMessage();
			}
		}
	}	
}				
?>