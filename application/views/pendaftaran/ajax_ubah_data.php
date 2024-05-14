<?php foreach($dt_pengguna as $row){ ?>
<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Tanggal STNK </label>
	<div class="col-sm-8">
		<div class="input-group">
			<input class="form-control date-picker" id="tgl_stnk" name="tgl_stnk" value="<?php echo $row->tgl_stnk;?>" type="text" data-date-format="yyyy-mm-dd" />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Nomor KTP Pemilik</label>
	<div class="col-sm-8">
		<input type="text" id="no_ktp" name="no_ktp" placeholder="Nomor KTP" value="<?php echo $row->no_ktp;?>" class="col-xs-12"/>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Nama Pemilik</label>
	<div class="col-sm-8">
		<input type="text" id="nama" name="nama" placeholder="Nama Pemilik Kendaraan" value="<?php echo $row->nama;?>" class="col-xs-12" />
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Alamat Pemilik </label>
	<div class="col-sm-8">
		<textarea class="form-control limited" id="alamat" name="alamat" placeholder="Alamat" maxlength="50"><?php echo $row->alamat;?></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Kecamatan</label>
	<div class="col-sm-8">
		<select id="kecamatan" name="kecamatan" class="select2" data-placeholder="Pilih kecamatan...">
			<option value="">-</option>
			<option value="<?php echo $row->kecamatan;?>" selected><?php echo $row->kecamatan;?></option>
			<?php foreach($dt_kecamatan as $kec){ ?>
			<option value="<?php echo $kec->kecamatan;?>"><?php echo $kec->kecamatan;?></option>
			<?php } ?>
		</select>
		<span class="help-block">Kosongkan jika kendaraan berasal dari luar daerah.</span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Kota</label>
	<div class="col-sm-8">
		<select id="kota" name="kota" class="select2" data-placeholder="Pilih kota...">
			<option value="Kabupaten Wonosobo" selected>Kabupaten Wonosobo</option>
			<?php foreach($dt_kota as $kota){ ?>
			<option value="<?php echo $kota->nama_kabupaten;?>"><?php echo $kota->nama_kabupaten;?></option>
			<?php } ?>
		</select>
	</div>
</div>
<?php } ?>

<script type="text/javascript">
	jQuery(function($) {
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		
		$('.select2').css('width','300px').select2({allowClear:true});
		
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
						$("#kecamatan").val(obj[0].kecamatan).trigger('change.select2');;
						$("#kota").val(obj[0].kota).trigger('change.select2');;
					}
				});
			}
			return false;
		});
	});
</script>