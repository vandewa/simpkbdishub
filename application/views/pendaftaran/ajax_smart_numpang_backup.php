<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Wilayah Asal</label>
	<div class="col-sm-8">
		<select id="kd_wil_asal" name="kd_wil_asal" class="select2 col-xs-12" data-placeholder="Pilih wilayah asal...">
			<option value=""></option>
			<?php foreach($dt_setting as $stg){ $wilayah = $stg->kodewilayah;}  
			foreach($dt_kabupaten as $kab){ 
			if($wilayah==$kab->kodewilayah){ ?>
			<option value="<?php echo $stg->kodewilayah;?>" selected><?php echo $stg->namawilayah; ?></option>
			<?php } else { ?>
			<option value="<?php echo $kab->kodewilayah;?>"><?php echo $kab->namawilayah;?></option>
			<?php }} ?>
		</select>
	</div>
</div>

<script type="text/javascript">
	jQuery(function($) {		
		$('.select2').css('width','300px').select2({allowClear:true})
	});
</script>