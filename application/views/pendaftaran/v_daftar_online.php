<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title;?></title>

		<meta name="description" content="Pendaftaran Online" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css')?>" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/fonts.googleapis.com.css')?>" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace.min.css')?>" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-skins.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-rtl.min.css')?>" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css')?>" />		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css')?>" />
		
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-xs-12 col-sm-offset-0">
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
										<div class="col-lg-7 col-sm-7">
											<form class="form-horizontal" role="form" action="<?php echo site_url('prosesbooking')?>" method="post">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<h3 class="header smaller lighter blue">
													Formulir Pendaftaran Online
												</h3>
												
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-left">Tanggal Booking</label>
													<div class="col-sm-9">
														<div class="input-group">
															<input class="form-control date-picker" id="tgl_booking" name="tgl_booking" type="text" data-date-format="yyyy-mm-dd" required />
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
													</div>
												</div>
												
												<div id="dt_booking"></div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-left"> Jenis Pendaftaran </label>
													<div class="col-sm-9">
														<select class="select2" id="jenis_pendaftaran" name="jenis_pendaftaran" data-placeholder="Pilih jenis pendaftaran" required >
															<option></option>
															<option value="Berkala">Uji Berkala</option>
														</select>
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-left"> Nomor Uji </label>
													<div class="col-sm-9">
														<input type="text" id="no_uji" name="no_uji" placeholder="Nomor Uji" class="col-xs-12" required />
													</div>
												</div>
												
												<div id="form_pendaftaran"></div>

											</form>
										</div>
										<div class="col-lg-5 col-sm-5">
											<h3 class="header smaller lighter blue">
												Petunjuk Pendaftaran
											</h3>
											<ol>
												<li>Pilih tanggal booking / tanggal kendaraan akan dilakukan uji. (hari/jam pelayan, selain hari sabtu, minggu dan libur nasional)</li>
												<li>Pilih jenis pendaftaran / jenis pelayanan.</li>
												<li>Masukan nomor uji kendaraan, maka secara otomatis data kendaraan akan tampil.</li>
												<li>Jika kendaraan belum pernah terdaftar di Unit Pelayanan Pengujian Kabupaten Wonosobo, maka pemohon harus mengisi semua formulir yang disediakan.</li>
												<li>Klik daftarkan untuk melakukan proses pendaftaran dan cetak bukti pendaftaran.</li>
												<li>Jika sudah pernah melakukan pendaftaran online namun lupa kode booking pendaftaran, silahkan masukan nomor uji kendaraan pada formulir dibawah ini untuk mencetak bukti pendaftaran. </li>
											</ol>
											<!--
											<h4 class="header smaller lighter blue">
												Cetak Ulang Bukti Pendaftaran Online
											</h4>
											<form action="<?php echo site_url('bookingonline/cari')?>" method="post">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-search blue"></i>
													</span>
													<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
													<input type="text" class="form-control search-query" id="cari" name="cari" placeholder="Masukan Nomor Pengujian..."/>
													<span class="input-group-btn">
														<button type="submit" class="btn btn-info btn-sm">
															<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
															Cari
														</button>
													</span>
												</div>
											</form>
											-->
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
		
		<script src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/select2.min.js')?>"></script>
		
		<script>
			jQuery(function($) {
				$('.select2').css('width','100%').select2({allowClear:true})
				
				$('input').keyup(function(e){
					$(this).val($(this).val().toUpperCase());
				});
				
				var disableDates = [<?php foreach($dt_libur as $row){ echo '"'.date("Y-n-d",strtotime($row->tgl_libur)).'",'; } ?>];
				$('.date-picker').datepicker({
					daysOfWeekDisabled: [0, 6],
					beforeShowDay: function(date){
						ymd = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() ;
						if(disableDates.indexOf(ymd) != -1){
							return false;
						} else {
							return true;
						}
					},
					startDate: "+2d",
					endDate: "+1m",
					autoclose: true,
					todayHighlight: true
				});
				
				$("#tgl_booking").change(function(e){
					var tgl = $("#tgl_booking").val();
					$.ajax({
						url: "<?php echo base_url('bookingonline/cek'); ?>",
						type: 'GET',
						data: {
							'tgl':tgl,
						},
						success: function(data){
							$('#dt_booking').html(data);
						},
						failed: function(data){
							alert('Gagal mendapatkan data');
						}
					});
				});
				
				/*
				$("#no_uji").keyup(function(){
					if($("#no_uji").val().length>3){
						var no_uji = $("#no_uji").val();
						
						var post_data = {
						   'no_uji': no_uji,
						   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
						};
						
						$.ajax({
							type: "post",
							url : "<?php echo base_url('bookingonline/kendaraan'); ?>",
							cache: false,    
							data: post_data,
							success: function(response){
								var obj = JSON.parse(response);
								if(obj == ""){
									$("#no_kendaraan").val("");
									$("#nama").val("");
									$("#alamat").val("");
									$("#kecamatan").val("");
								}
								else {
									$("#no_kendaraan").val(obj[0].no_kendaraan);
									$("#nama").val(obj[0].nama);
									$("#alamat").val(obj[0].alamat);
									$("#kecamatan").val(obj[0].kecamatan);
								}
							}
						});
					}
					return false;
				});
				
				$("#metode_bayar").on("change",function(e){
					if($(this).val()==="online"){
						var no_uji = $("#no_uji").val();
						$('#form_pembayaran').empty();
						$.ajax({
							url: "<?php echo base_url('bookingonline/biaya'); ?>",
							type: 'GET',
							data: {
								'no_uji':no_uji,
							},
							success: function(data){
								$('#form_pembayaran').html(data);
							},
							failed: function(data){
								alert('Gagal mendapatkan data');
							}
						});
					} else {
						$('#form_pembayaran').empty();
					}
				});
				
				*/
				
				$("#no_uji").keyup(function(){
					if($("#no_uji").val().length>3){
						var no_uji = $("#no_uji").val();
						$('#form_pendaftaran').empty();
						
						var post_data = {
						   'no_uji': no_uji,
						   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
						};
						
						$.ajax({
							type: "post",
							url : "<?php echo base_url('bookingonline/getkendaraan'); ?>",
							cache: false,    
							data: post_data,
							success: function(data){
								$('#form_pendaftaran').html(data);
							},
							failed: function(data){
								alert('Gagal mendapatkan data');
							}
						});
					} else {
						$('#form_pendaftaran').empty();
					}
				});
			});
		</script>
	</body>
</html>
