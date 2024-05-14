<div class="form-group">
	<label class="col-sm-3 control-label no-padding-left">Nomor Whatsapp</label>
	<div class="col-sm-9">
		<?php if($id=="PILIH"){ ?>
		<select id="phone" name="phone" class="select2 col-xs-12" data-placeholder="Pilih nomor whatsapp...">
			<option></option>
			<?php foreach($dt_wa as $row){?>
			<option value="<?php echo $row->telp;?>"><?php echo $row->telp;?> - <?php echo $row->nama;?></option>
			<?php } ?>
		</select>
		<?php } else if($id=="TULIS"){?>
		<input type="tel" id="phone" name="phone" placeholder="Nomor WhatsApp..." class="col-xs-12" />
		<?php } else if($id=="SEMUA"){?>
		<input type="tel" placeholder="Semua nomor whatsapp" value="Semua nomor whatsapp dalam sistem" class="col-xs-12" readonly />
		<?php } ?>
	</div>
</div>

<script type="text/javascript">
	jQuery(function($) {		
		$('.select2').css('width','300px').select2({allowClear:true})
	});
</script>