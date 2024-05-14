<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Halaman Tidak Ditemukan</title>

		<meta name="description" content="Halaman Tidak Ditemukan" />
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
					<div class="col-lg-8 col-sm-offset-2">
						<div class="error-container">
							<div class="well">
								<h1 class="grey lighter smaller">
									<span class="blue bigger-125">
										<i class="ace-icon fa fa-sitemap"></i>
										404
									</span>
									Page Not Found
								</h1>

								<hr />
								<h3 class="lighter smaller">We looked everywhere but we couldn't find it!</h3>

								<div>
									<form class="form-search">
										<span class="input-icon align-middle">
											<i class="ace-icon fa fa-search"></i>

											<input type="text" class="search-query" placeholder="Give it a search..." />
										</span>
										<button class="btn btn-sm" type="button">Go!</button>
									</form>

									<div class="space"></div>
									<h4 class="smaller">Try one of the following:</h4>

									<ul class="list-unstyled spaced inline bigger-110 margin-15">
										<li>
											<i class="ace-icon fa fa-hand-o-right blue"></i>
											Re-check the url for typos
										</li>

										<li>
											<i class="ace-icon fa fa-hand-o-right blue"></i>
											Read the faq
										</li>

										<li>
											<i class="ace-icon fa fa-hand-o-right blue"></i>
											Tell us about it
										</li>
									</ul>
								</div>

								<hr />
								<div class="space"></div>

								<div class="center">
									<a href="javascript:history.back()" class="btn btn-primary">
										<i class="ace-icon fa fa-arrow-left"></i>
										Go Back
									</a>
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
