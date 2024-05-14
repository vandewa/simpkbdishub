<?php foreach($dt_antrian as $row){
	$urut = $row->jumlah+1;
	$sisa = 100-$urut;?>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-left"></label>
	<div class="col-sm-9">
		<div class="alert alert-info">
			<strong>Tersedia</strong>, anda antrian ke-<strong><?php echo $urut;?></strong>, sisa kuota : <strong><?php echo $sisa;?></strong>
		</div>
	</div>
</div>
												

<?php } ?>