<?php 
if(!empty($dt_kendaraan)){
	foreach($dt_kendaraan as $row){ 
	if($row->tgl_habis_uji==""){
		$hbs_uji = $row->temp_tgl_habis_uji;
		$hbs_uji_txt = strftime("%d %B %Y",strtotime($row->temp_tgl_habis_uji));
	} else {
		$hbs_uji = $row->tgl_habis_uji;
		$hbs_uji_txt = strftime("%d %B %Y",strtotime($row->tgl_habis_uji));
	}?>
	
	<input type="hidden" id="jenis" value="<?php echo $row->jenis;?>"/>
	<input type="hidden" id="tgl_habis_uji" value="<?php echo $hbs_uji;?>"/>
	<input type="hidden" id="jbb" value="<?php echo $row->jbb;?>"/>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Nomor Uji </label>
		<div class="col-sm-9">
			<input type="text" id="no_uji" name="no_uji" placeholder="Nomor Uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> No Kendaraan </label>
		<div class="col-sm-9">
			<input type="text" id="no_kendaraan" name="no_kendaraan" placeholder="Nomor Kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Jenis Kendaraan</label>
		<div class="col-sm-9">
			<input type="text" id="jenis_kendaraan" name="jenis_kendaraan" placeholder="Jenis kendaraan" value="<?php echo $row->jenis;?>/<?php echo $row->jenis_kendaraan;?>/<?php echo $row->bentuk;?>" class="col-xs-12" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Merek / Tipe </label>
		<div class="col-sm-9">
			<input type="text" id="merek" name="merek" placeholder="Merek" value="<?php echo $row->merek;?>/<?php echo $row->tipe;?>" class="col-xs-12" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Habis Uji</label>
		<div class="col-sm-9">
			<input type="text" id="hbs" name="hbs" placeholder="Habis Uji" value="<?php echo $hbs_uji_txt;?>" class="col-xs-12" />
		</div>
	</div>
	
	<!--
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Biaya Uji</label>
		<div class="col-sm-9">
			<input type="text" id="retribusi" name="retribusi" placeholder="Retribusi" class="col-xs-12" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Denda Uji</label>
		<div class="col-sm-9">
			<input type="text" id="jml_denda" name="jml_denda" class="col-xs-12" />
			<input type="hidden" id="denda" name="denda" value="0" class="col-xs-12" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Total Biaya Uji</label>
		<div class="col-sm-9">
			<input type="text" id="total_semua" name="total_semua" placeholder="Total Retribusi" class="col-xs-12"/>
		</div>
	</div>
	<br/><br/><br/>
	

<!--
<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<td>NO UJI</td>
			<td><?php echo $row->no_uji;?></td>
		</tr>
		<tr>
			<td>NO KENDARAAN</td>
			<td><?php echo $row->no_kendaraan;?></td>
		</tr>
		<tr>
			<td>JENIS</td>
			<td><?php echo $row->jenis;?> / <?php echo $row->jenis_kendaraan;?> / <?php echo $row->bentuk;?></td>
		</tr>
		<tr>
			<td>MERK / TIPE</td>
			<td><?php echo $row->merek;?> / <?php echo $row->tipe;?></td>
		</tr>
		<tr>
			<td>JBB</td>
			<td><?php echo $row->jbb;?></td>
		</tr>
		<tr>
			<td>HABIS UJI</td>
			<td><?php echo date("d M Y",strtotime($hbs_uji));?></td>
		</tr>
		<tr>
			<td>BIAYA UJI</td>
			<td>
				Rp <br/>
			</td>
			
		</tr>
		<tr>
			<td>DENDA</td>
			<td>
				Rp <br/>
			</td>
			
		</tr>
		<tr>
			<td>TOTAL BIAYA UJI</td>
			<td>
				Rp <br/>
				*Total Biaya uji belum termasuk jika ada pergantian tanda uji<br/>
				*Biaya pergantian tanda uji Rp <br/>
			</td>
			
		</tr>
	</table>
</div>
-->

<?php }} else { ?>
<div class="alert alert-danger margin-bottom-30"><!-- DANGER -->
	<strong>Data Tidak Ditemukan !</strong><br/>Harap masukan nomor pengujian atau nomor kendaraan anda dengan benar.
</div>
<?php } ?>

<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/moment.min.js')?>"></script>
<script type="text/javascript">
	jQuery(function($) {
		setInterval(function(){
			var jns = $('#jenis').val();
			var jbb = parseFloat($('#jbb').val());
			
			$.ajax({
				url: "<?php echo base_url('beranda/get_retribusi'); ?>",
				type: 'GET',
				data: {
					'jns':jns,
					'jbb':jbb,
				},
				success: function(data){
					var obj = JSON.parse(data);
					if(obj == ""){
						$("#retribusi").val("");
					}
					else {
						$("#retribusi").val(obj[0].tarif);
					}
				}
			});
			
			var hbs_uji = new Date($('#tgl_habis_uji').val());
			var dhb = hbs_uji.getDate();
			var mhb = hbs_uji.getMonth()+1;
			var yhb = hbs_uji.getFullYear();
			if (dhb < 10) {
			  dhb = '0' + dhb;
			} 
			if (mhb < 10) {
			  mhb = '0' + mhb;
			}
			var hbs_uji = yhb + '-' + mhb + '-' + dhb;
			
			var a = moment([<?php echo date("Y");?>, <?php echo date("m");?>, <?php echo date("d");?>]);
			var b = moment([yhb, mhb, dhb]);
			var selisih = a.diff(b, 'months');
			
			if(a > b){
				denda = selisih + 1;
			} else {
				denda = 0;
			}
			
			var ret = parseFloat($('#retribusi').val());
			
			var jml_denda = ret * denda * 0.02;
			var jml = ret+jml_denda;
			
			$('#denda').val(denda);
			$('#jml_denda').val(jml_denda);
			$('#total_semua').val(jml);
		}, 5000);
	});
</script>