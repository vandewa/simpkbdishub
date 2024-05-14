<?php echo $this->session->flashdata('sukses');?>
<div class="page-content">
	<div class="page-header no-margin">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Lihat Kendaraan <?php echo $nouji;?>
				</h1>
			</div>
			<?php if($this->session->userdata('id_akses') == '1'){ ?>
			<div class="col-xs-12 col-sm-4" align="right">
				<a href="#statuskendaraan" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Status Kendaraan">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-lock bigger-120 blue"></i>
						Status Kendaraan
					</button>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="header smaller lighter blue">
				Berkas Kendaraan
			</h3>
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 text-right">
					<a href="#tambahberkas" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Tambah Berkas">
						<button class="btn btn-white btn-info btn-round">
							<i class="ace-icon fa fa-plus bigger-120 blue"></i>
							Tambah Berkas
						</button>
					</a>
				</div>
			</div>
			<br/>
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">JENIS BERKAS</th>
						<th class="text-center">NAMA BERKAS</th>
						<th class="text-center">OPSI</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$no = 1;
				if(isset($dt_berkas)){
				foreach($dt_berkas as $row){
				?>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->jenis_berkas;?></td>
						<td><?php echo $row->nama_berkas;?></td>
						<td class="text-center">
							<a href="<?php echo site_url('kendaraan/lihatberkas/'.$row->id_berkas);?>" target="_blank" class="tooltip-info" data-rel="tooltip" title="Lihat berkas">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-search bigger-110"></i>
									Lihat
								</button>
							</a>
							
							<a href="<?php echo site_url('kendaraan/hapusberkas?id='.$row->id_berkas.'&no='.$row->no_uji.'&raw='.$row->raw_berkas);?>" class="tooltip-info" data-rel="tooltip" title="Hapus berkas" onclick="return confirm('Anda yakin akan menghapus berkas?')">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash bigger-110"></i>
									Hapus
								</button>
							</a>
						</td>
					</tr>
				<?php }} ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="header smaller lighter blue">
				Foto Kendaraan
			</h3>
			
			<?php $no = 1;
			if(!empty($dt_foto)){ ?>
			<div class="row">
			<?php foreach($dt_foto as $ft){?>
				<div class="col-xs-6 col-sm-3">
					<div class="widget-box">
						<div class="widget-header">
							<h4 class="smaller center">
								KAMERA <?php echo $no++;?>
							</h4>
						</div>
						<div class="widget-body">
							<div class="widget-main center">
								<img class="img-responsive" src="<?php echo base_url('files/foto/'.$ft->kode_uji.'/'.$ft->foto);?>">
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
			<?php } else { ?>
			<div class="row">
				<div class="col-xs-12 text-center">
					Tidak ada foto kendaraan
				</div>
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="header smaller lighter blue">
				Data Kepemilikan Kendaraan
			</h3>
			
			<div class="row">
				<div class="col-xs-12">
					<table id="simple-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">No</th>
								<th class="hidden-480">No KTP</th>
								<th>Nama</th>
								<th class="hidden-480">Alamat</th>
								<th class="hidden-480">Kecamatan</th>
								<th class="hidden-480">Telepon</th>
								<th class="hidden-480">Tanggal STNK</th>
								<th>Status</th>
								<th>Opsi</th>
							</tr>
						</thead>
						
						<?php 
						$no = 1;
						if(isset($dt_pemilik)){
							foreach($dt_pemilik as $row){
							?>
						<tbody>
							<tr>
								<td class="center"><?php echo $no++;?></td>
								<td class="hidden-480"><?php echo $row->no_ktp;?></td>
								<td><?php echo $row->nama;?></td>
								<td class="hidden-480"><?php echo $row->alamat;?></td>
								<td class="hidden-480"><?php echo $row->kecamatan;?></td>
								<td class="hidden-480"><?php echo $row->telp;?></td>
								<td class="hidden-480"><?php echo strftime("%d %B %Y", strtotime(($row->tgl_stnk)));?></td>
								<td><b><?php if($row->aktif=="1"){ echo "AKTIF"; } else { echo "TIDAK AKTIF"; };?></b></td>
								<td>
									<a href="<?php echo site_url('kendaraan/detail/'.$row->no_uji);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
										<button class="btn btn-xs btn-success">
											<i class="ace-icon fa fa-search bigger-120"></i>
										</button>
									</a>
									
									<a href="<?php echo site_url('kendaraan/editpemilik/'.$row->id_user);?>" class="tooltip-success" data-rel="tooltip" title="Edit">
										<button class="btn btn-xs btn-info">
											<i class="ace-icon fa fa-pencil bigger-120"></i>
										</button>
									</a>
									<?php if($row->aktif=="1"){ ?>
									<a href="<?php echo site_url('kendaraan/hapuspemilik/'.$row->id_user);?>" onclick="return confirm('Anda yakin Menghapus Data Pemilik Kendaraan?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
										<button class="btn btn-xs btn-danger">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</button>
									</a>
									<?php } else { ?>
									<a href="<?php echo site_url('kendaraan/batalhapuspemilik/'.$row->no_uji);?>" onclick="return confirm('Anda yakin mengaktifkan pemilik kembali?')" class="tooltip-success" data-rel="tooltip" title="Aktifkan pemilik">
										<button class="btn btn-xs btn-warning">
											<i class="ace-icon fa fa-unlock bigger-120"></i>
										</button>
									</a>
									<?php } ?>
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
<?php 
if(isset($dt_kendaraan)){
	foreach($dt_kendaraan as $row){
		$bahan_bakar = $row->bahan_bakar;
		$jenis = $row->jenis;
		$tahun = $row->tahun;
		$jbb = $row->jbb;
		$nouji = $row->no_uji
	?>
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="header smaller lighter blue">
				Data Kendaraan
			</h3>	
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<tr>
					<td colspan="6" class="text-center"><b>URAIAN TENTANG KENDARAAN</b></td>
					<td colspan="3" class="text-center"><b>KETERANGAN KHUSUS</b></td>
				</tr>
				<tr>
					<td width="1%">1.</td>
					<td width="10%">Merk</td>
					<td width="10%">: <?php echo $row->merek;?></td>
					<td width="1%">10.</td>
					<td width="10%">Rumah-rumah (karoseri) </td>
					<td width="10%"></td>
					<td width="1%"><div align="center">a.</div></td>
					<td width="10%">Warna</td>
					<td width="10%">: <?php echo $row->warna;?></td>
				</tr>
				<tr>
					<td>2.</td>
					<td>Type</td>
					<td>: <?php echo $row->tipe;?></td>
					<td><div align="left">a.</div></td>
					<td>Jenis</td>
					<td>: <?php echo $row->karoseri;?></td>
					<td rowspan="3" valign="top"><div align="center">b.</div></td>
					<td>Bagian yang menjulur </td>
					<td></td>
				</tr>
				<tr>
					<td>3.</td>
					<td>Tahun Pembuatan </td>
					<td>: <?php echo $row->tahun;?></td>
					<td><div align="left">b.</div></td>
					<td>Bahan</td>
					<td>: <?php echo $row->dbm_bahan_bak;?></td>
					<td>- Ke belakang (ROH) </td>
					<td>: <?php echo $row->uk_roh;?></td>
				</tr>
				<tr>
					<td>4.</td>
					<td>Pemakaian Pertama </td>
					<td>: <?php echo date("d M Y",strtotime($row->tgl_pemakaian_pertama));?></td>
					<td><div align="left">c.</div></td>
					<td>Jumlah tempat duduk </td>
					<td>: <?php echo $row->tempat_duduk;?></td>
					<td>- Ke depan (FOH) </td>
					<td>: <?php echo $row->uk_foh;?></td>
				</tr>
				<tr>
					<td>5.</td>
					<td>Nomor Landasan/Rangka</td>
					<td>: <?php echo $row->no_rangka;?></td>
					<td>d.</td>
					<td>Jumlah tempat berdiri </td>
					<td>: <?php echo $row->tempat_berdiri;?></td>
					<td><div align="center">c.</div></td>
					<td>Jarak tengah</td>
					<td>: </td>
				</tr>
				<tr>
					<td>6.</td>
					<td>Nomor Mesin </td>
					<td>: <?php echo $row->no_mesin;?></td>
					<td rowspan="4" valign="top"><div align="left">e.</div>
					</td>
					<td colspan="2">keterangan-keterangan lainnya </td>
					<td><div align="center">d.</div></td>
					<td>Konfigurasi sumbu </td>
					<td>: <?php echo $row->konf_sumbu;?></td>
				</tr>
				<tr>
					<td>7.</td>
					<td>Panjang keseluruhan </td>
					<td>: <?php echo $row->uk_panjang;?></td>
					<td colspan="2" rowspan="3" valign="top">
						<table width="50%" border="0">
							<tr>
								<td width="50%">p : <?php echo $row->js_sumbup;?></td>
								<td width="50%">r : <?php echo $row->js_sumbur;?></td>
							</tr>
						</table>        
						
						<table width="50%" border="0">
							<tr>
								<td width="50%">q : <?php echo $row->js_sumbuq;?></td>
								<td width="50%">b : <?php echo $row->js_sumbub;?></td>
							</tr>
						</table>      
						</td>
					<td rowspan="3" valign="top"><div align="center">e.</div></td>
					<td rowspan="3" valign="top">Jarak sumbu </td>
					<td rowspan="3" valign="top">
						<table width="100%" border="0">
							<tr>
								<td width="50%">a1: <?php echo $row->js_sumbu1;?> </td>
								<td width="50%">a3: <?php echo $row->js_sumbu3;?></td>
							</tr>
						</table>        
						<table width="100%" border="0">
							<tr>
								<td width="50%">a2: <?php echo $row->js_sumbu2;?></td>
								<td width="50%">a4: <?php echo $row->js_sumbu4;?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>8.</td>
					<td>Lebar keseluruhan </td>
					<td>: <?php echo $row->uk_lebar;?></td>
				</tr>
				<tr>
					<td>9.</td>
					<td>Tinggi keseluruhan </td>
					<td>: <?php echo $row->uk_tinggi;?></td>
				</tr>
			</table>
			
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<tr>
					<td colspan="5" class="text-center"><b>BERAT, DAYA ANGKUT, KELAS JALAN YANG PALING RENDAH, DAN UKURAN BAN YANG PALING RINGAN (KECIL)</b></td>
					<td colspan="3" valign="top" class="text-center"><b>SERTIFIKAT UJI TIPE DAN REGISTRASI UJI TIPE</b></td>
				</tr>
			
				<tr>
					<td width="1%">a.</td>
					<td width="10%">Jumlah berat yang diperbolehkan (JBB) </td>
					<td width="1%">kg</td>
					<td width="5%" colspan="2"><?php echo $row->jbb;?></td>
					<td width="1%" rowspan="3" valign="top"><div align="center">a.</div><div align="center"></div><div align="center"></div></td>
					<td width="15%" colspan="2">No Sertifikat Uji Tipe (SUT) : <?php echo $row->no_ut;?></td>
				</tr>
				<tr>
					<td></td>
					<td>Jumlah berat kombinasi yang diperbolehkan (JBKB)  </td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->jbb_kombinasi;?></td>
					<td colspan="2" valign="top">Tanggal diterbitkan : <?php echo strftime("%d %B %Y", strtotime(($row->tgl_ut)));?></td>
				</tr>
				<tr>
					<td>b.</td>
					<td colspan="4">Berat kendaraan </td>
					<td colspan="2">Penerbit : <?php echo $row->penerbit_ut;?></td>
				</tr>
				<tr>
					<td></td>
					<td>Berat sumbu ke-1 </td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->bk_sumbu1;?></td>
					<td rowspan="3" class="text-center">b.</td>
					<td colspan="2">No. Rancang Bangun : <?php echo $row->no_rb;?></td></td>
				</tr>
				<tr>
					<td></td>
					<td>Berat sumbu ke-2</td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->bk_sumbu2;?></td>
					<td colspan="2" valign="top">Tanggal diterbitkan : <?php echo strftime("%d %B %Y", strtotime(($row->tgl_rb)));?></td>
				</tr>
				<tr>
					<td></td>
					<td>Berat sumbu ke-3</td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->bk_sumbu3;?></td>
					<td colspan="2">Penerbit : <?php echo $row->penerbit_ut;?></td>
				</tr>
				<tr>
					<td></td>
					<td>Berat sumbu ke-4</td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->bk_sumbu4;?></td>
					<td rowspan="3" class="text-center">c.</td>
					<td colspan="2">No. SRUT : <?php echo $row->no_sertifikasi_uji;?></td></td>
				</tr>
				<tr>
					<td></td>
					<td>Berat sumbu ke-5</td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->bk_sumbu5;?></td>
					<td colspan="2" valign="top">Tanggal diterbitkan : <?php echo strftime("%d %B %Y", strtotime(($row->tgl_sertifikasi_uji)));?></td>
				</tr>
				<tr>
					<td></td>
					<td>Berat total kendaraan </td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->bk_total;?></td>
					<td colspan="2">Penerbit : <?php echo $row->penerbit_sertifikasi_uji;?></td>
				</tr>
				<tr>
					<td>c.</td>
					<td>Daya angkut orang </td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->jml_da_orang;?></td>
					<td colspan="2" class="text-center"><b>DAYA MESIN/MOTOR</b></td>
				</tr>
				<tr>
					<td>d.</td>
					<td>Daya angkut barang </td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->da_barang;?></td>
					<td><div align="center">a.</div></td>
					<td>Isi Silinder : <?php echo $row->isi_silinder;?> cc</td>
				</tr>
				<tr>
					<td>e.</td>
					<td>Jumlah berat yang diijinkan (JBI) </td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->jbi;?></td>
					<td><div align="center">b.</div></td>
					<td>Daya Motor : <?php echo $row->daya_motor;?></td>
				</tr>
				<tr>
					<td>f.</td>
					<td>Jumlah berat kombinasi yang diijinkan (JBKBI) </td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->jbi_kombinasi;?></td>
					<td colspan="2" class="text-center">DIMENSI BAK MUATAN / TANGKI</td>
				</tr>
				<tr>
					<td>g.</td>
					<td>Muatan sumbu terberat (MST) </td>
					<td>kg</td>
					<td colspan="2"><?php echo $row->mst;?></td>
					<td colspan="2">P = <?php echo $row->dbm_panjang;?></td>
				</tr>
				<tr>
					<td>h.</td>
					<td>Kelas jalan terendah yang boleh dilalui </td>
					<td colspan="3"><div align="center"><?php echo $row->kelas_jalan;?></div></td>
					<td colspan="2">L = <?php echo $row->dbm_lebar;?></td>
				</tr>
				<tr>
					<td>i.</td>
					<td colspan="4">Pemakaian ban yang diijinkan </td>
					<td colspan="2">T = <?php echo $row->dbm_tinggi;?></td>
					
				</tr>
				<tr>
					<td></td>
					<td>Sumbu ke-1 </td>
					<td colspan="3"><?php echo $row->ban_sumbu1;?></td>
					<!--<td colspan="2">V = <?php $v=$row->dbm_lebar*$row->dbm_panjang*$row->dbm_tinggi; echo $v;?></td>-->
					<td colspan="3" class="text-center"><b>PENGGUNAAN KHUSUS</b></td>
				</tr>
				<tr>
					<td></td>
					<td>Sumbu ke-2</td>
					<td colspan="3"><?php echo $row->ban_sumbu2;?></td>
					<td rowspan="2"><div align="center">a.</div></td>
					<td colspan="2">Jenis barang khusus yang diijinkan diangkut : </td>
				</tr>
				<tr>
					<td></td>
					<td>Sumbu ke-3</td>
					<td colspan="3"><?php echo $row->ban_sumbu3;?></td>
					<td colspan="2">- </td>
				</tr>
				<tr>
					<td></td>
					<td>Sumbu ke-4 </td>
					<td colspan="3"><?php echo $row->ban_sumbu4;?></td>
					<td rowspan="2"><div align="center">b.</div></td>
					<td colspan="2">Jenis penggunaan khusus yang diperbolehkan </td>
				</tr>
				<tr>
					<td></td>
					<td>Sumbu ke-5</td>
					<td colspan="3"><?php echo $row->ban_sumbu5;?></td>
					<td colspan="2">-</td>
				</tr>
			</table>
		</div>
	</div>
<?php }} ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="header smaller lighter blue">
				Riwayat Uji Kendaraan
			</h3>
			
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<tr>
					<td width="15%"><div align="center"><strong>TANGGAL UJI </strong></div></td>
					<td width="15%"><div align="center"><strong>HABIS UJI </strong></div></td>
					<td width="35%"><div align="center"><strong>CATATAN</strong></div></td>
					<td width="20%"><div align="center"><strong>PENANDA TANGAN BUKU UJI </strong></div></td>
					<td width="15%"><div align="center"><strong>NO REG PENGUJI </strong></div></td>
				</tr>
				<?php
				if(isset($data_pengujian)){
				foreach($data_pengujian as $row){
				?>
				<tr>
					<td><div align="center"><?php echo strftime("%d %B %Y", strtotime(($row->tgl_uji)));?></div></td>
					<td><div align="center"><?php echo strftime("%d %B %Y", strtotime(($row->tgl_habis_uji)));?></div></td>
					<td>
					<?php 
					$kaca = $row->tint_meter;
					$sound = $row->sound_level;
					$alur = $row->alur_ban;
					$asap = $row->asap;
					$co = $row->asap_co;
					$hc = $row->asap_hc;
					
					$lampu_kiri = $row->lampu_kiri;
					$d_lampu_kiri = $row->derajat_lampu_kiri;
					$m_lampu_kiri = $row->menit_lampu_kiri;
					$lampu_kanan = $row->lampu_kanan;
					$d_lampu_kanan = $row->derajat_lampu_kanan;
					$m_lampu_kanan = $row->menit_lampu_kanan;
					$ss_in = $row->side_slip_in;

					if($row->ax_total_s1=="0"){
						$ax_s1 = $row->bk_sumbu1;
					} else {
						$ax_s1 = $row->ax_total_s1;
					}
					if($row->ax_total_s2=="0"){
						$ax_s2 = $row->bk_sumbu2;
					} else {
						$ax_s2 = $row->ax_total_s2;
					}
					if($row->ax_total_s3=="0"){
						$ax_s3 = $row->bk_sumbu3;
					} else {
						$ax_s3 = $row->ax_total_s3;
					}
					if($row->ax_total_s4=="0"){
						$ax_s4 = $row->bk_sumbu4;
					} else {
						$ax_s4 = $row->ax_total_s4;
					}
					$br_kiri_s1 = $row->br_kiri_s1;
					$br_kanan_s1 = $row->br_kanan_s1;
					$br_kiri_s2 = $row->br_kiri_s2;
					$br_kanan_s2 = $row->br_kanan_s2;
					$br_kiri_s3 = $row->br_kiri_s3;
					$br_kanan_s3 = $row->br_kanan_s3;
					$br_kiri_s4 = $row->br_kiri_s4;
					$br_kanan_s4 = $row->br_kanan_s4;
					$br_tangan_kiri = $row->br_tangan_kiri;
					$br_tangan_kanan = $row->br_tangan_kanan;
					$br_kaki_kiri = $row->br_kaki_kiri;
					$br_kaki_kanan = $row->br_kaki_kanan;
					
					$br_total_s1 = $br_kiri_s1 + $br_kanan_s1;
					$br_total_s2 = $br_kiri_s2 + $br_kanan_s2;
					$br_total_s3 = $br_kiri_s3 + $br_kanan_s3;
					$br_total_s4 = $br_kiri_s3 + $br_kanan_s4;
					
					$br_parkir_tangan = $br_tangan_kiri + $br_tangan_kanan;
					$br_parkir_kaki = $br_kaki_kiri + $br_kaki_kanan;
					
					$rem_utama = ($br_total_s1 + $br_total_s2 + $br_total_s3 + $br_total_s4)/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4) * 100;
					$ps1 = ((abs($br_kiri_s1-$br_kanan_s1))/$ax_s1)*100;
					$ps2 = ((abs($br_kiri_s2-$br_kanan_s2))/$ax_s2)*100;
					if($ax_s3>0){
						$ps3 = ((abs($br_kiri_s3-$br_kanan_s3))/$ax_s3)*100;
					}
					if($ax_s4>0){
						$ps4 = ((abs($br_kiri_s4-$br_kanan_s4))/$ax_s4)*100;
					}
					
					if($br_tangan_kanan>0){
						$rem_parkir = $br_parkir_tangan/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4)*100;
					} else {
						$rem_parkir = $br_parkir_kaki/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4)*100;
					}
					$speedometer = $row->speedometer;
					?>
					Kaca : <?php echo $row->tint_meter." %";?>, Sound : <?php echo $row->sound_level." db";?>, Alur ban : <?php echo $row->alur_ban ." mm";?>, 
					Asap <?php if($bahan_bakar=="SOLAR"){ echo $row->asap."%"; } else { ?> CO: <?php echo $row->asap_co."%";?> HC: <?php echo $row->asap_hc."%"; } ?>,
					Lampu Kiri : <?php echo $row->lampu_kiri;?> cd <?php echo $row->derajat_lampu_kiri;?>&deg; Lampu Kanan : <?php echo $row->lampu_kanan;?> cd <?php echo $row->derajat_lampu_kanan;?>&deg;,
					Sideslip : <?php echo $row->side_slip_in;?> mm, Rem Utama : <?php echo round($rem_utama,2);?>%, Rem Parkir : <?php echo round($rem_parkir,2);?>%, PS1: <?php echo round($ps1,2);?>%, PS2: <?php echo round($ps2,2);?>% <?php if($ax_s3>0){?>, PS3: <?php echo round($ps3,2);?>% <?php } ?> <?php if($ax_s4>0){?>, PS4: <?php echo round($ps4,2);?>%<?php } ?>
					Speedometer : <?php echo $row->speedometer;?> kpj
					</td>
					<td><div align="center"><?php echo $row->nama;?></div></td>
					<td><div align="center"><?php echo $row->nrp;?></div></td>
				</tr>
				<?php }} ?>
			</table>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="header smaller lighter blue">
				Riwayat Uji Luar Daerah
			</h3>
			
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<tr>
					<td colspan="5"><div align="center"><strong>RIWAYAT UJI DI LUAR WILAYAH</strong></div></td>
				</tr>
				<tr>
					<td width="17%"><div align="center"><strong>TGL UJI </strong></div></td>
					<td width="23%"><div align="center"><strong>KOTA TUJUAN</strong></div></td>
					<td><div align="center"><strong>CATATAN</strong></div></td>
				</tr>
				<?php if(isset($data_uji_keluar)){
				foreach($data_uji_keluar as $row){
				?>
				<tr>
					<td width="17%"><div align="center"><?php echo date("d M Y",strtotime($row->tgl));?></div></td>
					<td width="23%"><div align="center"><?php echo $row->tujuan_num;?></div></td>
					<td><div align="center">No Surat : 551.2/<?php echo $row->no_surat;?>, Tanggal : <?php echo strftime("%d %B %Y", strtotime(($row->tgl_surat)));?></div></td>
				</tr>
				<?php }} ?>
			</table>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="header smaller lighter blue">
				Riwayat Notifikasi WhatsApp
			</h3>
			
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<tr>
					<td><div align="center"><strong>NO</strong></div></td>
					<td><div align="center"><strong>TGL NOTIFIKASI</strong></div></td>
					<td><div align="center"><strong>NOTIFIKASI</strong></div></td>
				</tr>
				<?php 
				$no=1;
				if(isset($dt_whatsapp)){
				foreach($dt_whatsapp as $row){
				?>
				<tr>
					<td><div align="center"><?php echo $no++;?></div></td>
					<td><div align="center"><?php echo strftime("%d %B %Y %T", strtotime(($row->tgl_pesan)));?></div></td>
					<td><?php echo $row->message;?></td>
				</tr>
				<?php }} ?>
			</table>
		</div>
	</div>
</div>

<div id="tambahberkas" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Berkas Kendaraan</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('kendaraan/prosesberkas/'.$nouji);?>" enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Jenis Berkas</label>
								<div class="col-sm-9">
									<select id="jenis_berkas" name="jenis_berkas" class="select2" data-placeholder="Pilih jenis berkas...">
										<option value="">-</option>
										<option value="STNK">STNK</option>
										<option value="SRUT">SRUT</option>
										<option value="NUMPANG">NUMPANG</option>
										<option value="MUTASI">MUTASI</option>
										<option value="KARTU_INDUK">KARTU INDUK</option>
										<option value="KEHILANGAN">KEHILANGAN</option>
										<option value="FISKAL">FISKAL</option>
										<option value="LAINNYA">LAINNYA</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Upload Berkas</label>
								<div class="col-sm-9">
									<input type="file" id="berkas" name="berkas"/>
								</div>
							</div>
							
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i>
						Batal
					</button>

					<button type="submit" class="btn btn-sm btn-primary">
						<i class="ace-icon fa fa-check"></i>
						Kirim
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach($dt_kendaraan as $row){ ?>
<div id="statuskendaraan" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Status Kendaraan</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('kendaraan/edit_statuskendaraan/'.$row->no_uji);?>" enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Status Kendaraan</label>
								<div class="col-sm-9">
									<select id="status" name="status" class="select2" data-placeholder="Pilih status kendaraan...">
										<option value="">-</option>
										<?php foreach($dt_status_kendaraan as $sts){ 
										if($row->status==$sts->status){?>
										<option value="<?php echo $row->status;?>" selected><?php echo $sts->keterangan;?></option>
										<?php } else { ?>
										<option value="<?php echo $sts->status;?>"><?php echo $sts->keterangan;?></option>
										<?php }} ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i>
						Batal
					</button>

					<button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Anda yakin akan merubah status kendaraan?')">
						<i class="ace-icon fa fa-check"></i>
						Proses
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>

<script type="text/javascript">		
	jQuery(function($) {
		$('#berkas').ace_file_input({
			no_file:'Upload Berkas ...',
			btn_choose:'Pilih Berkas',
			btn_change:'Ganti',
			droppable:true,
			onchange:null,
		});
	});
</script>