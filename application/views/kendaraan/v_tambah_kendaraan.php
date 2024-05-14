<div class="page-content">
	
	<div class="page-header">
		<h1>
			Tambah Data Kendaraan
		</h1>
	</div>
	<form class="form-horizontal" role="form" action="<?php echo site_url('kendaraan/tambah_kendaraan')?>" method="post" id="validation-form">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="header smaller lighter blue">
					Pemilik Kendaraan
				</h3>
				
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<input type="hidden" id="id_user" name="id_user" value="USR-<?php echo $now;?>" class="col-xs-12"/>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Nomor KTP </label>
							<div class="col-sm-8">
								<input type="text" id="no_ktp" name="no_ktp" placeholder="Nomor KTP" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Nama Pemilik </label>
							<div class="col-sm-8">
								<input type="text" id="nama" name="nama" placeholder="Nama Pemilik" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tgl Terbit STNK</label>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="form-control date-picker" id="tgl_stnk" name="tgl_stnk" type="text" data-date-format="yyyy-mm-dd" />
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6">
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Alamat </label>
							<div class="col-sm-8">
								<textarea class="form-control limited" id="alamat" name="alamat" placeholder="Alamat" maxlength="30"></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Kecamatan </label>
							<div class="col-sm-8">
								<input type="text" id="kecamatan" name="kecamatan" placeholder="Kecamatan" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Kota </label>
							<div class="col-sm-8">
								<input type="text" id="kota" name="kota" placeholder="Kota" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left">Nomor Telepon</label>
							<div class="col-sm-8">
								<input type="text" id="telp" name="telp" placeholder="Nomor telepon ex. 628xxxx" class="col-xs-12"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="header smaller lighter blue">
					Identitas Kendaraan
				</h3>	
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Pemakaian Pertama</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_pemakaian_pertama" name="tgl_pemakaian_pertama" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tempat Uji Pertama </label>
						<div class="col-sm-8">
							<input type="text" id="tempat_pemakaian_pertama" name="tempat_pemakaian_pertama" placeholder="Tempat Pemakaian Pertama" class="col-xs-12"/>
						</div>
					</div>
				
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nomor Uji </label>
						<div class="col-sm-8">
							<input type="text" id="no_uji" name="no_uji" placeholder="Nomor Uji" class="col-xs-12" >
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan </label>
						<div class="col-sm-8">
							<input type="text" id="no_kendaraan" name="no_kendaraan" placeholder="Nomor Kendaraan" class="col-xs-12"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tgl Terbit STNK</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_terbit_stnk" name="tgl_terbit_stnk" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Jenis </label>
						<div class="col-sm-8">
							<input type="text" id="jenis_kendaraan" name="jenis_kendaraan" placeholder="Jenis" class="col-xs-12" />
						</div>
					</div>
					
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
						<label class="col-sm-4 control-label no-padding-left"> Jenis JBB</label>
						<div class="col-sm-8">
							<select class="form-control" id="jenis_jbb" name="jenis_jbb" data-placeholder="Pilih jenis jbb">
								<option value=""></option>
								<option value="jbbpnm">JBB Penumpang</option>
								<option value="jbb0kg">JBB s/d 4000kg</option>
								<option value="jbb4kg">JBB 4001kg s/d 8000kg</option>
								<option value="jbb8kg">JBB 8001kg s/d 14000kg</option>
								<option value="jbb14kg">JBB diatas 14000kg</option>
								<option value="GN">Kereta Gandeng</option>
								<option value="TP">Kereta Tempelan</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Kategori Kendaraan</label>
						<div class="col-sm-8">
							<select class="form-control" id="kategori_kendaraan" name="kategori_kendaraan" data-placeholder="Pilih kategori kendaraan">
								<option value=""></option>
								<option value="Mobil Penumpang Taxi">Mobil Penumpang Taxi</option>
								<option value="Mobil Mini Bus">Mobil Mini Bus</option>
								<option value="Mobil Micro Bus">Mobil Micro Bus</option>
								<option value="Mobil Bus Sedang">Mobil Bus Sedang</option>
								<option value="Mobil Bus">Mobil Bus</option>
								<option value="Mobil Barang Pick Up">Mobil Barang Pick Up</option>
								<option value="Mobil Barang Truck">Mobil Barang Truck</option>
								<option value="Kereta Gandeng">Kereta Gandeng</option>
								<option value="Kereta Tempelan">Kereta Tempelan</option>
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
				</div>
				
				<div class="col-xs-12 col-sm-6">
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
							<input type="text" id="bahan_bakar" name="bahan_bakar" placeholder="Bahan Bakar" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tahun Pembuatan </label>
						<div class="col-sm-8">
							<input type="text" id="tahun" name="tahun" placeholder="Tahun Pembuatan" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Status Penggunaan </label>
						<div class="col-sm-8">
							<select class="form-control" id="status" name="status" data-placeholder="Pilih status penggunaan">
								<option value=""></option>
								<option value="Umum">Umum</option>
								<option value="Tidak Umum">Tidak Umum</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nomor Rangka </label>
						<div class="col-sm-8">
							<input type="text" id="no_rangka" name="no_rangka" placeholder="Nomor Rangka Landasan" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nomor Mesin </label>
						<div class="col-sm-8">
							<input type="text" id="no_mesin" name="no_mesin" placeholder="Nomor Mesin" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> No Sertifikasi Uji</label>
						<div class="col-sm-8">
							<input type="text" id="no_sertifikasi_uji" name="no_sertifikasi_uji" placeholder="No Sertifikasi Uji Tipe" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tgl Sertifikasi Uji</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_sertifikasi_uji" name="tgl_sertifikasi_uji" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> No Registrasi Uji</label>
						<div class="col-sm-8">
							<input type="text" id="no_registrasi_uji" name="no_registrasi_uji" placeholder="No Registrasi Uji Tipe" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tgl Registrasi Uji</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_registrasi_uji" name="tgl_registrasi_uji" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Penerbit SRUT</label>
						<div class="col-sm-8">
							<input type="text" id="penerbit_sertifikasi_uji" name="penerbit_sertifikasi_uji" placeholder="Penerbit Sertifikasi Uji Tipe" class="col-xs-12" />
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
									<input type="text" id="uk_julur_belakang" name="uk_julur_belakang" placeholder="Julur Belakang" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Julur Depan </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="uk_julur_depan" name="uk_julur_depan" placeholder="Julur Depan" class="col-xs-12"/>
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
							<label class="col-sm-4 control-label no-padding-left"> Sumbu Q </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="js_sumbuq" name="js_sumbuq" placeholder="Jarak Sumbu Q" class="col-xs-12"/>
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
						
						<!--
						
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
						
						-->
						
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
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Warna </label>
							<div class="col-sm-8">
								<input type="text" id="warna" name="warna" placeholder="Warna" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Jarak Terendah </label>
							<div class="col-sm-8">
								<input type="text" id="jarak_terendah" name="jarak_terendah" placeholder="Jarak Terendah" class="col-xs-12"/>
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
						<label class="control-label bolder blue">Jumlah Berat</label>
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
									<input type="text" id="muatan_sum_berat" name="muatan_sum_berat" placeholder="Muatan Sumbu Terberat" class="col-xs-12"/>
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> Kelas Jalan </label>
							<div class="col-sm-8">
								<input type="text" id="kelas_jl_min" name="kelas_jl_min" placeholder="Kelas Jalan Terendah" class="col-xs-12"/>
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

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
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
		
		$('input').change(function(e){
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
		});
		
		$("#tipe").keyup(function(){
			if($("#tipe").val().length>2){
				var tipe = $("#tipe").val();
				var jenis = $("#jenis_kendaraan").val();
				
				var post_data = {
				   'tipe': tipe,'jenis': jenis,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('kendaraan/get_tipe_kendaraan'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						if(obj == ""){
							
						} else {
							$("#jenis_kendaraan").val(obj[0].jenis);
							$("#jenis_jbb").val(obj[0].jenis_jbb);
							$("#kategori_kendaraan").val(obj[0].kategori);
							$("#isi_silinder").val(obj[0].isi_silinder);
							$("#daya_motor").val(obj[0].daya_motor);
							$("#bahan_bakar").val(obj[0].bahan_bakar);
							$("#nama_komersiil").val(obj[0].nama_komersiil);
							$("#uk_panjang").val(obj[0].uk_panjang);
							$("#uk_lebar").val(obj[0].uk_lebar);
							$("#uk_tinggi").val(obj[0].uk_tinggi);
							$("#uk_julur_belakang").val(obj[0].uk_julur_belakang);
							$("#uk_julur_depan").val(obj[0].uk_julur_depan);
							$("#js_sumbu1").val(obj[0].js_sumbu1);
							$("#js_sumbu2").val(obj[0].js_sumbu2);
							$("#js_sumbup").val(obj[0].js_sumbup);
							$("#js_sumbuq").val(obj[0].js_sumbuq);
							$("#dimensi_muatan").val(obj[0].dimensi_muatan);
							$("#dbm_panjang").val(obj[0].dbm_panjang);
							$("#dbm_lebar").val(obj[0].dbm_lebar);
							$("#dbm_tinggi").val(obj[0].dbm_tinggi);
							$("#karoseri").val(obj[0].karoseri);
							$("#dbm_bahan_bak").val(obj[0].dbm_bahan_bak);
							$("#tempat_duduk").val(obj[0].tempat_duduk);
							$("#ban_sumbu1").val(obj[0].ban_sumbu1);
							$("#ban_sumbu2").val(obj[0].ban_sumbu2);
							$("#ban_sumbu3").val(obj[0].ban_sumbu3);
							$("#konf_sumbu").val(obj[0].konf_sumbu);
							$("#jbb").val(obj[0].jbb);
							$("#bk_sumbu1").val(obj[0].bk_sumbu1);
							$("#bk_sumbu2").val(obj[0].bk_sumbu2);
							$("#bk_sumbu3").val(obj[0].bk_sumbu3);
							$("#bk_total").val(obj[0].bk_total);
							$("#da_orang").val(obj[0].da_orang);
							$("#jml_da_orang").val(obj[0].jml_da_orang);
							$("#da_barang").val(obj[0].da_barang);
							$("#jbi").val(obj[0].jbi);
							$("#muatan_sum_berat").val(obj[0].muatan_sum_berat);
							$("#kelas_jl_min").val(obj[0].kelas_jl_min);
						}
					}
				});
			}
			return false;
		});
	});
</script>