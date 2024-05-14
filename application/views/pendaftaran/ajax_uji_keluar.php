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


<script type="text/javascript">
	jQuery(function($) {
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