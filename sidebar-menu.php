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
// fungsi pengecekan level untuk menampilkan menu sesuai dengan level
// jika level = admin, tampilkan menu
if ($_SESSION['level']=='admin') { ?>
  	<!--sidebar nav start-->
	<ul class="nav nav-pills nav-stacked custom-nav">
	<?php 
	// fungsi untuk pengecekan menu aktif
	// jika menu dashboard dipilih, menu dashboard aktif
	if ($_GET["module"]=="dashboard") {
		echo '<li class="active">
				<a href="?module=dashboard">
					<i class="fa fa-dashboard"></i> <span> Dashboard</span>
				</a>
			  </li>';
	}
	// jika tidak, menu dashboard tidak aktif
	else {
		echo '<li>
				<a href="?module=dashboard">
					<i class="fa fa-dashboard"></i> <span> Dashboard</span>
				</a>
			  </li>';
	}

	// jika menu prodi dipilih, menu prodi aktif
	if ($_GET["module"]=="prodi") {
		echo '<li class="active">
				<a href="?module=prodi">
					<i class="fa fa-desktop"></i> <span> Program Studi</span>
				</a>
			  </li>';
	}
	// jika tidak, menu prodi tidak aktif
	else {
		echo '<li>
				<a href="?module=prodi">
					<i class="fa fa-desktop"></i> <span> Program Studi</span>
				</a>
			  </li>';
	}

	// jika menu mahasiswa dipilih, menu mahasiswa aktif
	if ($_GET["module"]=="mahasiswa") {
		echo '<li class="active">
				<a href="?module=mahasiswa">
					<i class="fa fa-users"></i> <span> Mahasiswa</span>
				</a>
			  </li>';
	}
	// jika tidak, menu mahasiswa tidak aktif
	else {
		echo '<li>
				<a href="?module=mahasiswa">
					<i class="fa fa-users"></i> <span> Mahasiswa</span>
				</a>
			  </li>';
	}

	// jika menu beasiswa dipilih, menu beasiswa aktif
	if ($_GET["module"]=="beasiswa") {
		echo '<li class="active">
				<a href="?module=beasiswa">
					<i class="fa fa-graduation-cap"></i> <span> Beasiswa</span>
				</a>
			  </li>';
	}
	// jika tidak, menu beasiswa tidak aktif
	else {
		echo '<li>
				<a href="?module=beasiswa">
					<i class="fa fa-graduation-cap"></i> <span> Beasiswa</span>
				</a>
			  </li>';
	}

	// jika menu user dipilih, menu user aktif
	if ($_GET["module"]=="user") {
		echo '<li class="active">
				<a href="?module=user">
					<i class="fa fa-user"></i> <span> Manajemen User</span>
				</a>
			  </li>';
	}
	// jika tidak, menu user tidak aktif
	else {
		echo '<li>
				<a href="?module=user">
					<i class="fa fa-user"></i> <span> Manajemen User</span>
				</a>
			  </li>';
	}
	?>
	</ul>
	<!--sidebar nav end-->
<?php
}
// jika level = user, tampilkan menu
elseif ($_SESSION['level']=='user') { ?>
  	<!--sidebar nav start-->
	<ul class="nav nav-pills nav-stacked custom-nav">
	<?php 
	// fungsi untuk pengecekan menu aktif
	// jika menu dashboard dipilih, menu dashboard aktif
	if ($_GET["module"]=="dashboard") {
		echo '<li class="active">
				<a href="?module=dashboard">
					<i class="fa fa-dashboard"></i> <span> Dashboard</span>
				</a>
			  </li>';
	}
	// jika tidak, menu dashboard tidak aktif
	else {
		echo '<li>
				<a href="?module=dashboard">
					<i class="fa fa-dashboard"></i> <span> Dashboard</span>
				</a>
			  </li>';
	}

	// jika menu prodi dipilih, menu prodi aktif
	if ($_GET["module"]=="prodi") {
		echo '<li class="active">
				<a href="?module=prodi">
					<i class="fa fa-desktop"></i> <span> Program Studi</span>
				</a>
			  </li>';
	}
	// jika tidak, menu prodi tidak aktif
	else {
		echo '<li>
				<a href="?module=prodi">
					<i class="fa fa-desktop"></i> <span> Program Studi</span>
				</a>
			  </li>';
	}

	// jika menu mahasiswa dipilih, menu mahasiswa aktif
	if ($_GET["module"]=="mahasiswa") {
		echo '<li class="active">
				<a href="?module=mahasiswa">
					<i class="fa fa-users"></i> <span> Mahasiswa</span>
				</a>
			  </li>';
	}
	// jika tidak, menu mahasiswa tidak aktif
	else {
		echo '<li>
				<a href="?module=mahasiswa">
					<i class="fa fa-users"></i> <span> Mahasiswa</span>
				</a>
			  </li>';
	}

	// jika menu beasiswa dipilih, menu beasiswa aktif
	if ($_GET["module"]=="beasiswa") {
		echo '<li class="active">
				<a href="?module=beasiswa">
					<i class="fa fa-graduation-cap"></i> <span> Beasiswa</span>
				</a>
			  </li>';
	}
	// jika tidak, menu beasiswa tidak aktif
	else {
		echo '<li>
				<a href="?module=beasiswa">
					<i class="fa fa-graduation-cap"></i> <span> Beasiswa</span>
				</a>
			  </li>';
	}
	?>
	</ul>
	<!--sidebar nav end-->
<?php
}
?>