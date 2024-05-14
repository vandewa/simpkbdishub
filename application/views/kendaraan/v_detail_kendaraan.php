<div class="page-content">
	<?php 
	if(isset($detail_kendaraan)){
		foreach($detail_kendaraan as $row){
		?>
		
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Detail Kendaraan
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="<?php echo site_url('kendaraan/cetak_detail_kendaraan/'.$this->encryption->encode($row->no_uji));?>">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-print bigger-120 blue"></i>
						Cetak
					</button>
				</a>
			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Identitas Umum</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<div class="profile-user-info">
							<div class="profile-info-row">
								<div class="profile-info-name">Nomor Uji Berkala </div>

								<div class="profile-info-value">
									<span><?php echo $row->no_uji;?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Nomor Kendaraan </div>

								<div class="profile-info-value">						
									<span><?php echo $row->no_kendaraan;?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Nomor KTP </div>

								<div class="profile-info-value">
									<span><?php echo $row->no_ktp;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name"> Nama Pemilik Kendaraan </div>

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
								<div class="profile-info-name"> Alamat Email </div>

								<div class="profile-info-value">
									<span><?php echo $row->email;?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Pengujian Terakhir </div>

								<div class="profile-info-value">
									<span><?php echo $row->max_tgl_uji;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name"> Masa Berlaku </div>

								<div class="profile-info-value">
									<span><?php 
												$tgl_akhir = $row->max_tgl_habis_uji;
												$habis = date("Y-m-d", strtotime($tgl_akhir));
												echo $habis;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name"> Sisa Masa Berlaku </div>

								<div class="profile-info-value">
									<?php 
										$tgl_akhir = $row->max_tgl_habis_uji;
										$date = new DateTime($tgl_akhir);
										$datenow = new DateTime();
										
										$berlaku = $date->diff($datenow)->format("%m Bulan %d Hari %h Jam %i Menit");
									?>
									<?php if($row->max_tgl_habis_uji <= unix_to_human($now)){ ?> 
									<span class="label label-sm label-danger">Kadaluarsa</span>
									<?php }  else { ?>
									<span> <?php echo $berlaku; } ?> </span>
								</div>
							</div>		
						<?php }
						} ?>	

						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php 
		if(isset($detail_kendaraan)){
			foreach($detail_kendaraan as $row){
			?>
		<div class="col-xs-12 col-sm-6">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Identitas Kendaraan</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<div class="profile-user-info">
							<div class="profile-info-row">
								<div class="profile-info-name">Merek </div>

								<div class="profile-info-value">
									<span><?php echo $row->merek;?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name">Tipe </div>

								<div class="profile-info-value">						
									<span><?php echo $row->tipe;?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name">Jenis</div>

								<div class="profile-info-value">
									<span><?php echo $row->jenis;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name">Jenis JBB</div>

								<div class="profile-info-value">
									<span><?php 
										$jbb = $row->jenis_jbb;
										if($jbb=='jbb0kg'){
											echo "JBB s/d 4000kg";
										}
										elseif($jbb=='jbb4kg'){
											echo "JBB 4001kg s/d 8000kg";
										}
										elseif($jbb=='jbb8kg'){
											echo "JBB 8001kg s/d 14000kg";
										}
										elseif($jbb=='jbb14kg'){
											echo "JBB diatas 14000kg";
										}
										elseif($jbb=='GN'){
											echo "Kereta Gandeng";
										}
										elseif($jbb=='TP'){
											echo "Kereta Tempelan";
										}
										?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name">Isi Silinder</div>

								<div class="profile-info-value">
									<span><?php echo $row->isi_silinder;?> cc</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name">Daya Motor</div>

								<div class="profile-info-value">
									<span><?php echo $row->daya_motor;?> kW/PS/HP</span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name">Bahan Bakar</div>

								<div class="profile-info-value">
									<span><?php echo $row->bahan_bakar;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name">Tahun Pembuatan</div>

								<div class="profile-info-value">
									<span><?php echo $row->tahun;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name">Status Penggunaan</div>

								<div class="profile-info-value">
									<span><?php echo $row->status;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name">Nomor Rangka Landasan</div>

								<div class="profile-info-value">
									<span><?php echo $row->no_rangka;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name">Nomor Mesin</div>

								<div class="profile-info-value">
									<span><?php echo $row->no_mesin;?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name">Nomor dan Tanggal Sertifikasi Uji Tipe</div>

								<div class="profile-info-value">
									<span><?php echo $row->no_sertifikasi_uji;?>/<?php echo $row->tgl_sertifikasi_uji;?></span>
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
				<div class="widget-header">
					<h4 class="widget-title">Uraian Kendaraan</h4>
				</div>
				
				<div class="row">
					<div class="widget-body">
					
						<div class="widget-main col-xs-12 col-sm-4">
							<div class="profile-user-info">
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Ukuran Utama</b> </div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Panjang </div>

									<div class="profile-info-value">
										<span><?php echo $row->uk_panjang;?> mm</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name">Lebar</div>

									<div class="profile-info-value">						
										<span><?php echo $row->uk_lebar;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Tinggi</div>

									<div class="profile-info-value">						
										<span><?php echo $row->uk_tinggi;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Julur Belakang</div>

									<div class="profile-info-value">						
										<span><?php echo $row->uk_julur_belakang;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Julur Depan</div>

									<div class="profile-info-value">						
										<span><?php echo $row->uk_julur_depan;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">&nbsp
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Jarak Sumbu</b> </div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu I-II </div>

									<div class="profile-info-value">
										<span><?php echo $row->js_sumbu1;?> mm</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu II-III </div>

									<div class="profile-info-value">						
										<span><?php echo $row->js_sumbu2;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu III-IV </div>

									<div class="profile-info-value">						
										<span><?php echo $row->js_sumbu3;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Q (Jarak Titik Berat) </div>

									<div class="profile-info-value">						
										<span><?php echo $row->js_sumbuq;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">&nbsp
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Dimensi Bak Muatan</b> </div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Panjang </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dbm_panjang;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Lebar </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dbm_lebar;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Tinggi </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dbm_tinggi;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Bahan Bak </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dbm_bahan_bak;?></span>
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="widget-main col-xs-12 col-sm-4">
							<div class="profile-user-info">
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Dimensi Tangki</b> </div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Panjang </div>

									<div class="profile-info-value">
										<span><?php echo $row->dt_panjang;?> mm</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name">Lebar </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dt_lebar;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Tinggi </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dt_tinggi;?> mm</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Volume </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dt_volume;?> ltr</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Jenis Muatan </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dt_jenis_muatan;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Berat Jenis Muatan </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dt_berat_jenis_muatan;?> kg/dm<sup>3</sup></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Bahan Tangki </div>

									<div class="profile-info-value">						
										<span><?php echo $row->dt_bahan_tangki;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">&nbsp
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Pemakaian Ban Diijinkan</b> </div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu ke-1 </div>

									<div class="profile-info-value">
										<span><?php echo $row->ban_sumbu1;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu ke-2 </div>

									<div class="profile-info-value">						
										<span><?php echo $row->ban_sumbu2;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu ke-3 </div>

									<div class="profile-info-value">						
										<span><?php echo $row->ban_sumbu3;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu ke-4 </div>

									<div class="profile-info-value">						
										<span><?php echo $row->ban_sumbu4;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">&nbsp
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Konfigurasi Sumbu</b> </div>
									
									<div class="profile-info-value">						
										<span><?php echo $row->konf_sumbu;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">&nbsp
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>JBB</b> </div>
									
									<div class="profile-info-value">						
										<span><?php echo $row->jbb;?> kg</span>
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="widget-main col-xs-12 col-sm-4">
							<div class="profile-user-info">
								<div class="profile-info-row">
									<div class="profile-info-name"><b>JBKB</b> </div>
									
									<div class="profile-info-value">						
										<span><?php echo $row->jbb_kombinasi;?> kg</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name">&nbsp
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Berat Kosong</b> </div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu 1 </div>

									<div class="profile-info-value">
										<span><?php echo $row->bk_sumbu1;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu 2 </div>

									<div class="profile-info-value">
										<span><?php echo $row->bk_sumbu2;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu 3 </div>

									<div class="profile-info-value">
										<span><?php echo $row->bk_sumbu3;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Sumbu 4 </div>

									<div class="profile-info-value">
										<span><?php echo $row->bk_sumbu4;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Jumlah </div>

									<div class="profile-info-value">
										<span><?php echo $row->bk_total;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">&nbsp
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Daya Angkut</b> </div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Orang </div>

									<div class="profile-info-value">
										<span><?php echo $row->da_orang;?> orang</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">Barang </div>

									<div class="profile-info-value">
										<span><?php echo $row->da_barang;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">&nbsp
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>JBI</b> </div>
									
									<div class="profile-info-value">						
										<span><?php echo $row->jbi;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>JBKI</b> </div>
									
									<div class="profile-info-value">						
										<span><?php echo $row->jbi_kombinasi;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>MST</b> </div>
									
									<div class="profile-info-value">						
										<span><?php echo $row->muatan_sum_berat;?> kg</span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Kelas Jalan Terendah</b> </div>
									
									<div class="profile-info-value">						
										<span><?php echo $row->kelas_jl_min;?></span>
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
		
		<div class="space space-8"></div>
		
		&nbsp;
		
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Riwayat Pendaftaran</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th>No</th>
									<th>Kode Uji</th>
									<th>Nomor Kendaraan</th>
									<th>Nama Pemilik</th>
									<th>Nama Pemohon</th>
									<th>Tanggal Daftar</th>
									<th class="hidden-480">Detail</th>
								</tr>
							</thead>
							<?php
							$no=1;
							if(isset($data_pendaftaran)){
								foreach($data_pendaftaran as $row){
								?>
							<tbody>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $row->kode_uji;?></td>
									<td><?php echo $row->no_kendaraan;?></td>
									<td><?php echo $row->nama;?></td>
									<td><?php echo $row->nama_pemohon;?></td>
									<td><?php echo $row->tgl_daftar_uji;?></td>
									<td>
										<div class="hidden-sm hidden-xs btn-group">
											<a href="<?php echo site_url('pendaftaran/detail/'.$this->encryption->encode($row->id_daftar));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
												<button class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-search bigger-120"></i>
												</button>
											</a>
										</div>
										
										<div class="hidden-md hidden-lg">
											<div class="inline pos-rel">
												<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
													<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
												</button>

												<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
													<li>
														<a href="<?php echo site_url('pendaftaran/detail/'.$this->encryption->encode($row->id_daftar));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
															<button class="btn btn-xs btn-success">
																<i class="ace-icon fa fa-search bigger-120"></i>
															</button>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
							<?php 
							}
						} ?>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<div class="space space-8"></div>
		
		&nbsp;
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Riwayat Pengujian</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th>No</th>
									<th>Nomor Uji</th>
									<th>Nomor Kendaraan</th>
									<th>Tanggal</th>
									<th>Tempat</th>
									<th>Status</th>
									<th class="hidden-480">Detail</th>
								</tr>
							</thead>
							<?php
							$no=1;
							if(isset($data_pengujian)){
								foreach($data_pengujian as $row){
								?>
							<tbody>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $row->no_uji;?></td>
									<td><?php echo $row->no_kendaraan;?></td>
									<td><?php echo $row->tgl_uji;?></td>
									<td><?php echo $row->tempat;?></td>

									<td class="hidden-480">
										<?php if($row->hasil=='LULUS') { ?>
										<span class="label label-success">Lulus Uji</span>
										<?php } elseif($row->hasil=='GAGAL') { ?>
										<span class="label label-danger">Tidak Lulus Uji</span>
										<?php } else { ?>
										<span class="label label-warning">Belum Uji</span>
										<?php } ?>
									</td>
									<td>
										<div class="hidden-sm hidden-xs btn-group">
											<a href="<?php echo site_url('uji/detail/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
												<button class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-search bigger-120"></i>
												</button>
											</a>
											
											<a href="<?php echo site_url('uji/edit/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-success" data-rel="tooltip" title="Edit">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</a>
										</div>
										
										<div class="hidden-md hidden-lg">
											<div class="inline pos-rel">
												<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
													<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
												</button>

												<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
													<li>
														<a href="<?php echo site_url('uji/detail/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
															<span class="blue">
																<i class="ace-icon fa fa-search-plus bigger-120"></i>
															</span>
														</a>
													</li>
													
													<li>
														<a href="<?php echo site_url('uji/edit/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-error" data-rel="tooltip" title="Edit">
															<span class="red">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									
									</td>
								</tr>
							</tbody>
							<?php 
							}
						} ?>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<div class="space space-8"></div>
		&nbsp;
		

		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Riwayat Pemilik</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th>No</th>
									<th>Nomor KTP</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Kecamatan</th>
									<th>Telepon</th>
									<th>Pemilik Aktif</th>
									<th class="hidden-480">Detail</th>
								</tr>
							</thead>
							<?php
							$no=1;
							if(isset($data_pemilik)){
								foreach($data_pemilik as $row){
								?>
							<tbody>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $row->no_ktp;?></td>
									<td><?php echo $row->nama;?></td>
									<td><?php echo $row->alamat;?></td>
									<td><?php echo $row->kecamatan;?></td>
									<td><?php echo $row->telp;?></td>
									<td><?php if($row->aktif==1){?> Ya
									<?php } else { ?> Tidak <?php } ?>
										<td>
										<div class="hidden-sm hidden-xs btn-group">
											<a href="<?php echo site_url('pengguna/edit/'.$this->encryption->encode($row->id_user));?>" class="tooltip-success" data-rel="tooltip" title="Edit">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</a>
					
											<a href="<?php echo site_url('pengguna/hapus/'.$this->encryption->encode($row->id_user));?>" onclick="return confirm('Anda yakin Menghapus Data Pemilik Kendaraan?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
												<button class="btn btn-xs btn-danger">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</button>
											</a>
										</div>
										
										<div class="hidden-md hidden-lg">
											<div class="inline pos-rel">
												<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
													<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
												</button>

												<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
													<li>
														<a href="<?php echo site_url('pengguna/edit/'.$this->encryption->encode($row->id_user));?>" class="tooltip-success" data-rel="tooltip" title="Edit">
															<span class="green">
																<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
															</span>
														</a>
													</li>

													<li>
														<a href="<?php echo site_url('pengguna/hapus/'.$this->encryption->encode($row->id_user));?>" onclick="return confirm('Anda yakin Menghapus Data Pemilik Kendaraan?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
															<span class="red">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									
									</td>
								</tr>
							</tbody>
							<?php 
							}
						} ?>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>