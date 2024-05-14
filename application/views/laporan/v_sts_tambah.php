<div class="page-content">
	
	<div class="page-header">
		<h1>
			Buat Surat Tanda Setoran
		</h1>
	</div>
	<form class="form-horizontal" role="form" action="<?php echo site_url('laporan/proses_tambah_sts')?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanggal STS</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_sts" name="tgl_sts" value="<?php echo date("Y-m-d");?>" type="text" placeholder="Pilih Tanggal STS" data-date-format="yyyy-mm-dd" />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Setoran </label>
					<div class="col-sm-8">
						<input type="text" id="no_sts" name="no_sts" value="<?php echo $no_sts;?>" class="col-xs-12"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Biaya Uji </label>
					<div class="col-sm-8">
						<input type="text" id="retribusi" name="retribusi" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Denda Uji</label>
					<div class="col-sm-8">
						<input type="text" id="denda" name="denda" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanda Uji </label>
					<div class="col-sm-8">
						<input type="text" id="tanda" name="tanda" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Total Retribusi </label>
					<div class="col-sm-8">
						<input type="text" id="total" name="total" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Terbilang </label>
					<div class="col-sm-8">
						<input type="text" id="terbilang" name="terbilang" value="" class="col-xs-12" readonly />
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div id="form_jbb"></div>
			</div>
		</div>
		
		
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
</div>

<script type="text/javascript">
	jQuery(function($) {		
		setInterval(function(){
			var tgl = $("#tgl_sts").val();
			
			$.ajax({
				url: "<?php echo base_url('laporan/ajax_tambah_sts'); ?>",
				type: 'GET',
				data: {
					'tgl':tgl,
				},
				success: function(data){
					$('#form_jbb').html(data)
				},
				failed: function(data){
					alert('Gagal mendapatkan data');
				}
			});
			
			$.ajax({
				url: "<?php echo base_url('laporan/get_jumlah_sts'); ?>",
				type: 'GET',
				data: {
					'tgl':tgl,
				},
				success: function(data){
					var obj = JSON.parse(data);
					if(obj == ""){
						$("#retribusi").val("");
						$("#tanda").val("");
						$("#denda").val("");
					}
					else {
						$("#retribusi").val(obj[0].total_retribusi);
						$("#tanda").val(obj[0].total_tanda);
						$("#denda").val(obj[0].total_denda);
					}
				},
				failed: function(data){
					alert('Gagal mendapatkan data');
				}
			});
			
			$.ajax({
				url: "<?php echo base_url('laporan/get_total_sts'); ?>",
				type: 'GET',
				data: {
					'tgl':tgl,
				},
				success: function(data){
					var obj = JSON.parse(data);
					if(obj == ""){
						$("#total").val("");
					}
					else {
						$("#total").val(obj[0].jml_total_semua);
					}
				},
				failed: function(data){
					alert('Gagal mendapatkan data');
				}
			});
			
			/*
			var jml;
			var a = parseFloat($('#retribusi').val());
			var b = parseFloat($('#tanda').val());
			var c = parseFloat($('#denda').val());
			
			jml=a+b+c;

			$('#total').val(jml);
			*/
			
			var total = parseFloat($('#total').val());
			var th = ['','Ribu','Juta', 'Milyar','Triliun'];
			var dg = ['Nol','Satu','Dua','Tiga','Empat', 'Lima','Enam','Tujuh','Delapan','Sembilan']; var tn = ['Sepuluh','Sebelas','Dua Belas','Tiga Belas', 'Empat Belas','Lima Belas','Enam Belas', 'Tujuh Belas','Delapan Belas','Sembilan Belas']; var tw = ['Dua Puluh','Tiga Puluh','Empat Puluh','Lima Puluh', 'Enam Puluh','Tujuh Puluh','Delapan Puluh','Sembilan Puluh'];
			function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'Bukan Angka'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'Angka Terlalu Besar'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'Ratus ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'Koma '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ').replace("Satu Ratus","Seratus").replace("Satu Ribu","Seribu").replace("Satu Puluh","Sepuluh");}
			
			$('#terbilang').val(toWords(total));
		}, 1000);
	});
</script>