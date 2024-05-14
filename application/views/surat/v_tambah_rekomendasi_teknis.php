<div class="page-content">
	
	<div class="page-header">
		<h1>
			Formulir Surat Rekomendasi Teknis Kendaraan
		</h1>
	</div>
	<form class="form-horizontal" role="form" action="<?php echo site_url('surat/proses_tambahrekom')?>" method="post" id="validation-form">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="header smaller lighter blue">
					Data Pemilik Kendaraan
				</h3>
				
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						
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
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="header smaller lighter blue">
					Data Kendaraan
				</h3>	
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
						<div class="col-sm-8">
							<select id="detail_jenis_kendaraan" name="detail_jenis_kendaraan" class="form-control" data-placeholder="Pilih detail jenis kendaraan...">
								<option>Pilih Jenis Kendaraan</option>
								<option value="MOBIL PENUMPANG">MOBIL PENUMPANG</option>
								<option value="MOBIL BUS">MOBIL BUS</option>
								<option value="MOBIL BARANG">MOBIL BARANG</option>
								<option value="KENDARAN KHUSUS">KENDARAAN KHUSUS</option>
								<option value="KERETA GANDENGAN">KERETA GANDENGAN</option>
								<option value="KERETA TEMPELAN">KERETA TEMPELAN</option>
								<option value="MOBIL PENARIK">MOBIL PENARIK</option>
								<option value="KENDARAAN BERMOTOR RODA 3">KENDARAAN BERMOTOR RODA 3</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Bentuk Kendaraan </label>
						<div class="col-sm-8">
							<select id="jenis_kendaraan" name="jenis_kendaraan" class="select2" data-placeholder="Pilih bentuk kendaraan...">
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
								<option value="STATION WAGON">STATION WAGON</option>
								<option value="LIGHT TRUCK">LIGHT TRUCK</option>
								<option value="LIGHT TRUCK BAK BE">LIGHT TRUCK BAK BE</option>
								<option value="LIGHT TRUCK BAK KA">LIGHT TRUCK BAK KA</option>
								<option value="LIGHT TRUCK DUMP">LIGHT TRUCK DUMP</option>
								<option value="LIGHT TRUCK BOX">LIGHT TRUCK BOX</option>
								<option value="LIGHT TRUCK TANGKI">LIGHT TRUCK TANGKI</option>
								<option value="LIGHT TRUCK LOS BAK">LIGHT TRUCK LOS BAK</option>
								<option value="LIGHT TRUCK CRANE">LIGHT TRUCK CRANE</option>
								<option value="LIGHT TRUCK PEMADAM">LIGHT TRUCK PEMADAM</option>
								<option value="TRUCK">TRUCK</option>
								<option value="TRUCK DUMP">TRUCK DUMP</option>
								<option value="TRUCK BOX">TRUCK BOX</option>
								<option value="TRUCK TANGKI">TRUCK TANGKI</option>
								<option value="TRUCK LOS BAK">TRUCK LOS BAK</option>
								<option value="TRUCK CRANE">TRUCK CRANE</option>
								<option value="TRUCK PEMADAM">TRUCK PEMADAM</option>
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
								<option value="AMBULANCE">AMBULANCE</option>
								<option value="KENDARAAN KHUSUS">KENDARAAN KHUSUS</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Status Penggunaan </label>
						<div class="col-sm-8">
							<select class="form-control" id="sifat" name="sifat" data-placeholder="Pilih status penggunaan">
								<option>Pilih Status Penggunaan</option>
								<option value="Umum">Umum</option>
								<option value="Tidak Umum">Tidak Umum</option>
								<option value="Dinas">Dinas</option>
							</select>
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
						<label class="col-sm-2 control-label no-padding-left">Faktur Kendaraan</label>
						<div class="col-sm-4">
							<input type="text" id="no_faktur" name="no_faktur" placeholder="No Faktur Kendaraan" class="col-xs-12" />
						</div>

						<div class="col-sm-2">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_faktur" name="tgl_faktur" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>

						<div class="col-sm-4">
							<input type="text" id="penerbit_faktur" name="penerbit_faktur" placeholder="Penerbit Faktur Kendaraan" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-left">Uji Tipe</label>
						<div class="col-sm-4">
							<input type="text" id="no_ut" name="no_ut" placeholder="No Uji Tipe"  class="col-xs-12" />
						</div>

						<div class="col-sm-2">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_ut" name="tgl_ut" type="text"  data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>

						<div class="col-sm-4">
							<input type="text" id="penerbit_ut" name="penerbit_ut" placeholder="Penerbit Uji Tipe"  class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-left">Registrasi Uji Tipe</label>
						<div class="col-sm-4">
							<input type="text" id="no_srut" name="no_srut" placeholder="No Sertifikasi Uji Tipe" class="col-xs-12" />
						</div>

						<div class="col-sm-2">
							<div class="input-group">
								<input class="form-control date-picker" id="tgl_srut" name="tgl_srut" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>

						<div class="col-sm-4">
							<input type="text" id="penerbit_srut" name="penerbit_srut" placeholder="Penerbit Registrasi Uji Tipe" class="col-xs-12" />
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
						<label class="control-label bolder blue">Ukuran Kendaraan</label>
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
					</div>
					
					<div class="col-xs-12 col-sm-4">
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
									<input type="text" id="js_sumbu4" name="js_sumbu4" placeholder="Jarak Sumbu III-IV" class="col-xs-12"/>
									<span class="input-group-addon">mm</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Konfig Sumbu </label>
							<div class="col-sm-8">
								<input type="text" id="konf_sumbu" name="konf_sumbu" placeholder="Konfigurasi Sumbu" class="col-xs-12"/>
							</div>
						</div>
						
						<label class="control-label bolder blue">Rumah - rumah (karoseri)</label>
						<div class="space space-8"></div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Jenis Rumah </label>
							<div class="col-sm-8">
								<input type="text" id="jenis_rumah" name="jenis_rumah" placeholder="Jenis rumah-rumah" class="col-xs-12"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Bahan Utama </label>
							<div class="col-sm-8">
								<input type="text" id="bahan_rumah" name="bahan_rumah" placeholder="Bahan Utama rumah-rumah" class="col-xs-12"/>
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
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
		});
		
		$("#no_ktp").keyup(function(){
			if($("#no_ktp").val().length>11){
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
						if(obj == ""){
							
						} else {
							$("#nama").val(obj[0].nama);
							$("#alamat").val(obj[0].alamat);
							$("#kecamatan").val(obj[0].kecamatan);
						}
					}
				});
			}
			return false;
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
							$("#isi_silinder").val(obj[0].isi_silinder);
							$("#daya_motor").val(obj[0].daya_motor);
							$("#bahan_bakar").val(obj[0].bahan_bakar);
							$("#uk_panjang").val(obj[0].uk_panjang);
							$("#uk_lebar").val(obj[0].uk_lebar);
							$("#uk_tinggi").val(obj[0].uk_tinggi);
							$("#uk_roh").val(obj[0].uk_roh);
							$("#uk_foh").val(obj[0].uk_foh);
							$("#js_sumbu1").val(obj[0].js_sumbu1);
							$("#js_sumbu2").val(obj[0].js_sumbu2);
							$("#js_sumbu3").val(obj[0].js_sumbu3);
							$("#js_sumbu4").val(obj[0].js_sumbu4);
							$("#jenis_rumah").val(obj[0].karoseri);
							$("#bahan_rumah").val(obj[0].dbm_bahan_bak);
							$("#kema_sumbu1").val(obj[0].kema_sumbu1);
							$("#kema_sumbu2").val(obj[0].kema_sumbu2);
							$("#kema_sumbu3").val(obj[0].kema_sumbu3);
							$("#kema_sumbu4").val(obj[0].kema_sumbu4);
							$("#konf_sumbu").val(obj[0].konf_sumbu);
							$("#jbb").val(obj[0].jbb);
							$("#jbb_kombinasi").val(obj[0].jbb_kombinasi);
						}
					}
				});
			}
			return false;
		});
	});
</script>