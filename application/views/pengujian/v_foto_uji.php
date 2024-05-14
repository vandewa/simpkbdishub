<div class="page-content">
	
	<?php 
	if(isset($proses_uji_kendaraan)){
		foreach($proses_uji_kendaraan as $row){
			$kode_uji = $row->kode_uji;
			$no_uji = $row->no_uji;
		?>

		<div class="page-header">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<h1>
						Input Hasil Pengujian Kendaraan Bermotor
					</h1>
				</div>
			</div>
		</div>
	<form class="form-horizontal" role="form">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<input type="hidden" id="kode_uji" name="kode_uji" value="<?php echo $row->kode_uji;?>" />
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Pengujian </label>
					<div class="col-sm-8">
						<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>"  class="col-xs-12" readonly />
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
					<label class="col-sm-4 control-label no-padding-left"> Tanggal Pemeriksaan </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_uji" name="tgl_uji" type="text" value="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd"/>
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nama </label>
					<div class="col-sm-8">
						<input type="text" id="nama" name="nama" value="<?php echo $row->nama;?>"  class="col-xs-12" readonly />
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
		
		<h3 class="header smaller lighter blue">FOTO KENDARAAN</h3>
		
		<div class="row">
		<?php $no = 1;
		if(!empty($dt_foto)){
			foreach($dt_foto as $ft){?>
			<div class="col-xs-12 col-sm-6">
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
		</div>
		<?php } else { ?>
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA 1
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" name="cam2" id="cam1">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA 2
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" name="cam2" id="cam2">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA 3
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" name="cam3" id="cam3">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="smaller center">
							KAMERA 4
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main center">
							<img class="img-responsive" name="cam4" id="cam4">
						</div>
					</div>
				</div>
			</div>
			&nbsp;
			<div class="col-xs-12 text-center">
				<button type="submit" id="ambil_foto" class="btn btn-primary">
					<i class="ace-icon fa fa-camera align-top bigger-125"></i>
					Ambil Foto
				</button>
			</div>
			&nbsp;
		</div>
		
		<?php } ?>
		
		<div id="dt_foto"></div>
	
	<?php }} ?>
</div>

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
<script type="text/javascript">
	jQuery(function($) {
		
		/*
		cam1 = "<?php echo base_url('uji/get_cam1')?>";
		setInterval(function(){
			d = new Date();
			tmp = "?"+d.getTime();
			$("#cam1").attr("src", cam1+tmp);
		}, 2000);
		
		cam2 = "<?php echo base_url('uji/get_cam1')?>";
		setInterval(function(){
			d = new Date();
			tmp = "?"+d.getTime();
			$("#cam2").attr("src", cam2+tmp);
		}, 2000);
		*/
		
		cam1 = "http://admin:123456@192.168.1.20/images/snapshot.jpg";
		setInterval(function(){
			d = new Date();
			tmp = "?"+d.getTime();
			$("#cam1").attr("src", cam1+tmp);
		}, 2000);
		
		cam2 = "http://admin:123456@192.168.1.21/images/snapshot.jpg";
		setInterval(function(){
			d = new Date();
			tmp = "?"+d.getTime();
			$("#cam2").attr("src", cam2+tmp);
		}, 2000);
		
		cam3 = "http://admin:123456@192.168.1.22/images/snapshot.jpg";
		setInterval(function(){
			d = new Date();
			tmp = "?"+d.getTime();
			$("#cam3").attr("src", cam3+tmp);
		}, 2000);
		
		cam4 = "http://admin:123456@192.168.1.23/images/snapshot.jpg";
		setInterval(function(){
			d = new Date();
			tmp = "?"+d.getTime();
			$("#cam4").attr("src", cam4+tmp);
		}, 2000);
		
		$("#ambil_foto").click(function(){
			$("#dt_foto").load('<?php echo base_url('uji/get_foto_uji?kode='.$kode_uji.'&no='.$no_uji);?>');
		});
	});
</script>	