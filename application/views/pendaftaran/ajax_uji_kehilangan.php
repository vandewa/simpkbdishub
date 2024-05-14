<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left">Nomor kehilangan</label>
	<div class="col-sm-8">
		<input type="text" id="no_kehilangan" name="no_kehilangan" placeholder="Nomor kehilangan" class="col-xs-12" />
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Tanggal kehilangan </label>
	<div class="col-sm-8">
		<div class="input-group">
			<input class="form-control date-picker" id="tgl_kehilangan" name="tgl_kehilangan" type="text" data-date-format="yyyy-mm-dd" />
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
		})
	});
</script>