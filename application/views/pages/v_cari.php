<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Cari Informasi Kendaraan</title>

		<meta name="description" content="Cek informasi kendaraan" />
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
					<div class="col-xs-10 col-sm-offset-1">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-truck blue"></i>
								<span class="red">SIM</span>
								<span class="grey" id="id-text2">PKB</span>
							</h1>
							<h4 class="blue" id="id-company-text">&copy; DINAS PERHUBUNGAN <span class="grey">KABUPATEN TEGAL</span></h4>
						</div>

						<div class="space-6"></div>

						<div class="visible widget-box">
							<div class="widget-body">
								<div class="widget-main">
									<h3 class="header smaller lighter blue">
										Lihat Informasi Kendaraan Anda
									</h3>
									
									<?php echo form_error('cari','<p class="text-danger">');?>
									
									<div class="row">
										<div class="col-xs-12 col-sm-6">
										<form action="<?php echo site_url('cari/ajax_cari')?>" method="post" id="search-form">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-search blue"></i>
												</span>
												<input type="text" class="form-control search-query" id="cari" name="cari" value="" placeholder="Masukan Nomor Pengujian/Nomor Kendaraan..." autofocus/>
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
									<h6><i>Misal</i> : <b>SLW1234</b> / <b>G-1234-LZ</b></h6>
									
									<h3 class="header smaller lighter blue"></h3>
									
									<?php
										if (isset($error)){
											echo '<p class="text-danger">' . $error . '</p>';
										}
									?>
									
									<div id="formcari"></div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="bigger-120">
						<span class="blue bolder">SIMPKB</span>
						Dinas Perhubungan Kabupaten Tegal Develop by Ghani &copy; 2017 | Theme by Ace
					</span>

					&nbsp; &nbsp;
					<span class="action-buttons">
						<a href="https://twitter.com/ghaninwicaksono" target="_blank">
							<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
						</a>

						<a href="https://www.facebook.com/ghaniiwicaksono" target="_blank">
							<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
						</a>

						<a href="https://id.linkedin.com/in/ghani-nur-wicaksono-82851399" target="_blank">
							<i class="ace-icon fa fa-linkedin-square bigger-150"></i>
						</a>
					</span>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>;
		<script type="text/javascript">
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
		</script>

		<!-- <![endif]-->

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src=<?php echo base_url('assets/js/jquery.mobile.custom.js')?>>"+"<"+"/script>");
		</script>
	</body>
</html>
