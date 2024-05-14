<div class="page-content">
	
	<?php 
	if(isset($dt_perso)){
		foreach($dt_perso as $row){
		?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('uji/proseseditperso?id='.$row->idx.'&no='.$row->nouji);?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<div class="page-header">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<h1>
						EDIT DATA PERSO HASIL UJI KENDARAAN
					</h1>
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Pengujian </label>
					<div class="col-sm-8">
						<input type="text" id="nouji" name="nouji" value="<?php echo $row->nouji;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="noregistrasikendaraan" name="noregistrasikendaraan" value="<?php echo $row->noregistrasikendaraan;?>"  class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Rangka </label>
					<div class="col-sm-8">
						<input type="text" id="norangka" name="norangka" placeholder="Nomor Rangka Landasan" value="<?php echo $row->norangka;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Mesin </label>
					<div class="col-sm-8">
						<input type="text" id="nomesin" name="nomesin" placeholder="Nomor Mesin" value="<?php echo $row->nomesin;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Merek </label>
					<div class="col-sm-8">
						<input type="text" id="merek" name="merek" placeholder="Merek" value="<?php echo $row->merek;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="tipe" name="tipe" placeholder="Tipe" value="<?php echo $row->tipe;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-8">
						<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis kendaraan..." required >
							<option></option>
							<?php foreach($dt_jenis_kendaraan as $jnsken){ 
							if($row->jenis==$jnsken->jenis_kendaraan){?>
							<option value="<?php echo $row->jenis;?>" selected><?php echo $row->jenis;?></option>
							<?php } else { ?>
							<option value="<?php echo $jnsken->jenis_kendaraan;?>"><?php echo $jnsken->jenis_kendaraan;?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tahun Pembuatan </label>
					<div class="col-sm-8">
						<input type="text" id="thpembuatan" name="thpembuatan" placeholder="Tahun Pembuatan" value="<?php echo $row->thpembuatan;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Bahan Bakar </label>
					<div class="col-sm-8">
						<select id="bahanbakar" name="bahanbakar" class="select2" data-placeholder="Pilih bahan bakar..." required >
							<option></option>
							<?php foreach($dt_bahanbakar as $bbm){ 
							if($row->bahanbakar==$bbm->bahan_bakar){ ?>
							<option value="<?php echo $row->bahanbakar;?>" selected><?php echo $row->bahanbakar;?></option>
							<?php } else { ?>
							<option value="<?php echo $bbm->bahan_bakar;?>"><?php echo $bbm->bahan_bakar;?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Isi Silinder </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="isisilinder" name="isisilinder" placeholder="Isi Silinder" value="<?php echo $row->isisilinder;?>" class="col-xs-12" required />
							<span class="input-group-addon">
								cc
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Daya Motor </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="dayamotorpenggerak" name="dayamotorpenggerak" placeholder="Daya Motor" value="<?php echo $row->dayamotorpenggerak;?>" class="col-xs-12" required />
							<span class="input-group-addon">
								kW/PS/HP
							</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Direktur </label>
					<div class="col-sm-8">
						<select id="direktur" name="direktur" class="select2" data-placeholder="Pilih direktur...">
							<?php foreach($dt_direktur as $dir){ ?>
							<option value="<?php echo $dir->idx;?>"><?php echo $dir->nama;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kepala Dinas</label>
					<div class="col-sm-8">
						<select id="kadis" name="kadis" class="select2" data-placeholder="Pilih kepala dinas...">
							<?php foreach($dt_kadis as $dis){ ?>
							<option value="<?php echo $dis->idx;?>"><?php echo $dis->nama;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Penguji</label>
					<div class="col-sm-8">
						<select class="select2" id="penguji" name="penguji" data-placeholder="Pilih penguji" required>
							<option value=""></option>
							<?php foreach($dt_penguji as $pgj){ 
							if($row->idpetugasuji==$pgj->idx){ ?>
							<option value="<?php echo $row->idpetugasuji;?>" selected><?php echo $pgj->nama;?></option>
							<?php } else { ?>
							<option value="<?php echo $pgj->idx;?>"><?php echo $pgj->nama; ?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kode Wilayah Uji</label>
					<div class="col-sm-8">
						<select class="select2" id="kd_wilayah" name="kd_wilayah" data-placeholder="Pilih kode wilayah" required>
							<option value=""></option>
							<?php foreach($dt_setting as $stg){ $wilayah = $stg->kodewilayah;}  
							foreach($dt_wilayah as $wly){ 
							if($wilayah==$wly->kodewilayah){ ?>
							<option value="<?php echo $wilayah;?>" selected><?php echo $wilayah; ?></option>
							<?php } else { ?>
							<option value="<?php echo $wly->kodewilayah;?>"><?php echo $wly->kodewilayah; ?>-<?php echo $wly->namawilayah; ?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kode Wilayah Asal </label>
					<div class="col-sm-8">
						<select class="select2" id="kd_wilayah_asal" name="kd_wilayah_asal" data-placeholder="Pilih kode wilayah asal" required>
							<option value=""></option>
							<?php foreach($dt_wilayah as $wly){ 
							if($row->kodewilayahasal==$wly->kodewilayah){ ?>
							<option value="<?php echo $row->kodewilayahasal;?>" selected><?php echo $row->kodewilayahasal; ?></option>
							<?php } else { ?>
							<option value="<?php echo $wly->kodewilayah;?>"><?php echo $wly->kodewilayah; ?>-<?php echo $wly->namawilayah; ?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor KTP </label>
					<div class="col-sm-8">
						<input type="text" id="noidentitaspemilik" name="noidentitaspemilik" placeholder="Nomor KTP" value="<?php echo $row->noidentitaspemilik;?>" class="col-xs-12"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nama Pemilik </label>
					<div class="col-sm-8">
						<input type="text" id="nama" name="nama" placeholder="Nama Pemilik" value="<?php echo $row->nama;?>" class="col-xs-12"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Alamat </label>
					<div class="col-sm-8">
						<textarea class="form-control limited" id="alamat" name="alamat" placeholder="Alamat" maxlength="50"><?php echo $row->alamat;?></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Nomor SRUT</label>
					<div class="col-sm-8">
						<input type="text" id="nosertifikatreg" name="nosertifikatreg" placeholder="No Sertifikasi Uji Tipe" value="<?php echo $row->nosertifikatreg;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Tanggal SRUT</label>
					<div class="col-sm-8">
						<input type="text" id="tglsertifikatreg" name="tglsertifikatreg" placeholder="Tanggal Sertifikasi Uji Tipe" value="<?php echo $row->tglsertifikatreg;?>" class="col-xs-12" required />
					</div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller lighter blue">DATA SPESIFIKASI KENDARAAN</h3>
		
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBB </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jbb" name="jbb" placeholder="Jumlah Berat Diperbolehkan" value="<?php echo $row->jbb;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBKB </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jbkb" name="jbkb" placeholder="Jumlah Berat Kombinasi Diperbolehkan" value="<?php echo $row->jbkb;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBI </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jbi" name="jbi" placeholder="JBI" value="<?php echo $row->jbi;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBKI </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jbki" name="jbki" placeholder="JBI Kombinasi" value="<?php echo $row->jbki;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> MST </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="mst" name="mst" placeholder="Muatan Sumbu Terberat" value="<?php echo $row->mst;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> BK Total </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="beratkosong" name="beratkosong" placeholder="Jumlah Berat Kosong" value="<?php echo $row->beratkosong;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Konf Sumbu </label>
					<div class="col-sm-8">
						<input type="text" id="konfigurasisumburoda" name="konfigurasisumburoda" placeholder="Konfigurasi Sumbu" value="<?php echo $row->konfigurasisumburoda;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Ukuran Ban </label>
					<div class="col-sm-8">
						<input type="text" id="ukuranban" name="ukuranban" placeholder="Sumbu ke-1" value="<?php echo $row->ukuranban;?>" class="col-xs-12" required />
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Panjang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="panjangkendaraan" name="panjangkendaraan" placeholder="Panjang Ukuran Utama" value="<?php echo $row->panjangkendaraan;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="lebarkendaraan" name="lebarkendaraan" placeholder="Lebar Ukuran Utama" value="<?php echo $row->lebarkendaraan;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="tinggikendaraan" name="tinggikendaraan" placeholder="Tinggi Ukuran Utama" value="<?php echo $row->tinggikendaraan;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Julur Belakang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="julurdepan" name="julurdepan" placeholder="Julur Belakang" value="<?php echo $row->julurdepan;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Julur Depan </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="julurbelakang" name="julurbelakang" placeholder="Julur Depan" value="<?php echo $row->julurbelakang;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Panjang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="panjangbakatautangki" name="panjangbakatautangki" placeholder="Panjang Dimensi Bak Muatan" value="<?php echo $row->panjangbakatautangki;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Lebar </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="lebarbakatautangki" name="lebarbakatautangki" placeholder="Lebar Dimensi Bak Muatan" value="<?php echo $row->lebarbakatautangki;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tinggi </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="tinggibakatautangki" name="tinggibakatautangki" placeholder="Tinggi Dimensi Bak Muatan" value="<?php echo $row->tinggibakatautangki;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Sumbu I-II </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jaraksumbu1_2" name="jaraksumbu1_2" placeholder="Jarak Sumbu I-II" value="<?php echo $row->jaraksumbu1_2;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Sumbu II-III </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jaraksumbu2_3" name="jaraksumbu2_3" placeholder="Jarak Sumbu II-III" value="<?php echo $row->jaraksumbu2_3;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Sumbu III-IV </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="jaraksumbu3_4" name="jaraksumbu3_4" placeholder="Jarak Sumbu III-IV" value="<?php echo $row->jaraksumbu3_4;?>" class="col-xs-12" required />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Orang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="dayaangkutorang" name="dayaangkutorang" placeholder="Berat Orang" value="<?php echo $row->dayaangkutorang;?>" class="col-xs-12" required />
							<span class="input-group-addon">Org</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Barang </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" id="dayaangkutbarang" name="dayaangkutbarang" placeholder="Daya Angkut Barang" value="<?php echo $row->dayaangkutbarang;?>" class="col-xs-12" required />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kelas Jalan </label>
					<div class="col-sm-8">
						<input type="text" id="kelasjalanterendah" name="kelasjalanterendah" placeholder="Kelas Jalan Terendah" value="<?php echo $row->kelasjalanterendah;?>" class="col-xs-12" required />
					</div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller lighter blue">FOTO KENDARAAN</h3>
		
		<?php if($row->uid!='') { ?>
		<div class="col-xs-12 col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller center">
						KAMERA DEPAN
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main center">
						<img class="img-responsive" src="data:image/png;base64,<?php echo base64_encode($row->fotodepansmall);?>">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller center">
						KAMERA BELAKANG
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main center">
						<img class="img-responsive" src="data:image/png;base64,<?php echo base64_encode($row->fotobelakangsmall);?>">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller center">
						KAMERA KANAN
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main center">
						<img class="img-responsive" src="data:image/png;base64,<?php echo base64_encode($row->fotokanansmall);?>">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller center">
						KAMERA KIRI
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main center">
						<img class="img-responsive" src="data:image/png;base64,<?php echo base64_encode($row->fotokirismall);?>">
					</div>
				</div>
			</div>
		</div>
		
		<?php } 
		foreach($dt_foto as $ft){ ?>
		
		<div class="col-xs-12 col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller center">
						KAMERA DEPAN
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main center">
						<img class="img-responsive" src="data:image/png;base64,<?php echo base64_encode($ft->fotodepanmentah);?>">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller center">
						KAMERA BELAKANG
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main center">
						<img class="img-responsive" src="data:image/png;base64,<?php echo base64_encode($ft->fotobelakangmentah);?>">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller center">
						KAMERA KANAN
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main center">
						<img class="img-responsive" src="data:image/png;base64,<?php echo base64_encode($ft->fotokananmentah);?>">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller center">
						KAMERA KIRI
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main center">
						<img class="img-responsive" src="data:image/png;base64,<?php echo base64_encode($ft->fotokirimentah);?>">
					</div>
				</div>
			</div>
		</div>
		
		<?php } ?>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit" onclick="return confirm('Anda yakin data sudah benar?')">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Proses Perso
				</button>

				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</div>
	</form>
	<?php }} ?>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
		});
	});
</script>