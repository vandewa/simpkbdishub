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
					<div class="col-lg-6 col-sm-offset-3">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-truck blue"></i>
								<span class="red">SIM</span>
								<span class="grey" id="id-text2">PKB</span>
							</h1>
							<h4 class="blue" id="id-company-text">&copy; DINAS PERHUBUNGAN <span class="grey">KABUPATEN WONOSOBO</span></h4>
						</div>

						<div class="space-6"></div>

						<div class="visible widget-box">
							<div class="widget-body">
								<div class="widget-main">
									<h3 class="header smaller lighter blue text-center">
										PERSETUJUAN UJI KELUAR <b>VALID</b>
									</h3>
									
									<?php 
									if(!empty($dt_cek)){
										foreach($dt_cek as $row){
										?>
									
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Jenis Surat </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo strtoupper($row->jenis_uji_keluar);?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Nomor Surat </label>
													<div class="col-sm-8">
														<input type="text" value="551.2/<?php echo $row->no_surat;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Tujuan </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->tujuan_num;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>

											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Tanggal </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo strftime("%d %B %Y",strtotime($row->tgl_surat));?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Nomor Pengujian </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan</label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->jenis_kendaraan;?> / <?php echo $row->jenis;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>

											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Merek / Tipe </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->merek;?> / <?php echo $row->tipe;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
										</div>
										<?php }
									} else { ?>
										
										<div class="alert alert-danger">
											<center>
												<p>Data persetujuan uji keluar tidak ditemukan. Silahkan hubungi UPT PKB Dinas Perhubungan Kabupaten Wonosobo</p>
											</center>
										</div>
										
									<?php } ?>
										</div>
									</div>
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
						Dinas Perhubungan Kabupaten Wonosobo &copy; 2020
					</span>
				</div>
			</div>
		</div>
		
		<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
		</script>
	</body>
</html>
