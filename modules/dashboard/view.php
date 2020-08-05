
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/highcharts.js"></script>

<script type="text/javascript">
// script untuk membuat grafik batang
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'prodi',
                type: 'column',  
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Jumlah Mahasiswa Penerima Beasiswa Per Program Studi',
                x: -20 // center
            },
            xAxis: { // X axis
                categories: ['Program Studi']
            },
            yAxis: {
                title: {  // label yAxis
                    text: 'Jumlah Mahasiswa'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080' //warna dari grafik line
                }]
            },
            tooltip: { 
                //fungsi tooltip, ini opsional, kegunaan dari fungsi ini 
                //akan menampikan data di titik tertentu di grafik saat mouseover
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+'Jumlah : '+ this.y;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },

            series: 
            [
            <?php 
            // sql statement untuk menampilkan data dari tabel is_mahasiswa dan is_prodi
			$query1 = "SELECT a.prodi, b.id_prodi, b.nama_prodi 
					   FROM is_mahasiswa as a INNER JOIN is_prodi as b 
					   ON a.prodi=b.id_prodi 
					   WHERE a.ipk>'3.50' AND a.gaji_ortu<'1500000'
					   GROUP BY id_prodi ASC";
			// membuat prepared statements
			$stmt1 = $pdo->prepare($query1);

			// eksekusi query
			$stmt1->execute();

			// tampilkan data
			while ($data1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
				$id_prodi   = $data1['id_prodi'];
				$nama_prodi = $data1['nama_prodi'];

                // sql statement untuk menampilkan data dari tabel is_mahasiswa dan is_prodi
				$query2 = "SELECT COUNT(a.nim) as jumlah, a.prodi, b.nama_prodi 
			               FROM is_mahasiswa as a INNER JOIN is_prodi as b
			               ON a.prodi=b.id_prodi
			               WHERE a.ipk>'3.50' AND a.gaji_ortu<'1500000' AND a.prodi=:prodi";
				// membuat prepared statements
				$stmt2 = $pdo->prepare($query2);

				// mengikat parameter 
				$stmt2->bindParam(':prodi', $id_prodi);

				// eksekusi query
				$stmt2->execute();

				// tampilkan data
				while ($data2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
					$jumlah = $data2['jumlah'];
				}             
                ?>
                {  
                    name: '<?php echo $nama_prodi; ?>',
                    //data yang akan ditampilkan 
                    data: [<?php echo $jumlah; ?>]
                },
                <?php } ?>
            ]
        });
    });
    
});
</script>

<script type="text/javascript">
	$(function () {
		chart = new Highcharts.Chart({
            chart: {
                renderTo: 'pie',
                type: 'pie',  
                marginRight: 5
            },
			title: {
				text: 'Jumlah Mahasiswa Penerima Beasiswa Per Jenis Kelamin'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b><br> {point.percentage:.1f} %',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						}
					}
				}
			},
			series: [{
				type: 'pie',
				name: 'SP',
				data: [
				<?php
				// sql statement untuk menampilkan data dari tabel is_mahasiswa
				$query1 = "SELECT jenis_kelamin FROM is_mahasiswa 
						   WHERE ipk>'3.50' AND gaji_ortu<'1500000' 
						   GROUP BY jenis_kelamin ASC";
				// membuat prepared statements
				$stmt1 = $pdo->prepare($query1);

				// eksekusi query
				$stmt1->execute();

				// tampilkan data
				while ($data1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
					$jenis_kelamin = $data1['jenis_kelamin'];

					// sql statement untuk menampilkan data dari tabel is_mahasiswa
					$query2 = "SELECT COUNT(nim) as jumlah, jenis_kelamin
					           FROM is_mahasiswa
					           WHERE ipk>'3.50' AND gaji_ortu<'1500000' AND jenis_kelamin=:jenis_kelamin";
					// membuat prepared statements
					$stmt2 = $pdo->prepare($query2);

					// mengikat parameter 
					$stmt2->bindParam(':jenis_kelamin', $jenis_kelamin);

					// eksekusi query
					$stmt2->execute();

					// tampilkan data
					while ($data2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
						$jumlah = $data2['jumlah'];     
					?>   
		                ['<?php echo $jenis_kelamin; ?>', <?php echo $jumlah; ?>],
		                
				   	<?php
				   	} //end while
			   	} //end while
			   	?>
				]
			}]
		});
	});
	</script>

<div id="page-wrapper">
	<div class="graphs">

		<div class='alert alert-info alert-dismissible' role='alert'>
        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          		<span aria-hidden='true'>&times;</span>
        	</button>
        	<i class="fa fa-user"></i> Selamat datang <strong><?php echo $_SESSION['nama_lengkap']; ?></strong> <br/>
      	</div>

		<div class="col_3">
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="fa fa-desktop"></i>
					<div class="stats">
					  	<div class="grow grow1">
							<p><a style="color:#fff" href="?module=prodi">Program Studi</a></p>
					  	</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="fa fa-users"></i>
					<div class="stats">
					  	<div class="grow grow1">
							<p><a style="color:#fff" href="?module=mahasiswa">Mahasiswa</a></p>
					  	</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="fa fa-graduation-cap"></i>
					<div class="stats">
					  	<div class="grow grow1">
							<p><a style="color:#fff" href="?module=beasiswa">Beasiswa</a></p>
					  	</div>
					</div>
				</div>
			</div>
		<?php  
		if ($_SESSION['level']=='admin') { ?>
			<div class="col-md-3 widget">
				<div class="r3_counter_box">
					<i class="fa fa-user"></i>
					<div class="stats">
					  	<div class="grow grow1">
							<p><a style="color:#fff" href="?module=user">User</a></p>
					  	</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
			<div class="clearfix"> </div>
		</div>
		<hr>

	    <div style="margin-bottom: 35px">
	    	<div class="col-md-7 widget">
				<div class="tab-content bs-example1">
					<div id="prodi" style="min-width: 310px; height: 342px; max-width: 600px;"></div>
				</div>
			</div>
			
			<div class="col-md-5 widget">
				<div class="tab-content bs-example1">
					<div id="pie" style="min-width: 310px; height: 342px; max-width: 600px;"></div>
				</div>
			</div>
			<div class="clearfix"> </div>
	    </div>
	</div>
</div>