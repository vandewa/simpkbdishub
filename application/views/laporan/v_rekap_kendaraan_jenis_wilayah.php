<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Kendaraan Berdasarkan Jenis Kendaraan dan Wilayah
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-2">
		</div>
		<div class="col-xs-12 col-sm-3">
		<form action="<?php echo site_url('laporan/rekap_kendaraan_jenis_wilayah')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="col-sm-12">
				<select multiple="" id="jenis_kendaraan" name="jenis_kendaraan[]" class="select2" data-placeholder="Pilih jenis kendaraan...">
					<?php foreach($kendaraan as $row){ ?>
					<option value="<?php echo $row->jenis;?>"><?php echo $row->jenis;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<div class="col-sm-12">
				<select multiple="" id="wilayah_kendaraan" name="wilayah_kendaraan[]" class="select2" data-placeholder="Pilih wilayah kendaraan...">
					<?php foreach($wilayah as $row){ ?>
					<option value="<?php echo $row->kecamatan;?>"><?php echo $row->kecamatan;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<div class="col-sm-12">
				<select multiple="" name="sorting" class="select2" data-placeholder="Urutkan berdasar...">
					<option value="">&nbsp;</option>
					<option value="no_uji">NOMOR UJI</option>
					<option value="jenis">JENIS KENDARAAN</option>
					<option value="tgl_habis_uji">MASA BERLAKU</option>
					<option value="kecamatan">WILAYAH</option>
				</select>
			</div>
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