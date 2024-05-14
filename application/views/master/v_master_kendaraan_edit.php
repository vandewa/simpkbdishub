<div class="page-content">
	
	<div class="page-header">
		<h1>
			Edit Data Kendaraan
		</h1>
	</div>
	<?php 
	if(isset($detail_kendaraan)){
		foreach($detail_kendaraan as $row){
		?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('master/proses_edit_master_kendaraan/'.$row->id_kendaraan);?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="header smaller lighter blue">
					Identitas Kendaraan
				</h3>	
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Merek </label>
						<div class="col-sm-8">
							<input type="text" id="merek" name="merek" placeholder="Merek" value="<?php echo $row->merek;?>" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tipe </label>
						<div class="col-sm-8">
							<input type="text" id="tipe" name="tipe" placeholder="Tipe" value="<?php echo $row->tipe;?>" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Jenis </label>
						<div class="col-sm-8">
							<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis kendaraan..." required>
								<option></option>
								<?php foreach($dt_jenis as $jns){ 
								if($row->jenis==$jns->jenis){?>
								<option value="<?php echo $row->jenis;?>" selected><?php echo $row->jenis;?></option>
								<?php } else { ?>
								<option value="<?php echo $jns->jenis;?>"><?php echo $jns->jenis;?></option>
								<?php }} ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
						<div class="col-sm-8">
							<select id="jenis_kendaraan" name="jenis_kendaraan" class="select2" data-placeholder="Pilih jenis kendaraan..." required>
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
				</div>
				
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Bentuk Kendaraan </label>
						<div class="col-sm-8">
							<select id="bentuk" name="bentuk" class="select2" data-placeholder="Pilih bentuk kendaraan..." required>
								<option></option>
								<?php foreach($dt_jenis_bentuk as $jnsben){
								if($row->bentuk==$jnsben->jenis_kendaraan){?>
								<option value="<?php echo $row->bentuk;?>" selected><?php echo $row->bentuk;?></option>
								<?php } else { ?>
								<option value="<?php echo $jnsben->jenis_kendaraan;?>"><?php echo $jnsben->jenis_kendaraan;?></option>
								<?php }} ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Isi Silinder </label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" id="isi_silinder" name="isi_silinder" placeholder="Isi Silinder" value="<?php echo $row->isi_silinder;?>" class="col-xs-12"/>
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
								<input type="text" id="daya_motor" name="daya_motor" placeholder="Daya Motor" value="<?php echo $row->daya_motor;?>" class="col-xs-12" />
								<span class="input-group-addon">
									kW/PS/HP
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Bahan Bakar </label>
						<div class="col-sm-8">
							<select id="bahan_bakar" name="bahan_bakar" class="select2" data-placeholder="Pilih bahan bakar...">
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
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="header smaller lighter blue">
					Uraian Kendaraan
				</h3>
				
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<label class="control-label bolder blue">Ukuran Utama</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Panjang </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_panjang" name="uk_panjang" placeholder="Panjang Ukuran Utama" value="<?php echo $row->uk_panjang;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_lebar" name="uk_lebar" placeholder="Lebar Ukuran Utama" value="<?php echo $row->uk_lebar;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_tinggi" name="uk_tinggi" placeholder="Tinggi Ukuran Utama" value="<?php echo $row->uk_tinggi;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Julur Belakang </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_roh" name="uk_roh" placeholder="Julur Belakang" value="<?php echo $row->uk_roh;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Julur Depan </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_foh" name="uk_foh" placeholder="Julur Depan" value="<?php echo $row->uk_foh;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<label class="control-label bolder blue">Jarak Sumbu</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu I-II </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbu1" name="js_sumbu1" placeholder="Jarak Sumbu I-II" value="<?php echo $row->js_sumbu1;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu II-III </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbu2" name="js_sumbu2" placeholder="Jarak Sumbu II-III" value="<?php echo $row->js_sumbu2;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu III-IV </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbu3" name="js_sumbu3" placeholder="Jarak Sumbu III-IV" value="<?php echo $row->js_sumbu3;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu IV-V </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbu4" name="js_sumbu4" placeholder="Jarak Sumbu IV-V" value="<?php echo $row->js_sumbu4;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu P </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbup" name="js_sumbup" placeholder="Jarak Sumbu P" value="<?php echo $row->js_sumbup;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu Q </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbuq" name="js_sumbuq" placeholder="Jarak Sumbu Q" value="<?php echo $row->js_sumbuq;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu R </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbur" name="js_sumbur" placeholder="Jarak Sumbu R" value="<?php echo $row->js_sumbur;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu B </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbub" name="js_sumbub" placeholder="Jarak Sumbu B" value="<?php echo $row->js_sumbub;?>" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<label class="control-label bolder blue">Rumah - rumah (karoseri)</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Karoseri </label>
							<div class="col-sm-8">
								<input type="text" id="karoseri" name="karoseri" placeholder="Karoseri" value="<?php echo $row->karoseri;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Bahan Utama </label>
							<div class="col-sm-8">
								<input type="text" id="dbm_bahan_bak" name="dbm_bahan_bak" placeholder="Bahan Utama" value="<?php echo $row->dbm_bahan_bak;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tempat Duduk </label>
							<div class="col-sm-8">
								<input type="text" id="tempat_duduk" name="tempat_duduk" placeholder="Banyak tempat duduk" value="<?php echo $row->tempat_duduk;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tempat Berdiri </label>
							<div class="col-sm-8">
								<input type="text" id="tempat_berdiri" name="tempat_berdiri" placeholder="Banyak tempat berdiri" value="<?php echo $row->tempat_berdiri;?>" class="col-xs-12"/>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-4">
						<label class="control-label bolder blue">Keistimewaan</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Nama Komersiil </label>
							<div class="col-sm-8">
								<input type="text" id="nama_komersiil" name="nama_komersiil" placeholder="Nama Komersiil" value="<?php echo $row->nama_komersiil;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label bolder blue no-padding-left">Dimensi Muatan</label>
							<div class="col-sm-8">
								<select class="form-control" id="dimensi_muatan" name="dimensi_muatan" placeholder="Pilih dimensi muatan">
									<?php if($row->dimensi_kendaraan==''){?>
									<option value="">-</option>
									<option value="Bak muatan">Bak Muatan</option>
									<option value="Tangki">Tangki</option>
									<option value="Penumpang">Penumpang</option>
									<?php } else { ?>
									<option value="<?php echo $row->dimensi_kendaraan;?>" selected><?php echo $row->dimensi_kendaraan;?></option>
									<option value="">-</option>
									<option value="Bak muatan">Bak Muatan</option>
									<option value="Tangki">Tangki</option>
									<option value="Penumpang">Penumpang</option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div id="bak_muatan">
							<label class="control-label bolder blue">Dimensi Bak Muatan</label>
							<div class="space space-8"></div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Jenis Bak Muatan </label>
								<div class="col-sm-8">
									<select class="form-control" id="dbm_jenis" name="dbm_jenis" data-placeholder="Pilih jenis bak muatan">
										<option value="<?php echo $row->dbm_jenis;?>" selected><?php echo $row->dbm_jenis;?></option>
										<option value="">Pilih jenis bak muatan</option>
										<option value="TERBUKA">TERBUKA</option>
										<option value="TERTUTUP">TERTUTUP</option>
										<option value="BOX">BOX</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Panjang </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dbm_panjang" name="dbm_panjang" placeholder="Panjang Dimensi Bak Muatan" value="<?php echo $row->dbm_panjang;?>" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dbm_lebar" name="dbm_lebar" placeholder="Lebar Dimensi Bak Muatan" value="<?php echo $row->dbm_lebar;?>" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dbm_tinggi" name="dbm_tinggi" placeholder="Tinggi Dimensi Bak Muatan" value="<?php echo $row->dbm_tinggi;?>" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
						</div>
						
						<div id="tangki">
							<label class="control-label bolder blue">Dimensi Tangki</label>
							<div class="space space-8"></div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Panjang </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_panjang" name="dt_panjang" placeholder="Panjang Dimensi Tangki" value="<?php echo $row->dt_panjang;?>" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_lebar" name="dt_lebar" placeholder="Lebar Dimensi Tangki" value="<?php echo $row->dt_lebar;?>" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_tinggi" name="dt_tinggi" placeholder="Tinggi Dimensi Tangki" value="<?php echo $row->dt_tinggi;?>" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Volume </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_volume" name="dt_volume" placeholder="Volume Dimensi Tangki" value="<?php echo $row->dt_volume;?>" class="col-xs-12"/>
										<span class="input-group-addon">ltr</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Jenis Muatan </label>
								<div class="col-sm-8">
									<input type="text" id="dt_jenis_muatan" name="dt_jenis_muatan" placeholder="Jenis Muatan" value="<?php echo $row->dt_jenis_muatan;?>" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Berat Jenis Muatan </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_berat_jenis_muatan" name="dt_berat_jenis_muatan" placeholder="Berat Jenis Muatan" value="<?php echo $row->dt_berat_jenis_muatan;?>" class="col-xs-12"/>
										<span class="input-group-addon">kg/dm<sup>3</sup></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Bahan Tangki </label>
								<div class="col-sm-8">
									<input type="text" id="dt_bahan_tangki" name="dt_bahan_tangki" placeholder="Bahan Tangki" value="<?php echo $row->dt_bahan_tangki;?>" class="col-xs-12"/>
								</div>
							</div>
						</div>
						
						<label class="control-label bolder blue">Pemakaian Ban Yang Diijinkan</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-1 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu1" name="ban_sumbu1" placeholder="Sumbu ke-1" value="<?php echo $row->ban_sumbu1;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-2 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu2" name="ban_sumbu2" placeholder="Sumbu ke-2" value="<?php echo $row->ban_sumbu2;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-3 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu3" name="ban_sumbu3" placeholder="Sumbu ke-3" value="<?php echo $row->ban_sumbu3;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-4 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu4" name="ban_sumbu4" placeholder="Sumbu ke-4" value="<?php echo $row->ban_sumbu4;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> Konfigurasi Sumbu </label>
							<div class="col-sm-8">
								<input type="text" id="konf_sumbu" name="konf_sumbu" placeholder="Konfigurasi Sumbu" value="<?php echo $row->konf_sumbu;?>" class="col-xs-12"/>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-4">
						<label class="control-label bolder blue">Kemampuan kendaraan menurut pabrik</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu I </label>
							<div class="col-sm-8">
								<input type="text" id="kem_sumbu1" name="kem_sumbu1" placeholder="Sumbu I" value="<?php echo $row->kema_sumbu1;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu II </label>
							<div class="col-sm-8">
								<input type="text" id="kem_sumbu2" name="kem_sumbu2" placeholder="Sumbu II" value="<?php echo $row->kema_sumbu2;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu III </label>
							<div class="col-sm-8">
								<input type="text" id="kem_sumbu3" name="kem_sumbu3" placeholder="Sumbu III" value="<?php echo $row->kema_sumbu3;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu IV </label>
							<div class="col-sm-8">
								<input type="text" id="kem_sumbu4" name="kem_sumbu4" placeholder="Sumbu IV" value="<?php echo $row->kema_sumbu4;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="space space-8"></div>
					
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBB </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbb" name="jbb" placeholder="Jumlah Berat Diperbolehkan" value="<?php echo $row->jbb;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBKB </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbb_kombinasi" name="jbb_kombinasi" placeholder="Jumlah Berat Kombinasi Diperbolehkan" value="<?php echo $row->jbb_kombinasi;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<label class="control-label bolder blue">Berat Kosong</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu I </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu1" name="bk_sumbu1" placeholder="Berat Kosong Sumbu I" value="<?php echo $row->bk_sumbu1;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu II </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu2" name="bk_sumbu2" placeholder="Berat Kosong Sumbu II" value="<?php echo $row->bk_sumbu2;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu III </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu3" name="bk_sumbu3" placeholder="Berat Kosong Sumbu III" value="<?php echo $row->bk_sumbu3;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu IV </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu4" name="bk_sumbu4" placeholder="Berat Kosong Sumbu IV" value="<?php echo $row->bk_sumbu4;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Jumlah </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_total" name="bk_total" placeholder="Jumlah Berat Kosong" value="<?php echo $row->bk_total;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<label class="control-label bolder blue">Daya Angkut</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Orang </label>
							<div class="col-sm-4">
								<div class="input-group">
									<input type="text" id="da_orang" name="da_orang" placeholder="Daya Angkut" value="<?php echo $row->da_orang;?>" class="col-xs-12"/>
									<span class="input-group-addon">Orang</span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="input-group">
									<input type="text" id="jml_da_orang" name="jml_da_orang" placeholder="Berat Orang" value="<?php echo $row->jml_da_orang;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Barang </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="da_barang" name="da_barang" placeholder="Daya Angkut Barang" value="<?php echo $row->da_barang;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBI </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbi" name="jbi" placeholder="JBI" value="<?php echo $row->jbi;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBKI </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbi_kombinasi" name="jbi_kombinasi" placeholder="JBI Kombinasi" value="<?php echo $row->jbi_kombinasi;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> MST </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="mst" name="mst" placeholder="Muatan Sumbu Terberat" value="<?php echo $row->mst;?>" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> Kelas Jalan </label>
							<div class="col-sm-8">
								<input type="text" id="kelas_jalan" name="kelas_jalan" placeholder="Kelas Jalan Terendah" value="<?php echo $row->kelas_jalan;?>" class="col-xs-12"/>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
		
			<?php 
			}
		} ?>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit" onclick="return confirm('Anda yakin data kendaraan sudah benar?')">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Kirim
				</button>

				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('#dimensi_muatan').on('change',function(){
			if( $(this).val()==="Bak muatan"){
				$("#bak_muatan").show();
				$("#tangki").hide();
			} else if( $(this).val()==="Tangki"){
				$("#bak_muatan").hide();
				$("#tangki").show();
			} else {
				$("#bak_muatan").hide();
				$("#tangki").hide();
			}
		});
		
		$('#status_pemilik').on('change',function(){
			if( $(this).val()==="ganti_nama"){
				$("#nama").val("");
				$("#alamat").val("");
				$("#kecamatan").val("");
				$("#kota").val("");
				$("#telp").val("");
			}
		});
		
		$('input').keyup(function(e){
			var jml;
			var s1 = parseFloat($('#bk_sumbu1').val());
			var s2 = parseFloat($('#bk_sumbu2').val());
			var s3 = parseFloat($('#bk_sumbu3').val());
			var s4 = parseFloat($('#bk_sumbu4').val());
			var orang = parseFloat($('#jml_da_orang').val());
			var barang = parseFloat($('#da_barang').val());

			jml=s1+s2+s3+s4;
			jbi = jml+orang+barang;

			$('#bk_total').val(jml);
			$('#jbi').val(jbi);
			
			$(this).val($(this).val().toUpperCase());
		});
	});
</script>