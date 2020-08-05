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
// panggil file database.php untuk koneksi ke database
require_once "config/database.php";

if (isset($_POST['login'])) {
	// ambil data hasil submit dari form
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$status   = "aktif";

	try {
		// sql statement untuk seleksi data dari tabel is_user
		$query = "SELECT * FROM is_users WHERE username = :username AND password = :password AND status = :status";
		// membuat prepared statements
		$stmt = $pdo->prepare($query);

		// mengikat parameter
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':status', $status);

		// eksekusi query
		$stmt->execute();

		$count = $stmt->rowCount();
		// jika data ada, jalankan perintah untuk membuat session
		if($count > 0) {
			// mengambil data user
          	$data = $stmt->fetch(PDO::FETCH_ASSOC);
          	
			session_start();
			$_SESSION['id_user']      = $data['id_user'];
			$_SESSION['username']     = $data['username'];
			$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
			$_SESSION['password']     = $data['password'];
			$_SESSION['level']        = $data['level'];
			$_SESSION['status']       = $data['status'];
			// lalu alihkan ke halaman admin
			header("Location: main.php?module=dashboard");
			return;
		}
		// jika data tidak ada, alihkan ke halaman login dan tampilkan pesan = 1
		else {
			header("Location: index.php?alert=1");
		}
	} catch (Exception $e) {
		// tampilkan pesan kesalahan
        echo "ada kesalahan pada query : ".$e->getMessage();
	}
}
?>