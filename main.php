
<?php  
session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Admin Panel | Aplikasi Pengolahan Data Penerima Beasiswa</title>
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

		<!-- page specific plugin styles -->
	    <link rel="stylesheet" type="text/css" href="assets/css/datepicker.min.css" />
	    <link rel="stylesheet" type="text/css" href="assets/js/dataTables/css/dataTables.bootstrap.css" />

		<!--animate-->
		<link rel="stylesheet" type="text/css" media="all" href="assets/css/animate.css" />
		<script type="text/javascript" src="assets/js/wow.min.js"></script>
		<script>
			 new WOW().init();
		</script>
		<!--//end-animate-->
		
		<!-- Fungsi untuk membatasi karakter yang diinputkan -->
	    <script language="javascript">
	      function getkey(e)
	      {
	        if (window.event)
	          return window.event.keyCode;
	        else if (e)
	          return e.which;
	        else
	          return null;
	      }

	      function goodchars(e, goods, field)
	      {
	        var key, keychar;
	        key = getkey(e);
	        if (key == null) return true;
	       
	        keychar = String.fromCharCode(key);
	        keychar = keychar.toLowerCase();
	        goods = goods.toLowerCase();
	       
	        // check goodkeys
	        if (goods.indexOf(keychar) != -1)
	            return true;
	        // control keys
	        if ( key==null || key==0 || key==8 || key==9 || key==27 )
	          return true;
	          
	        if (key == 13) {
	            var i;
	            for (i = 0; i < field.form.elements.length; i++)
	                if (field == field.form.elements[i])
	                    break;
	            i = (i + 1) % field.form.elements.length;
	            field.form.elements[i].focus();
	            return false;
	            };
	        // else return false
	        return false;
	    }
	    </script>
	</head> 
   
	<body class="sticky-header left-side-collapsed"  onload="initMap()">
	    <section>
	    	<!-- left side start-->
			<div class="left-side sticky-left-side">

				<!--logo and iconic logo start-->
				<div class="logo">
					<h1><a href="?module=dashboard"><i style="margin-right:7px" class="glyphicon glyphicon-education"></i> Beasiswa</a></h1>
				</div>
				<div class="logo-icon text-center">
					<a href="?module=dashboard"><i class="fa fa-home"></i> </a>
				</div>

				<!--logo and iconic logo end-->
				<div class="left-side-inner">

					<!-- panggil file "sidebar-menu.php" untuk menampilkan menu -->
          			<?php include "sidebar-menu.php" ?>

				</div>
			</div>
			<!-- left side end-->
	    
			<!-- main content start-->
			<div class="main-content">
				<!-- header-starts -->
				<div class="header-section">
				 
					<!--toggle button start-->
					<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
					<!--toggle button end-->

					<!--notification menu start -->
					<div class="menu-right">
						<div class="user-panel-top">  
							
							<!-- panggil file "top-menu.php" untuk menampilkan menu -->
          					<?php include "top-menu.php" ?>

							<div class="clearfix"></div>
						</div>
					</div>
					<!--notification menu end -->
				</div>
				<!-- //header-ends -->

				<!-- panggil file "content-menu.php" untuk menampilkan content -->
          		<?php include "content.php" ?>

          		<!-- Modal Logout -->
				<div class="modal fade" id="logout">
					<div class="modal-dialog">
					  	<div class="modal-content">
						    <div class="modal-header">
						      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						      	<h4 class="modal-title"><i class="fa fa-sign-out"> Logout</i></h4>
						    </div>
						    <div class="modal-body">
						      	<p>Apakah Anda yakin ingin logout? </p>
						    </div>
						    <div class="modal-footer">
						      	<a type="button" class="btn btn-danger" href="logout.php">Ya, Logout</a>
						      	<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
						    </div>
					  	</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			<!--body wrapper end-->
			</div>

	        <!--footer section start-->
			<footer>
			   <p><a href="https://www.indrasatya.com/" target="_blank"></a></p>
			</footer>
	        <!--footer section end-->

	    <!-- main content end-->
	   	</section>
	  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

	    <script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>

	    <!-- DataTables -->
	    <script type="text/javascript" src="assets/js/dataTables/js/jquery.dataTables.js"></script>
	    <script type="text/javascript" src="assets/js/dataTables/js/dataTables.bootstrap.js"></script>

		<script type="text/javascript" src="assets/js/jquery.nicescroll.js"></script>
		<script type="text/javascript" src="assets/js/scripts.js"></script>
		
		<script type="text/javascript">
	    $(function () {
	    	// datepicker plugin
        	$('.date-picker').datepicker({
          		autoclose: true,
          		todayHighlight: true
        	});

        	// toolip
        	$('[data-toggle="tooltip"]').tooltip();

        	// datatables
        	$('#dataTables-example').dataTable( {
            	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            	"pageLength": 10
        	});

	        $('#logout').on('shown.bs.modal', function () {
	        	$('#logout').focus()
	        })
	    })
    	</script>
	</body>
</html>