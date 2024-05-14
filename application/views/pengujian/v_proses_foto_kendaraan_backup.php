<div class="page-content">
	<?php 
	if(isset($proses_uji_kendaraan)){
		foreach($proses_uji_kendaraan as $row){
			$kode_uji = $row->kode_uji;
			$no_uji = $row->no_uji;
		?>
		
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-10">
				<h1>
					Ambil Foto Kendaraan
				</h1>
			</div>
			
			<div class="col-xs-12 col-sm-2" align="right">
				<a href="<?php echo site_url('uji/uploadfoto/'.$kode_uji)?>">
					<button type="button" class="btn btn-warning">
						<i class="ace-icon fa fa-upload align-top bigger-125"></i>
						Upload Foto
					</button>
				</a>
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
		
		<h3 class="header smaller lighter blue"></h3>
		
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA DEPAN
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" name="cam1" id="cam1" src="http://admin:hik12345@192.168.1.201/Streaming/Channels/1/preview">
							<br/>
							<button type="button" id="ambilfoto1" class="btn btn-xs btn-primary">
								<i class="ace-icon fa fa-camera"></i>
								FOTO DEPAN
							</button>
							<br/>
							<div id="dt_foto1"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA BELAKANG
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" name="cam2" id="cam2" src="http://admin:hik12345@192.168.1.202/Streaming/Channels/1/preview">
							<br/>
							<button type="button" id="ambilfoto2" class="btn btn-xs btn-primary">
								<i class="ace-icon fa fa-camera"></i>
								FOTO BELAKANG
							</button>
							<br/>
							<div id="dt_foto2"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA KIRI
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" name="cam3" id="cam3" src="http://admin:hik12345@192.168.1.203/Streaming/Channels/1/preview">
							<br/>
							<button type="button" id="ambilfoto3" class="btn btn-xs btn-primary">
								<i class="ace-icon fa fa-camera"></i>
								FOTO KIRI
							</button>
							<br/>
							<div id="dt_foto3"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA KANAN
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" name="cam4" id="cam4" src="http://admin:hik12345@192.168.1.204/Streaming/Channels/1/preview">
							<br/>
							<button type="button" id="ambilfoto4" class="btn btn-xs btn-primary">
								<i class="ace-icon fa fa-camera"></i>
								FOTO KANAN
							</button>
							<br/>
							<div id="dt_foto4"></div>
						</div>
					</div>
				</div>
			</div>
			&nbsp;
			
			
			<?php $no = 1;
			if(!empty($dt_foto)){ ?>
			<h3 class="header smaller lighter blue">HASIL FOTO KENDARAAN</h3>
			
			<div class="row">
			<?php foreach($dt_foto as $ft){?>
				<div class="col-xs-6 col-sm-3">
					<div class="widget-box">
						<div class="widget-header">
							<h4 class="smaller center">
								KAMERA <?php echo $no++;?>
							</h4>
						</div>
						<div class="widget-body">
							<div class="widget-main center">
								<img class="img-responsive" src="<?php echo base_url('files/foto/'.$ft->kode_uji.'/'.$ft->foto);?>">
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			&nbsp;
				<div class="col-xs-12 text-center">
					<a href="<?php echo site_url('uji/hapusfoto?id='.$kode_uji.'&redirect='.$redirect); ?>" class="btn btn-danger btn-bold" data-rel="tooltip" onclick="return confirm('Anda yakin akan menghapus foto?')" title="Hapus foto">
						Hapus Foto <i class="ace-icon fa fa-trash bigger-120"></i>
					</a>
				</div>
			</div>
			
			<?php } else { ?>
			
			<div class="col-xs-12 text-center">
				<button type="button" id="ambil_foto" class="btn btn-primary">
					<i class="ace-icon fa fa-camera align-top bigger-125"></i>
					FOTO SEMUA SISI
				</button>
			</div>
			&nbsp;
			<div id="dt_foto"></div>
			
			<?php } ?>
		</div>
		
	<form class="form-horizontal" role="form" action="<?php echo site_url('uji/proses_foto_kendaraan?kode='.$row->kode_uji.'&no='.$row->no_uji)?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	
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

<script type="text/javascript">
	jQuery(function($) {
		$("#ambil_foto").click(function(){
			$("#dt_foto").load('<?php echo base_url('uji/get_foto_uji?kode='.$kode_uji.'&no='.$no_uji);?>');
			/*
			setTimeout(function() {
				window.location = window.location.href;
			}, 5000);
			*/
		});
		
		$("#ambilfoto1").click(function(){
			$("#dt_foto1").load('<?php echo base_url('uji/get_foto_kamera?cam=0&kode='.$kode_uji.'&no='.$no_uji);?>');
		});
		
		$("#ambilfoto2").click(function(){
			$("#dt_foto2").load('<?php echo base_url('uji/get_foto_kamera?cam=1&kode='.$kode_uji.'&no='.$no_uji);?>');
		});
		
		$("#ambilfoto3").click(function(){
			$("#dt_foto3").load('<?php echo base_url('uji/get_foto_kamera?cam=2&kode='.$kode_uji.'&no='.$no_uji);?>');
		});
		
		$("#ambilfoto4").click(function(){
			$("#dt_foto4").load('<?php echo base_url('uji/get_foto_kamera?cam=3&kode='.$kode_uji.'&no='.$no_uji);?>');
		});
	});
</script>	