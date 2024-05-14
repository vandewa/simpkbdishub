<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Tujuan</label>
	<div class="col-sm-8">
		<select id="nuk_tujuan" name="nuk_tujuan" class="select2" data-placeholder="Pilih kabupaten...">
			<option value=""></option>
			<?php foreach($dt_kabupaten as $kab){ ?>
			<option value="<?php echo $kab->nama_kabupaten;?>"><?php echo $kab->nama_kabupaten;?></option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Kota</label>
	<div class="col-sm-8">
		<input type="text" id="nuk_kota" name="nuk_kota" placeholder="Kota tujuan" class="col-xs-12" readonly />
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Dasar Mutasi Kendaraan</label>
	<div class="col-sm-8">
		<select class="select2" id="mk_dasar" name="mk_dasar" data-placeholder="Pilih dasar mutasi kendaraan...">
			<option></option>
			<option value="STNK">STNK</option>
			<option value="Fiskal">Fiskal</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Nomor STNK/Fiskal</label>
	<div class="col-sm-8">
		<input type="text" id="mk_dasar_no" name="mk_dasar_no" placeholder="Nomor STNK/Fiskal..." class="col-xs-12" />
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Tanggal STNK/Fiskal</label>
	<div class="col-sm-8">
		<div class="input-group">
			<input class="form-control date-picker" id="tgl_dasar" name="tgl_dasar" type="text" data-date-format="yyyy-mm-dd" />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Kota Dikeluarkan STNK/Fiskal</label>
	<div class="col-sm-8">
		<select id="mk_dasar_kota" name="mk_dasar_kota" class="select2 col-xs-12" data-placeholder="Pilih Kota yang mengeluarkan STNK/Fiskal...">
			<option value=""></option>
			<?php foreach($dt_kabupaten as $kab){ ?>
			<option value="<?php echo $kab->nama_kabupaten;?>"><?php echo $kab->nama_kabupaten;?></option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Nama Pemilik Baru</label>
	<div class="col-sm-8">
		<input type="text" id="nm_baru" name="nm_baru" placeholder="Nama pemilik..." class="col-xs-12" />
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Alamat Pemilik Baru</label>
	<div class="col-sm-8">
		<textarea class="form-control limited" id="nm_alamat" name="nm_alamat" placeholder="Alamat" maxlength="80"></textarea>
	</div>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		}),
		
		$('.select2').css('width','300px').select2({allowClear:true})
		
		$("#nuk_tujuan").on("select2:select",function(e){
			var tujuan = $("#nuk_tujuan").val();
			var post_data = {
			   'tujuan': tujuan,
			   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			};
			
			$.ajax({
				type: "post",
				url : "<?php echo base_url('pendaftaran/get_kota_tujuan'); ?>",
				cache: false,    
				data: post_data,
				success: function(response){
					var obj = JSON.parse(response);
					if(obj == ""){
						$("#nuk_kota").val("");
					}
					else {
						$("#nuk_kota").val(obj[0].pusat_pemerintah);
					}
				}
			});
		});
	});
</script>