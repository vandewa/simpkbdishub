<div class="page-content">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="page-header">
				<h1>
					Laporan Jumlah KBWU Uji Pertama
				</h1>
			</div>
		</div>
	</div>
	
	
	<div class="row justify-content-center">
		<div class="col-lg-offset-1 col-lg-10 widget-container-col" id="widget-container-col-1">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">PILIH TANGGAL PENCARIAN</h5>
				</div>

				<div class="widget-body">
					<div class="widget-main text-center">
						<form class="form-inline" action="<?php echo site_url('laporan/rekap_ujitkc5')?>" method="get" target="_blank">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							
							<div class="row">
								<div class="col-xs-3">
									<select id="ttd" name="ttd" class="select2" data-placeholder="Pilih tanda tangan surat...">
										<option></option>
										<option value="kadis">Kepala Dinas</option>
										<option value="kabid">Kepala Bidang</option>
										<option value="kasie">Kepala Seksi</option>
									</select>
								</div>
								
								<div class="col-xs-3">
									<select id="rekap" name="rekap" class="select2" data-placeholder="Pilih jenis rekap...">
										<option value="">Bulanan</option>
										<option value="MONTH">Tahunan</option>
									</select>
								</div>
								<div class="col-xs-5">
									<div class="input-daterange input-group">
										<input type="text" name="awal" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal awal" />
										<span class="input-group-addon">
											<i class="fa fa-exchange"></i>
										</span>

										<input type="text" name="akhir" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal akhir" />
									</div>
								</div>
								<div class="col-xs-1">
									<button type="submit" class="btn btn-info btn-sm">
										<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
										Pilih
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