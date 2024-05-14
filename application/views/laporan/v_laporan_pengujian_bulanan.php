<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Uji Kendaraan
		</h1>
	</div>
	<form class="form-horizontal" role="form" action="<?php echo site_url('laporan/ajax_pengujian_bulanan')?>" method="post" id="search-form">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<div class="row">
		<div class="col-xs-12 col-sm-5">
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
				<div class="col-sm-8">
					<select id="jenis_kendaraan" name="jenis_kendaraan" class="form-control" data-placeholder="Pilih jenis kendaraan...">
						<option>-</option>
						<option value="MOBIL PENUMPANG">MOBIL PENUMPANG</option>
						<option value="MOBIL BUS">MOBIL BUS</option>
						<option value="MOBIL BARANG">MOBIL BARANG</option>
						<option value="KENDARAN KHUSUS">KENDARAAN KHUSUS</option>
						<option value="KERETA GANDENGAN">KERETA GANDENGAN</option>
						<option value="KERETA TEMPELAN">KERETA TEMPELAN</option>
						<option value="MOBIL PENARIK">MOBIL PENARIK</option>
						<option value="KENDARAAN BERMOTOR RODA 3">KENDARAAN BERMOTOR RODA 3</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-left"> Status </label>
				<div class="col-sm-8">
					<select class="form-control" id="status" name="status" data-placeholder="Pilih status">
						<option value=""></option>
						<option value="Umum">Umum</option>
						<option value="Tidak Umum">Tidak Umum</option>
						<option value="Pemerintah">Pemerintah</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-left"> Tahun </label>
				<div class="col-sm-8">
					<div class="input-group">
						<div class="input-group">
							<input type="text" id="tahun_awal" name="tahun_awal" placeholder="Tahun awal" class="col-xs-12" />
							<span class="input-group-addon">
								<i class="fa fa-exchange"></i>
							</span>
							<input type="text" id="tahun_akhir" name="tahun_akhir" placeholder="Tahun akhir" class="col-xs-12" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-left"> JBB </label>
				<div class="col-sm-8">
					<div class="input-group">
						<div class="input-group">
							<input type="text" id="jbb_awal" name="jbb_awal" placeholder="jbb awal" class="col-xs-12" />
							<span class="input-group-addon">
								<i class="fa fa-exchange"></i>
							</span>
							<input type="text" id="jbb_akhir" name="jbb_akhir" placeholder="jbb akhir" class="col-xs-12"/>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-left"> Tanggal Daftar </label>
				<div class="col-sm-8">
					<div class="input-group">
						<div class="input-daterange input-group">
							<input type="text" name="tgl_awal" data-date-format="yyyy-mm-dd" class="form-control date-picker" placeholder="Tanggal awal"/>
							<span class="input-group-addon">
								<i class="fa fa-exchange"></i>
							</span>

							<input type="text" name="tgl_akhir" data-date-format="yyyy-mm-dd" class="form-control date-picker" placeholder="Tanggal akhir" />
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4"></label>
				<div class="col-sm-8">
					<button class="btn btn-primary" type="submit">
						<i class="ace-icon fa fa-check"></i>
						Kirim
					</button>
				</div>
			</div>
			
			<div id="formcari"></div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>;
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