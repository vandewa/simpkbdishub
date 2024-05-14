<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.css')?>" />
		
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-fonts.css')?>" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace.css')?>"/>
		
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-truck blue"></i>
									<span class="red">PKB</span>
									<span class="grey" id="id-text2">ONLINE</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; DISHUBKOMINFO <span class="grey">KABUPATEN TEGAL</span></h4>
							</div>

							<div class="space-6"></div>
							
						</div>
					</div><!-- /.col -->
					
					<div class="col-sm-6 col-sm-offset-3">
						<div class="alert alert-block alert-success">
							<center>
							<p>
								<strong>
									<i class="ace-icon fa fa-check"></i>
									Terima Kasih Atas Laporan Anda.
								</strong>
							</p>
							
							<p>
								Laporan dengan nomor laporan <strong><?php echo $no_pengaduan;?></strong> sudah kami terima dan akan segera kami tindak lanjuti.
							</p>
							
							<p>
								UPTD Pengujian Kendaraan Bermotor Dishubkominfo Kabupaten Tegal
							</p>
							
							<p>
								<a type="button" class="btn btn-sm btn-info" href="<?php echo site_url('pengaduan/daftarpengaduan')?>">Lihat Laporan Anda</a>
							</p>
							</center>
							<p>
								<center><a type="button" class="btn btn-sm btn-success" href="<?php echo site_url('')?>">Beranda</a></center>
							</p>
						</div>
					</div>	
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		
	</body>
</html>
