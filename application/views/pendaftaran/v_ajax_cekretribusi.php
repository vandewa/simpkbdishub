<?php 
if(!empty($dt_kendaraan)){
	foreach($dt_kendaraan as $row){ 
	if($row->tgl_habis_uji==""){
		$hbs_uji = date("Y-m-d");
		$hbs_uji_txt = "";
	} else {
		$hbs_uji = $row->tgl_habis_uji;
		$hbs_uji_txt = strftime("%d %B %Y",strtotime($row->tgl_habis_uji));
	}?>
	
	<input type="hidden" id="jenis" value="<?php echo $row->jenis;?>"/>
	<input type="hidden" id="tgl_habis_uji" value="<?php echo $hbs_uji;?>"/>
	<input type="hidden" id="jenis_uji" value="Berkala"/>
	<input type="hidden" id="jbb" value="<?php echo $row->jbb;?>"/>
	

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Biaya Uji</label>
		<div class="col-sm-9">
			<input type="text" id="retribusi" name="retribusi" placeholder="Retribusi" class="col-xs-12" readonly />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Denda Uji</label>
		<div class="col-sm-9">
			<input type="text" id="jml_denda" name="jml_denda" class="col-xs-12" readonly />
			<input type="hidden" id="denda" name="denda" value="0" class="col-xs-12" />
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Total Biaya Uji</label>
		<div class="col-sm-9">
			<input type="text" id="total_semua" name="total_semua" placeholder="Total Retribusi" class="col-xs-12" readonly />
			<input type="hidden" id="total_retribusi" name="total_retribusi" value="" class="col-xs-12" readonly />
		</div>
	</div>
	

<?php }} else { ?>
<div class="alert alert-danger margin-bottom-30"><!-- DANGER -->
	<strong>Data Tidak Ditemukan !</strong>
</div>
<?php } ?>

<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/moment.min.js')?>"></script>
<script type="text/javascript">
	jQuery(function($) {
		setInterval(function(){
			var uji = $('#jenis_uji').val();
			var jns = $('#jenis').val();
			var jbb = parseFloat($('#jbb').val());
			
			$.ajax({
				url: "<?php echo base_url('beranda/get_retribusi'); ?>",
				type: 'GET',
				data: {
					'uji':uji,
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
			var mhb = hbs_uji.getMonth();
			var yhb = hbs_uji.getFullYear();
			if (dhb < 10) {
			  dhb = '0' + dhb;
			} 
			if (mhb < 10) {
			  mhb = '0' + mhb;
			}
			var hbs_uji = yhb + '-' + mhb + '-' + dhb;
			<?php $tgl = date("Y-m-d",strtotime('-1 days')); ?>
			var a = moment([<?php echo date("Y",strtotime($tgl));?>, <?php echo date("m",strtotime($tgl));?>, <?php echo date("d",strtotime($tgl));?>]);
			var b = moment([yhb, mhb, dhb]);
			var selisih = a.diff(b, 'months');
			
			if(a > b){
				denda = selisih;
			} else {
				denda = 0;
			}
			
			var ret = parseFloat($('#retribusi').val());
			
			var jml_denda = ret * denda * 0 ;
			var jml = ret+jml_denda;
			var jml_retribusi = ret;
			
			$('#denda').val(denda);
			$('#jml_denda').val(jml_denda);
			$('#total_retribusi').val(jml_retribusi);
			$('#total_semua').val(jml);
		}, 1000);
	});
</script>