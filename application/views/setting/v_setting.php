<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<h1>
					Pengaturan Sistem
				</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#umum">
							<i class="blue ace-icon fa fa-cogs bigger-120"></i>
							Umum
						</a>
					</li>
				</ul>
				
				<div class="tab-content">
					<div id="umum" class="tab-pane fade in active">
						<?php 
						if(isset($dt_setting)){
							foreach($dt_setting as $row){
							?>
						<form class="form-horizontal" role="form" action="<?php echo site_url('setting/updateumum/'.$row->id)?>" method="post">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Dinas</label>
									<div class="col-sm-10">
										<input type="text" id="dinas" name="dinas" value="<?php echo $row->dinas;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Alamat</label>
									<div class="col-sm-10">
										<textarea id="alamat" name="alamat" class="autosize-transition form-control"  ><?php echo $row->alamat;?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Telepon</label>
									<div class="col-sm-10">
										<input type="text" id="telepon" name="telepon" value="<?php echo $row->telepon;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Email</label>
									<div class="col-sm-10">
										<input type="email" id="email" name="email" value="<?php echo $row->email;?>" class="col-xs-12"  />
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Kode Wilayah </label>
									<div class="col-sm-8">
										<select id="kodewilayah" name="kodewilayah" class="select2" data-placeholder="Pilih kode wilayah...">
											<option value="<?php echo $row->kodewilayah;?>" selected><?php echo $row->kodewilayah;?></option>
											<option></option>
											<?php foreach($dt_wilayah as $kdwil){ ?>
											<option value="<?php echo $kdwil->kodewilayah;?>"><?php echo $kdwil->namawilayah;?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Nama Wilayah </label>
									<div class="col-sm-8">
										<input type="text" id="namawilayah" name="namawilayah" value="<?php echo $row->namawilayah;?>" class="col-xs-12"  />
									</div>
								</div>
				
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Kode Smartcard</label>
									<div class="col-sm-8">
										<input type="text" id="kd_buku" name="kd_buku" value="<?php echo $row->kd_buku;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Kode Sertifikat</label>
									<div class="col-sm-8">
										<input type="text" id="kd_stiker" name="kd_stiker" value="<?php echo $row->kd_stiker;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> No WhatsApp</label>
									<div class="col-sm-8">
										<input type="text" id="no_wa" name="no_wa" value="<?php echo $row->no_wa;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> API WhatsApp</label>
									<div class="col-sm-8">
										<input type="text" id="api_wa" name="api_wa" value="<?php echo $row->api_wa;?>" class="col-xs-12"  />
									</div>
								</div>
							</div>
						</div>
						<?php 
							}
						} ?>
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
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.select2').css('width','300px').select2({allowClear:true})
	
	jQuery(function($) {
		$("#kodewilayah").on("select2:select",function(e){
			var kdwil = $("#kodewilayah").val();
			var post_data = {
			   'kdwil': kdwil,
			   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			};
			
			$.ajax({
				type: "post",
				url : "<?php echo base_url('setting/get_kode_wilayah'); ?>",
				cache: false,    
				data: post_data,
				success: function(response){
					var obj = JSON.parse(response);
					if(obj == ""){
						$("#namawilayah").val("");
					}
					else {
						$("#namawilayah").val(obj[0].namawilayah);
					}
				}
			});
		});
	});
</script>