<div class="page-content">
	<div class="page-header">
		<h1>
			Pesan Keluar
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" action="<?php echo site_url('kendaraan/prosestambahpemilik')?>" method="post">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						
				<div class="row">
					<div class="col-xs-12 col-sm-12">							
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-left"> No WhatsApp </label>
							<div class="col-sm-9">
								<input type="tel" id="phone" name="phone" placeholder="Nomor WhatsApp..." class="col-xs-12" />
							</div>
						</div>
						
						<div class="form-group">
						<label class="col-sm-3 control-label no-padding-left"> Pesan </label>
							<div class="col-sm-9">
								<textarea id="message" name="message" class="form-control" placeholder="Pesan WhatsApp..."></textarea>
							</div>
						</div>
					</div>
				</div>
					
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-8">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>
							Simpan
						</button>

						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Reset
						</button>
					</div>
				</div>
							
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$("#jenis_koordinat").on("select2:select",function(e){
			var koor = $("#jenis_koordinat").val();
			$.ajax({
				url: "<?php echo base_url('permohonan/get_formkoordinat'); ?>",
				type: 'GET',
				data: {'id':koor},
				success: function(data){
					$('#form_koordinat').html(data)
				},
				failed: function(data){
					alert('Gagal mendapatkan koordinat');
				}
			});
		});
	});
</script>