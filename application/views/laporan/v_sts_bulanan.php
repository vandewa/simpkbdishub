<div class="page-content">
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div class="page-header">
				<h1>
					Laporan Setoran Bulanan
				</h1>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 pull-right">
			<form action="<?php echo site_url('laporan/rekap_sts_bulanan')?>" method="post" id="search-form">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="input-group">
					<div class="input-daterange input-group">
						<input type="text" name="tgl_awal" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal awal" />
						<span class="input-group-addon">
							<i class="fa fa-exchange"></i>
						</span>

						<input type="text" name="tgl_akhir" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal akhir" />
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
	<div id="formcari"></div>
</div>

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
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