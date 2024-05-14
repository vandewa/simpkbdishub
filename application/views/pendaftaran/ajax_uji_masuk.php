<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Dari</label>
	<div class="col-sm-8">
		<select id="num_dari" name="num_dari" class="select2 col-xs-12" data-placeholder="Pilih kabupaten..." required>
			<option value="">-</option>
			<?php foreach($dt_kabupaten as $kab){ ?>
			<option value="<?php echo $kab->nama_kabupaten;?>"><?php echo $kab->nama_kabupaten;?></option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Nomor</label>
	<div class="col-sm-8">
		<input type="text" id="num_nomor" name="num_nomor" placeholder="Uji nomor" class="col-xs-12" required />
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Tanggal</label>
	<div class="col-sm-8">
		<div class="input-group">
			<input class="form-control date-picker" id="num_tgl" name="num_tgl" type="text" data-date-format="yyyy-mm-dd" required />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(function($) {
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		}),
		
		$('.select2').css('width','300px').select2({allowClear:true})
	});
</script>