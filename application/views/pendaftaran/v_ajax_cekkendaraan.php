<?php 
if(!empty($dt_kendaraan)){
	foreach($dt_kendaraan as $row){ 
	if($row->status=="0") { ?>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Nomor Kendaraan </label>
		<div class="col-sm-9">
			<input type="text" id="no_kendaraan" name="no_kendaraan" placeholder="Nomor Kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" readonly />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Nama Pemilik </label>
		<div class="col-sm-9">
			<input type="text" id="nama" name="nama" placeholder="Nama Pemilik" class="col-xs-12" value="<?php echo $row->nama;?>" readonly />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Alamat </label>
		<div class="col-sm-9">
			<textarea class="form-control limited" id="alamat" name="alamat" placeholder="Alamat" maxlength="50" readonly><?php echo $row->alamat;?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Kecamatan </label>
		<div class="col-sm-9">
			<input type="text" id="kecamatan" name="kecamatan" placeholder="Kecamatan" class="col-xs-12" value="<?php echo $row->kecamatan;?>" readonly />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Nomor Whatsapp </label>
		<div class="col-sm-9">
			<input type="tel" id="telp" name="telp" placeholder="Nomor Whatsapp" class="col-xs-12" required />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Metode Pembayaran </label>
		<div class="col-sm-9">
			<select class="select2" id="metode_bayar" name="metode_bayar" data-placeholder="Pilih metode pembayaran" required >
				<option></option>
				<option value="tunai">Tunai (Agen Lakupandai pada loket)</option>
				<option value="online">Online (Internet Banking, M-Banking, ATM Bank BPD Jateng)</option>
			</select>
		</div>
	</div>
	
	<div id="form_pembayaran"></div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-left"> Pernyataan Pendaftaran </label>
		<label class="col-sm-9">
			<input type="checkbox" name="pernyataan" class="ace input-lg" value="1" required />
			<span class="lbl text-justify"> Dengan ini saya menyatakan bahwa data pendaftaran uji kendaraan ini adalah benar dan saya bersedia untuk melaksanakan pengujian kendaraan dengan batas masa waktu uji berlakunya kendaraan saya. Jika saya melakukan pengujian melebihi batas waktu uji, saya siap menerima sanksi yang berlaku.</span>
		</label>
	</div>
	
	<div class="form-actions center">
		<button type="submit" onclick="return confirm('Anda yakin data pendaftaran sudah benar?')" class="btn btn-lg btn-info">
			DAFTARKAN
			<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
		</button>
	</div>
												
	<?php } else { ?>
	<div class="alert alert-danger text-center"><!-- DANGER -->
		<strong>Kendaraan diblokir, Silahkan hubungi UPUBKB Dinas Perhubungan Kabupaten Tegal.</strong><br/>
		<a href="https://wa.me/6289518555280" target="_blank" class="btn btn-xs btn-warning">
			Hubungi Kami <i class="ace-icon fa fa-whatsapp icon-on-right bigger-110"></i>
		</a>
	</div>
	<?php } ?>
<?php }} else { ?>
<div class="alert alert-danger margin-bottom-30"><!-- DANGER -->
	<strong>Data Tidak Ditemukan !</strong>
</div>
<?php } ?>

<script type="text/javascript">
	jQuery(function($) {		
		$('.select2').css('width','100%').select2({allowClear:true})
		
		$("#metode_bayar").on("change",function(e){
			if($(this).val()==="online"){
				var no_uji = $("#no_uji").val();
				$('#form_pembayaran').empty();
				
				var post_data = {
				   'no_uji': no_uji,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
						
				$.ajax({
					url: "<?php echo base_url('bookingonline/biaya'); ?>",
					type: "post",
					data: post_data,
					success: function(data){
						$('#form_pembayaran').html(data);
					},
					failed: function(data){
						alert('Gagal mendapatkan data');
					}
				});
			} else {
				$('#form_pembayaran').empty();
			}
		});
	});
</script>