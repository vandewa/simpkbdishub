<?php
if(isset($detail_retribusi)){
    foreach($detail_retribusi as $row){
        ?>

		<input type="hidden" name="kd_tarif" value="<?php echo $row->kd_tarif;?>">
		<input type="hidden" name="kd_barang" value="<?php echo $row->kd_barang;?>">
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-left"> Jenis Retribusi </label>
			<div class="col-sm-9">
				<input type="text" id="jenis" name="jenis" value="<?php echo $row->jenis;?>" class="col-xs-12" readonly />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-left"> Sifat </label>
			<div class="col-sm-6">
				<input type="text" id="sifat" name="sifat" value="<?php echo $row->sifat;?>" class="col-xs-12" readonly />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-left"> Retribusi </label>
			<div class="col-sm-6">
				<input type="text" id="tarif" name="tarif" value="<?php echo $row->tarif;?>" class="col-xs-12" readonly />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-left"> jumlah Pengadaaan </label>
			<div class="col-sm-6">
				<input type="text" id="qty" name="qty" class="col-xs-12" placeholder="Masukan jumlah pengadaan" />
			</div>
		</div>
		
    <?php
    }
}
?>
