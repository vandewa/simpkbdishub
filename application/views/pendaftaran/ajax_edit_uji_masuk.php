<?php foreach($dt_ujimasuk as $row){?>
<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Dari</label>
	<div class="col-sm-8">
		<select id="num_dari" name="num_dari" class="select2 col-xs-12" data-placeholder="Pilih kabupaten...">
			<option value="">-</option>
			<?php foreach($dt_kabupaten as $kab){ 
			if($row->num_dari==$kab->nama_kabupaten){?>
			<option value="<?php echo $row->num_dari;?>" selected><?php echo $row->num_dari;?></option>
			<?php } else { ?>
			<option value="<?php echo $kab->nama_kabupaten;?>"><?php echo $kab->nama_kabupaten;?></option>
			<?php }} ?>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Nomor</label>
	<div class="col-sm-8">
		<input type="text" id="num_nomor" name="num_nomor" value="<?php echo $row->num_nomor;?>" placeholder="Uji nomor" class="col-xs-12" />
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Tanggal</label>
	<div class="col-sm-8">
		<div class="input-group">
			<input class="form-control date-picker" id="num_tgl" name="num_tgl" value="<?php echo $row->num_tgl;?>" type="text" data-date-format="yyyy-mm-dd" />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
</div>
<?php } ?>

<script type="text/javascript">
	jQuery(function($) {
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		}),
		
		$('.select2').css('width','300px').select2({allowClear:true})
	});
</script>