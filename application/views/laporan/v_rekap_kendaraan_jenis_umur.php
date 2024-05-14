<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Kendaraan Berdasarkan Jenis Kendaraan dan Umur
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-5">
		</div>
		<div class="col-xs-12 col-sm-3">
		<form action="<?php echo site_url('laporan/rekap_kendaraan_jenis_umur')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="col-sm-12">
				<select multiple="" id="jenis_kendaraan" name="jenis_kendaraan[]" class="select2" data-placeholder="Pilih jenis kendaraan...">
					<option value="*">SEMUA KENDARAAN</option>
					<?php foreach($kendaraan as $row){ ?>
					<option value="<?php echo $row->jenis;?>"><?php echo $row->jenis;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-2">
			<select class="form-control" id="operasi" name="operasi">
				<option value="=" selected>=</option>
				<option value=">=">Kurang dari</option>
				<option value="<=">Lebih dari</option>
			</select>
		</div>
		
		<div class="col-xs-12 col-sm-1">
			<input type="text" name="umur" placeholder="Usia Kendaraan" class="col-xs-12"/>
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