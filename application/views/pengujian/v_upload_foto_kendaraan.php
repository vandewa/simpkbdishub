<div class="page-content">
	<?php 
	if(isset($dt_kendaraan)){
		foreach($dt_kendaraan as $row){
			$kode_uji = $row->kode_uji;
			$no_uji = $row->no_uji;
		?>
		
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-10">
				<h1>
					Upload Foto Kendaraan
				</h1>
			</div>
		</div>
	</div>
	<form class="form-horizontal" role="form">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Pengujian </label>
					<div class="col-sm-8">
						<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="jenis" name="jenis" class="col-xs-12" value="<?php echo $row->jenis;?>"  readonly />
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>"  class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Merk dan Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="merktipe" name="merktipe" class="col-xs-12" value="<?php echo $row->merek;?> / <?php echo $row->tipe;?>" readonly />
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form class="form-horizontal" role="form" action="<?php echo site_url('uji/proses_uploadfoto?kode='.$row->kode_uji.'&no='.$row->no_uji)?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	
		
		<h3 class="header smaller lighter blue"></h3>
		
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA DEPAN
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<input type="file" id="foto1" name="foto[]"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA BELAKANG
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<input type="file" id="foto2" name="foto[]"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA KIRI
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<input type="file" id="foto3" name="foto[]"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA KANAN
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<input type="file" id="foto4" name="foto[]"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<h3 class="header smaller lighter blue"></h3>
				
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Kirim
				</button>

				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</div>
	</form>
	<?php } } ?>
</div>

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
<script type="text/javascript">
	jQuery(function($) {
		
	});
</script>	