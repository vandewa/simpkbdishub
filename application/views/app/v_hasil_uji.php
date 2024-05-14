<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title;?></title>

	<meta name="description" content="Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Tegal">
	<meta name="author" content="duamedia">
	<meta name="robots" content="noindex, nofollow">

	<!-- Open Graph Meta -->
	<meta property="og:title" content="Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Tegal">
	<meta property="og:site_name" content="SIMPKB">
	<meta property="og:description" content="Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Tegal">
	<meta property="og:type" content="website">
	<meta property="og:url" content="">
	<meta property="og:image" content="">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/bootstrap_limitless.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/layout.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/components.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/colors.min.css');?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo base_url('assets/app/js/main/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/main/bootstrap.bundle.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/loaders/blockui.min.js');?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url('assets/app/js/app.js');?>"></script>
	<!-- /theme JS files -->

</head>

<body>
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-dark text-center">			
				<div class="page-header-content header-elements-md-inline bg-primary-800 d-flex justify-content-center">
					<!--<div class="header-elements mr-4">
						<div class="d-flex justify-content-center">
							<img class="img-fluid" src="<?php echo base_url('assets/images/logo-kab-tegal.png');?>" width="50" alt="">
						</div>
					</div>
					-->
					<div class="page-title d-flex">
						<h3>
							<span class="font-weight-semibold">STATUS PENGUJIAN KENDARAAN BERMOTOR
						</h3>
					</div>
					<!--
					<div class="header-elements ml-4">
						<div class="d-flex justify-content-center">
							<img class="img-fluid" src="<?php echo base_url('assets/images/logo-dishub-kab.png');?>" width="50" alt="">
						</div>
					</div>
					-->
				</div>
			</div>
			<!-- /page header -->

			<!-- Content area -->
			<div class="content">
			<?php if(!empty($dt_kendaraan)){
				foreach($dt_kendaraan as $ken){ ?>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header bg-primary-800 text-white text-center">
								<h5 class="card-title font-weight-bold">FOTO KENDARAAN (<?php echo $ken->no_kendaraan;?>)</h5>
							</div>

							<div class="card-body">
								<div id="dt_foto"></div>
								<?php if($ken->hasil=="LULUS") { $bg = "success-800"; $hasil = $ken->hasil; } else if($ken->hasil=="TIDAK LULUS"){ $bg = "danger-800";  $hasil = $ken->hasil; } else { $bg = "warning-800";  $hasil = "MENUNGGU PENGESAHAN"; }?>
								<div class="d-flex justify-content-center rounded mt-1">
									<div class="bg-<?php echo $bg;?> align-self-center border-white py-1 px-2">
										<h1 class="font-weight-black"><?php echo $hasil;?></h1>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card">
							<div class="card-header bg-primary-800 text-white text-center">
								<h5 class="card-title font-weight-bold">DATA KENDARAAN (<?php echo $ken->no_kendaraan;?>)</h5>
							</div>

							<div class="card-body">
								<div class="table-responsive mb-2">
									<table class="table table-xs">
										<input type="hidden" id="kode_uji" name="kode_uji" value="<?php echo $ken->kode_uji;?>" />
										<tbody class="font-weight-bold font-size-lg">
											<tr>
												<td>NO UJI</td>
												<td>:</td>
												<td><?php echo $ken->no_uji;?></td>
											</tr>
											<tr>
												<td>NO KENDARAAN</td>
												<td>:</td>
												<td><?php echo $ken->no_kendaraan;?></td>
											</tr>
											<tr>
												<td>NAMA PEMILIK</td>
												<td>:</td>
												<td><?php echo $ken->nama;?></td>
											</tr>
											<tr>
												<td>STATUS UJI</td>
												<td>:</td>
												<td><?php 
													if(($ken->status=="1") && ($ken->uji=="1")){
														echo "MENUNGGU PENGESAHAN";
													} else if(($ken->status=="2") && ($ken->uji=="1")){
														echo "PROSES CETAK BERKAS";
													} else if(($ken->status=="2") && ($ken->uji=="2")){
														echo "BERKAS DICETAK";
													} else if(($ken->status=="4") && ($ken->uji=="1")){
														echo "CETAK SURAT KETERANGAN TIDAK LULUS";
													}
												?></td>
											</tr>
										</tbody>
									</table>
								</div>
								
								<div class="card-header bg-primary-800 text-white text-center">
									<h5 class="card-title font-weight-bold">HASIL PENGUJIAN</h5>
								</div>
								
								<?php 
									foreach($dt_kendaraan as $row){
									$id = $row->kode_uji;
									$ci = &get_instance();
									$ci->load->model('model_pengujian');
									$visual = $this->model_pengujian->getAktifCatatan($id);
									
									if($visual=="0"){
										$btn_visual = "success";
										$md_visual = "success";
										$icon_visual = "icon-checkmark4";
										$title_visual = "LULUS";
										
									} else {
										$btn_visual = "danger";
										$md_visual = "danger";
										$icon_visual = "icon-cross2";
										$title_visual = "GAGAL";
									}
									
									$tint = $row->tint_meter;
									if($tint>=70){
										$btn_tint = "success";
										$md_tint = "success";
										$icon_tint = "icon-checkmark4";
										$title_tint = "LULUS";
									} else {
										$btn_tint = "danger";
										$md_tint = "danger";
										$icon_tint = "icon-cross2";
										$title_tint = "GAGAL";
									}
									
									$sound = $row->sound_level;
									if(($sound>=83)&&($sound<=118)){
										$btn_sound = "success";
										$md_sound = "success";
										$icon_sound = "icon-checkmark4";
										$title_sound = "LULUS";
									} else{
										$btn_sound = "danger";
										$md_sound = "danger";
										$icon_sound = "icon-cross2";
										$title_sound = "GAGAL";
									}
									
									$alur = $row->alur_ban;
									if($alur>=1){
										$span_alur="success";
									} else{
										$span_alur="danger";
									}
									
									$bahan_bakar = $row->bahan_bakar;
									$tahun = $row->tahun;
									$jbb = $row->jbb;
									$asap = $row->asap;
									$co = $row->asap_co;
									$hc = $row->asap_hc;
									
									if($bahan_bakar=="SOLAR"){
										if($tahun<=2010){
											if($asap<=70){
												$btn_asap = "success";
												$md_asap = "success";
												$icon_asap = "icon-checkmark4";
												$title_asap = "LULUS";
											} else if($asap>70){
												$btn_asap = "danger";
												$md_asap = "danger";
												$icon_asap = "icon-cross2";
												$title_asap = "GAGAL";
											}
										} else {
											if($jbb<=3500){
												if($asap<=40){
													$btn_asap = "success";
													$md_asap = "success";
													$icon_asap = "icon-checkmark4";
													$title_asap = "LULUS";
												} else if($asap>40){
													$btn_asap = "danger";
													$md_asap = "danger";
													$icon_asap = "icon-cross2";
													$title_asap = "GAGAL";
												}
											} else if($jbb>3500){
												if($asap<=50){
													$btn_asap = "success";
													$md_asap = "success";
													$icon_asap = "icon-checkmark4";
													$title_asap = "LULUS";
												} else if($asap>50){
													$btn_asap = "danger";
													$md_asap = "danger";
													$icon_asap = "icon-cross2";
													$title_asap = "GAGAL";
												}
											}
										}
									} else {
										if($tahun<=2007){
											if($co<=4.5){
												$title_co = "LULUS";
												$btn_co = "success";
											} else if($co>4.5){
												$title_co = "GAGAL";
												$btn_co = "danger";
											}
											if($hc<=1200){
												$title_hc = "LULUS";
												$btn_hc = "success";
											} else if($hc>1200){
												$title_hc = "GAGAL";
												$btn_hc = "danger";
											}
										} else {
											if($co<=1.5){
												$title_co = "LULUS";
												$btn_co = "success";
											} else if($co>1.5){
												$title_co = "GAGAL";
												$btn_co = "danger";
											}
											if($hc<=200){
												$title_hc = "LULUS";
												$btn_hc = "success";
											} else if($hc>200){
												$title_hc = "GAGAL";
												$btn_hc = "danger";
											}
										}
										
										if(($title_co=="LULUS") && ($title_hc=="LULUS")){
											$btn_asap = "success";
											$md_asap = "success";
											$icon_asap = "icon-checkmark4";
											$title_asap = "LULUS";
										} else {
											$btn_asap = "danger";
											$md_asap = "danger";
											$icon_asap = "icon-cross2";
											$title_asap = "GAGAL";
										}
									}
									
									$lampu_kiri = $row->lampu_kiri;
									$d_lampu_kiri = $row->derajat_lampu_kiri;
									$m_lampu_kiri = $row->menit_lampu_kiri;
									$lampu_kanan = $row->lampu_kanan;
									$d_lampu_kanan = $row->derajat_lampu_kanan;
									$m_lampu_kanan = $row->menit_lampu_kanan;
									
									if($lampu_kiri>=12000){
										$title_lampu_kiri = "LULUS";
									}
									else{
										$title_lampu_kiri = "GAGAL";
									}
									
									if($d_lampu_kiri<=1.09){
										$title_derajat_kiri = "LULUS";
									} else {
										$title_derajat_kiri = "GAGAL";
									}
									
									if($lampu_kanan>=12000){
										$title_lampu_kanan = "LULUS";
									}
									else{
										$title_lampu_kanan = "GAGAL";
									}
									
									if($d_lampu_kanan<=0.34){
										$title_derajat_kanan = "LULUS";
									} else {
										$title_derajat_kanan = "GAGAL";
									}
									
									if(($title_lampu_kiri=="LULUS") && ($title_derajat_kiri=="LULUS") && ($title_lampu_kanan=="LULUS") && ($title_derajat_kanan=="LULUS")){
										$btn_lampu = "success";
										$md_lampu = "success";
										$icon_lampu = "icon-checkmark4";
										$title_lampu = "LULUS";
									} else {
										$btn_lampu = "danger";
										$md_lampu = "danger";
										$icon_lampu = "icon-cross2";
										$title_lampu = "GAGAL";
									}
									
									$ss_in = $row->side_slip_in;
									if($ss_in<=5){
										$btn_side = "success";
										$md_side = "success";
										$icon_side = "icon-checkmark4";
										$title_side = "LULUS";
									}
									else{
										$btn_side = "danger";
										$md_side = "danger";
										$icon_side = "icon-cross2";
										$title_speed = "GAGAL";
									}
									
									$jenis = $row->jenis;
									if($row->ax_total_s1=="0"){
										$ax_s1 = 50;
									} else {
										$ax_s1 = $row->ax_total_s1;
									}
									if($row->ax_total_s2=="0"){
										$ax_s2 = 50;
									} else {
										$ax_s2 = $row->ax_total_s2;
									}
									if($row->ax_total_s3=="0"){
										$ax_s3 = $row->bk_sumbu3;
									} else {
										$ax_s3 = $row->ax_total_s3;
									}
									if($row->ax_total_s4=="0"){
										$ax_s4 = $row->bk_sumbu4;
									} else {
										$ax_s4 = $row->ax_total_s4;
									}
									$br_kiri_s1 = $row->br_kiri_s1;
									$br_kanan_s1 = $row->br_kanan_s1;
									$br_kiri_s2 = $row->br_kiri_s2;
									$br_kanan_s2 = $row->br_kanan_s2;
									$br_kiri_s3 = $row->br_kiri_s3;
									$br_kanan_s3 = $row->br_kanan_s3;
									$br_kiri_s4 = $row->br_kiri_s4;
									$br_kanan_s4 = $row->br_kanan_s4;
									$br_tangan_kiri = $row->br_tangan_kiri;
									$br_tangan_kanan = $row->br_tangan_kanan;
									$br_kaki_kiri = $row->br_kaki_kiri;
									$br_kaki_kanan = $row->br_kaki_kanan;
									
									$br_total_s1 = $br_kiri_s1 + $br_kanan_s1;
									$br_total_s2 = $br_kiri_s2 + $br_kanan_s2;
									$br_total_s3 = $br_kiri_s3 + $br_kanan_s3;
									$br_total_s4 = $br_kiri_s3 + $br_kanan_s4;
									
									$br_parkir_tangan = $br_tangan_kiri + $br_tangan_kanan;
									$br_parkir_kaki = $br_kaki_kiri + $br_kaki_kanan;
									
									$rem_utama = ($br_total_s1 + $br_total_s2 + $br_total_s3 + $br_total_s4)/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4) * 100;
									$ps1 = ((abs($br_kiri_s1-$br_kanan_s1))/$ax_s1)*100;
									$ps2 = ((abs($br_kiri_s2-$br_kanan_s2))/$ax_s2)*100;
									if($ax_s3>0){
										$ps3 = ((abs($br_kiri_s3-$br_kanan_s3))/$ax_s3)*100;
									}
									if($ax_s4>0){
										$ps4 = ((abs($br_kiri_s4-$br_kanan_s4))/$ax_s4)*100;
									}
									
									if($br_tangan_kanan>0){
										$rem_parkir = $br_parkir_tangan/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4)*100;
									} else {
										$rem_parkir = $br_parkir_kaki/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4)*100;
									}
									
									if($rem_utama>=50){
										$btn_rem_utama = "success";
										$title_rem_utama = "LULUS";
										if($ps1<=8){
											$btn_ps1 = "success";
											$title_ps1 = "LULUS";
										}
										else{
											$btn_ps1 = "danger";
											$title_ps1 = "GAGAL";
										}
										
										if($ps2<=8){
											$btn_ps2 = "success";
											$title_ps2 = "LULUS";
										}
										else{
											$btn_ps2 = "danger";
											$title_ps2 = "GAGAL";
										}
										
										if($ax_s3>0){
											if($ps3<=8){
												$btn_ps3 = "success";
												$title_ps3 = "LULUS";
											}
											else{
												$btn_ps3 = "danger";
												$title_ps3 = "GAGAL";
											}
										}
										
										if($ax_s4>0){
											if($ps4<=8){
												$btn_ps1 = "success";
												$title_ps1 = "LULUS";
											}
											else{
												$btn_ps4 = "danger";
												$title_ps4 = "GAGAL";
											}
										}
									} else{
										$btn_rem_utama = "danger";
										$title_rem_utama = "GAGAL";
										if($ps1<=8){
											$btn_ps1 = "success";
											$title_ps1 = "LULUS";
										}
										else{
											$btn_ps1 = "danger";
											$title_ps1 = "GAGAL";
										}
										
										if($ps2<=8){
											$btn_ps2 = "success";
											$title_ps2 = "LULUS";
										}
										else{
											$btn_ps2 = "danger";
											$title_ps2 = "GAGAL";
										}
										
										if($ax_s3>0){
											if($ps3<=8){
												$btn_ps3 = "success";
												$title_ps3 = "LULUS";
											}
											else{
												$btn_ps3 = "danger";
												$title_ps3 = "GAGAL";
											}
										}
										
										if($ax_s4>0){
											if($ps4<=8){
												$btn_ps1 = "success";
												$title_ps1 = "LULUS";
											}
											else{
												$btn_ps4 = "danger";
												$title_ps4 = "GAGAL";
											}
										}
									}
									
									if($jenis=="MOBIL PENUMPANG"){
										if($rem_parkir>=16){
											$btn_parkir = "success";
											$title_parkir = "LULUS";
										} else {
											$btn_parkir = "danger";
											$title_parkir = "GAGAL";
										}
									} else {
										if($rem_parkir>=12){
											$btn_parkir = "success";
											$title_parkir = "LULUS";
										} else {
											$btn_parkir = "danger";
											$title_parkir = "GAGAL";
										}
									}
									
									if(($title_rem_utama=="LULUS") && ($title_parkir=="LULUS") && ($title_ps1=="LULUS") && ($title_ps2=="LULUS")){
										$btn_rem = "success";
										$md_rem = "success";
										$icon_rem = "icon-checkmark4";
										$title_rem = "LULUS";
									} else {
										$btn_rem = "danger";
										$md_rem = "danger";
										$icon_rem = "icon-cross2";
										$title_rem = "GAGAL";
									}
									
									$speedometer = $row->speedometer;
									if(($speedometer>=36)&&($speedometer<=46)){
										$btn_speed = "success";
										$md_speed = "success";
										$icon_speed = "icon-checkmark4";
										$title_speed = "LULUS";
									}
									else{
										$btn_speed = "danger";
										$md_speed = "danger";
										$icon_speed = "icon-cross2";
										$title_speed = "GAGAL";
									}
									
									if(($title_visual=="LULUS") && ($title_sound=="LULUS") && ($title_tint=="LULUS") && ($title_asap=="LULUS") && ($title_lampu=="LULUS") && ($title_side=="LULUS") && ($title_rem=="LULUS") && ($title_speed=="LULUS")){
										$btn_hasil = "success";
										$icon_hasil = "icon-checkmark4";
										$title_hasil = "LULUS";
									} else {
										$btn_hasil = "danger";
										$icon_hasil = "icon-cross2";
										$title_hasil = "TIDAK LULUS";
									}
								}
								?>
								
								<div class="row font-weight-bold font-size-lg mt-1">
									<div class="col-sm-6 col-lg-6">
										<div class="row p-1">
											<div class="col-sm-8">
												<div class="bg-primary py-2 px-2">
													UJI VISUAL
												</div>
											</div>
											<div class="col-sm-4">
												<div class="bg-<?php echo $btn_visual;?>-800 py-2 px-2 text-center">
													<i class="<?php echo $icon_visual;?>"></i>
												</div>
											</div>
										</div>
										
										<div class="row p-1">
											<div class="col-sm-8">
												<div class="bg-primary py-2 px-2">
													UJI KACA
												</div>
											</div>
											<div class="col-sm-4">
												<div class="bg-<?php echo $btn_tint;?>-800 py-2 px-2 text-center">
													<i class="<?php echo $icon_tint;?>"></i>
												</div>
											</div>
										</div>
										
										<div class="row p-1">
											<div class="col-sm-8">
												<div class="bg-primary py-2 px-2">
													UJI LAMPU
												</div>
											</div>
											<div class="col-sm-4">
												<div class="bg-<?php echo $btn_lampu;?>-800 py-2 px-2 text-center">
													<i class="<?php echo $icon_lampu;?>"></i>
												</div>
											</div>
										</div>
										
										<div class="row p-1">
											<div class="col-sm-8">
												<div class="bg-primary py-2 px-2">
													UJI PENGEREMAN
												</div>
											</div>
											<div class="col-sm-4">
												<div class="bg-<?php echo $btn_rem;?>-800 py-2 px-2 text-center">
													<i class="<?php echo $icon_rem;?>"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-lg-6">
										<div class="row p-1">
											<div class="col-sm-8">
												<div class="bg-primary py-2 px-2">
													UJI KLAKSON
												</div>
											</div>
											<div class="col-sm-4">
												<div class="bg-<?php echo $btn_sound;?>-800 py-2 px-2 text-center">
													<i class="<?php echo $icon_sound;?>"></i>
												</div>
											</div>
										</div>
										
										<div class="row p-1">
											<div class="col-sm-8">
												<div class="bg-primary py-2 px-2">
													UJI EMISI
												</div>
											</div>
											<div class="col-sm-4">
												<div class="bg-<?php echo $btn_asap;?>-800 py-2 px-2 text-center">
													<i class="<?php echo $icon_asap;?>"></i>
												</div>
											</div>
										</div>
										
										<div class="row p-1">
											<div class="col-sm-8">
												<div class="bg-primary py-2 px-2">
													UJI KINCUP RODA
												</div>
											</div>
											<div class="col-sm-4">
												<div class="bg-<?php echo $btn_side;?>-800 py-2 px-2 text-center">
													<i class="<?php echo $icon_side;?>"></i>
												</div>
											</div>
										</div>
										
										<div class="row p-1">
											<div class="col-sm-8">
												<div class="bg-primary py-2 px-2">
													UJI KECEPATAN
												</div>
											</div>
											<div class="col-sm-4">
												<div class="bg-<?php echo $btn_speed;?>-800 py-2 px-2 text-center">
													<i class="<?php echo $icon_speed;?>"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php }} else { ?>
			<div class="alert bg-danger text-white alert-styled-left alert-dismissible text-center">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				<h1 class="font-weight-bold">BELUM ADA DATA PENGUJIAN KENDARAAN</h1>
			</div>
			<?php } ?>

			<!--
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; <?php echo date("Y");?>. <a href="#">SINGKEREN KABUPATEN TEGAL</a>
					</span>
				</div>
			</div>
			-->
			
			<script type="text/javascript">
				function autoRefreshPage(){
					window.location = window.location.href;
				}
				setInterval('autoRefreshPage()', 10000);
				
				setTimeout(function(){
					var kode = $("#kode_uji").val();
					$.ajax({
						url: "<?php echo base_url('app/get_fotouji'); ?>",
						type: 'GET',
						data: {
							'id':kode,
						},
						success: function(data){
							$('#dt_foto').html(data);
						},
						failed: function(data){
							alert('Gagal mendapatkan foto');
						}
					});
				}, 500);
			</script>
		
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
