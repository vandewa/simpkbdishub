<div class="content">
	<div class="card border-top-3 border-top-info border-bottom-3 border-bottom-info rounded-0">		
		<div class="card-header bg-info text-white header-elements-inline">
			<h6 class="card-title">FORMULIR SURVEY KEPUASAN MASYARAKAT</h6>
		</div>
		
		<div class="card-body">
		<form class="form-validate-jquery" action="<?php echo site_url('beranda/prosesikm/'.$this->uri->segment(3));?>" method="post" data-fouc>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">USIA</label>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" data-fouc>
						Kurang 20
					</label>
				</div>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" data-fouc>
						21 - 30
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" data-fouc>
						31 - 40
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" data-fouc>
						41 - 50
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" data-fouc>
						51 - 60
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" data-fouc>
						Lebih 60
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">JENIS KELAMIN</label>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="jenis_kelamin" data-fouc>
						Laki-Laki
					</label>
				</div>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="jenis_kelamin" data-fouc>
						Perempuan
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">PENDIDIKAN TERAKHIR</label>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" data-fouc>
						SD
					</label>
				</div>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" data-fouc>
						SMP
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" data-fouc>
						SMA
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" data-fouc>
						Diploma
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" data-fouc>
						Sarjana
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" data-fouc>
						Tidak Tamat
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">PEKERJAAN</label>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" data-fouc>
						Sopir
					</label>
				</div>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" data-fouc>
						Wirausaha
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" data-fouc>
						Pegawai Swasta
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" data-fouc>
						PNS/TNI/POLRI
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" data-fouc>
						Lainnya
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-semibold">1. Seberapa puaskah anda dengan pelayanan yang kami berikan?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kepuasan" value="5" data-fouc required>
						Sangat Puas
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kepuasan" value="4" data-fouc>
						Puas
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kepuasan" value="3" data-fouc>
						Cukup Puas
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kepuasan" value="2" data-fouc>
						Kurang Puas
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kepuasan" value="1" data-fouc>
						Tidak Puas
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-semibold">2. Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="5" data-fouc required>
						Sangat Cepat
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="4" data-fouc>
						Cepat
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="3" data-fouc>
						Normal
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="2" data-fouc>
						Lambat
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="1" data-fouc>
						Sangat Lambat
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-semibold">3. Bagaimana saran dan masukan saudara guna meningkatkan pelayanan kami ?</label>
				<textarea class="form-control" rows="2" name="saran" id="saran" placeholder="Ketik kritik dan saran disini"></textarea>
			</div>
			
			<div class="text-center">
				<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin mengirim survey kepuasan masyarakat ?')">Kirim Data <i class="icon-paperplane ml-2"></i></button>
			</div>
		</form>
		</div>
	</div>
</div>