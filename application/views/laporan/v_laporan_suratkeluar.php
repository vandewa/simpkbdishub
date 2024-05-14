<div class="page-content">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="page-header">
				<h1>
					Laporan Surat Uji Keluar Kendaraan
				</h1>
			</div>
		</div>
	</div>
	
	
	<div class="row justify-content-center">
		<div class="col-lg-offset-2 col-lg-8 widget-container-col" id="widget-container-col-1">
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
					<div class="widget-main text-center">
						<form class="form-inline" action="<?php echo site_url('laporan/rekap_suratkeluar')?>" method="get" id="search-form">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<select id="rekap" name="rekap" class="form-control" required>
								<option value="">Pilih Jenis Surat</option>
								<option value="numpang">Numpang</option>
								<option value="mutasi">Mutasi</option>
							</select>
									
							<div class="input-group">
								<div class="input-daterange input-group">
									<input type="text" name="awal" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal awal" />
									<span class="input-group-addon">
										<i class="fa fa-exchange"></i>
									</span>
									<input type="text" name="akhir" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal akhir" />
								</div>
							</div>
							
							<button type="submit" class="btn btn-info btn-sm">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								Pilih
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	&nbsp;
	<div id="formcari"></div>
</div>

<script type="text/javascript">
	$('#search-form').submit(function(e) {
		e.preventDefault();
		$.ajax({
			type:$(this).attr('method'),
			url:$(this).attr('action'),
			data:$(this).serialize(),
			success:function(data){
				$('#formcari').html(data)
			}
		});
	});
</script>