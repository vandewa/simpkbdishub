<?php 
	$ci = &get_instance();
	$ci->load->model('model_laporan','laporan');
	
	$jbb1 = array("0","2501","5001","9001");
	$jbb2 = array("2500","5000","9000","100000");
	
	for ($i=0;$i<4; $i++) {
		for ($j=0;$j<4; $j++) {
			if($i==$j){
				$jml = $this->laporan->getStsJbb($tgl,$jbb1[$i],$jbb2[$j]);
				?>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBB <?php echo $jbb1[$i].' - '.$jbb2[$j]?> </label>
					<div class="col-sm-8">
						<input type="text" id="jbb<?php echo $i;?>" name="jbb<?php echo $i;?>" value="<?php foreach($jml as $row){ echo $row->total;}?>" class="col-xs-12" readonly />
					</div>
				</div>
				<?php
			}
		}
	}
?>
<?php foreach($dt_jbbkereta as $row){ ?>
<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Gandengan / Tempelan </label>
	<div class="col-sm-8">
		<input type="text" id="jbb4" name="jbb4" value="<?php echo $row->total?>" class="col-xs-12" readonly />
	</div>
</div>
<?php } ?>

<?php foreach($dt_jbbnumpang as $row){ ?>
<div class="form-group">
	<label class="col-sm-4 control-label no-padding-left"> Numpang / Mutasi </label>
	<div class="col-sm-8">
		<input type="text" id="nuk" name="nuk" value="<?php echo $row->total?>" class="col-xs-12" readonly />
	</div>
</div>
<?php } ?>