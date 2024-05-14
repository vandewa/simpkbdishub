<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12">
				<h1>
					
				</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">Status WhatsApp Gateway</h5>

					<div class="widget-toolbar">
						<a href="#" data-action="reload">
							<i class="ace-icon fa fa-refresh"></i>
						</a>

						<a href="#" data-action="collapse">
							<i class="ace-icon fa fa-chevron-up"></i>
						</a>

						<a href="#" data-action="close">
							<i class="ace-icon fa fa-times"></i>
						</a>
					</div>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<form class="form-horizontal" role="form">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left"> No WhatsApp </label>
										<div class="col-sm-9">
											<input type="text" id="no_whatsapp" name="no_whatsapp" class="col-xs-12" />
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
<script type="text/javascript">
	jQuery(function($) {
		setInterval(function(){
			var post_data = {
				   'token': 'HchJvm5k18suIYEzzTrilq61kb6fRM14HGpslnsVnBKDYjCBwE4Uvs0yPpcaShyF',
				};
				
			$.ajax({
				type: "get",
				url : "https://console.wablas.com/api/device/info",
				cache: false,    
				data: post_data,
				success: function(response){
					var obj = JSON.parse(response);
					$("#no_whatsapp").val(obj[data].sender);
					$("#alamat").val(obj[0].alamat);
					$("#kecamatan").val(obj[0].kecamatan);
					$("#kota").val(obj[0].kota);
				}
			});
		}, 5000);
	});
</script>	

