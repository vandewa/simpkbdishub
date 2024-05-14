<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Pengaduan Pelayanan Pengujian Kendaraan Bermotor</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.css')?>" />


		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-fonts.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.custom.css')?>" />
		
		
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-xs-6 col-sm-offset-3">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-truck blue"></i>
								<span class="red">PKB</span>
								<span class="grey" id="id-text2">ONLINE</span>
							</h1>
							<h4 class="blue" id="id-company-text">&copy; DISHUBKOMINFO <span class="grey">KABUPATEN TEGAL</span></h4>
						</div>

						<div class="space-6"></div>

						<div class="visible widget-box">
							<div class="widget-body">
								<div class="widget-main">
									<h3 class="header smaller lighter blue">
										<center>Pengaduan Pelayanan Pengujian Kendaraan Bermotor</center>
									</h3>
									<form action="<?php echo site_url('lapor/kirimaduan');?>" method="post">
										<div class="row">
											<div class="col-xs-12 col-sm-12">
												<label class="block clearfix">
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left bolder blue"> Nomor Pengaduan </label>
														<div class="col-sm-9">
															<input type="text" id="no_pengaduan" name="no_pengaduan" class="col-xs-12" value="LP-<?php echo $now;?>" readonly />
														</div>
													</div>
												</label>
												
												<?php echo form_error('nama','<p class="text-danger">');?>
												<label class="block clearfix">
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left bolder blue"> Nama * </label>
														<div class="col-sm-9">
															<input type="text" id="nama" name="nama" value="<?php echo set_value('nama');?>" placeholder="Masukan nama..." class="col-xs-12"/>
														</div>
													</div>
												</label>
												
												<?php echo form_error('email','<p class="text-danger">');?>
												<label class="block clearfix">
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left bolder blue"> Email * </label>
														<div class="col-sm-9">
															<input type="email" id="email" name="email" value="<?php echo set_value('email');?>" placeholder="Masukan email..." class="col-xs-12"/>
														</div>
													</div>
												</label>
												
												<?php echo form_error('perihal','<p class="text-danger">');?>
												<label class="block clearfix">
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left bolder blue"> Judul *</label>
														<div class="col-sm-9">
															<input type="text" id="perihal" name="perihal" value="<?php echo set_value('perihal');?>" placeholder="Masukan judul..." class="col-xs-12"/>
														</div>
													</div>
												</label>
												
												<?php echo form_error('isi','<p class="text-danger">');?>
												<label class="block clearfix">
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left bolder blue"> Pesan *</label>
														<div class="col-sm-9">
															<textarea id="isi" name="isi" class="autosize-transition form-control" placeholder="Masukan pesan..."><?php echo set_value('isi');?></textarea>
														</div>
													</div>
												</label>
												
												<?php echo form_error('captcha','<p class="text-danger">');?>
												<label class="block clearfix">
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left bolder blue"> Kode Keamanan</label>
														<div class="col-sm-9">
															<div class="input-group">
																<span><?php echo $image;?></span>
																<input type="text" id="captcha" name="captcha" class="width-50 pull-right form-control" placeholder="Kode Keamanan"/>
															</div>
														</div>
													</div>
												</label>
												
												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-8">
														<button class="btn btn-info" type="submit">
															<i class="ace-icon fa fa-check bigger-110"></i>
															LAPOR
														</button>

														&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Reset
														</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
	</body>
</html>
