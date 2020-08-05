
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login | Aplikasi Pengolahan Data Penerima Beasiswa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Aplikasi Pengolahan Data Penerima Beasiswa" />

		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

		<!-- favicon -->
    	<link rel="shortcut icon" href="assets/images/favicon.png" />

		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
		<!-- Graph CSS -->
		<link rel="stylesheet" type="text/css" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" /> 

		<!--animate-->
		<link rel="stylesheet" type="text/css" media="all" href="assets/css/animate.css" />
		<script src="assets/js/wow.min.js"></script>
		<script>
			 new WOW().init();
		</script>
		<!--//end-animate-->

	</head> 
   
	<body class="sign-in-up">
	    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="row">
		            <div class="col-md-4 col-md-offset-4">
		            <?php  
		            // fungsi untuk menampilkan pesan
		            // jika alert = "" (kosong)
		            // tampilkan pesan "" (kosong)
		            if (empty($_GET['alert'])) {
		              echo "";
		            } 
		            // jika alert = 1
		            // tampilkan pesan Gagal "username atau password salah, cek kembali username dan password Anda"
		            elseif ($_GET['alert'] == 1) {
		              echo "<div class='alert alert-danger alert-dismissible' role='alert'>
		                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		                        <span aria-hidden='true'>&times;</span>
		                      </button>
		                      <strong><i class='glyphicon glyphicon-alert'></i> Gagal Login!</strong><br> username atau password salah, cek kembali username dan password Anda.
		                    </div>";
		            } 
		            // jika alert = 2
		            // tampilkan pesan Sukses "Anda telah berhasil logout"
		            elseif ($_GET['alert'] == 2) {
		              echo "<div class='alert alert-success alert-dismissible' role='alert'>
		                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		                        <span aria-hidden='true'>&times;</span>
		                      </button>
		                      <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Anda telah berhasil logout.
		                    </div>";
		            }
		            ?>
		            </div>
		        </div>

				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<p><span><i style="margin-right:7px" class="glyphicon glyphicon-education"></i> Beasiswa</span></p>
						</div>
						<div class="signin">
							<form role="form" method="POST" action="login-check.php">
								<div class="log-input">
									<div class="log-input-center">
									   <input type="text" class="user" name="username" placeholder="Username" autofocus required />
									</div>
								</div>

								<div class="log-input">
									<div class="log-input-center">
									   <input type="password" class="lock" name="password" placeholder="Password" required />
									</div>
								</div>

								<input type="submit" name="login" value="Login">
							</form>	 
						</div>
					</div>
				</div>
			</div>
			<!--footer section start-->
			<footer>
			   <p><a href="" target="_blank"></a></p>
			</footer>
	        <!--footer section end-->
		</section>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="assets/js/jquery.nicescroll.js"></script>
		<script type="text/javascript" src="assets/js/scripts.js"></script>

	</body>
</html>