<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Kendaraan Berdasarkan Nomor Kendaraan atau Nomor Uji
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			
		</div>
		<div class="col-xs-12 col-sm-2">
		<form action="<?php echo site_url('laporan/rekap_kendaraan_no_kendaraan')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<select class="form-control" id="jenis" name="jenis">
				<option value="" selected>--Pilih Jenis Rekap--</option>
				<option value="no_uji">Nomor Uji</option>
				<option value="no_kendaraan">Nomor Kendaraan</option>
			</select>
		</div>
		
		<div class="col-xs-12 col-sm-1">
			<input type="text" name="no_depan" placeholder="No Depan" class="col-xs-12"/>
		</div>
		<div class="col-xs-12 col-sm-3">
			<div class="input-daterange input-group">
				<input type="text" name="no_awal" class="form-control" placeholder="Nomor Awal" />
				<span class="input-group-addon">
					<i class="fa fa-exchange"></i>
				</span>
				<input type="text" name="no_akhir" class="form-control" placeholder="Nomor Akhir" />
			</div>
		</div>
		<div class="col-xs-12 col-sm-1">
			<input type="text" name="no_belakang" placeholder="No Belakang" class="col-xs-12"/>
		</div>
		
		<div class="col-xs-12 col-sm-1" align="right">
			<div class="input-group">				
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Pilih
					</button>
				</span>
			</div>
		</form>
		</div>
	</div>
</div>