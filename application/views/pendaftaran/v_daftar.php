<div class="page-content">
	
	<div class="page-header">
		<div class="row text-center">
			<div class="col-xs-12">
				<h1>
					Pendaftaran Pengujian Kendaraan Bermotor
				</h1>
			</div>
		</div>
	</div>
	<form class="form-horizontal" role="form" action="<?php echo site_url('pendaftaran/prosesdaftar')?>" method="post" id="daftaruji">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<?php echo $this->session->flashdata('alert');?>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<?php	
					$kode_admin = mb_substr($this->session->userdata('nama'),0,2);
					$kode_add = mb_substr($this->session->userdata('id_user'),-3); 
				?>
				<div class="form-group">	
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Pengujian </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="no_uji" name="no_uji" placeholder="Nomor Pengujian" class="col-xs-12" required="" autofocus />
							<span class="input-group-btn">
								<a class="btn btn-info btn-sm">
									<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								</a>
							</span>
						</div>
					</div>
				</div>
				
				<div id="cek_noken"></div>
				
				
				
				<div class="space space-8"></div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor KTP/SIM Pemohon</label>
					<div class="col-sm-8">
						<input type="text" id="no_ktp_pemohon" name="no_ktp_pemohon" placeholder="Nomor KTP Pemohon" class="col-xs-12"/>
					</div>
				</div>
			
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nama Pemohon</label>
					<div class="col-sm-8">
						<input type="text" id="nama_pemohon" name="nama_pemohon" placeholder="Nama Pemohon" class="col-xs-12"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Alamat Pemohon </label>
					<div class="col-sm-8">
						<textarea id="alamat_pemohon" name="alamat_pemohon" class="autosize-transition form-control" placeholder="Alamat Pemohon"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Nomor Whatsapp</label>
					<div class="col-sm-8">
						<input type="text" id="no_telp" name="no_telp" placeholder="Nomor whatsapp ex. 628xxxx" class="col-xs-12" />
					</div>
				</div>
				
				<div class="space space-8"></div>
				
				
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Pendaftaran Untuk </label>
					<div class="col-sm-8">
						<select class="form-control" id="jenis_uji" name="jenis_uji" data-placeholder="Pilih jenis pendaftaran">
							<option value="">--Pilih jenis pendaftaran--</option>
							<option value="Pertama">Uji Pertama</option>
							<option value="Berkala">Uji Berkala</option>
							<option value="Numpang Masuk">Numpang Uji Masuk</option>
							<option value="Numpang Keluar">Numpang Uji Keluar</option>
							<option value="Mutasi Masuk">Mutasi Uji Masuk</option>
							<option value="Mutasi Keluar">Mutasi Uji Keluar</option>
							<option value="Penilaian Teknis">Penilaian Teknis</option>
							<option value="Penggantian">Penggantian Tanda Uji</option>
							<option value="Kehilangan">Kehilangan Buku Uji</option>
						</select>
					</div>
				</div>
				
				<div id="form_jenis_pendaftaran"></div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Status Penerbitan </label>
					<div class="col-sm-8">
						<select class="form-control" id="status_terbit" name="status_terbit" data-placeholder="Pilih status terbit" required>
							<option value="">--Pilih status penerbitan--</option>
							<?php foreach($terbit as $tbt){ ?>
							<option value="<?php echo $tbt->statuspenerbitan;?>"><?php echo $tbt->keterangan;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kode Uji </label>
					<div class="col-sm-8">
						<input type="text" id="kode_uji" name="kode_uji" value="<?php echo $kode_uji; echo $kode_admin;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="no_kendaraan" name="no_kendaraan" placeholder="Nomor Kendaraan" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nama Pemilik</label>
					<div class="col-sm-8">
						<input type="text" id="nama" name="nama" placeholder="Nama Pemilik Kendaraan" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Alamat Pemilik </label>
					<div class="col-sm-8">
						<textarea class="form-control limited" id="alamat" name="alamat" placeholder="Alamat" maxlength="50"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Merk</label>
					<div class="col-sm-8">
						<input type="text" id="merek" name="merek" placeholder="Merk Kendaraan" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="tipe" name="tipe" placeholder="Tipe Kendaraan" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Bentuk Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="bentuk" name="bentuk" placeholder="Bentuk Kendaraan" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Rangka </label>
					<div class="col-sm-8">
						<input type="text" id="no_rangka" name="no_rangka" placeholder="Nomor Rangka Landasan" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Mesin </label>
					<div class="col-sm-8">
						<input type="text" id="no_mesin" name="no_mesin" placeholder="Nomor Mesin" class="col-xs-12" readonly />
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
</div>

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
<script src="<?php echo base_url('assets/js/moment.js')?>"></script>
<script type="text/javascript">
	jQuery(function($) {
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
		});
		
		$("#no_uji").keyup(function(){
			if($("#no_uji").val().length>3){
				var no_uji = $("#no_uji").val();
				
				var post_data = {
				   'no_uji': no_uji,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('kendaraan/get_kendaraan'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						if(obj == ""){
							$("#no_kendaraan").val("");
							$("#nama").val("");
							$("#alamat").val("");
							$("#merek").val("");
							$("#bentuk").val("");
							$("#no_rangka").val("");
							$("#no_mesin").val("");
						}
						else {
							$("#no_kendaraan").val(obj[0].no_kendaraan);
							$("#nama").val(obj[0].nama);
							$("#alamat").val(obj[0].alamat);
							$("#merek").val(obj[0].merek);
							$("#tipe").val(obj[0].tipe);
							$("#bentuk").val(obj[0].bentuk);
							$("#no_rangka").val(obj[0].no_rangka);
							$("#no_mesin").val(obj[0].no_mesin);
						}
					}
				});
			}
			return false;
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
						$("#nama").val(obj[0].nama);
						$("#alamat").val(obj[0].alamat);
						$("#kecamatan").val(obj[0].kecamatan);
						$("#kota").val(obj[0].kota);
					}
				});
			}
			return false;
		});
		
		$('#jenis_uji').on('change',function(){
			if( ($(this).val()==="Numpang Masuk") || ($(this).val()==="Mutasi Masuk")){
				$('#form_jenis_pendaftaran').empty();
				$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_masuk');?>");
			} else if($(this).val()==="Numpang Keluar"){
				$('#form_jenis_pendaftaran').empty();
				$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_keluar');?>");
			} else if($(this).val()==="Mutasi Keluar"){
				$('#form_jenis_pendaftaran').empty();
				$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_mutasi');?>");
			} else if($(this).val()==="Kehilangan"){
				$('#form_jenis_pendaftaran').empty();
				$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_kehilangan');?>");
			} else {
				$('#form_jenis_pendaftaran').empty();
			}
		});
	});
</script>	