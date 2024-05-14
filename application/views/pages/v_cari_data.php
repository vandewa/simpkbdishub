<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Cari Kendaraan Anda</title>

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
									
									<div class="row">
										<div class="col-xs-12 col-sm-6">
										<form action="<?php echo site_url('cek_kendaraan/cari')?>" method="post">
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
									if(!empty($data_cari)){
										foreach($data_cari as $row){
										?>
									
									<div class="row">
										<div class="col-xs-12 col-sm-6">
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
													<label class="col-sm-4 control-label no-padding-left"> Nomor Pengujian </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>

											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Merek/Tipe </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->merek;?> / <?php echo $row->tipe;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Jenis </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->jenis;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Tahun </label>
													<div class="col-sm-8">
														<input type="text" value="<?php echo $row->tahun;?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
										</div>
										
										<div class="col-xs-12 col-sm-6">
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-2 control-label no-padding-left"> Retribusi </label>
													<div class="col-sm-4">
														<input type="text" value="Rp <?php 
																					$retribusi = $row->retribusi;
																					$stiker = 12500;
																					$plat = 7500;
																					$buku = $row->buku;
																					if($retribusi=='150000'){
																						$n_retribusi = 40000;
																					} else if ($retribusi=='200000'){
																						$n_retribusi = 50000;
																					} else if ($retribusi=='250000'){
																						$n_retribusi = 60000;
																					} else if ($retribusi=='300000'){
																						$n_retribusi = 70000;
																					} else if ($retribusi=='350000'){
																						$n_retribusi = 80000;
																					} else {
																						$n_retribusi = $retribusi;
																					}
																					echo number_format($n_retribusi, 0, ".", ","); ?>" class="col-xs-12" readonly />
													</div>
													<label class="col-sm-2 control-label no-padding-left"> Stiker </label>
													
													<div class="col-sm-4">
														<input type="text" value="Rp <?php echo number_format($stiker, 0, ".", ",");?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-2 control-label no-padding-left"> Plat </label>
													<div class="col-sm-4">
														<input type="text" value="Rp <?php echo number_format($plat, 0, ".", ",");?>" class="col-xs-12" readonly />
													</div>
													
													<label class="col-sm-2 control-label no-padding-left"> Buku </label>
													<div class="col-sm-4">
														<input type="text" value="Rp <?php 
																					$maxbuku = "10000";
																					$minbuku = "0";
																					if($buku=='0'){
																						$buku = $maxbuku;
																						echo number_format($buku, 0, ".", ",");;
																					} else if($buku!=='0'){
																						$buku = $minbuku;
																						echo number_format($buku, 0, ".", ",")." / Tidak Ganti";;
																					}?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Total Retribusi </label>
													<div class="col-sm-8">
														<input type="text" value="Rp <?php 
																					$total = $n_retribusi+$plat+$stiker+$buku;
																					echo number_format($total, 0, ".", ",");
																				?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
											
											<label class="block clearfix">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-left"> Masa Berlaku </label>
													<div class="col-sm-8">
														<input type="text" value="<?php 
															$tgl_habis = $row->tgl_habis_uji;
															$habis = date("d-m-Y", strtotime($tgl_habis));
															$d = date("d", strtotime($tgl_habis));
															$m = date("m", strtotime($tgl_habis));
															$y = date("Y", strtotime($tgl_habis));
															
															$jd = gregoriantojd($m,$d,$y);
															$mn = jdmonthname($jd,0);
															
															echo $d." ".$mn." ".$y;
															?>" class="col-xs-12" readonly />
													</div>
												</div>
											</label>
										<?php }
									} else { ?>
										
										<div class="alert alert-danger">
											<center>
												<p>	
													Kendaraan nomor pengujian <strong><?php echo set_value('cari');?></strong> tidak ditemukan atau belum terdaftar dalam sistem. 
												</p>
												<p>	
													Harap masukan nomor pengujian atau nomor kendaraan anda dengan benar.
												</p>
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
						Dinas Perhubungan Kabupaten Tegal &copy; 2018
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
		
		<script type="text/javascript">
			window.jQuery || document.write("<script src=<?php echo base_url('assets/js/jquery.js')?>>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src=<?php echo base_url('assets/js/jquery.mobile.custom.js')?>>"+"<"+"/script>");
		</script>
	</body>
</html>
