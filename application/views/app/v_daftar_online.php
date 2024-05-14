<div class="content">
	<div class="card border-top-3 border-top-primary border-bottom-3 border-bottom-primary rounded-0">		
		<div class="card-header bg-primary text-white header-elements-inline">
			<h6 class="card-title">FORMULIR PENDAFTARAN ONLINE</h6>
		</div>
		
		<div class="card-body">
		<form class="form-validate-jquery" action="<?php echo site_url('beranda/prosesikm/'.$this->uri->segment(3));?>" method="post" data-fouc>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">			
			<div class="form-group row">
				<label class="col-lg-3 col-form-label" for="tgl_booking">Tanggal Booking</label>
				<div class="col-lg-9">
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text">
								<i class="icon-calendar"></i>
							</span>
						</span>
						<input type="text" class="form-control daterange-single" id="tgl_booking" name="tgl_booking" placeholder="Pilih tanggal booking" data-date-format="yyyy-mm-dd">
					</div>
				</div>
			</div>
						
			<div class="form-group row">
				<label class="col-lg-2 col-form-label" for="no_uji">No Uji</label>
				<div class="col-lg-4">
					<input type="text" class="form-control" name="no_uji" id="no_uji" placeholder="Nomor uji kendaraan" required>
					<span class="badge d-block badge-warning form-text text-left">NOMOR KENDARAAN TANPA SPASI, Contoh : AD1234BKA</span>
				</div>
			</div>
			
			<div class="text-center">
				<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin mengirim survey kepuasan masyarakat ?')">Kirim Data <i class="icon-paperplane ml-2"></i></button>
			</div>
		</form>
		</div>
	</div>
</div>