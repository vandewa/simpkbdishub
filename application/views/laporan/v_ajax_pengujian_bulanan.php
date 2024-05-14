<?php  foreach($dt_laporan as $row){ ?>
<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Jumlah </label>
	<div class="col-sm-8">
		<input type="text" value="<?php echo $row->jumlah;?>" class="col-xs-12" readonly />
	</div>
</div>
<?php } ?>