<div class="content">
	<div class="card border-top-3 border-top-info border-bottom-3 border-bottom-info rounded-0">		
		<div class="card-header bg-info text-white header-elements-inline">
			<h6 class="card-title">FORMULIR SURVEY KEPUASAN MASYARAKAT</h6>
		</div>
		
		<div class="card-body">
		<form class="form-validate-jquery" action="<?php echo site_url('app/prosesikm/'.$this->uri->segment(3));?>" method="post" data-fouc>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">USIA ANDA</label>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" value="Kurang 20" data-fouc required>
						Kurang 20
					</label>
				</div>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" value="21 - 31" data-fouc>
						21 - 30
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" value="31 - 40" data-fouc>
						31 - 40
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" value="41 - 50" data-fouc>
						41 - 50
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" value="51 - 60" data-fouc>
						51 - 60
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="usia" value="Lebih 60" data-fouc>
						Lebih 60
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">JENIS KELAMIN</label>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="jenis_kelamin" value="Laki-Laki" data-fouc required>
						Laki-Laki
					</label>
				</div>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="jenis_kelamin" value="Perempuan" data-fouc>
						Perempuan
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">PENDIDIKAN TERAKHIR</label>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" value="SD" data-fouc required>
						SD
					</label>
				</div>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" value="SMP" data-fouc>
						SMP
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" value="SMA" data-fouc>
						SMA
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" value="Diploma" data-fouc>
						Diploma
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" value="Sarjana" data-fouc>
						Sarjana
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pendidikan" value="Tidak Tamat" data-fouc>
						Tidak Tamat
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">PEKERJAAN</label>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" value="Sopir" data-fouc required>
						Sopir
					</label>
				</div>

				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" value="Wirausaha" data-fouc>
						Wirausaha
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" value="Pegawai Swasta" data-fouc>
						Pegawai Swasta
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" value="PNS/TNI/POLRI" data-fouc>
						PNS/TNI/POLRI
					</label>
				</div>
				
				<div class="form-check form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="pekerjaan" value="Lainnya" data-fouc>
						Lainnya
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">1. Bagaimana kesesuaian persyaratan untuk memperoleh pelayanan uji kendaraan?</label>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kesesuaian" value="4" data-fouc required>
						Sangat Sesuai
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kesesuaian" value="3" data-fouc>
						Sesuai
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kesesuaian" value="2" data-fouc>
						Kurang Sesuai
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kesesuaian" value="1" data-fouc>
						Tidak Sesuai
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">2. Bagaimana kemudahan prosedur pelayanan uji kendaraan?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kemudahan" value="4" data-fouc required>
						Sangat Mudah
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kemudahan" value="3" data-fouc>
						Mudah
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kemudahan" value="2" data-fouc>
						Kurang Mudah
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kemudahan" value="1" data-fouc>
						Tidak Mudah
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">3. Bagaimana kecepatan waktu petugas dalam memberikan pelayanan?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="4" data-fouc required>
						Sangat Cepat
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="3" data-fouc>
						Cepat
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="2" data-fouc>
						Kurang Cepat
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kecepatan" value="1" data-fouc>
						Tidak Cepat
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">4. Bagaimana pendapat Saudara tentang sistem informasi pelayanan publik di pelayanan uji kendaraan?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="sistem" value="4" data-fouc required>
						Dikelola dengan Baik
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="sistem" value="3" data-fouc>
						Berfungsi kurang Maksimal
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="sistem" value="2" data-fouc>
						Ada tetapi tidak Berfungsi
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="sistem" value="1" data-fouc>
						Tidak Ada
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">5. Bagaimana pendapat Saudara tentang kemampuan/ kompetensi petugas dalam memberikan pelayanan?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kompetensi" value="4" data-fouc required>
						Sangat Kompeten
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kompetensi" value="3" data-fouc>
						Kompeten
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kompetensi" value="2" data-fouc>
						Kurang Kompeten
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kompetensi" value="1" data-fouc>
						Tidak Kompeten
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">6. Bagaimana Pendapat Saudara perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kesopanan" value="4" data-fouc required>
						Sangat Sopan dan Ramah
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kesopanan" value="3" data-fouc>
						Sopan dan Ramah
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kesopanan" value="2" data-fouc>
						Kurang Sopan dan Ramah
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="kesopanan" value="1" data-fouc>
						Tidak Sopan dan Ramah
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-bold">7. Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="sarana" value="4" data-fouc required>
						Sangat Baik
					</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="sarana" value="3" data-fouc>
						Baik
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="sarana" value="2" data-fouc>
						Cukup
					</label>
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-input-styled" name="sarana" value="1" data-fouc>
						Buruk
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="d-block font-size-lg font-weight-semibold">8. Bagaimana saran dan masukan saudara guna meningkatkan pelayanan kami?</label>
				<textarea class="form-control" rows="2" name="saran" id="saran" placeholder="Ketik kritik dan saran disini"></textarea>
			</div>
			
			<div class="text-center">
				<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin mengirim survey kepuasan masyarakat ?')">Kirim Data <i class="icon-paperplane ml-2"></i></button>
			</div>
		</form>
		</div>
	</div>
</div>