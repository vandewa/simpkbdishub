<?php echo $this->session->flashdata('sukses');?>
<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Edit Kendaraan
				</h1>
			</div>
			<?php if($this->session->userdata('id_akses') == '1'){ ?>
			<div class="col-xs-12 col-sm-4" align="right">
				<a href="<?php echo site_url('kendaraan/prosesmutasi/'.$nouji)?>" onclick="return confirm('Anda yakin akan memutasi kendaran ini?')">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-lock bigger-120 blue"></i>
						Mutasikan Kendaraan
					</button>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
	<form class="form-horizontal" role="form" action="<?php echo site_url('kendaraan/edit_kendaraan')?>" method="post">
		<?php 
		if(isset($dt_kendaraan)){
			foreach($dt_kendaraan as $row){
			?>
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="header smaller lighter blue">
					Pemilik Kendaraan
				</h3>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<input type="hidden" id="id_user" name="id_user" value="<?php echo $row->id_user;?>"/>
						
						<div class="form-group">
							<label class="col-sm-4 control-label bolder blue no-padding-left">Status Pemilik</label>
							<div class="col-sm-8">
								<select class="form-control" id="status_pemilik" name="status_pemilik" placeholder="Pilih status pemilik">
									<option value="tetap" selected>Tetap</option>
									<option value="ganti_nama">Ganti Nama</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tgl Terbit STNK</label>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="form-control date-picker" id="tgl_stnk" name="tgl_stnk" type="text" value="<?php echo $row->tgl_stnk;?>" data-date-format="yyyy-mm-dd" />
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
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
								<input type="text" id="nama" name="nama" placeholder="Nama Pemilik" value="<?php echo $row->nama;?>" class="col-xs-12"/>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6">
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Alamat </label>
							<div class="col-sm-8">
								<textarea class="form-control limited" id="alamat" name="alamat" placeholder="Alamat" maxlength="50"><?php echo $row->alamat;?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Kecamatan </label>
							<div class="col-sm-8">
								<select id="kecamatan" name="kecamatan" class="select2" data-placeholder="Pilih kecamatan...">
									<option value="">-</option>
									<option value="<?php echo $row->kecamatan;?>" selected><?php echo $row->kecamatan;?></option>
									<?php foreach($dt_kecamatan as $kec){ ?>
									<option value="<?php echo $kec->kecamatan;?>"><?php echo $kec->kecamatan;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Kota </label>
							<div class="col-sm-8">
								<input type="text" id="kota" name="kota" placeholder="Kota" value="<?php echo $row->kota;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left">Nomor Telepon</label>
							<div class="col-sm-8">
								<input type="text" id="telp" name="telp" placeholder="Nomor telepon ex. 628xxxx" value="<?php echo $row->telp;?>" class="col-xs-12"/>
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
						<label class="col-sm-4 control-label no-padding-left bolder blue">Import Data Kendaraan</label>
						<div class="col-sm-8">
							<select class="form-control" id="import_data" name="import_data">
								<option value="tidak" selected>Tidak</option>
								<option value="import">Import</option>
							</select>
						</div>
					</div>
				
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Uji </label>
						<div class="col-sm-8">
							<input type="text" id="no_uji" name="no_uji" placeholder="Nomor Uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Kendaraan </label>
						<div class="col-sm-8">
							<input type="text" id="no_kendaraan" name="no_kendaraan" placeholder="Nomor Kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Pemakaian Pertama</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_pemakaian_pertama" name="tgl_pemakaian_pertama" type="text" value="<?php echo $row->tgl_pemakaian_pertama;?>" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tempat Uji Pertama </label>
						<div class="col-sm-8">
							<input type="text" id="tempat_pemakaian_pertama" name="tempat_pemakaian_pertama" placeholder="Tempat Uji Pertama" value="<?php echo $row->tempat_pemakaian_pertama;?>" class="col-xs-12"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Jenis </label>
						<div class="col-sm-8">
							<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis kendaraan..." required >
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
						<label class="col-sm-4 control-label no-padding-left"> Bentuk Kendaraan </label>
						<div class="col-sm-8">
							<select id="bentuk" name="bentuk" class="select2" data-placeholder="Pilih bentuk kendaraan..." required >
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
				</div>
				
				<div class="col-xs-12 col-sm-6">					
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
						<label class="col-sm-4 control-label no-padding-left"> Tahun Pembuatan </label>
						<div class="col-sm-8">
							<input type="text" id="tahun" name="tahun" placeholder="Tahun Pembuatan" value="<?php echo $row->tahun;?>" class="col-xs-12" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Status Penggunaan </label>
						<div class="col-sm-8">
							<select class="select2" id="sifat" name="sifat" data-placeholder="Pilih status penggunaan">
								<option value="<?php echo $row->sifat;?>" selected><?php echo $row->sifat;?></option>
								<option value=""></option>
								<option value="UMUM">UMUM</option>
								<option value="TIDAK UMUM">TIDAK UMUM</option>
								<option value="DINAS">DINAS</option>
							</select>
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
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="header smaller lighter blue">
					Sertifikat Uji Tipe dan Registrasi
				</h3>
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-left">Uji Tipe</label>
						<div class="col-sm-4">
							<input type="text" id="no_ut" name="no_ut" placeholder="No Uji Tipe" value="<?php echo $row->no_ut;?>" class="col-xs-12" />
						</div>

						<div class="col-sm-2">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_ut" name="tgl_ut" type="text" value="<?php echo $row->tgl_ut;?>" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>

						<div class="col-sm-4">
							<input type="text" id="penerbit_ut" name="penerbit_ut" placeholder="Penerbit Uji Tipe" value="<?php echo $row->penerbit_ut;?>" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-left">Rancang Bangun</label>
						<div class="col-sm-4">
							<input type="text" id="no_rb" name="no_rb" placeholder="No Rancang Bangun" value="<?php echo $row->no_rb;?>" class="col-xs-12" />
						</div>

						<div class="col-sm-2">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_rb" name="tgl_rb" type="text" value="<?php echo $row->tgl_rb;?>" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>

						<div class="col-sm-4">
							<input type="text" id="penerbit_rb" name="penerbit_rb" placeholder="Penerbit Rancang Bangun" value="<?php echo $row->penerbit_rb;?>" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-left">Registrasi Uji Tipe</label>
						<div class="col-sm-4">
							<input type="text" id="no_sertifikasi_uji" name="no_sertifikasi_uji" placeholder="No Sertifikasi Uji Tipe" value="<?php echo $row->no_sertifikasi_uji;?>" class="col-xs-12" required />
						</div>

						<div class="col-sm-2">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_sertifikasi_uji" name="tgl_sertifikasi_uji" type="text" value="<?php echo $row->tgl_sertifikasi_uji;?>" data-date-format="yyyy-mm-dd" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>

						<div class="col-sm-4">
							<input type="text" id="penerbit_sertifikasi_uji" name="penerbit_sertifikasi_uji" placeholder="Penerbit Registrasi Uji Tipe" value="<?php echo $row->penerbit_sertifikasi_uji;?>" class="col-xs-12" required />
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
									<input type="text" id="js_sumbu1" name="js_sumbu1" placeholder="Jarak Sumbu I-II" value="<?php echo $row->js_sumbu1;?>" class="col-xs-12" required />
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
									<input type="text" id="js_sumbuq" name="js_sumbuq" placeholder="Jarak Sumbu Q" value="<?php echo $row->js_sumbuq;?>" class="col-xs-12" required />
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
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Warna </label>
							<div class="col-sm-8">
								<input type="text" id="warna" name="warna" placeholder="Warna" value="<?php echo $row->warna;?>" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Jarak Terendah </label>
							<div class="col-sm-8">
								<input type="text" id="jarak_terendah" name="jarak_terendah" placeholder="Jarak Terendah" value="<?php echo $row->jarak_terendah;?>" class="col-xs-12"/>
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
										<option value="">Pilih jenis bak muatan</option>
										<option value="<?php echo $row->dbm_jenis;?>" selected><?php echo $row->dbm_jenis;?></option>
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
								<input type="text" id="ban_sumbu1" name="ban_sumbu1" placeholder="Sumbu ke-1" value="<?php echo $row->ban_sumbu1;?>" class="col-xs-12" required />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu ke-2 </label>
							<div class="col-sm-8">
								<input type="text" id="ban_sumbu2" name="ban_sumbu2" placeholder="Sumbu ke-2" value="<?php echo $row->ban_sumbu2;?>" class="col-xs-12" required />
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
						
						<label class="control-label bolder blue">Jumlah Berat yang diperoleh</label>
						<div class="space space-8"></div>
					
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue"> JBB </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="jbb" name="jbb" placeholder="Jumlah Berat Diperbolehkan" value="<?php echo $row->jbb;?>" class="col-xs-12" required />
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
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left bolder blue">Hitung MST</label>
							<div class="col-sm-8">
								<select class="form-control" id="hitung_mst" name="hitung_mst">
									<option value="tidak" selected>TIDAK</option>
									<option value="r1">PICK UP/TRUCK</option>
									<option value="r2">PICK UP/TRUCK DENGAN P</option>
									<option value="r3">TRONTON</option>
									<option value="r4">BUS</option>
									<option value="r5">CARI BARANG</option>
								</select>
							</div>
						</div>
						
						
						<label class="control-label bolder blue">Berat Kosong</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu I </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu1" name="bk_sumbu1" placeholder="Berat Kosong Sumbu I" value="<?php echo $row->bk_sumbu1;?>" class="col-xs-12" required />
									<span class="input-group-addon">kg</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Sumbu II </label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="bk_sumbu2" name="bk_sumbu2" placeholder="Berat Kosong Sumbu II" value="<?php echo $row->bk_sumbu2;?>" class="col-xs-12" required />
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
									<input type="text" id="da_orang" name="da_orang" placeholder="Daya Angkut" value="<?php echo $row->da_orang;?>" class="col-xs-12" required />
									<span class="input-group-addon">Orang</span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="input-group">
									<input type="text" id="jml_da_orang" name="jml_da_orang" placeholder="Berat Orang" value="<?php echo $row->jml_da_orang;?>" class="col-xs-12" required />
									<span class="input-group-addon">kg</span>
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
								<input type="text" id="kelas_jalan" name="kelas_jalan" placeholder="Kelas Jalan Terendah" value="<?php echo $row->kelas_jalan;?>" class="col-xs-12" required />
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
<?php 
if(isset($dt_kendaraan)){
	foreach($dt_kendaraan as $row){
	?>
	<div id="editnomoruji" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Edit Nomor Uji</h4>
				</div>
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('kendaraan/editnomoruji/'.$row->no_uji);?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								
								<div class="form-group">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									
									<label class="col-sm-3 control-label no-padding-left"> Nomor Uji Lama</label>
									<div class="col-sm-7">
										<input type="text" id="no_uji_lama" name="no_uji_lama" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Nomor Uji Baru </label>
									<div class="col-sm-7">
										<input type="text" id="no_uji_baru" name="no_uji_baru" class="col-xs-12"/>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button class="btn btn-sm" data-dismiss="modal">
							<i class="ace-icon fa fa-times"></i>
							Batal
						</button>

						<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin akan mengubah nomor uji?')">
							<i class="ace-icon fa fa-check"></i>
							Kirim
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php }} ?>

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
			var jbb = parseFloat($('#jbb').val());

			jml=s1+s2+s3+s4;
			jbi = jml+orang+barang;

			$('#bk_total').val(jml);
			$('#jbi').val(jbi);
			
			$(this).val($(this).val().toUpperCase());
			
			if(jbi>jbb){
				alert("JBI kendaraan tidak boleh melebihi JBB. Cek daya angkut muatan.");
				$('#da_barang').autofocus
			}
		});
		
		$('#import_data').on('change',function(){
			if( $(this).val()==="import"){
				$("#tipe").keyup(function(){
					if($("#tipe").val().length>2){
						var tipe = $("#tipe").val();
						var bentuk = $("#bentuk").val();
						
						var post_data = {
						   'tipe': tipe,'bentuk': bentuk,
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
									$("#jenis").val(obj[0].jenis).trigger('change');
									$("#jenis_kendaraan").val(obj[0].jenis_kendaraan).trigger('change');
									$("#bentuk").val(obj[0].bentuk).trigger('change');
									$("#isi_silinder").val(obj[0].isi_silinder);
									$("#daya_motor").val(obj[0].daya_motor);
									$("#bahan_bakar").val(obj[0].bahan_bakar).trigger('change');
									$("#nama_komersiil").val(obj[0].nama_komersiil);
									$("#uk_panjang").val(obj[0].uk_panjang);
									$("#uk_lebar").val(obj[0].uk_lebar);
									$("#uk_tinggi").val(obj[0].uk_tinggi);
									$("#uk_roh").val(obj[0].uk_roh);
									$("#uk_foh").val(obj[0].uk_foh);
									$("#js_sumbu1").val(obj[0].js_sumbu1);
									$("#js_sumbu2").val(obj[0].js_sumbu2);
									$("#js_sumbu3").val(obj[0].js_sumbu3);
									$("#js_sumbu4").val(obj[0].js_sumbu4);
									$("#js_sumbup").val(obj[0].js_sumbup);
									$("#js_sumbuq").val(obj[0].js_sumbuq);
									$("#js_sumbur").val(obj[0].js_sumbur);
									$("#js_sumbub").val(obj[0].js_sumbub);
									$("#kema_sumbu1").val(obj[0].kema_sumbu1);
									$("#kema_sumbu2").val(obj[0].kema_sumbu2);
									$("#kema_sumbu3").val(obj[0].kema_sumbu3);
									$("#kema_sumbu4").val(obj[0].kema_sumbu4);
									$("#dimensi_muatan").val(obj[0].dimensi_muatan);
									$("#dbm_panjang").val(obj[0].dbm_panjang);
									$("#dbm_lebar").val(obj[0].dbm_lebar);
									$("#dbm_tinggi").val(obj[0].dbm_tinggi);
									$("#dbm_jenis").val(obj[0].dbm_jenis);
									$("#karoseri").val(obj[0].karoseri);
									$("#dbm_bahan_bak").val(obj[0].dbm_bahan_bak);
									$("#tempat_duduk").val(obj[0].tempat_duduk);
									$("#ban_sumbu1").val(obj[0].ban_sumbu1);
									$("#ban_sumbu2").val(obj[0].ban_sumbu2);
									$("#ban_sumbu3").val(obj[0].ban_sumbu3);
									$("#ban_sumbu4").val(obj[0].ban_sumbu4);
									$("#konf_sumbu").val(obj[0].konf_sumbu);
									$("#jbb").val(obj[0].jbb);
									$("#jbb_kombinasi").val(obj[0].jbb_kombinasi);
									$("#bk_sumbu1").val(obj[0].bk_sumbu1);
									$("#bk_sumbu2").val(obj[0].bk_sumbu2);
									$("#bk_sumbu3").val(obj[0].bk_sumbu3);
									$("#bk_sumbu4").val(obj[0].bk_sumbu4);
									$("#bk_total").val(obj[0].bk_total);
									$("#da_orang").val(obj[0].da_orang);
									$("#jml_da_orang").val(obj[0].jml_da_orang);
									$("#da_barang").val(obj[0].da_barang);
									$("#jbi").val(obj[0].jbi);
									$("#jbi_kombinasi").val(obj[0].jbi_kombinasi);
									$("#mst").val(obj[0].mst);
									$("#kelas_jalan").val(obj[0].kelas_jalan);
								}
							}
						});
					}
					return false;
				});
			}
		});
		
		$('#hitung_mst').on('change',function(){
			$('input').off();
			if( $(this).val()==="r1"){
				$('input').keyup(function(){ 
					var a = parseFloat($('#js_sumbu1').val());
					var q = parseFloat($('#js_sumbuq').val());
					var s2 = parseFloat($('#bk_sumbu2').val());
					var lb = parseFloat($('#da_barang').val());
					var mst;
					mst = s2+(lb*q/a);
					$('#mst').val(mst);
				});
			} else if( $(this).val()==="r2"){
				$('input').keyup(function(){ 
					var a = parseFloat($('#js_sumbu1').val());
					var q = parseFloat($('#js_sumbuq').val());
					var p = parseFloat($('#js_sumbup').val());
					var s2 = parseFloat($('#bk_sumbu2').val());
					var lb = parseFloat($('#da_barang').val());
					var g = parseFloat($('#jml_da_orang').val());
					var mst;
					mst = s2+(lb*q/a)+(g*p/a);
					$('#mst').val(mst);
				});

			} else if( $(this).val()==="r3"){
				$('input').keyup(function(){ 
					var a1 = parseFloat($('#js_sumbu1').val());
					var a2 = parseFloat($('#js_sumbu2').val());
					var q = parseFloat($('#js_sumbuq').val());
					var s2 = parseFloat($('#bk_sumbu2').val());
					var lb = parseFloat($('#da_barang').val());
					var a;
					var mst;
					a = a1+0.5*a2;
					mst = s2+(lb*q/(2*a));
					$('#mst').val(mst);
				});
			} else if( $(this).val()==="r4"){
				$('input').keyup(function(){ 
					var a = parseFloat($('#js_sumbu1').val());
					var q = parseFloat($('#js_sumbuq').val());
					var s2 = parseFloat($('#bk_sumbu2').val());
					var da = parseFloat($('#da_orang').val());
					var jda = parseFloat($('#jml_da_orang').val());
					var lb;
					var mst;
					lb = (da-1)*10;
					mst = s2+(lb*q/a);
					$('#mst').val(mst);
					$('#da_barang').val(lb);
				});
			} else if( $(this).val()==="r5"){
				$('input').keyup(function(){ 
					var mst = parseFloat($('#mst').val());
					var a = parseFloat($('#js_sumbu1').val());
					var q = parseFloat($('#js_sumbuq').val());
					var s2 = parseFloat($('#bk_sumbu2').val());
					var lb;
					lb = (mst-s2)*(a/q);
					$('#da_barang').val(lb);
				});
			} else if( $(this).val()==="tidak"){
				$('input').off();
			}
		});
	});
</script>