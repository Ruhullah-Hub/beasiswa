<?php 
/* panggil file database.php untuk koneksi ke database */
require_once "../../config/database.php";

header("Content-Type: application/force-download");
header("Cache-Control: no-cache, must-revalidate");
header("content-disposition: attachment;filename=DATA-MAHASISWA-PENERIMA-BEASISWA.xls");
?>

<!-- Buat Table saat di Export Ke Excel -->
<center>
	<h2>DATA MAHASISWA PENERIMA BEASISWA</h2>
</center>
<table border='1'>
	<h3>
		<thead>
			<tr>
				<td align="center" valign="top" width=50>No.</td>
				<td align="center" valign="top" width=100>NIM</td>
				<td align="center" valign="top" width=180>NAMA MAHASISWA</td>
				<td align="center" valign="top" width=140>TEMPAT LAHIR</td>
				<td align="center" valign="top" width=140>TANGGAL LAHIR</td>
				<td align="center" valign="top" width=140>JENIS KELAMIN</td>
				<td align="center" valign="top" width=300>ALAMAT</td>
				<td align="center" valign="top" width=100>TELEPON</td>
				<td align="center" valign="top" width=150>PROGRAM STUDI</td>
				<td align="center" valign="top" width=80>IPK</td>
				<td align="center" valign="top" width=180>NAMA ORANG TUA</td>
				<td align="center" valign="top" width=180>PEKERJAAN ORANG TUA</td>
				<td align="center" valign="top" width=150>GAJI ORANG TUA</td>
			</tr>
		</thead>
	</h3>

	<tbody>

	<?php
	try {
		$no = 1;
		// sql statement untuk menampilkan data dari tabel is_mahasiswa, is_prodi dan is_pekerjaan
		$query = "SELECT a.nim,a.nama_mahasiswa,a.tempat_lahir,a.tanggal_lahir,a.jenis_kelamin,a.alamat,a.telepon,a.prodi,a.ipk,a.foto,a.nama_ortu,a.pekerjaan_ortu,a.gaji_ortu,
	  			  b.nama_prodi,
	  			  c.nama_pekerjaan
	  			  FROM is_mahasiswa as a INNER JOIN is_prodi as b INNER JOIN is_pekerjaan as c
	  			  ON a.prodi=b.id_prodi AND a.pekerjaan_ortu=c.id_pekerjaan
	  			  WHERE a.ipk>'3.50' AND a.gaji_ortu<'1500000'
		          ORDER BY a.nim ASC";
		// membuat prepared statements
		$stmt = $pdo->prepare($query);

		// eksekusi query
		$stmt->execute();

		// tampilkan data
		while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$tanggal       = $data['tanggal_lahir'];
			$tgl           = explode('-',$tanggal);
			$tanggal_lahir = $tgl[2]."-".$tgl[1]."-".$tgl[0];
	?>
			<tr>
			    <td align="center" valign="top"><?php echo $no; ?></td>
			    <td align="center" valign="top"><?php echo $data['nim']; ?></td>
			    <td valign="top"><?php echo $data['nama_mahasiswa']; ?></td>
			    <td valign="top"><?php echo $data['tempat_lahir']; ?></td>
			    <td align="center" valign="top"><?php echo $tanggal_lahir; ?></td>
			    <td valign="top"><?php echo $data['jenis_kelamin']; ?></td>
			    <td valign="top"><?php echo $data['alamat']; ?></td>
			    <td align="center" valign="top"><?php echo $data['telepon']; ?></td>
			    <td valign="top"><?php echo $data['nama_prodi']; ?></td>
			    <td align="center" valign="top"><?php echo $data['ipk']; ?></td>
			    <td valign="top"><?php echo $data['nama_ortu']; ?></td>
			    <td valign="top"><?php echo $data['nama_pekerjaan']; ?></td>
			    <td align="right" valign="top"><?php echo $data['gaji_ortu']; ?></td>
			</tr>
<?php
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