<div class="page-content">
	
	<?php 
	if(isset($data_pengujian)){
		foreach($data_pengujian as $row){
		?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('uji/tambah_proses_pengesahan?id='.$row->kode_uji.'&no='.$row->no_uji);?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Laporan Pengujian Kendaraan Bermotor
				</h1>
			</div>
		</div>
	</div>
	<?php 
	} }
	if(isset($data_pengujian)){
		foreach($data_pengujian as $row){
			$penguji = $row->penguji;
		?>
	
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Pengujian </label>
					<div class="col-sm-8">
						<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>"  class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" class="col-xs-12" value="<?php echo $row->jenis;?> / <?php echo $row->bentuk;?>"  readonly />
					</div>
				</div>
				
				<input type="hidden" id="jenis" name="jenis" class="col-xs-12" value="<?php echo $row->jenis;?>"  readonly />
				<input type="hidden" id="tahun" name="tahun" class="col-xs-12" value="<?php echo $row->tahun;?>"  readonly />
				<input type="hidden" id="bahan_bakar" name="bahan_bakar" class="col-xs-12" value="<?php echo $row->bahan_bakar;?>"  readonly />
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanggal Pengujian </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_uji" name="tgl_uji" type="text" value="<?php echo date('Y-m-d',strtotime($row->tgl_uji)); ?>" data-date-format="yyyy-mm-dd" readonly />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Merk dan Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="merktipe" name="merktipe" class="col-xs-12" value="<?php echo $row->merek;?> / <?php echo $row->tipe;?>" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tahun </label>
					<div class="col-sm-8">
						<input type="text" id="tahun" name="tahun" class="col-xs-12" value="<?php echo $row->tahun;?>" readonly />
					</div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller lighter blue">FOTO KENDARAAN</h3>
		
		<?php $no = 1;
		if(!empty($dt_foto)){ ?>
		<div class="row">
		<?php foreach($dt_foto as $ft){?>
			<div class="col-xs-12 col-sm-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA <?php echo $no++;?>
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" src="<?php echo base_url('files/foto/'.$ft->kode_uji.'/'.$ft->foto);?>">
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
		<?php } else { ?>
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<div class="alert alert-danger text-center">
					<button type="button" class="close" data-dismiss="alert">
						<i class="ace-icon fa fa-times"></i>
					</button>

					<strong>
						<i class="ace-icon fa fa-times"></i>
						Foto tidak di temukan. 
					</strong>

					Silahkan klik ambil foto untuk memfoto kendaraan
					<br />
				</div>
			</div>

			<div class="col-xs-12 text-center">
				<a href="<?php echo site_url('uji/ambil_foto_kendaraan/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Foto kendaraan">
					<button type="button" class="btn btn-primary">
						<i class="ace-icon fa fa-camera align-top bigger-125"></i>
						Ambil FotO
					</button>
				</a>
			</div>
		</div>
		
		<?php } ?>
		
		
		
		<h3 class="header smaller lighter blue">HASIL PENGUJIAN</h3>
		<div class="row">
			<div class="col-xs-12">
				<table id="simple-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center"></th>
							<th class="text-center">Tanggal</th>
							<th class="text-center">Kaca</th>
							<th class="text-center">Kebisingan</th>
							<th class="text-center">Alur Ban</th>
							<th class="text-center">Emisi</th>
							<th class="text-center">Lampu</th>
							<th class="text-center">Side Slip</th>
							<th class="text-center">Rem</th>
							<th class="text-center">Speed</th>
						</tr>
					</thead>
					<tbody>
					<?php $no=1; foreach($dt_riwayat as $row){
						$kaca = $row->tint_meter;
						if(($kaca>=70) && ($kaca<=100)){
							$span_kaca="success";
							$cek_kaca=1;
						} else{
							$span_kaca="danger";
							$cek_kaca=0;
						}
						
						$sound = $row->sound_level;
						if(($sound>=83)&&($sound<=118)){
							$span_sound="success";
							$cek_sound=1;
						} else{
							$span_sound="danger";
							$cek_sound=0;
						}
						
						$alur = $row->alur_ban;
						if($alur>=1){
							$span_alur="success";
							$cek_alur=1;
						} else{
							$span_alur="danger";
							$cek_alur=0;
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
									$span_asap="success";
									$cek_asap=1;
								} else if($asap>70){
									$span_asap="danger";
									$cek_asap=0;
								}
							} else {
								if($jbb<=3500){
									if($asap<=40){
										$span_asap="success";
										$cek_asap=1;
									} else if($asap>40){
										$span_asap="danger";
										$cek_asap=0;
									}
								} else if($jbb>3500){
									if($asap<=50){
										$span_asap="success";
										$cek_asap=1;
									} else if($asap>50){
										$span_asap="danger";
										$cek_asap=0;
									}
								}
							}
						} else {
							if($tahun<=2007){
								if($co<=4.5){
									$span_co="success";
								} else if($co>4.5){
									$span_co="danger";
								}
								if($hc<=1200){
									$span_hc="success";
								} else if($hc>1200){
									$span_hc="danger";
								}
							} else {
								if($co<=1.5){
									$span_co="success";
								} else if($co>1.5){
									$span_co="danger";
								}
								if($hc<=200){
									$span_hc="success";
								} else if($hc>200){
									$span_hc="danger";
								}
							}
							if(($span_co=="success")&&($span_hc=="success")){
								$cek_asap=1;
							} else {
								$cek_asap=0;
							}
						}
						
						$lampu_kiri = $row->lampu_kiri;
						$d_lampu_kiri = $row->derajat_lampu_kiri;
						$m_lampu_kiri = $row->menit_lampu_kiri;
						$lampu_kanan = $row->lampu_kanan;
						$d_lampu_kanan = $row->derajat_lampu_kanan;
						$m_lampu_kanan = $row->menit_lampu_kanan;
						
						if($lampu_kiri>=12000){
							$span_l_kiri = "success";
						}
						else{
							$span_l_kiri = "danger";
						}
						
						if($d_lampu_kiri<=1.09){
							$span_d_kiri = "success";
						} else {
							$span_d_kiri = "danger";
						}
						
						if($lampu_kanan>=12000){
							$span_l_kanan = "success";
						}
						else{
							$span_l_kanan = "danger";
						}
						
						if($d_lampu_kanan<=0.34){
							$span_d_kanan = "success";
						} else {
							$span_d_kanan = "danger";
						}
						
						if(($span_l_kiri=="success") && ($span_l_kanan=="success") && ($span_d_kiri=="success") && ($span_d_kanan=="success")){
							$cek_lampu=1;
						} else {
							$cek_lampu=0;
						}
						
						$ss_in = $row->side_slip_in;
						if(($ss_in>=-5) && ($ss_in<=5)){
							$span_side = "success";
							$cek_side=1;
						}
						else{
							$span_side = "danger";
							$cek_side=0;
						}

						$jenis = $row->jenis;
						if($row->ax_total_s1=="0"){
							$ax_s1 = $row->bk_sumbu1;
						} else {
							$ax_s1 = $row->ax_total_s1;
						}
						if($row->ax_total_s2=="0"){
							$ax_s2 = $row->bk_sumbu2;
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
						
						if(($rem_utama>=50) && ($rem_utama<=100)){
							$span_rem_utama = "success";
							if($ps1<=8){
								$span_ps1 = "success";
							}
							else{
								$span_ps1 = "danger";
							}
							
							if($ps2<=8){
								$span_ps2 = "success";
							}
							else{
								$span_ps2 = "danger";
							}
							
							if($ax_s3>0){
								if($ps3<=8){
									$span_ps3 = "success";
								}
								else{
									$span_ps3 = "danger";
								}
							}
							
							if($ax_s4>0){
								if($ps4<=8){
									$span_ps4 = "success";
								}
								else{
									$span_ps4 = "danger";
								}
							}
						} else{
							$span_rem_utama = "danger";
							if($ps1<=8){
								$span_ps1 = "success";
							}
							else{
								$span_ps1 = "danger";
							}
							
							if($ps2<=8){
								$span_ps2 = "success";
							}
							else{
								$span_ps2 = "danger";
							}
							
							if($ax_s3>0){
								if($ps3<=8){
									$span_ps3 = "success";
								}
								else{
									$span_ps3 = "danger";
								}
							}
							
							if($ax_s4>0){
								if($ps4<=8){
									$span_ps4 = "success";
								}
								else{
									$span_ps4 = "danger";
								}
							}
						}
						
						if(($jenis=="MOBIL PENUMPANG") || ($jenis=="MOBIL BUS")){
							if(($rem_parkir>=16) && ($rem_parkir<=100)){
								$span_parkir = "success";
							} else {
								$span_parkir = "danger";
							}
						} else {
							if(($rem_parkir>=12) && ($rem_parkir<=100)){
								$span_parkir = "success";
							} else {
								$span_parkir = "danger";
							}
						}
						
						$speedometer = $row->speedometer;
						if(($speedometer>=36)&&($speedometer<=46)){
							$span_speedometer = "success";
							$cek_speedo=1;
						}
						else{
							$span_speedometer = "danger";
							$cek_speedo=0;
						}
						
						$jenis = $row->jenis;
						if(($jenis!="KERETA GANDENGAN") && ($jenis!="KERETA TEMPELAN")){
							if(($cek_sound=="1") && ($cek_alur=="1") && ($cek_asap=="1") && ($cek_lampu=="1") && ($cek_side=="1") && ($cek_speedo=="1")){

							} else {

							}
						} else {
							
						} ?>
						<tr>
							<td class="text-center"><?php echo $no++;?></td>
							<td class="text-center"><?php echo date("d M Y h:i:s",strtotime($row->tgl_riwayat));?></td>
							<td class="text-center"><span class="badge badge-<?php echo $span_kaca;?>"><?php echo $row->tint_meter." %";?></span></td>
							<td class="text-center"><span class="badge badge-<?php echo $span_sound;?>"><?php echo $row->sound_level." db";?></span></td>
							<td class="text-center"><span class="badge badge-<?php echo $span_alur;?>"><?php echo $row->alur_ban ." mm";?></span></td>
							<td class="text-center"><?php if($bahan_bakar=="SOLAR"){ ?><span class="badge badge-<?php echo $span_asap;?>"> <?php echo $row->asap."%";?></span><?php } else { ?><span class="badge badge-<?php echo $span_co;?>">CO: <?php echo $row->asap_co."%";?></span> <span class="badge badge-<?php echo $span_co;?>">HC: <?php echo $row->asap_hc."%";?></span><?php } ?></td>
							<td class="text-center">Kiri : <span class="badge badge-<?php echo $span_l_kiri;?>"><?php echo $row->lampu_kiri;?> cd</span> <span class="badge badge-<?php echo $span_d_kiri;?>"><?php echo $row->derajat_lampu_kiri;?>&deg;</span><br/>Kanan : <span class="badge badge-<?php echo $span_l_kanan;?>"><?php echo $row->lampu_kanan;?> cd</span> <span class="badge badge-<?php echo $span_d_kanan;?>"><?php echo $row->derajat_lampu_kanan;?>&deg;</span>
							<td class="text-center"><span class="badge badge-<?php echo $span_side;?>"><?php echo $row->side_slip_in;?> mm</span></td>
							<td class="text-center">Utama : <span class="badge badge-<?php echo $span_rem_utama;?>">BEF: <?php echo round($rem_utama,2);?>%</span> <br/> Parkir : <span class="badge badge-<?php echo $span_parkir;?>">PEF: <?php echo round($rem_parkir,2);?>%</span> <br/> PS : <span class="badge badge-<?php echo $span_ps1;?>">PS1: <?php echo round($ps1,2);?>%</span> <span class="badge badge-<?php echo $span_ps2;?>">PS2: <?php echo round($ps2,2);?>%</span> <?php if($ax_s3>0){?><span class="badge badge-<?php echo $span_ps3;?>">PS3: <?php echo round($ps3,2);?>%</span><?php } ?> <?php if($ax_s4>0){?><span class="badge badge-<?php echo $span_ps4;?>">PS4: <?php echo round($ps4,2);?>%</span><?php } ?></td>
							<td class="text-center"><span class="badge badge-<?php echo $span_speedometer;?>"><?php echo $row->speedometer;?></span></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		
		<?php if($catatan>0){ ?>
		<h3 class="header smaller lighter red">CATATAN KERUSAKAN</h3>
		
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Kerusakan</th>
							<th>Keterangan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
					<?php $no=1; foreach($dt_catatan as $ctt){ 
						if($ctt->aktif=="1"){ $tr="red"; $ket="BELUM DIPERBAIKI"; } else { $tr="blue"; $ket="SUDAH DIPEBAIKI";}?>
						<tr class="<?php echo $tr;?>">
							<td class="center"><?php echo $no++;?></td>
							<td><?php if($ctt->aktif=="0"){ echo "<strike>".$ctt->catatan."</strike>"; } else { echo $ctt->catatan; }?></td>
							<td><?php echo $ket;?></td>
							<td>
								<?php if($ctt->aktif=="1"){ ?>
								<a href="<?php echo site_url('uji/hapuscatatan?id='.$ctt->id_catatan.'&kode='.$ctt->kode_uji.'&redirect='.$redirect);?>" class="btn btn-xs btn-success tooltip-info" data-rel="tooltip" title="Hapus catatan">
									<i class="ace-icon fa fa-check bigger-120"></i>
								</a>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php } ?>
		
		<h3 class="header smaller lighter red">TAMBAH CATATAN KERUSAKAN</h3>
		
		<div id="formcatatanmanual">
			<div class="form-group">
				<label class="col-xs-2 control-label no-padding-left"> Catatan</label>
				<div class="col-xs-9">
					<input type="text" id="catatanmanual" name="catatan[]" placeholder="catatan kerusakan kendaraan" class="col-xs-12"/>
				</div>
				<div class="col-xs-1">
					<a href="#" class="add_catatanmanual btn btn-primary btn-sm" title="Tambah catatan">
						<i class="ace-icon fa fa-plus icon-only"></i>
					</a>
				</div>
			</div>
		</div>
		
		<!--
		<h3 class="header smaller lighter blue">PERINTAH PERBAIKAN</h3>
		
		<div id="formperbaikan">
			<div class="form-group">
				<label class="col-xs-1 control-label no-padding-left"> Perbaikan </label>
				<div class="col-xs-10">
					<input type="text" id="perbaikan" name="perbaikan[]" placeholder="Perintah perbaikan kendaraan" class="col-xs-12"/>
				</div>
				<div class="col-xs-1">
					<a href="javascript:void(0);" class="add_perbaikan" title="Tambah perbaikan">
						<i class="ace-icon fa fa-plus bigger-120"></i>
					</a>
				</div>
			</div>
		</div>
		-->
		
		<h3 class="header smaller lighter blue"></h3>
				
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-5 control-label no-padding-left bolder blue"> Hasil Pengujian </label>
					<div class="col-sm-7">
						<select class="select2" id="hasil" name="hasil" data-placeholder="Pilih Hasil Pengujian" required>
							<option></option>
							<option value="LULUS">LULUS</option>
							<option value="TIDAK LULUS">TIDAK LULUS</option>
						</select>
					</div>
				</div>
				
				<div id="form_hasiluji"></div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-5 control-label no-padding-left bolder blue"> Penguji</label>
					<div class="col-sm-7">
						<select class="select2" id="penguji" name="penguji" data-placeholder="Pilih penguji" required>
							<?php foreach($dt_pengujism as $pgj){
							if($row->id_penguji==$pgj->idx){ ?>
							<option value="<?php echo $row->id_penguji;?>" selected><?php echo $penguji;?></option>
							<?php } else { 
							if($this->session->userdata('id_akses') == '1'){ ?>
							<option value="<?php echo $pgj->idx;?>"><?php echo $pgj->nama; ?></option>
							<?php }}} ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		
		<div id="form_kirimhasil"></div>
	</form>
	<?php }} ?>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('.add_catatanmanual').click(function(e) {
			e.preventDefault();
				$('#formcatatanmanual').append('<div class="form-group"><label class="col-xs-2 control-label no-padding-left"> Catatan Manual</label><div class="col-xs-9"><input type="text" id="catatanmanual" name="catatan[]" placeholder="catatan kerusakan kendaraan" class="col-xs-12"/></div><div class="col-xs-1"><a href="#" class="hapus_catatanmanual btn btn-danger btn-sm" title="Hapus catatan"><i class="ace-icon fa fa-times icon-only"></i></a></div></div>');
			});

		$('#formcatatanmanual').on('click', '.hapus_catatanmanual', function(e) {
			e.preventDefault();
			$(this).parent().remove();
		});
		
		$('#hasil').on('change',function(){
			var tgl = $("#tgl_uji").val();
			var hasil = $("#hasil").val();
			$.ajax({
				url: "<?php echo base_url('uji/get_hasiluji'); ?>",
				type: 'GET',
				data: {
					'hsl':hasil,
					'tgl':tgl,
				},
				success: function(data){
					$('#form_hasiluji').html(data);
					$("#form_kirimhasil").load("<?php echo base_url('uji/get_kirimhasil');?>");
				},
				failed: function(data){
					alert('Gagal mendapatkan data');
				}
			});
		});
		
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
		});
	});
</script>