<!-- Aplikasi Pengolahan Data Penerima Beasiswa
************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 24 Juli 2016
* Website      : http://www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->
   
<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1"><i class="fa fa-lock"></i> Ubah Password</h3>

		<?php 
		// fungsi untuk menampilkan pesan
		// jika alert = "" (kosong)
		// tampilkan pesan "" (kosong) 
		if (empty($_GET['alert'])) {
		    echo "";
		} 
		// jika alert = 1
		// tampilkan pesan Gagal "Paswword lama Anda salah"
		elseif ($_GET['alert'] == 1) {
		    echo "	<div class='alert alert-danger alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-times-circle'></i> Gagal!</strong> Paswword lama Anda salah.
		          	</div>";
		} 
		// jika alert = 2
		// tampilkan pesan Gagal "Password baru dan Ulangi password baru tidak cocok"
		elseif ($_GET['alert'] == 2) {
		    echo "	<div class='alert alert-danger alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-times-circle'></i> Gagal!</strong> Password baru dan Ulangi password baru tidak cocok.
		          	</div>";
		}
		// jika alert = 3
		// tampilkan pesan Sukses "Password berhasil diubah"
		elseif ($_GET['alert'] == 3) {
		    echo "	<div class='alert alert-success alert-dismissible' role='alert'>
		            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		              		<span aria-hidden='true'>&times;</span>
		            	</button>
		            	<strong><i class='fa fa-check-circle'></i> Sukses!</strong> Password berhasil diubah.
		          	</div>";
		}
		?>

        <div class="tab-content bs-example1">
            <div class="tab-pane active" id="horizontal-form">
              	<form class="form-horizontal" method="POST" action="modules/password/proses.php">
 
                	<div class="form-group">
                  		<label class="col-sm-3 control-label">Password Lama</label>
                  		<div class="col-sm-5">
                    		<input type="password" class="form-control1" name="old_pass" autocomplete="off" required>
                  		</div>
                	</div>

                	<div class="form-group">
                  		<label class="col-sm-3 control-label">Password Baru</label>
                  		<div class="col-sm-5">
                    		<input type="password" class="form-control1" name="new_pass" autocomplete="off" required>
                  		</div>
                	</div>

                	<div class="form-group">
                  		<label class="col-sm-3 control-label">Ulangi Password Baru</label>
                  		<div class="col-sm-5">
                    		<input type="password" class="form-control1" name="retype_pass" autocomplete="off" required>
                  		</div>
                	</div>
					
					<hr>
                	<div class="form-group">
              			<div class="col-sm-offset-3 col-sm-9">
                			<input type="submit" class="btn btn-info btn-submit" name="simpan" value="Simpan">
              			</div>
            		</div>
              	</form>
            </div>
        </div> 
    </div>
</div>