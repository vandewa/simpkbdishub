<div class="row">
	<?php foreach($dt_foto as $ft){ ?>
	<div class="col-sm-6 col-lg-6">
		<div class="card-img-actions m-1">
			<img class="card-img img-fluid" src="<?php echo base_url('files/foto/'.$ft->kode_uji.'/'.$ft->foto);?>" alt="">
		</div>
	</div>
	<?php } ?>
</div>