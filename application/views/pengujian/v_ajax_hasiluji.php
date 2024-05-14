<?php if($hasil=="LULUS"){ ?>
<div class="form-group">
	<label class="col-sm-5 control-label no-padding-left bolder blue"> Tanggal Habis Uji </label>
	<div class="col-sm-7">
		<div class="input-group">
			<input class="form-control date-picker" id="tgl_habis_uji" name="tgl_habis_uji" value="<?php echo date('Y-m-d', strtotime("+6 month",strtotime($tgl)));?>" type="text" data-date-format="yyyy-mm-dd" readonly />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
</div>

<!--<input type="hidden" id="tgl_batas_perbaikan" name="tgl_batas_perbaikan" class="col-xs-12" value=""/>-->
<?php } else if($hasil=="TIDAK LULUS"){ ?>
<div class="form-group">
	<label class="col-sm-5 control-label no-padding-left bolder blue"> Tanggal Batas Perbaikan </label>
	<div class="col-sm-7">
		<div class="input-group">
			<input class="form-control date-picker" id="tgl_batas_perbaikan" name="tgl_batas_perbaikan" value="<?php $date = strtotime("+7 day"); echo date('Y-m-d', $date);?>" type="text" data-date-format="yyyy-mm-dd"/>
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
</div>
<input type="hidden" id="tgl_habis_uji" name="tgl_habis_uji" class="col-xs-12" value=""/>
<?php } ?>

<script type="text/javascript">
	jQuery(function($) {		
		$('.date-picker').datepicker({
			daysOfWeekDisabled: [0],
			startDate: "+1d",
			endDate: "+6m",
			autoclose: true,
			todayHighlight: true
		});
	});
</script>