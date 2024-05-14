<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Cek Data</title>

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
								<i class="ace-icon fa fa-truck blue"></i>
								<span class="red">CEK DATA</span>
								<span class="grey">KENDARAAN</span>
							</h3>
						</div>

						<div class="space-12"></div>

						<div class="visible widget-box">
							<div class="widget-body">
								<div class="widget-main">
									<div class="row">
										<div class="col-xs-12">
										<form action="<?php echo site_url('cekkendaraan')?>" method="post" id="search-form">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-search blue"></i>
												</span>
												<input type="text" class="form-control search-query" id="no_uji" name="no_uji" placeholder="Masukan Nomor Pengujian/Nomor Kendaraan..." autofocus required />
												<span class="input-group-btn">
													<button type="submit" class="btn btn-info btn-sm">
														<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
														Cari
													</button>
												</span>
											</div>
										</form>
										</div>
									</div>
									<h6>Contoh : AA-1234-FP / WS1234</h6>
									<div class="row">
										<div class="col-xs-12">
										<form class="form-horizontal" role="form">
											<div id="formcari"></div>
										</form>
										</div>
									</div>
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
		
		<script>
			$('#search-form').submit(function(e) {
				e.preventDefault();
				$.ajax({
					type:$(this).attr('method'),
					url:$(this).attr('action'),
					data:$(this).serialize(),
					success:function(data){
						$('#formcari').html(data)
					}
				});
			});
			
			jQuery(function($) {
				$('input').keyup(function(e){
					$(this).val($(this).val().toUpperCase());
				});
			});
		</script>
	</body>
</html>
