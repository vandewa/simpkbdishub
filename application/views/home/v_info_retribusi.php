<section class="nopadding">
	<div class="container">		
		<div class="row">
			<div class="col-md-12">
				<header class="text-center margin-top-40">
					<h3 class="weight-300">INFORMASI BIAYA PENGUJIAN KENDARAAN BERMOTOR</h3>
					<h2 class="weight-200 letter-spacing-1 size-17"><span>DINAS PERHUBUNGAN KABUPATEN WONOSOBO</span></h2>
				</header>
				
				<div class="divider divider-center divider-color">
					<i class="fa fa-chevron-down"></i>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8">
				<header class="text-center margin-bottom-10">
					<h4 class="weight-600">TARIF RETRIBUSI PENGUJIAN</h4>
					<h4 class="weight-200 letter-spacing-1 size-13"><span>DASAR : PERDA KABUPATEN WONOSOBO NO 5 TAHUN 2019</span></h4>
				</header>
				
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><i class="fa fa-truck pull-right hidden-xs"></i> JENIS</th>
								<th><i class="fa fa-money pull-right hidden-xs"></i> TARIF</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><strong>Uji Kendaraan Baru</strong></td>
								<td></td>
							</tr>
							<tr>
								<td>Mobil Penumpang Umum (Taxi)</td>
								<td>180.000</td>
							</tr>
							<tr>
								<td>Mobil Barang dan Bus JBB s/d 4.000 kg (Pick Up, Minibus)</td>
								<td>230.000</td>
							</tr>
							<tr>
								<td>Mobil Barang dan Bus JBB 4.001 s/d 8.000 kg (Light Truck, Microbus)</td>
								<td>280.000</td>
							</tr>
							<tr>
								<td>Mobil Barang dan Bus JBB 8.001 s/d 14.000 kg (Truck, Bus sedang)</td>
								<td>330.000</td>
							</tr>
							<tr>
								<td>Mobil Barang dan Bus JBB diatas 14.001 kg (Truck Tronton, Bus Besar)</td>
								<td>380.000</td>
							</tr>
							<tr>
								<td>Kereta Gandengan</td>
								<td>180.000</td>
							</tr>
							<tr>
								<td>Kereta Tempelan</td>
								<td>230.000</td>
							</tr>
							<tr>
								<td><strong>Uji Kendaraan Berkala</strong></td>
								<td></td>
							</tr>
							<tr>
								<td>Mobil Penumpang Umum (Taxi)</td>
								<td>70.000</td>
							</tr>
							<tr>
								<td>Mobil Barang dan Bus JBB s/d 4.000 kg (Pick Up, Minibus)</td>
								<td>80.000</td>
							</tr>
							<tr>
								<td>Mobil Barang dan Bus JBB 4.001 s/d 8.000 kg (Light Truck, Microbus)</td>
								<td>90.000</td>
							</tr>
							<tr>
								<td>Mobil Barang dan Bus JBB 8.001 s/d 14.000 kg (Truck, Bus sedang)</td>
								<td>100.000</td>
							</tr>
							<tr>
								<td>Mobil Barang dan Bus JBB diatas 14.001 kg (Truck Tronton, Bus Besar)</td>
								<td>110.000</td>
							</tr>
							<tr>
								<td>Kereta Gandengan</td>
								<td>70.000</td>
							</tr>
							<tr>
								<td>Kereta Tempelan</td>
								<td>80.000</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-4">
				<header class="text-center margin-bottom-20 margin-top-20">
					<h4 class="weight-600">CEK DATA KENDARAAN</h4>
					<h2 class="weight-200 letter-spacing-1 size-13"><span>KENDARAAN WAJIB UJI KABUPATEN WONOSOBO</span></h2>
				</header>
				
				<form role="form" action="<?php echo site_url('cekkendaraan')?>" method="post" id="search-form">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<div class="input-group">
						<input type="text" placeholder="Masukan nomor uji/ nomor kendaraan" name="no_uji" id="no_uji" value="" class="form-control"/>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-info">
								<span class="fa fa-search"></span>
								Cari
							</button>
						</span>
					</div>
					<label class="text-muted block">Contoh : AA-1234-FP / WS1234</label>
				</form>
				
				<div id="formcari"></div>
			</div>
		</div>
	</div>
</section>