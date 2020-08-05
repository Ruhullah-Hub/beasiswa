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
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";
require_once "config/fungsi_rupiah.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
	// jika halaman konten yang dipilih dashboard, panggil file view dashboard
	if ($_GET['module'] == 'dashboard') {
		include "modules/dashboard/view.php";
	}

	// jika halaman konten yang dipilih prodi, panggil file view prodi
	elseif ($_GET['module'] == 'prodi') {
		include "modules/prodi/view.php";
	}

	// jika halaman konten yang dipilih form prodi, panggil file form prodi
	elseif ($_GET['module'] == 'form_prodi') {
		include "modules/prodi/form.php";
	}
	// -----------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih mahasiswa, panggil file view mahasiswa
	elseif ($_GET['module'] == 'mahasiswa') {
		include "modules/mahasiswa/view.php";
	}

	// jika halaman konten yang dipilih form mahasiswa, panggil file form mahasiswa
	elseif ($_GET['module'] == 'form_mahasiswa') {
		include "modules/mahasiswa/form.php";
	}
	// -----------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih beasiswa, panggil file view beasiswa
	elseif ($_GET['module'] == 'beasiswa') {
		include "modules/beasiswa/view.php";
	}

	// jika halaman konten yang dipilih form beasiswa, panggil file form beasiswa
	elseif ($_GET['module'] == 'form_beasiswa') {
		include "modules/beasiswa/form.php";
	}
	// -----------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih user, panggil file view user
	elseif ($_GET['module'] == 'user' && $_SESSION['level']=='admin') {
		include "modules/user/view.php";
	}

	// jika halaman konten yang dipilih form user, panggil file form user
	elseif ($_GET['module'] == 'form_user' && $_SESSION['level']=='admin') {
		include "modules/user/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih profil, panggil file view profil
	elseif ($_GET['module'] == 'profil') {
		include "modules/profil/view.php";
	}

	// jika halaman konten yang dipilih form profil, panggil file form profil
	elseif ($_GET['module'] == 'form_profil') {
		include "modules/profil/form.php";
	}
	// -----------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih password, panggil file view password
	elseif ($_GET['module'] == 'password') {
		include "modules/password/view.php";
	}
}
?>