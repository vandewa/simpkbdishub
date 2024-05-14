<div class="page-content">
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Pendaftaran Pengujian Kendaraan Bermotor
				</h1>
			</div>
			
			<div class="col-xs-12 col-sm-4" align="right">
				<form action="<?php echo site_url('pendaftaran/ujiberkala')?>" method="post">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="ace-icon fa fa-search blue"></i>
						</span>
						
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..."/>
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
	</div>
	<?php 
	if(!empty($cari_pengujian)){
		foreach($cari_pengujian as $row){
			if($row->blokir=='1'){
				$tgl = unix_to_human($kode_uji);
				$tgl_skg = date("Y-m-d", strtotime($tgl));
				$tgl_daftar = $row->tgl_daftar_uji;
				$selisih = $row->selisih;
		?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('pendaftaran/daftar_uji_berkala')?>" method="post">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<?php $kode_admin = mb_substr($this->session->userdata('nama'),0,2); ?>
				<?php $kode_add = mb_substr($this->session->userdata('id_user'),-3); ?>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kode Uji </label>
					<div class="col-sm-8">
						<input type="text" id="kode_uji" name="kode_uji" value="<?php echo $kode_uji; echo $kode_admin;?>" class="col-xs-12"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Pemeriksaan </label>
					<div class="col-sm-8">
						<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label bolder blue no-padding-left">Status Pemohon</label>
					<div class="col-sm-8">
						<select class="form-control" id="status_pemohon" name="status_pemohon" placeholder="Pilih status pemohon">
							<option value="pemilik" selected>Pemilik Kendaraan</option>
							<option value="dikuasakan">Dikuasakan</option>
						</select>
					</div>
				</div>
				
				<div id="pemilik">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nama Pemilik</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Nama Pemilik" id="nama_pemilik" name="nama_pemilik" class="col-xs-12" value="<?php echo $row->nama;?>" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Alamat Pemilik </label>
						<div class="col-sm-8">
							<textarea class="autosize-transition form-control" id="alamat_pemilik" name="alamat_pemilik" placeholder="Alamat Pemilik"><?php echo $row->alamat;?> <?php echo $row->kecamatan;?></textarea>
						</div>
					</div>
				</div>
				
				<div id="dikuasakan" style="display: none;">
					<!--
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nomor KTP Pemohon </label>
						<div class="col-sm-8">
							<input type="text" id="no_ktp_pemohon" name="no_ktp_pemohon" placeholder="Nomor KTP Pemohon" class="col-xs-12" />
						</div>
					</div>
					-->
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nama Pemohon</label>
						<div class="col-sm-8">
							<input type="text" id="nama_pemohon" name="nama_pemohon" placeholder="Nama Pemohon" class="col-xs-12" autofocus />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Alamat Pemohon </label>
						<div class="col-sm-8">
							<textarea id="alamat_pemohon" name="alamat_pemohon" class="autosize-transition form-control" placeholder="Alamat Pemohon"></textarea>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Nomor Telepon</label>
					<div class="col-sm-8">
						<input type="text" id="no_telp" name="no_telp" value="<?php echo $row->telp;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label bolder blue no-padding-left">Status Pemilik</label>
					<div class="col-sm-8">
						<select class="form-control" id="status_pemilik" name="status_pemilik" placeholder="Pilih status pemilik">
							<option value="tetap" selected>Tetap</option>
							<option value="ganti_nama">Ganti Nama</option>
						</select>
					</div>
				</div>
				
				<div id="ganti_nama" style="display: none;">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tanggal STNK </label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_stnk" name="tgl_stnk" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nama Pemilik Baru</label>
						<div class="col-sm-8">
							<input type="text" id="nama" name="nama" placeholder="Nama Pemilik Kendaraan" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Alamat Pemilik </label>
						<div class="col-sm-8">
							<textarea class="form-control limited" id="alamat" name="alamat" placeholder="Alamat" maxlength="30"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Kecamatan</label>
						<div class="col-sm-8">
							<input type="text" id="kecamatan" name="kecamatan" placeholder="kecamatan" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Kota</label>
						<div class="col-sm-8">
							<input type="text" id="kota" name="kota" placeholder="Kota" class="col-xs-12" />
						</div>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Pendaftaran Untuk </label>
					<div class="col-sm-8">
						<select class="form-control" id="jenis_uji" name="jenis_uji" data-placeholder="Pilih jenis pendaftaran">
							<option value="">--Pilih jenis pendaftaran--</option>
							<option value="Pertama">Uji Pertama</option>
							<option value="Berkala" selected>Uji Berkala</option>
							<option value="Numpang Masuk">Numpang Uji Masuk</option>
							<option value="Numpang Keluar">Numpang Uji Keluar</option>
							<option value="Mutasi Masuk">Mutasi Uji Masuk</option>
							<option value="Mutasi Keluar">Mutasi Uji Keluar</option>
							<option value="Penilaian Teknis">Penilaian Teknis</option>
							<option value="Penggantian buku uji atau stiker">Penggantian buku uji atau stiker</option>
							<option value="Kehilangan buku uji atau stiker">Kehilangan buku uji atau stiker</option>
						</select>
					</div>
				</div>

				<div id="status_numpang" style="display: none;">
				
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Numpang Dari</label>
						<div class="col-sm-8">
							<input type="text" id="num_dari" name="num_dari" placeholder="Numpang uji dari" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Nomor Numpang</label>
						<div class="col-sm-8">
							<input type="text" id="num_nomor" name="num_nomor" placeholder="Numpang uji nomor" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tanggal Numpang </label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="num_tgl" name="num_tgl" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				
				<div id="status_mutasi" style="display: none;">
				
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Mutasi Dari</label>
						<div class="col-sm-8">
							<input type="text" id="mut_dari" name="mut_dari" placeholder="Mutasi uji dari" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Nomor Mutasi</label>
						<div class="col-sm-8">
							<input type="text" id="mut_nomor" name="mut_nomor" placeholder="Mutasi uji nomor" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tanggal Mutasi </label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="mut_tgl" name="mut_tgl" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				
				<div id="kehilangan" style="display: none;">
				
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Nomor kehilangan</label>
						<div class="col-sm-8">
							<input type="text" id="no_kehilangan" name="no_kehilangan" placeholder="Nomor kehilangan" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Tanggal kehilangan </label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_kehilangan" name="tgl_kehilangan" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				
				<div id="nuk" style="display: none;">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Numpang Tujuan</label>
						<div class="col-sm-8">
							<input type="text" id="nuk_tujuan" name="nuk_tujuan" placeholder="Numpang uji ke" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left">Kota</label>
						<div class="col-sm-8">
							<input type="text" id="nuk_kota" name="nuk_kota" placeholder="Kota tujuan" class="col-xs-12" />
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanggal Pendaftaran </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_daftar_uji" name="tgl_daftar_uji" type="text" value="<?php echo $tglpendaftaran;?>" data-date-format="yyyy-mm-dd" />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Merek</label>
					<div class="col-sm-8">
						<input type="text" id="merek" name="merek" value="<?php echo $row->merek;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="tipe" name="tipe" value="<?php echo $row->tipe;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Jenis Kendaraan</label>
					<div class="col-sm-8">
						<select multiple="" id="jenis_kendaraan" name="jenis_kendaraan" class="select2" data-placeholder="Pilih jenis kendaraan...">
							<option value="<?php echo $row->jenis;?>" selected><?php echo $row->jenis;?></option>
							<option value="">&nbsp;</option>
							<option value="TAXI">TAXI</option>
							<option value="MOBIL PENUMPANG">MOBIL PENUMPANG</option>
							<option value="MINIBUS">MINIBUS</option>
							<option value="MICROBUS">MICROBUS</option>
							<option value="BUS">BUS</option>
							<option value="PICK UP">PICK UP</option>
							<option value="PICK UP BOX">PICK UP BOX</option>
							<option value="PICK UP LOS BAK">PICK UP LOS BAK</option>
							<option value="DOUBLE CABIN">DOUBLE CABIN</option>
							<option value="DELIVERY VAN">DELIVERY VAN</option>
							<option value="BLIND VAN">BLIND VAN</option>
							<option value="LIGHT TRUCK">LIGHT TRUCK</option>
							<option value="LIGHT TRUCK BAK BE">LIGHT TRUCK BAK BE</option>
							<option value="LIGHT TRUCK BAK KA">LIGHT TRUCK BAK KA</option>
							<option value="LIGHT TRUCK DUMP">LIGHT TRUCK DUMP</option>
							<option value="LIGHT TRUCK BOX">LIGHT TRUCK BOX</option>
							<option value="LIGHT TRUCK TANGKI">LIGHT TRUCK TANGKI</option>
							<option value="LIGHT TRUCK LOS BAK">LIGHT TRUCK LOS BAK</option>
							<option value="LIGHT TRUCK CRANE">LIGHT TRUCK CRANE</option>
							<option value="TRUCK">TRUCK</option>
							<option value="TRUCK DUMP">TRUCK DUMP</option>
							<option value="TRUCK BOX">TRUCK BOX</option>
							<option value="TRUCK TANGKI">TRUCK TANGKI</option>
							<option value="TRUCK LOS BAK">TRUCK LOS BAK</option>
							<option value="TRUCK CRANE">TRUCK CRANE</option>
							<option value="TRUCK CONCRETE">TRUCK CONCRETE</option>
							<option value="TRUCK TRONTON">TRUCK TRONTON</option>
							<option value="TRUCK TRONTON DUMP">TRUCK TRONTON DUMP</option>
							<option value="TRUCK TRONTON BOX">TRUCK TRONTON BOX</option>
							<option value="TRUCK TRONTON TANGKI">TRUCK TRONTON TANGKI</option>
							<option value="TRUCK TRONTON LOS BAK">TRUCK TRONTON LOS BAK</option>
							<option value="TRUCK TRONTON MIXER">TRUCK TRONTON MIXER</option>
							<option value="TRUCK TRONTON CRANE">TRUCK TRONTON CRANE</option>
							<option value="TRACTOR HEAD">TRACTOR HEAD</option>
							<option value="KERETA GANDENG">KERETA GANDENG</option>
							<option value="KERETA GANDENG BOX">KERETA GANDENG BOX</option>
							<option value="KERETA GANDENG TANGKI">KERETA GANDENG TANGKI</option>
							<option value="KERETA TEMPELAN">KERETA TEMPELAN</option>
							<option value="KERETA TEMPELAN BOX">KERETA TEMPELAN BOX</option>
							<option value="KERETA TEMPELAN TANGKI">KERETA TEMPELAN TANGKI</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Rangka </label>
					<div class="col-sm-8">
						<input type="text" id="no_rangka" name="no_rangka" value="<?php echo $row->no_rangka;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Mesin </label>
					<div class="col-sm-8">
						<input type="text" id="no_mesin" name="no_mesin" value="<?php echo $row->no_mesin;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanggal Habis Masa Uji </label>
					<div class="col-sm-5">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_habis_uji" name="tgl_habis_uji" type="text" value="<?php 
																																	$tanggal = unix_to_human($kode_uji);
																																	$sekarang = date("Y-m-d", strtotime($tanggal));	
																																	if($row->tgl_habis_uji==''){
																																		echo $sekarang;
																																	}
																																	else {
																																		echo $row->tgl_habis_uji;
																																	}?>" data-date-format="yyyy-mm-dd" />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
				
				<div id="pilih_penguji">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left bolder blue"> Pilih Penguji </label>
						<div class="col-sm-8">
							<select class="form-control" id="no_reg" name="no_reg" data-placeholder="Pilih penguji">
								<?php
								if(isset($data_penguji)){
									foreach($data_penguji as $row){
									?>
									<option value="<?php echo $row->no_reg;?>"><?php echo $row->nama; ?> - <?php echo $row->jml;?></option>
									<?php
									}
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">			
			<div class="col-xs-12 col-sm-12">
				<h4 class="header smaller lighter blue">
					Retribusi
				</h4>
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-left"> Retribusi</label>
					<div class="col-sm-5">
						<select class="form-control" id="retribusi" name="retribusi" data-placeholder="Pilih jenis retribusi">
							<option value="0">-</option>
						<?php 
						if(isset($data_tarif)){
							foreach($data_tarif as $row){
							?>
							<option value="<?php echo $row->tarif;?>"><?php echo $row->jenis; ?></option>
							<?php
							}
						}
						?>
						</select>
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> Stiker</label>
					<div class="col-sm-1">
						<select class="form-control" id="stiker_uji" name="stiker_uji" data-placeholder="Pilih jenis stiker">
							<option value="0">-</option>
						<?php 
						if(isset($stiker)){
							foreach($stiker as $row){
							?>
							<option value="<?php echo $row->tarif;?>" selected><?php echo $row->sifat; ?></option>
							<?php
							}
						}
						?>
						</select>
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> Plat</label>
					<div class="col-sm-1">
						<select class="form-control" id="plat_uji" name="plat_uji" data-placeholder="Pilih jenis plat">
							<option value="0">-</option>
						<?php 
						if(isset($plat)){
							foreach($plat as $row){
							?>
							<option value="<?php echo $row->tarif;?>" selected><?php echo $row->sifat; ?></option>
							<?php
							}
						}
						?>
						</select>
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> Buku</label>
					<div class="col-sm-1">
						<select class="form-control" id="buku_uji" name="buku_uji" data-placeholder="Pilih jenis buku">
							<option value="0">-</option>
						<?php 
						if(isset($buku)){
							foreach($buku as $row){
							?>
							<option value="<?php echo $row->tarif;?>"><?php echo $row->sifat; ?></option>
							<?php
							}
						}
						?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-left"> Total</label>
					<div class="col-sm-5">
						<input type="text" id="total_retribusi" name="total_retribusi" value="" class="col-xs-12">
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> Terbilang </label>
					<div class="col-sm-5">
						<input type="text" id="terbilang" name="terbilang" value="" class="col-xs-12">
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit" onclick="return confirm('Anda yakin data pendaftaran sudah benar?')">
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
	
	<?php 
	} else { ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger">
					<center>
						<p>	
							Kendaraan nomor pengujian <strong><?php echo $row->no_uji;?></strong> telah <strong>DIBLOKIR</strong> pada tanggal <?php echo $row->tgl_blokir;?> karena <?php echo $row->ket_blokir;?>.
						</p>
						
						<p>
							Silahkan hapus blokir kendaraan terlebih dahulu pada menu rekap blokir.
						</p>
										
						<p>
							<a type="button" class="btn btn-sm btn-info" href="<?php echo site_url('kendaraan/rekap_blokir')?>">Rekap Blokir</a>
						</p>
					</center>
				</div>
			</div>
		</div>
	<?php
			}
		}
	} else { ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger">
					<center>
						<p>	
							<strong>Data tidak ditemukan, harap masukan nomor uji kembali dengan benar.</strong>
						</p>
						
						
					</center>
				</div>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<form action="<?php echo site_url('pendaftaran/ujiberkala')?>" method="post">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="ace-icon fa fa-search blue"></i>
						</span>
						
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." autofocus/>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-info btn-sm">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								Cari
							</button>
						</span>
					</div>
				</form>
				
				<div class="space space-12"></div>
				
				
				<center>
					<a href="<?php echo site_url('pendaftaran/uji');?>">
					<button class="btn btn-primary btn-round">
						<i class="ace-icon fa fa-list-alt bigger-125"></i>
						PENDAFTARAN
					</button>
					</a>
				</center>
			</div>
		</div>
		
	<?php } ?>
</div>

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
<script type="text/javascript">
	jQuery(function($) {
		$("#retribusi").change(function(e){
			var th = ['','Ribu','Juta', 'Milyar','Triliun'];
			var dg = ['Nol','Satu','Dua','Tiga','Empat', 'Lima','Enam','Tujuh','Delapan','Sembilan']; var tn = ['Sepuluh','Sebelas','Dua Belas','Tiga Belas', 'Empat Belas','Lima Belas','Enam Belas', 'Tujuh Belas','Delapan Belas','Sembilan Belas']; var tw = ['Dua Puluh','Tiga Puluh','Empat Puluh','Lima Puluh', 'Enam Puluh','Tujuh Puluh','Delapan Puluh','Sembilan Puluh'];
			function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'Bukan Angka'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'Angka Terlalu Besar'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'Ratus ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'Koma '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ').replace("Satu Ratus","Seratus").replace("Satu Ribu","Seribu").replace("Satu Puluh","Sepuluh");}

			var jml;					
			var ret = parseFloat($('#retribusi').val());
			var stik = parseFloat($('#stiker_uji').val());
			var plat = parseFloat($('#plat_uji').val());
			var buk = parseFloat($('#buku_uji').val());
			
			jml = ret+stik+plat+buk;
			
			$('#total_retribusi').val(jml);
			$('#terbilang').val(toWords(jml));
		});
		
		$("#stiker_uji").change(function(e){
			var th = ['','Ribu','Juta', 'Milyar','Triliun'];
			var dg = ['Nol','Satu','Dua','Tiga','Empat', 'Lima','Enam','Tujuh','Delapan','Sembilan']; var tn = ['Sepuluh','Sebelas','Dua Belas','Tiga Belas', 'Empat Belas','Lima Belas','Enam Belas', 'Tujuh Belas','Delapan Belas','Sembilan Belas']; var tw = ['Dua Puluh','Tiga Puluh','Empat Puluh','Lima Puluh', 'Enam Puluh','Tujuh Puluh','Delapan Puluh','Sembilan Puluh'];
			function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'Bukan Angka'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'Angka Terlalu Besar'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'Ratus ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'Koma '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ').replace("Satu Ratus","Seratus").replace("Satu Ribu","Seribu").replace("Satu Puluh","Sepuluh");}

			var jml;					
			var ret = parseFloat($('#retribusi').val());
			var stik = parseFloat($('#stiker_uji').val());
			var plat = parseFloat($('#plat_uji').val());
			var buk = parseFloat($('#buku_uji').val());
			
			jml = ret+stik+plat+buk;
			
			$('#total_retribusi').val(jml);
			$('#terbilang').val(toWords(jml));
		});
		
		$("#plat_uji").change(function(e){
			var th = ['','Ribu','Juta', 'Milyar','Triliun'];
			var dg = ['Nol','Satu','Dua','Tiga','Empat', 'Lima','Enam','Tujuh','Delapan','Sembilan']; var tn = ['Sepuluh','Sebelas','Dua Belas','Tiga Belas', 'Empat Belas','Lima Belas','Enam Belas', 'Tujuh Belas','Delapan Belas','Sembilan Belas']; var tw = ['Dua Puluh','Tiga Puluh','Empat Puluh','Lima Puluh', 'Enam Puluh','Tujuh Puluh','Delapan Puluh','Sembilan Puluh'];
			function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'Bukan Angka'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'Angka Terlalu Besar'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'Ratus ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'Koma '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ').replace("Satu Ratus","Seratus").replace("Satu Ribu","Seribu").replace("Satu Puluh","Sepuluh");}

			var jml;					
			var ret = parseFloat($('#retribusi').val());
			var stik = parseFloat($('#stiker_uji').val());
			var plat = parseFloat($('#plat_uji').val());
			var buk = parseFloat($('#buku_uji').val());
			
			jml = ret+stik+plat+buk;
			
			$('#total_retribusi').val(jml);
			$('#terbilang').val(toWords(jml));
		});
		
		$("#buku_uji").change(function(e){
			var th = ['','Ribu','Juta', 'Milyar','Triliun'];
			var dg = ['Nol','Satu','Dua','Tiga','Empat', 'Lima','Enam','Tujuh','Delapan','Sembilan']; var tn = ['Sepuluh','Sebelas','Dua Belas','Tiga Belas', 'Empat Belas','Lima Belas','Enam Belas', 'Tujuh Belas','Delapan Belas','Sembilan Belas']; var tw = ['Dua Puluh','Tiga Puluh','Empat Puluh','Lima Puluh', 'Enam Puluh','Tujuh Puluh','Delapan Puluh','Sembilan Puluh'];
			function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'Bukan Angka'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'Angka Terlalu Besar'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'Ratus ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'Koma '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ').replace("Satu Ratus","Seratus").replace("Satu Ribu","Seribu").replace("Satu Puluh","Sepuluh");}

			var jml;					
			var ret = parseFloat($('#retribusi').val());
			var stik = parseFloat($('#stiker_uji').val());
			var plat = parseFloat($('#plat_uji').val());
			var buk = parseFloat($('#buku_uji').val());
			
			jml = ret+stik+plat+buk;
			
			$('#total_retribusi').val(jml);
			$('#terbilang').val(toWords(jml));
			if( $(this).val()==="30000"){
				$("#kehilangan").show();
			} else {
				$("#kehilangan").hide();
			}
		});
		
		$('#jenis_uji').on('change',function(){
			if( $(this).val()==="Numpang Masuk"){
				$("#status_numpang").show();
				$("#status_mutasi").hide();
				$("#kehilangan").hide();
				$("#pilih_penguji").show();
				$("#nuk").hide();
				$("#mk").hide();
			} else if( $(this).val()==="Numpang Keluar"){
				$("#status_numpang").hide();
				$("#status_mutasi").hide();
				$("#kehilangan").hide();
				$("#pilih_penguji").hide();
				$("#nuk").show();
				$("#mk").hide();
				$("#stiker_uji option").filter(function(){
					return this.text == "-";
				}).attr('selected', true);
				$("#plat_uji option").filter(function(){
					return this.text == "-";
				}).attr('selected', true);
			} else if( $(this).val()==="Mutasi Masuk"){
				$("#status_numpang").hide();
				$("#status_mutasi").show();
				$("#kehilangan").hide();
				$("#pilih_penguji").show();
				$("#nuk").hide();
				$("#mk").hide();
			} else if( $(this).val()==="Mutasi Keluar"){
				$("#status_numpang").hide();
				$("#status_mutasi").hide();
				$("#kehilangan").hide();
				$("#pilih_penguji").hide();
				$("#nuk").hide();
				$("#mk").show();
				$("#retribusi option").filter(function(){
					return this.text == "-";
				}).attr('selected', true);
				$("#stiker_uji option").filter(function(){
					return this.text == "-";
				}).attr('selected', true);
				$("#buku_uji option").filter(function(){
					return this.text == "-";
				}).attr('selected', true);
				$("#plat_uji option").filter(function(){
					return this.text == "-";
				}).attr('selected', true);
			} else if( $(this).val()==="Kehilangan buku uji atau stiker"){
				$("#status_numpang").hide();
				$("#status_mutasi").hide();
				$("#kehilangan").show();
				$("#pilih_penguji").show();
				$("#nuk").hide();
				$("#mk").hide();
			} else {
				$("#status_numpang").hide();
				$("#status_mutasi").hide();
				$("#kehilangan").hide();
				$("#pilih_penguji").show();
				$("#nuk").hide();
				$("#mk").hide();
			}
		});
		
		$('#status_pemilik').on('change',function(){
			if( $(this).val()==="ganti_nama"){
				$("#ganti_nama").show();
			} else {
				$("#ganti_nama").hide();
			}
		});
		
		$('#status_pemohon').on('change',function(){
			if( $(this).val()==="dikuasakan"){
				$("#dikuasakan").show();
				$("#pemilik").hide();
			} else {
				$("#dikuasakan").hide();
				$("#pemilik").show();
			}
		});
		
		$("#no_ktp_pemohon").keyup(function(){
			if($("#no_ktp_pemohon").val().length>11){
				var no_ktp = $("#no_ktp_pemohon").val();
				
				var post_data = {
				   'no_ktp': no_ktp,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('pendaftaran/get_pemohon'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						if(obj == ""){
							$("#nama_pemohon").val("");
							$("#alamat_pemohon").val("");
							//$("#no_telp").val("");
						}
						else {
							$("#nama_pemohon").val(obj[0].nama);
							$("#alamat_pemohon").val(obj[0].alamat);
							$("#no_telp").val(obj[0].telp);
						}
					}
				});
			}
			return false;
		});
		
		$("#no_ktp_pemilik").keyup(function(){
			if($("#no_ktp_pemilik").val().length>11){
				var no_ktp = $("#no_ktp_pemilik").val();
				
				var post_data = {
				   'no_ktp': no_ktp,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('pendaftaran/get_pemohon'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						$("#nama_pemilik").val(obj[0].nama);
						$("#alamat_pemilik").val(obj[0].alamat);
						$("#no_telp").val(obj[0].telp);
					}
				});
			}
			return false;
		});
		
		$("#no_ktp").keyup(function(){
			if($("#no_ktp").val().length>15){
				var no_ktp = $("#no_ktp").val();
				
				var post_data = {
				   'no_ktp': no_ktp,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('pendaftaran/get_pemilik'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						$("#nama").val(obj[0].nama);
						$("#alamat").val(obj[0].alamat);
						$("#kecamatan").val(obj[0].kecamatan);
						$("#kota").val(obj[0].kota);
					}
				});
			}
			return false;
		});
	});
</script>	