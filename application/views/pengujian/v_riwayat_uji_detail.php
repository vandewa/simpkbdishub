<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Laporan Hasil Pengujian
				</h1>
			</div>
		</div>
	</div>
	
	<?php 
	if(isset($detail_uji)){
		foreach($detail_uji as $row){
		?>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="widget-body">
							<div class="widget-main">
								<div class="profile-user-info">
									<div class="profile-info-row">
										<div class="profile-info-name"><b>Nomor Pengujian</b> </div>

										<div class="profile-info-value">
											<span class="bolder"><?php echo $row->no_uji;?></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Nomor Kendaraan </div>

										<div class="profile-info-value">						
											<span><?php echo $row->no_kendaraan;?></span>
										</div>
									</div>
									
									<div class="profile-info-row">
										<div class="profile-info-name"> Nama Pemilik</div>

										<div class="profile-info-value">
											<span><?php echo $row->nama;?></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Alamat</div>

										<div class="profile-info-value">
											<span><?php echo $row->alamat;?></span>
										</div>
									</div>
									
									<div class="profile-info-row">
										<div class="profile-info-name"> Kecamatan</div>

										<div class="profile-info-value">
											<span><?php echo $row->kecamatan;?></span>
										</div>
									</div>
									
									
									<div class="profile-info-row">
										<div class="profile-info-name"> Jenis Kendaraan </div>

										<div class="profile-info-value">
											<span><?php echo $row->jenis;?></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Merek dan Tipe </div>

										<div class="profile-info-value">
											<span><?php echo $row->merek;?> / <?php echo $row->tipe;?></span>
										</div>
									</div>
									
									<div class="profile-info-row">
										<div class="profile-info-name"> Tahun Pembuatan </div>

										<div class="profile-info-value">
											<span><?php echo $row->tahun;?></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Nomor Mesin </div>

										<div class="profile-info-value">
											<span><?php echo $row->no_mesin;?></span>
										</div>
									</div>
									
									<div class="profile-info-row">
										<div class="profile-info-name"> Nomor Rangka </div>

										<div class="profile-info-value">
											<span><?php echo $row->no_rangka;?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6">
						<div class="widget-body">
							<div class="widget-main">
								<div class="profile-user-info">
									<div class="profile-info-row">
										<div class="profile-info-name"><b>Kode Pengujian</b> </div>

										<div class="profile-info-value">
											<span class="bolder"><?php echo $row->kode_uji;?></span>
										</div>
									</div>
									
									<div class="profile-info-row">
										<div class="profile-info-name">Tanggal Pengujian </div>

										<div class="profile-info-value">
											<span><?php echo $row->tgl_uji;?></span>
										</div>
									</div>
									
									<div class="profile-info-row">
										<div class="profile-info-name"> Sifat Pengujian </div>

										<div class="profile-info-value">
											<span><?php echo $row->sifat_uji;?></span>
										</div>
									</div>
									
									<div class="profile-info-row">
										<div class="profile-info-name"> Posisi Speedometer</div>

										<div class="profile-info-value">
											<span><?php echo $row->pos_speed;?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	&nbsp;
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">				
				<div class="row">
					<div class="widget-body">
					
						<div class="widget-main col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="col-sm-1 bolder blue">1.</label>
								<label class="col-sm-11 bolder blue">PERALATAN</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">101</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u101=='Y'){ echo "checked"; }?> >   No. Chasis</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">102</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u102=='Y'){ echo "checked"; }?>>   Pelat Pabrik Pembuatnya</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">103</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u103=='Y'){ echo "checked"; }?>>   Pelat Nomor</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">104</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u104=='Y'){ echo "checked"; }?>>   Tulisan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u105=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">105</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u105=='Y'){ echo "checked"; }?>>   Penghapus Kaca Depan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">106</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u106=='Y'){ echo "checked"; }?>>   Klakson</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u107x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">107</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u107=='Y'){ echo "checked"; }?>>   Kaca Spion</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">108</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u108=='Y'){ echo "checked"; }?>>   Pandangan Ke Depan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">109</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u109=='Y'){ echo "checked"; }?>>   Kaca Penahan Sinar</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">110</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u110=='Y'){ echo "checked"; }?>>   Alat-alat Pengendali</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">111</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u111=='Y'){ echo "checked"; }?>>   Lampu Indikasi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">112</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u112=='Y'){ echo "checked"; }?>>   Speedometer</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">113</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u113=='Y'){ echo "checked"; }?>>   Perlengkapan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">114</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u114=='Y'){ echo "checked"; }?>>   </label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u1hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u1hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-1 bolder blue">2.</label>
								<label class="col-sm-11 bolder blue">SISTEM PENERANGAN</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u201x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">201</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u201=='Y'){ echo "checked"; }?>>   Lampu Jauh</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u202x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">202</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u202=='Y'){ echo "checked"; }?>>   Tambahan Lampu Jauh</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u203x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">203</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u203=='Y'){ echo "checked"; }?>>   Lampu Dekat</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u204x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">204</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u204=='Y'){ echo "checked"; }?>>   Arah Lampu</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u205x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">205</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u205=='Y'){ echo "checked"; }?>>   Lampu Kabut</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u206x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">206</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u206=='Y'){ echo "checked"; }?>>   Lampu Posisi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u207x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">207</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u207=='Y'){ echo "checked"; }?>>   Lampu Belakang</label>
							</div>
								<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u208x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">208</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u208=='Y'){ echo "checked"; }?>>   Lampu Rem</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">209</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u209=='Y'){ echo "checked"; }?>>   Lampu Pelat Nomor</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u210x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">210</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u210=='Y'){ echo "checked"; }?>>   Lampu Mundur</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u211x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">211</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u211=='Y'){ echo "checked"; }?>>   Lampu Kabut Belakang</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u212x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">212</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u212=='Y'){ echo "checked"; }?>>   Lampu Arah/Peringatan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u213x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">213</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u213=='Y'){ echo "checked"; }?>>   Reflektor Merah</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u214x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">214</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u214=='Y'){ echo "checked"; }?>>   Lampu Tambahan Lain</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">215</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u215=='Y'){ echo "checked"; }?>>  </label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u2hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u2hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-1 bolder blue">3.</label>
								<label class="col-sm-11 bolder blue">SISTEM KEMUDI</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">301</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u301=='Y'){ echo "checked"; }?>>   Roda Kemudi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">302</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u302=='Y'){ echo "checked"; }?>>   Speeling pada Roda Kemudi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">303</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u303=='Y'){ echo "checked"; }?>>   Batang Kemudi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">304</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u304=='Y'){ echo "checked"; }?>>   Roda Gigi Kemudi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u305x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">305</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u305=='Y'){ echo "checked"; }?>>   Sambungan Kemudi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u306x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">306</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u306=='Y'){ echo "checked"; }?>>   Penyambung Sendi Peluru</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">307</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u307=='Y'){ echo "checked"; }?>>   Power Steering</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">308</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u308=='Y'){ echo "checked"; }?>>   Side Slip</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">309</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u309=='Y'){ echo "checked"; }?>>   </label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u3hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u3hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							
						</div>
						<div class="widget-main col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="col-sm-1 bolder blue">4.</label>
								<label class="col-sm-11 bolder blue">AS DAN SUSPENSI</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u401x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">401</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u401=='Y'){ echo "checked"; }?>>   Suspensi Roda Depan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u401x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">401</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u401=='Y'){ echo "checked"; }?>>   Suspensi Roda Depan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u402x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">402</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u402=='Y'){ echo "checked"; }?>>   Suspensi Roda Belakang</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u403x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">403</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u403=='Y'){ echo "checked"; }?>>   Sumbu</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u404x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">404</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u404=='Y'){ echo "checked"; }?>>   Pemasangan Sumbu</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u405x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">405</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u405=='Y'){ echo "checked"; }?>>   Pegas</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u406x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">406</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u406=='Y'){ echo "checked"; }?>>   Bantalan-bantalan Roda</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">407</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u407=='Y'){ echo "checked"; }?>>   </label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u4hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u4hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-1 bolder blue">5.</label>
								<label class="col-sm-11 bolder blue">BAN DAN PELEK</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u501x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">501</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u501=='Y'){ echo "checked"; }?>>   Ukuran Dari Jenis Ban</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u502x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">502</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u502=='Y'){ echo "checked"; }?>>   Keadaan Ban</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u503x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">503</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u503=='Y'){ echo "checked"; }?>>   Kedalaman Kembang Ban</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u511x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">511</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u511=='Y'){ echo "checked"; }?>>   Ukuran Dan Jenis Pelek</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u512x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">512</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u512=='Y'){ echo "checked"; }?>>   Keadaan Pelek</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u513x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">513</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u513=='Y'){ echo "checked"; }?>>   Penguatan Ban/Pelek</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">521</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u521=='Y'){ echo "checked"; }?>>   </label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u5hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u5hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-1 bolder blue">6.</label>
								<label class="col-sm-11 bolder blue">RANGKA DAN BODI</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">601</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u601=='Y'){ echo "checked"; }?>>   Rangka Penopang</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">602</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u602=='Y'){ echo "checked"; }?>>   Bemper</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">603</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u603=='Y'){ echo "checked"; }?>>   Tempat Roda Cadangan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">604</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u604=='Y'){ echo "checked"; }?>>   Keamanan Bodi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">605</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u605=='Y'){ echo "checked"; }?>>   Kondisi Bodi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">606</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u606=='Y'){ echo "checked"; }?>>   Ruang Pengemudi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">607</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u607=='Y'){ echo "checked"; }?>>   Tempat Duduk/Berdiri</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">608</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u608=='Y'){ echo "checked"; }?>>   Sambungan Kereta Gandengan</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-1 bolder blue">7.</label>
								<label class="col-sm-11 bolder blue">SISTEM REM</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">701</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u701=='Y'){ echo "checked"; }?>>   Pedal Rem</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">702</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u702=='Y'){ echo "checked"; }?>>   Speeling Pedal</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">703</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u703=='Y'){ echo "checked"; }?>>   Kebocoran, Kelemahan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u704x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">704</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u704=='Y'){ echo "checked"; }?>>   Sambungan Tuas, Kabel</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u705x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">705</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u705=='Y'){ echo "checked"; }?>>   Pipa, Selang</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u706x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">706</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u706=='Y'){ echo "checked"; }?>>   Silinder, Katup</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u707x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">707</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u707=='Y'){ echo "checked"; }?>>   Teromol, Cakram</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u708x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">708</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u708=='Y'){ echo "checked"; }?>>   Perodo/ Pad/ Pelapis</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">71.</label>
								<label class="col-sm-9 blue">   <u>Sistem Vacuum</u></label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">711</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u711=='Y'){ echo "checked"; }?>>   Fungsi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">712</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u712=='Y'){ echo "checked"; }?>>   Kebocoran</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">72.</label>
								<label class="col-sm-9 blue">   <u>Sistem Tekanan Angin</u></label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">721</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u721=='Y'){ echo "checked"; }?>>   Kebocoran</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">722</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u722=='Y'){ echo "checked"; }?>>   Waktu Pengisian Angin</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u723x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">723</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u723=='Y'){ echo "checked"; }?>>   Penggerak Rem</label>
							</div>
						</div>
						
						<div class="widget-main col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">724</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u724=='Y'){ echo "checked"; }?>>   Pengisian krt, Gandengan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">725</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u725=='Y'){ echo "checked"; }?>>   Tekanan Angin</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">73.</label>
								<label class="col-sm-9 blue">   <u>Rem Parkir</u></label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">731</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u731=='Y'){ echo "checked"; }?>>   Tuas Tangan/ Pedal</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">732</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u732=='Y'){ echo "checked"; }?>>   Speeling Tuas Tangan/ Pedal</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">733</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u733=='Y'){ echo "checked"; }?>>   Kebocoran, Kelemahan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u734x=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2">734</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u734=='Y'){ echo "checked"; }?>>   Sambungan, Tuas, Kabel</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u73hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u73hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">74.</label>
								<label class="col-sm-9 blue">   <u>Sistem Ruang Gas Buangan</u></label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">741</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u741=='Y'){ echo "checked"; }?>>   Fungsi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">75.</label>
								<label class="col-sm-9 blue">   <u>Efisiensi Rem</u></label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">751</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u751=='Y'){ echo "checked"; }?>>   Rem Utama</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">752</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u752=='Y'){ echo "checked"; }?>>   Perbedaan Depan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">753</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u753=='Y'){ echo "checked"; }?>>   Perbedaan Belakang</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">754</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u754=='Y'){ echo "checked"; }?>>   Rem Parkir</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u7hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u7hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-1 bolder blue">8.</label>
								<label class="col-sm-11 bolder blue">MESIN / TRANSMISI</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">801</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u801=='Y'){ echo "checked"; }?>>   Dudukan Mesin</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">802</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u802=='Y'){ echo "checked"; }?>>   Kondisi Mesin</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">803</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u803=='Y'){ echo "checked"; }?>>   Transmisi</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">804</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u804=='Y'){ echo "checked"; }?>>   Sistem Gas Buangan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">805</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u805=='Y'){ echo "checked"; }?>>   Emisi Asap</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">806</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u806=='Y'){ echo "checked"; }?>>   Emisi CO</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">807</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u807=='Y'){ echo "checked"; }?>>   </label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u8hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u8hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-1 bolder blue">9.</label>
								<label class="col-sm-11 bolder blue">LAIN - LAIN</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">901</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u901=='Y'){ echo "checked"; }?>>   Sistem Bahan Bakar</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">902</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u902=='Y'){ echo "checked"; }?>>   Sistem Kelistrikan</label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"></label>
								<label class="col-sm-2">903</label>
								<label class="col-sm-9"><input type="checkbox" <?php if($row->u903=='Y'){ echo "checked"; }?>>   </label>
							</div>
							<div class="form-group">
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u9hasil=='Y'){ echo "checked"; }?>></label>
								<label class="col-sm-2 bolder blue">LULUS</label>
								<label class="col-sm-1"><input type="checkbox" <?php if($row->u9hasil=='N'){ echo "checked"; }?>></label>
								<label class="col-sm-8 bolder red">GAGAL</label>
							</div>
							&nbsp;
							<div class="form-group">
								<label class="col-sm-4">Sistem Slip :</label>
								<label class="col-sm-5 bolder"><?php echo $row->sistem_slip;?></label>
								<label class="col-sm-3">m/Km</label>
							</div>
							<div class="form-group">
								<label class="col-sm-12 bolder"><u>Efisiensi Rem</u></label>
							</div>
							<div class="form-group">
								<label class="col-sm-4">Rem Utama :</label>
								<label class="col-sm-5 bolder"><?php echo $row->rem_utama;?></label>
								<label class="col-sm-3">% g</label>
							</div>
							<div class="form-group">
								<label class="col-sm-4">Rem Parkir :</label>
								<label class="col-sm-5 bolder"><?php echo $row->rem_parkir;?></label>
								<label class="col-sm-3">% g</label>
							</div>
							<div class="form-group">
								<label class="col-sm-12 bolder"><u>Gaya Rem</u></label>
							</div>
							<div class="form-group">
								<label class="col-sm-3">S1 : Kr.</label>
								<label class="col-sm-3 bolder"><?php echo $row->s1_kiri;?></label>
								<label class="col-sm-2">Kn. :</label>
								<label class="col-sm-3 bolder"><?php echo $row->s1_kanan;?></label>
								<label class="col-sm-1">.</label>
							</div>
							<div class="form-group">
								<label class="col-sm-3">S2 : Kr.</label>
								<label class="col-sm-3 bolder"><?php echo $row->s2_kiri;?></label>
								<label class="col-sm-2">Kn. :</label>
								<label class="col-sm-3 bolder"><?php echo $row->s2_kanan;?></label>
								<label class="col-sm-1">.</label>
							</div>
							<div class="form-group">
								<label class="col-sm-3">S3 : Kr.</label>
								<label class="col-sm-3 bolder"><?php echo $row->s3_kiri;?></label>
								<label class="col-sm-2">Kn. :</label>
								<label class="col-sm-3 bolder"><?php echo $row->s3_kanan;?></label>
								<label class="col-sm-1">.</label>
							</div>
							<div class="form-group">
								<label class="col-sm-3">S4 : Kr.</label>
								<label class="col-sm-3 bolder"><?php echo $row->s4_kiri;?></label>
								<label class="col-sm-2">Kn. :</label>
								<label class="col-sm-3 bolder"><?php echo $row->s4_kanan;?></label>
								<label class="col-sm-1">.</label>
							</div>
							<div class="form-group">
								<label class="col-sm-12 bolder">Speedometer Tester Indikasi :</label>
							</div>
							<div class="form-group">
								<label class="col-sm-3"></label>
								<label class="col-sm-6 bolder"><?php echo $row->speedtest;?></label>
								<label class="col-sm-3">kM/jam</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	&nbsp;
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">				
				<div class="row">
					<div class="widget-body">
						<div class="widget-main col-xs-12">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="bolder blue">Catatan</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<textarea id="catatan" name="catatan" class="autosize-transition form-control" placeholder="Catatan Pemeriksaan" id="catatan" name="catatan" ><?php echo $row->catatan;?></textarea>
								</div>
							</div>
							&nbsp;
							<div class="form-group">
								<div class="col-sm-6">
									<label class="bolder blue">HASIL PENGUJIAN</label></br>
									<div class="form-group">
										<label class="col-sm-1"><input type="checkbox" <?php if($row->hasil=='LULUS'){ echo "checked"; }?>></label>
										<label class="col-sm-2 bolder blue">LULUS</label>
										<label class="col-sm-1"><input type="checkbox" <?php if($row->hasil=='GAGAL'){ echo "checked"; }?>></label>
										<label class="col-sm-8 bolder red">GAGAL</label>
									</div> </br></br>
									<label class="bolder blue">PERSETUJUAN NUMPANG UJI</label></br>
									<div class="form-group">
										<label class="bolder">DARI : <?php echo $row->num_dari;?></label></br>
										<label class="bolder">NOMOR : <?php echo $row->num_no;?></label></br>
										<label class="bolder">TANGGAL : <?php $tgl_num = $row->num_tgl; $num = date("d-m-Y", strtotime($tgl_num)); if($num=='01-01-1970'){ echo "";} else { echo $num;};?></label></br>
									</div>
								</div>
								<div class="col-sm-6">
									<center>
									<label class="bolder blue">TANGGAL PEMERIKSAAN BERIKUTNYA</label></br>
									<label class="bolder"><?php $tgl_akhir = $row->tgl_habis_uji; $habis = date("d-m-Y", strtotime($tgl_akhir)); echo $habis;?></label></br>
									<label class="bolder blue">UNTUK DIPERBAIKI SAMPAI DENGAN TANGGAL</label></br>
									<label class="bolder"><?php $tgl_batas = $row->tgl_batas_perbaikan; $perbaiki = date("d-m-Y", strtotime($tgl_batas)); echo $perbaiki;?></label>
									
									</br></br>
									<div class="form-group">
										<label class="bolder">TANDA TANGAN PENGUJI</label></br></br></br></br>
										<label class="bolder">PENGUJI</label></br>
									</div>
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
			<?php 
			}
		} ?>
	&nbsp;
</div>