<div class="page-content">
	<div class="page-header">
		<h1>
			Ubah Pemilik Kendaraan Bermotor
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<?php 
			if(isset($data_pemilik)){
				foreach($data_pemilik as $row){
				?>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('kendaraan/proseseditpemilik/'.$row->id_user);?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Nomor KTP</label>
							<div class="col-sm-8">
								<input type="text" id="no_ktp" name="no_ktp" value="<?php echo $row->no_ktp;?>" placeholder="Nomor KTP" class="col-xs-12" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Nama</label>
							<div class="col-sm-8">
								<input type="text" id="nama" name="nama" value="<?php echo $row->nama;?>" placeholder="Nama" class="col-xs-12" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Alamat</label>
							<div class="col-sm-8">
								<textarea id="alamat" name="alamat" class="autosize-transition form-control"  placeholder="Alamat" ><?php echo $row->alamat;?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Kecamatan</label>
							<div class="col-sm-8">
								<select id="kecamatan" name="kecamatan" class="select2" data-placeholder="Pilih kecamatan...">
									<option value="">-</option>
									<option value="<?php echo $row->kecamatan;?>" selected><?php echo $row->kecamatan;?></option>
									<?php foreach($dt_kecamatan as $kec){ ?>
									<option value="<?php echo $kec->kecamatan;?>"><?php echo $kec->kecamatan;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Kota</label>
							<div class="col-sm-8">
								<input type="text" id="kota" name="kota" value="<?php echo $row->kota;?>" placeholder="Kota" class="col-xs-12" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Telepon</label>
							<div class="col-sm-8">
								<input type="text" id="telp" name="telp" value="<?php echo $row->telp;?>" placeholder="Telepon" class="col-xs-12" />
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6">
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Nomor Pengujian</label>
							<div class="col-sm-8">
								<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" placeholder="Nomor Pengujian" class="col-xs-12" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan</label>
							<div class="col-sm-8">
								<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>" placeholder="Nomor Kendaraan" class="col-xs-12" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-left"> Tgl Terbit STNK</label>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="form-control date-picker" id="tgl_stnk" name="tgl_stnk" type="text" value="<?php echo $row->tgl_stnk;?>" data-date-format="yyyy-mm-dd" />
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
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
			
			<h3 class="header smaller lighter blue"></h3>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
		});
	});
</script>