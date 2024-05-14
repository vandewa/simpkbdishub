<div class="page-content">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="page-header">
				<h1>
					Laporan Jumlah KBWU Uji
				</h1>
			</div>
		</div>
	</div>
	
	
	<div class="row justify-content-center">
		<div class="col-lg-offset-2 col-lg-8 widget-container-col" id="widget-container-col-1">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">PILIH PENCARIAN</h5>
				</div>

				<div class="widget-body">
					<div class="widget-main text-center">
						<form class="form-inline" action="<?php echo site_url('laporan/rekap_ujitkc6')?>" method="post" id="search-form">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<select id="jenis" name="jenis" class="form-control" required>
								<option value="">Pilih Jenis Rekap</option>
								<option value="Jenis">Jenis Kendaraan</option>
								<option value="Bentuk">Bentuk Kendaraan</option>
							</select>
							
							<select id="status" name="status" class="form-control" required>
								<option value="">Pilih Jenis KBWU</option>
								<option value="semua">Semua</option>
								<option value="aktif">Aktif</option>
								<option value="tidak aktif">Tidak Aktif</option>
							</select>
							
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
	<br/>
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