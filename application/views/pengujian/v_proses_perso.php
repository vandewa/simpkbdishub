<div class="page-content">
	
	<?php 
	if(isset($dt_perso)){
		foreach($dt_perso as $row){
		?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('uji/prosesperso?kode='.$row->kode_uji.'&no='.$row->no_uji.'&idp='.$row->id_user);?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<div class="page-header">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<h1>
						PERSO DATA HASIL UJI KENDARAAN
					</h1>
				</div>
			</div>
		</div>
	
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
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>"  class="col-xs-12"required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Rangka </label>
					<div class="col-sm-8">
						<input type="text" id="no_rangka" name="no_rangka" placeholder="Nomor Rangka Landasan" value="<?php echo $row->no_rangka;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Mesin </label>
					<div class="col-sm-8">
						<input type="text" id="no_mesin" name="no_mesin" placeholder="Nomor Mesin" value="<?php echo $row->no_mesin;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Merek </label>
					<div class="col-sm-8">
						<input type="text" id="merek" name="merek" placeholder="Merek" value="<?php echo $row->merek;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="tipe" name="tipe" placeholder="Tipe" value="<?php echo $row->tipe;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-8">
						<select id="jenis_kendaraan" name="jenis_kendaraan" class="select2" data-placeholder="Pilih jenis kendaraan..." required >
							<option></option>
							<?php foreach($dt_jenis_kendaraan as $jnsken){ 
							if($row->jenis_kendaraan==$jnsken->jenis_kendaraan){?>
							<option value="<?php echo $row->jenis_kendaraan;?>" selected><?php echo $row->jenis_kendaraan;?></option>
							<?php } else { ?>
							<option value="<?php echo $jnsken->jenis_kendaraan;?>"><?php echo $jnsken->jenis_kendaraan;?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tahun Pembuatan </label>
					<div class="col-sm-8">
						<input type="text" id="tahun" name="tahun" placeholder="Tahun Pembuatan" value="<?php echo $row->tahun;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Bahan Bakar </label>
					<div class="col-sm-8">
						<select id="bahan_bakar" name="bahan_bakar" class="select2" data-placeholder="Pilih bahan bakar..." required >
							<option></option>
							<?php foreach($dt_bahanbakar as $bbm){ 
							if($row->bahan_bakar==$bbm->bahan_bakar){ ?>
							<option value="<?php echo $row->bahan_bakar;?>" selected><?php echo $row->bahan_bakar;?></option>
							<?php } else { ?>
							<option value="<?php echo $bbm->bahan_bakar;?>"><?php echo $bbm->bahan_bakar;?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Isi Silinder </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="isi_silinder" name="isi_silinder" placeholder="Isi Silinder" value="<?php echo $row->isi_silinder;?>" class="col-xs-12" required />
							<span class="input-group-addon">
								cc
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Daya Motor </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="daya_motor" name="daya_motor" placeholder="Daya Motor" value="<?php echo $row->daya_motor;?>" class="col-xs-12" required />
							<span class="input-group-addon">
								kW/PS/HP
							</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Direktur </label>
					<div class="col-sm-8">
						<select id="direktur" name="direktur" class="select2" data-placeholder="Pilih direktur...">
							<?php foreach($dt_direktur as $dir){ ?>
							<option value="<?php echo $dir->idx;?>"><?php echo $dir->nama;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kepala Dinas</label>
					<div class="col-sm-8">
						<select id="kadis" name="kadis" class="select2" data-placeholder="Pilih kepala dinas...">
							<?php foreach($dt_kadis as $dis){ ?>
							<option value="<?php echo $dis->idx;?>"><?php echo $dis->nama;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Penguji</label>
					<div class="col-sm-8">
						<select class="select2" id="penguji" name="penguji" data-placeholder="Pilih penguji" required>
							<option value=""></option>
							<?php foreach($dt_penguji as $pgj){ 
							if($row->penguji==$pgj->idx){ ?>
							<option value="<?php echo $row->penguji;?>" selected><?php echo $row->nama_penguji; ?></option>
							<?php } else { ?>
							<option value="<?php echo $pgj->idx;?>"><?php echo $pgj->nama; ?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kode Wilayah Uji</label>
					<div class="col-sm-8">
						<select class="select2" id="kd_wilayah" name="kd_wilayah" data-placeholder="Pilih kode wilayah" required>
							<option value=""></option>
							<?php foreach($dt_setting as $stg){ $wilayah = $stg->kodewilayah;}  
							foreach($dt_wilayah as $wly){ 
							if($wilayah==$wly->kodewilayah){ ?>
							<option value="<?php echo $wilayah;?>" selected><?php echo $wilayah; ?></option>
							<?php } else { ?>
							<option value="<?php echo $wly->kodewilayah;?>"><?php echo $wly->kodewilayah; ?>-<?php echo $wly->namawilayah; ?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kode Wilayah Asal </label>
					<div class="col-sm-8">
						<select class="select2" id="kd_wilayah_asal" name="kd_wilayah_asal" data-placeholder="Pilih kode wilayah asal" required>
							<option value=""></option>
							<?php foreach($dt_wilayah as $wly){ 
							if($row->kd_wil_asal==$wly->kodewilayah){ ?>
							<option value="<?php echo $row->kd_wil_asal;?>" selected><?php echo $row->kd_wil_asal; ?></option>
							<?php } else { ?>
							<option value="<?php echo $wly->kodewilayah;?>"><?php echo $wly->kodewilayah; ?>-<?php echo $wly->namawilayah; ?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor KTP </label>
					<div class="col-sm-8">
						<input type="text" id="no_ktp" name="no_ktp" placeholder="Nomor KTP" value="<?php echo $row->no_ktp;?>" class="col-xs-12"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nama Pemilik </label>
					<div class="col-sm-8">
						<input type="text" id="nama" name="nama" placeholder="Nama Pemilik" value="<?php echo $row->pemilik;?>" class="col-xs-12"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Alamat </label>
					<div class="col-sm-8">
						<textarea class="form-control limited" id="alamat" name="alamat" placeholder="Alamat" maxlength="50"><?php echo $row->alamat;?> <?php echo $row->kecamatan;?> <?php echo $row->kota;?></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Nomor SRUT</label>
					<div class="col-sm-8">
						<input type="text" id="no_sertifikasi_uji" name="no_sertifikasi_uji" placeholder="No Sertifikasi Uji Tipe" value="<?php echo $row->no_sertifikasi_uji;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Tanggal SRUT</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_sertifikasi_uji" name="tgl_sertifikasi_uji" type="text" value="<?php echo $row->tgl_sertifikasi_uji;?>" data-date-format="yyyy-mm-dd" required />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller lighter blue">DATA SPESIFIKASI KENDARAAN</h3>
		
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBB </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jbb" name="jbb" placeholder="Jumlah Berat Diperbolehkan" value="<?php echo $row->jbb;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBKB </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jbb_kombinasi" name="jbb_kombinasi" placeholder="Jumlah Berat Kombinasi Diperbolehkan" value="<?php echo $row->jbb_kombinasi;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBI </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jbi" name="jbi" placeholder="JBI" value="<?php echo $row->jbi;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBKI </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jbi_kombinasi" name="jbi_kombinasi" placeholder="JBI Kombinasi" value="<?php echo $row->jbi_kombinasi;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> MST </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="mst" name="mst" placeholder="Muatan Sumbu Terberat" value="<?php echo $row->mst;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> BK Total </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="bk_total" name="bk_total" placeholder="Jumlah Berat Kosong" value="<?php echo $row->bk_total;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Konf Sumbu </label>
					<div class="col-sm-8">
						<input type="text" id="konf_sumbu" name="konf_sumbu" placeholder="Konfigurasi Sumbu" value="<?php echo $row->konf_sumbu;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Ukuran Ban </label>
					<div class="col-sm-8">
						<input type="text" id="ban_sumbu1" name="ban_sumbu1" placeholder="Sumbu ke-1" value="<?php echo $row->ban_sumbu1;?>" class="col-xs-12" required />
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Panjang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="uk_panjang" name="uk_panjang" placeholder="Panjang Ukuran Utama" value="<?php echo $row->uk_panjang;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="uk_lebar" name="uk_lebar" placeholder="Lebar Ukuran Utama" value="<?php echo $row->uk_lebar;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="uk_tinggi" name="uk_tinggi" placeholder="Tinggi Ukuran Utama" value="<?php echo $row->uk_tinggi;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Julur Belakang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="uk_roh" name="uk_roh" placeholder="Julur Belakang" value="<?php echo $row->uk_roh;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Julur Depan </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="uk_foh" name="uk_foh" placeholder="Julur Depan" value="<?php echo $row->uk_foh;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Panjang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="dbm_panjang" name="dbm_panjang" placeholder="Panjang Dimensi Bak Muatan" value="<?php echo $row->dbm_panjang;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="dbm_lebar" name="dbm_lebar" placeholder="Lebar Dimensi Bak Muatan" value="<?php echo $row->dbm_lebar;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="dbm_tinggi" name="dbm_tinggi" placeholder="Tinggi Dimensi Bak Muatan" value="<?php echo $row->dbm_tinggi;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Sumbu I-II </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="js_sumbu1" name="js_sumbu1" placeholder="Jarak Sumbu I-II" value="<?php echo $row->js_sumbu1;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Sumbu II-III </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="js_sumbu2" name="js_sumbu2" placeholder="Jarak Sumbu II-III" value="<?php echo $row->js_sumbu2;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Sumbu III-IV </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="js_sumbu3" name="js_sumbu3" placeholder="Jarak Sumbu III-IV" value="<?php echo $row->js_sumbu3;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Orang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="da_orang" name="da_orang" placeholder="Berat Orang" value="<?php echo $row->da_orang;?>" class="col-xs-12" required />
							<span class="input-group-addon">Org</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Barang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="da_barang" name="da_barang" placeholder="Daya Angkut Barang" value="<?php echo $row->da_barang;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kelas Jalan </label>
					<div class="col-sm-8">
						<input type="text" id="kelas_jalan" name="kelas_jalan" placeholder="Kelas Jalan Terendah" value="<?php echo $row->kelas_jalan;?>" class="col-xs-12" required />
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
		<?php } ?>
		
		<h3 class="header smaller lighter blue">HASIL PENGUJIAN</h3>
		<div class="row">
			<div class="col-xs-12">
				<table id="simple-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
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
					<?php 
						$kaca = $row->tint_meter;
						if($kaca>=70){
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
						if($ss_in<=5){
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
						
						if($rem_utama>=50){
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
						
						if($jenis=="MOBIL PENUMPANG"){
							if($rem_parkir>=16){
								$span_parkir = "success";
							} else {
								$span_parkir = "danger";
							}
						} else {
							if($rem_parkir>=12){
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
							<td class="text-center"><span class="badge badge-<?php echo $span_kaca;?>"><?php echo $row->tint_meter." %";?></span></td>
							<td class="text-center"><span class="badge badge-<?php echo $span_sound;?>"><?php echo $row->sound_level." db";?></span></td>
							<td class="text-center"><span class="badge badge-<?php echo $span_alur;?>"><?php echo $row->alur_ban ." mm";?></span></td>
							<td class="text-center"><?php if($bahan_bakar=="SOLAR"){ ?><span class="badge badge-<?php echo $span_asap;?>"> <?php echo $row->asap."%";?></span><?php } else { ?><span class="badge badge-<?php echo $span_co;?>">CO: <?php echo $row->asap_co."%";?></span> <span class="badge badge-<?php echo $span_co;?>">HC: <?php echo $row->asap_hc."%";?></span><?php } ?></td>
							<td class="text-center">Kiri : <span class="badge badge-<?php echo $span_l_kiri;?>"><?php echo $row->lampu_kiri;?> cd</span> <span class="badge badge-<?php echo $span_d_kiri;?>"><?php echo $row->derajat_lampu_kiri;?>&deg;</span><br/>Kanan : <span class="badge badge-<?php echo $span_l_kanan;?>"><?php echo $row->lampu_kanan;?> cd</span> <span class="badge badge-<?php echo $span_d_kanan;?>"><?php echo $row->derajat_lampu_kanan;?>&deg;</span>
							<td class="text-center"><span class="badge badge-<?php echo $span_side;?>"><?php echo $row->side_slip_in;?> mm</span></td>
							<td class="text-center">Utama : <span class="badge badge-<?php echo $span_rem_utama;?>">BEF: <?php echo round($rem_utama,2);?>%</span> <br/> Parkir : <span class="badge badge-<?php echo $span_parkir;?>">PEF: <?php echo round($rem_parkir,2);?>%</span> <br/> PS : <span class="badge badge-<?php echo $span_ps1;?>">PS1: <?php echo round($ps1,2);?>%</span> <span class="badge badge-<?php echo $span_ps2;?>">PS2: <?php echo round($ps2,2);?>%</span> <?php if($ax_s3>0){?><span class="badge badge-<?php echo $span_ps3;?>">PS3: <?php echo round($ps3,2);?>%</span><?php } ?> <?php if($ax_s4>0){?><span class="badge badge-<?php echo $span_ps4;?>">PS4: <?php echo round($ps4,2);?>%</span><?php } ?></td>
							<td class="text-center"><span class="badge badge-<?php echo $span_speedometer;?>"><?php echo $row->speedometer;?></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit" onclick="return confirm('Anda yakin data sudah benar?')">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Perso
				</button>

				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</div>
	</form>
	<?php }} ?>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
		});
	});
</script>