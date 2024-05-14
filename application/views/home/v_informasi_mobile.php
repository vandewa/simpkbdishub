<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Informasi</title>

		<meta name="description" content="Cek data pengujian"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css')?>" />

		<link rel="stylesheet" href="<?php echo base_url('assets/css/fonts.googleapis.com.css')?>" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace.min.css')?>" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-skins.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-rtl.min.css')?>" />
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="center">
							<h3>
								<i class="ace-icon fa fa-calendar blue"></i>
								<span class="red">INFORMASI</span>
								<span class="grey">E-KIR</span>
							</h3>
						</div>

						<div class="space-12"></div>

						<div class="visible widget-box widget-color-red" id="widget-box-1">
							<div class="widget-header">
								<h5 class="widget-title">INFORMASI E-KIR</h5>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<?php foreach($dt_informasi as $row){?>
									<p class="alert alert-danger">
										<?php echo $row->informasi;?>
									</p>
									<?php } ?>
								</div>
							</div>
						</div>
						
						<div class="space-8"></div>
						
						<div class="visible widget-box widget-color-blue" id="widget-box-1">
							<div class="widget-header">
								<h5 class="widget-title">INFORMASI PENDAFTARAN</h5>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									
								</div>
							</div>
						</div>
						
						<div class="space-8"></div>
						
						<div class="visible widget-box widget-color-purple" id="widget-box-1">
							<div class="widget-header">
								<h5 class="widget-title">KUOTA PENDAFTARAN ONLINE</h5>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
		</script>
	</body>
</html>
