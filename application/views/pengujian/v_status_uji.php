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
					<div class="col-xs-12 col-sm-offset-0">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-check-square-o blue"></i>
								<span class="red">STATUS </span>
								<span class="grey">PENGUJIAN</span>
							</h1>
						</div>

						<div class="space-6"></div>

						<div class="visible widget-box">
							<div class="widget-body">
								<div class="widget-main">									
									<table id="simple-table" class="table table-striped table-bordered table-hover">
										<thead class="thin-border-bottom">
											<tr>
												<th class="center">NO</th>
												<th class="center">NO UJI</th>
												<th class="hidden-480 center">NO KENDARAAN</th>
												<th class="hidden-480 center">NAMA PEMILIK</th>
												<th class="hidden-480 center">UJI VISUAL</th>
												<th class="hidden-480 center">UJI KEBISINGAN</th>
												<th class="hidden-480 center">UJI KACA</th>
												<th class="hidden-480 center">UJI EMISI</th>
												<th class="hidden-480 center">UJI LAMPU</th>
												<th class="hidden-480 center">UJI KINCUP</th>
												<th class="hidden-480 center">UJI REM</th>
												<th class="hidden-480 center">UJI KECEPATAN</th>
												<th class="hidden-480 center">HASIL</th>
											</tr>
										</thead>
										
										<tbody>
											<?php 
												$no = 1;
												foreach($dt_uji as $row){
													$kode_uji = $row->kode_uji;
													$ci = &get_instance();
													$ci->load->model('model_pengujian');
													$visual = $this->model_pengujian->getCekCatatan($kode_uji);
													
													if($visual=="0"){
														$btn_visual = "success";
														$md_visual = "success";
														$icon_visual = "fa-check";
														$title_visual = "LULUS";
														
													} else {
														$btn_visual = "danger";
														$md_visual = "danger";
														$icon_visual = "fa-close";
														$title_visual = "GAGAL";
													}
													
													$tint = $row->tint_meter;
													if($tint<=70){
														$btn_tint = "success";
														$md_tint = "success";
														$icon_tint = "fa-check";
														$title_tint = "LULUS";
													} else {
														$btn_tint = "danger";
														$md_tint = "danger";
														$icon_tint = "fa-close";
														$title_tint = "GAGAL";
													}
													
													$sound = $row->sound_level;
													if(($sound>=83)&&($sound<=118)){
														$btn_sound = "success";
														$md_sound = "success";
														$icon_sound = "fa-check";
														$title_sound = "LULUS";
													} else{
														$btn_sound = "danger";
														$md_sound = "danger";
														$icon_sound = "fa-close";
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
																$icon_asap = "fa-check";
																$title_asap = "LULUS";
															} else if($asap>70){
																$btn_asap = "danger";
																$md_asap = "danger";
																$icon_asap = "fa-close";
																$title_asap = "GAGAL";
															}
														} else {
															if($jbb<=3500){
																if($asap<=40){
																	$btn_asap = "success";
																	$md_asap = "success";
																	$icon_asap = "fa-check";
																	$title_asap = "LULUS";
																} else if($asap>40){
																	$btn_asap = "danger";
																	$md_asap = "danger";
																	$icon_asap = "fa-close";
																	$title_asap = "GAGAL";
																}
															} else if($jbb>3500){
																if($asap<=50){
																	$btn_asap = "success";
																	$md_asap = "success";
																	$icon_asap = "fa-check";
																	$title_asap = "LULUS";
																} else if($asap>50){
																	$btn_asap = "danger";
																	$md_asap = "danger";
																	$icon_asap = "fa-close";
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
															$icon_asap = "fa-check";
															$title_asap = "LULUS";
														} else {
															$btn_asap = "danger";
															$md_asap = "danger";
															$icon_asap = "fa-close";
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
														$icon_lampu = "fa-check";
														$title_lampu = "LULUS";
													} else {
														$btn_lampu = "danger";
														$md_lampu = "danger";
														$icon_lampu = "fa-close";
														$title_lampu = "GAGAL";
													}
													
													$ss_in = $row->side_slip_in;
													if($ss_in<=5){
														$btn_side = "success";
														$md_side = "success";
														$icon_side = "fa-check";
														$title_side = "LULUS";
													}
													else{
														$btn_side = "danger";
														$md_side = "danger";
														$icon_side = "fa-close";
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
														$icon_rem = "fa-check";
														$title_rem = "LULUS";
													} else {
														$btn_rem = "danger";
														$md_rem = "danger";
														$icon_rem = "fa-close";
														$title_rem = "GAGAL";
													}
													
													$speedometer = $row->speedometer;
													if(($speedometer>=36)&&($speedometer<=46)){
														$btn_speed = "success";
														$md_speed = "success";
														$icon_speed = "fa-check";
														$title_speed = "LULUS";
													}
													else{
														$btn_speed = "danger";
														$md_speed = "danger";
														$icon_speed = "fa-close";
														$title_speed = "GAGAL";
													}
													
													if(($title_visual=="LULUS") && ($title_sound=="LULUS") && ($title_tint=="LULUS") && ($title_asap=="LULUS") && ($title_lampu=="LULUS") && ($title_side=="LULUS") && ($title_rem=="LULUS") && ($title_speed=="LULUS")){
														$btn_hasil = "success";
														$icon_hasil = "fa-check";
														$title_hasil = "LULUS";
													} else {
														$btn_hasil = "danger";
														$icon_hasil = "fa-close";
														$title_hasil = "TIDAK LULUS";
													}
												?>
											<tr>
												<td class="center"><?php echo $no++;?></th>
												<td class="center bolder"><?php echo $row->no_uji;?></th>
												<td class="hidden-480 center bolder"><?php echo $row->no_kendaraan;?></td>
												<td class="hidden-480 center bolder"><?php echo $row->nama;?></td>
												<td class="hidden-480 center"><button type="button" class="btn btn-xs btn-<?php echo $btn_visual;?>" title="<?php echo $title_visual;?>"><i class="fa <?php echo $icon_visual;?>"></i></button></td>
												<td class="hidden-480 center"><button type="button" class="btn btn-xs btn-<?php echo $btn_sound;?>" title="<?php echo $title_sound;?>"><i class="fa <?php echo $icon_sound;?>"></i></button></td>
												<td class="hidden-480 center"><button type="button" class="btn btn-xs btn-<?php echo $btn_tint;?>" title="<?php echo $title_tint;?>"><i class="fa <?php echo $icon_tint;?>"></i></button></td>
												<td class="hidden-480 center"><button type="button" class="btn btn-xs btn-<?php echo $btn_asap;?>" title="<?php echo $title_asap;?>"><i class="fa <?php echo $icon_asap;?>"></i></button></td>
												<td class="hidden-480 center"><button type="button" class="btn btn-xs btn-<?php echo $btn_lampu;?>" title="<?php echo $title_lampu;?>"><i class="fa <?php echo $icon_lampu;?>"></i></button></td>
												<td class="hidden-480 center"><button type="button" class="btn btn-xs btn-<?php echo $btn_side;?>" title="<?php echo $title_side;?>"><i class="fa <?php echo $icon_side;?>"></i></button></td>
												<td class="hidden-480 center"><button type="button" class="btn btn-xs btn-<?php echo $btn_rem;?>" title="<?php echo $title_rem;?>"><i class="fa <?php echo $icon_rem;?>"></i></button></td>
												<td class="hidden-480 center"><button type="button" class="btn btn-xs btn-<?php echo $btn_speed;?>" title="<?php echo $title_speed;?>"><i class="fa <?php echo $icon_speed;?>"></i></button></td>
												<td class="hidden-480 center"><span class="label label-<?php echo $btn_hasil;?>"><i class="ace-icon fa <?php echo $icon_hasil;?>"></i> <b><?php echo $title_hasil;?></b></span></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
									
									<div class="row">
										<div class="col-xs-4 pull-right text-right">
											<button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i></button> : <b> LULUS  </b> <button type="button" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button> : <b> TIDAK LULUS </b> <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-minus"></i></button> : <b> BELUM UJI </b> 
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
						Dinas Perhubungan Kabupaten Jepara &copy; 2020
					</span>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
			function autoRefreshPage(){
				window.location = window.location.href;
			}
			setInterval('autoRefreshPage()', 30000);
		</script>
	</body>
</html>
