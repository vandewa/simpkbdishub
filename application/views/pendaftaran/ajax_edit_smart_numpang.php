<?php foreach($dt_wilayahasal as $row){?>
<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Wilayah Asal</label>
	<div class="col-sm-8">
		<select id="kd_wil_asal" name="kd_wil_asal" class="select2 col-xs-12" data-placeholder="Pilih wilayah asal...">
			<option></option>
			<?php foreach($dt_kabupaten as $kab){ 
			if($row->kodewilayah==$kab->kodewilayah){?>
			<option value="<?php echo $row->kodewilayah;?>" selected><?php echo $row->namawilayah;?></option>
			<?php } else { ?>
			<option value="<?php echo $kab->kodewilayah;?>"><?php echo $kab->namawilayah;?></option>
			<?php }} ?>
		</select>
	</div>
</div>
<?php } ?>

<script type="text/javascript">
	jQuery(function($) {		
		$('.select2').css('width','300px').select2({allowClear:true})
	});
</script>