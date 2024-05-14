<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pendaftaran Berdasarkan Jenis Permohonan Uji
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-5">
		</div>
		<div class="col-xs-12 col-sm-3">
		<form action="<?php echo site_url('laporan/pendaftaran_jenisuji_cari')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="col-sm-12">
				<select class="form-control" id="jenis_uji" name="jenis_uji" data-placeholder="Pilih jenis pendaftaran">
					<option value="">-- Pilih Jenis Permohonan Uji --</option>
					<option value="Pertama">Uji Pertama</option>
					<option value="Berkala">Uji Berkala</option>
					<option value="Numpang Masuk">Numpang Uji Masuk</option>
					<option value="Numpang Keluar">Numpang Uji Keluar</option>
					<option value="Mutasi Masuk">Mutasi Uji Masuk</option>
					<option value="Mutasi Keluar">Mutasi Uji Keluar</option>
					<option value="Penilaian Teknis">Penilaian Teknis</option>
					<option value="Penggantian buku uji atau stiker">Penggantian buku uji atau stiker</option>
					<option value="Kehilangan buku uji atau stiker">Kehilangan buku uji atau stiker</option>
				</select>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
			<div class="input-group">
				<div class="input-daterange input-group">
					<input type="text" name="tgl_awal" data-date-format="yyyy-mm-dd" class="form-control date-picker" placeholder="Tanggal awal"/>
					<span class="input-group-addon">
						<i class="fa fa-exchange"></i>
					</span>
					<input type="text" name="tgl_akhir" data-date-format="yyyy-mm-dd" class="form-control date-picker" placeholder="Tanggal akhir"/>
				</div>
				
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