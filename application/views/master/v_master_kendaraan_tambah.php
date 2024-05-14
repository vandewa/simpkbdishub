<div class="page-content">
	
	<div class="page-header">
		<h1>
			Tambah Data Kendaraan
		</h1>
	</div>
	<form class="form-horizontal" role="form" action="<?php echo site_url('master/proses_tambah_master_kendaraan')?>" method="post" id="validation-form">
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
							<input type="text" id="merek" name="merek" placeholder="Merek" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tipe </label>
						<div class="col-sm-8">
							<input type="text" id="tipe" name="tipe" placeholder="Tipe" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Jenis </label>
						<div class="col-sm-8">
							<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis kendaraan..." required>
								<option></option>
								<?php foreach($dt_jenis as $jns){ ?>
								<option value="<?php echo $jns->jenis;?>"><?php echo $jns->jenis;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
						<div class="col-sm-8">
							<select id="jenis_kendaraan" name="jenis_kendaraan" class="select2" data-placeholder="Pilih jenis kendaraan..." required>
								<option></option>
								<?php foreach($dt_jenis_kendaraan as $jnsken){ ?>
								<option value="<?php echo $jnsken->jenis_kendaraan;?>"><?php echo $jnsken->jenis_kendaraan;?></option>
								<?php } ?>
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
								<?php foreach($dt_jenis_bentuk as $jnsben){ ?>
								<option value="<?php echo $jnsben->jenis_kendaraan;?>"><?php echo $jnsben->jenis_kendaraan;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Isi Silinder </label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" id="isi_silinder" name="isi_silinder" placeholder="Isi Silinder" class="col-xs-12"/>
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
								<input type="text" id="daya_motor" name="daya_motor" placeholder="Daya Motor" class="col-xs-12" />
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
								<?php foreach($dt_bahanbakar as $bbm){ ?>
								<option value="<?php echo $bbm->bahan_bakar;?>"><?php echo $bbm->bahan_bakar;?></option>
								<?php } ?>
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
									<input type="text" id="uk_panjang" name="uk_panjang" placeholder="Panjang Ukuran Utama" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_lebar" name="uk_lebar" placeholder="Lebar Ukuran Utama" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_tinggi" name="uk_tinggi" placeholder="Tinggi Ukuran Utama" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Julur Belakang </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_roh" name="uk_roh" placeholder="Julur Belakang" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Julur Depan </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_foh" name="uk_foh" placeholder="Julur Depan" class="col-xs-12"/>
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
									<input type="text" id="js_sumbu1" name="js_sumbu1" placeholder="Jarak Sumbu I-II" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu II-III </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbu2" name="js_sumbu2" placeholder="Jarak Sumbu II-III" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu III-IV </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbu3" name="js_sumbu3" placeholder="Jarak Sumbu III-IV" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu IV-V </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbu4" name="js_sumbu4" placeholder="Jarak Sumbu IV-V" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu P </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbup" name="js_sumbup" placeholder="Jarak Sumbu P" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu Q </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbuq" name="js_sumbuq" placeholder="Jarak Sumbu Q" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu R </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbur" name="js_sumbur" placeholder="Jarak Sumbu R" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu B </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbub" name="js_sumbub" placeholder="Jarak Sumbu B" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<label class="control-label bolder blue">Rumah - rumah (karoseri)</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Karoseri </label>
							<div class="col-sm-8">
								<input type="text" id="karoseri" name="karoseri" placeholder="Karoseri" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Bahan Utama </label>
							<div class="col-sm-8">
								<input type="text" id="dbm_bahan_bak" name="dbm_bahan_bak" placeholder="Bahan Utama" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tempat Duduk </label>
							<div class="col-sm-8">
								<input type="text" id="tempat_duduk" name="tempat_duduk" placeholder="Banyak tempat duduk" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tempat Berdiri </label>
							<div class="col-sm-8">
								<input type="text" id="tempat_berdiri" name="tempat_berdiri" placeholder="Banyak tempat berdiri" class="col-xs-12"/>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-4">
						<label class="control-label bolder blue">Keistimewaan</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Nama Komersiil </label>
							<div class="col-sm-8">
								<input type="text" id="nama_komersiil" name="nama_komersiil" placeholder="Nama Komersiil" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label bolder blue no-padding-left">Dimensi Muatan</label>
							<div class="col-sm-8">
								<select class="form-control" id="dimensi_muatan" name="dimensi_muatan" data-placeholder="Pilih kategori kendaraan">
									<option value="" selected>Pilih dimensi muatan</option>
									<option value="Bak muatan">Bak Muatan</option>
									<option value="Tangki">Tangki</option>
									<option value="Penumpang">Penumpang</option>
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
										<option value="">Pilih jenis bak muatan</option>
										<option value=""></option>
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
										<input type="text" id="dbm_panjang" name="dbm_panjang" placeholder="Panjang Dimensi Bak Muatan" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dbm_lebar" name="dbm_lebar" placeholder="Lebar Dimensi Bak Muatan" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dbm_tinggi" name="dbm_tinggi" placeholder="Tinggi Dimensi Bak Muatan" class="col-xs-12"/>
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
										<input type="text" id="dt_panjang" name="dt_panjang" placeholder="Panjang Dimensi Tangki" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_lebar" name="dt_lebar" placeholder="Lebar Dimensi Tangki" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_tinggi" name="dt_tinggi" placeholder="Tinggi Dimensi Tangki" class="col-xs-12"/>
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Volume </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_volume" name="dt_volume" placeholder="Volume Dimensi Tangki" class="col-xs-12"/>
										<span class="input-group-addon">ltr</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Jenis Muatan </label>
								<div class="col-sm-8">
									<input type="text" id="dt_jenis_muatan" name="dt_jenis_muatan" placeholder="Jenis Muatan" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Berat Jenis Muatan </label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="dt_berat_jenis_muatan" name="dt_berat_jenis_muatan" placeholder="Berat Jenis Muatan" class="col-xs-12"/>
										<span class="input-group-addon">kg/dm<sup>3</sup></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Bahan Tangki </label>
								<div class="col-sm-8">
									<input type="text" id="dt_bahan_tangki" name="dt_bahan_tangki" placeholder="Bahan Tangki" class="col-xs-12"/>
								</div>
							</div>
						</div>
						
						<label class="control-label bolder blue">Pemakaian Ban Yang Diijinkan</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-1 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu1" name="ban_sumbu1" placeholder="Sumbu ke-1" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-2 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu2" name="ban_sumbu2" placeholder="Sumbu ke-2" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-3 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu3" name="ban_sumbu3" placeholder="Sumbu ke-3" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-4 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu4" name="ban_sumbu4" placeholder="Sumbu ke-4" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> Konfigurasi Sumbu </label>
							<div class="col-sm-8">
								<input type="text" id="konf_sumbu" name="konf_sumbu" placeholder="Konfigurasi Sumbu" class="col-xs-12"/>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-4">
						<label class="control-label bolder blue">Kemampuan kendaraan menurut pabrik</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu I </label>
							<div class="col-sm-8">
								<input type="text" id="kem_sumbu1" name="kem_sumbu1" placeholder="Sumbu I" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu II </label>
							<div class="col-sm-8">
								<input type="text" id="kem_sumbu2" name="kem_sumbu2" placeholder="Sumbu II" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu III </label>
							<div class="col-sm-8">
								<input type="text" id="kem_sumbu3" name="kem_sumbu3" placeholder="Sumbu III" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu IV </label>
							<div class="col-sm-8">
								<input type="text" id="kem_sumbu4" name="kem_sumbu4" placeholder="Sumbu IV" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="space space-8"></div>
					
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBB </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbb" name="jbb" placeholder="Jumlah Berat Diperbolehkan" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBKB </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbb_kombinasi" name="jbb_kombinasi" placeholder="Jumlah Berat Kombinasi Diperbolehkan" class="col-xs-12"/>
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
									<input type="text" id="bk_sumbu1" name="bk_sumbu1" placeholder="Berat Kosong Sumbu I" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu II </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu2" name="bk_sumbu2" placeholder="Berat Kosong Sumbu II" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu III </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu3" name="bk_sumbu3" placeholder="Berat Kosong Sumbu III" value="0" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu IV </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu4" name="bk_sumbu4" placeholder="Berat Kosong Sumbu IV" value="0" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Jumlah </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_total" name="bk_total" placeholder="Jumlah Berat Kosong" class="col-xs-12"/>
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
									<input type="text" id="da_orang" name="da_orang" placeholder="Daya Angkut" class="col-xs-12"/>
									<span class="input-group-addon">Orang</span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="input-group">
									<input type="text" id="jml_da_orang" name="jml_da_orang" placeholder="Berat Orang" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Barang </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="da_barang" name="da_barang" placeholder="Daya Angkut Barang" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBI </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbi" name="jbi" placeholder="JBI" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBKI </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbi_kombinasi" name="jbi_kombinasi" placeholder="JBI Kombinasi" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> MST </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="mst" name="mst" placeholder="Muatan Sumbu Terberat" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> Kelas Jalan </label>
							<div class="col-sm-8">
								<input type="text" id="kelas_jalan" name="kelas_jalan" placeholder="Kelas Jalan Terendah" class="col-xs-12"/>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit">
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