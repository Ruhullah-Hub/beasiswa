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

try {
  	// sql statement untuk menampilkan data dari tabel is_users berdasarkan id_user
  	$query = "SELECT nama_lengkap, foto, level FROM is_users
              WHERE id_user=:id_user";
  	// membuat prepared statements
  	$stmt = $pdo->prepare($query);

  	// mengikat parameter 
  	$stmt->bindParam(':id_user', $_SESSION['id_user']);

  	// eksekusi query
  	$stmt->execute();

  	// mengambil data
  	$data = $stmt->fetch(PDO::FETCH_ASSOC);

	// nilai untuk mengisi form
	$nama_lengkap = $data['nama_lengkap'];
	$foto         = $data['foto'];
	$level        = $data['level'];

} catch (PDOException $e) {
	// tampilkan pesan kesalahan
	echo "ada kesalahan pada query : ".$e->getMessage();
}
?>
<div class="profile_details">		
	<ul>
		<li class="dropdown profile_details_drop">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<div class="profile_img">	
				<?php  
				if ($foto=="") { ?>
					<span style="background:url(images/user/default_user.png) no-repeat center"></span> 
				<?php
				}
				else { ?>
					<span style="background:url(images/user/<?php echo $foto; ?>) no-repeat center"></span> 
				<?php
				}
				?>
					
					<div class="user-name">
						<p><?php echo $nama_lengkap; ?><span><?php echo $level; ?></span></p>
					</div>
					<i class="fa fa-chevron-down"></i>
					<div class="clearfix"></div>	
				</div>	
			</a>
			<ul class="dropdown-menu drp-mnu">
				<li style="margin-top:7px">
					<a href="?module=profil"><i class="fa fa-user"></i>Profil</a>
				</li> 
				<li>
					<a href="?module=password"><i class="fa fa-lock"></i>Ubah Password</a>
				</li> 
				<li role="separator" class="divider"></li>
				<li>
					<a data-toggle="modal" href="#logout"><i class="fa fa-sign-out"></i> Logout</a>
				</li>
			</ul>
		</li>
		<div class="clearfix"> </div>
	</ul>
</div>	