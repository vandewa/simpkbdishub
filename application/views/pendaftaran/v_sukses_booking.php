<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title;?></title>

		<meta name="description" content="User login page" />
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
					<div class="col-lg-6 col-xs-12 col-lg-offset-3">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-truck blue"></i>
								<span class="red">PENDAFTARAN </span>
								<span class="grey">ONLINE</span>
							</h1>
						</div>

						<div class="space-12"></div>

						<div class="visible widget-box">
							<div class="widget-body">
								<div class="widget-main">									
									<div class="row">
										<div class="col-lg-12 col-sm-12">
											<div class="alert alert-block alert-success">
												<p>
													<strong>
														TERIMA KASIH,
														<i class="ace-icon fa fa-check"></i>
													</strong>
													<br/>
													Pendaftaran berhasil, bukti pendaftaran online akan dikirimkan melalui pesan WhatsApp.
												</p>
											</div>
											
											<?php echo $this->session->flashdata('kirimulang');?>
											
											<center>
												<a href="#kirim_ulang-<?php echo $id; ?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Kirim ulang">
													<button class="btn btn-sm btn-warning">
														<i class="ace-icon fa fa-envelope"> </i> Kirim Ulang Bukti Pendaftaran
													</button>
												</a>
												<a type="button" class="btn btn-sm btn-info" href="<?php echo site_url('bookingonline')?>"><i class="ace-icon fa fa-home"></i> Pendaftaran</a>
											</center>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="kirim_ulang-<?php echo $id;?>" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Kirim Ulang Bukti Pendaftaran</h4>
					</div>
					<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('resendpendaftaran?id='.$id);?>">
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12">
									
									<div class="form-group">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<label class="col-sm-3 control-label no-padding-left"> Nomor WhatsApp</label>
										<div class="col-sm-9">
											<input type="text" id="no_wa" name="no_wa" class="col-xs-12"/>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button class="btn btn-sm" data-dismiss="modal">
								<i class="ace-icon fa fa-times"></i>
								Batal
							</button>

							<button type="submit" class="btn btn-sm btn-info">
								<i class="ace-icon fa fa-check"></i>
								Kirim Ulang
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="bigger-120">
						<span class="blue bolder">SIMPKB</span>
						Dinas Perhubungan Kabupaten Tegal &copy; 2020
					</span>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
		</script>
	</body>
</html>
