<div class="page-content">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="page-header">
				<h1>
					Laporan Muatan Sumbu Terberat, Jenis Kendaraan, dan Sifat Kendaraan (TKC-4)
				</h1>
			</div>
		</div>
	</div>
	
	
	<div class="row justify-content-center">
		<div class="col-lg-offset-1 col-lg-10 widget-container-col" id="widget-container-col-1">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">PILIH TANGGAL PENCARIAN</h5>

					<div class="widget-toolbar">
						<a href="#" data-action="close">
							<i class="ace-icon fa fa-times"></i>
						</a>
					</div>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<form action="<?php echo site_url('laporan/rekap_ujitkc4')?>" method="get" target="_blank">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="row">
								<div class="col-xs-4">
									<select id="ttd" name="ttd" class="select2" data-placeholder="Pilih tanda tangan surat...">
										<option></option>
										<option value="kadis">Kepala Dinas</option>
										<option value="kabid">Kepala Bidang</option>
										<option value="kasie">Kepala Seksi</option>
									</select>
								</div>

								<div class="col-xs-6">
									<div class="input-daterange input-group">
										<input type="text" name="awal" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal awal" />
										<span class="input-group-addon">
											<i class="fa fa-exchange"></i>
										</span>

										<input type="text" name="akhir" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal akhir" />
									</div>
								</div>
								<div class="col-xs-2">
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