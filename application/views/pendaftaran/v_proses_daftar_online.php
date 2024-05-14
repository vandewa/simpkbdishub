<div class="page-content">
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Proses Pendaftaran Online Pengujian Kendaraan Bermotor
				</h1>
			</div>
		</div>
	</div>
	<?php
	$cek = $this->pendaftaran->getCekDaftarSkrg($no_uji);
	if($cek > 0){
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-info">
				<center>
					<p>	
						<strong>Kendaraan nomor uji <?php echo $no_uji;?> sudah terdaftar uji hari ini. Silahkan cek pada menu rekap pendaftaran.</strong>
					</p>
					
					<a href="<?php echo site_url('pendaftaran');?>">
						<button class="btn btn-primary btn-round">
							<i class="ace-icon fa fa-list-alt bigger-125"></i>
							REKAP PENDAFTARAN
						</button>
					</a>
				</center>
			</div>
		</div>
	</div>
	<?php
	} else {
	if(!empty($cari_pengujian)){
	foreach($cari_pengujian as $row){ 
		$idp = $row->id_user;
	?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('pendaftaran/proses_daftaronline?idp='.$idp.'&antrian='.$row->no_antrian.'&booking='.$row->tgl_booking)?>" method="post">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanggal Booking </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_booking" name="tgl_booking" type="text" value="<?php echo $row->tgl_booking;?>" data-date-format="yyyy-mm-dd" readonly />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kode Uji </label>
					<div class="col-sm-8">
						<input type="text" id="kode_uji" name="kode_uji" value="<?php echo $kode_uji; ?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Pengujian </label>
					<div class="col-sm-8">
						<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div id="cek_noken"></div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label bolder blue no-padding-left">Status Pemohon</label>
					<div class="col-sm-8">
						<select class="form-control" id="status_pemohon" name="status_pemohon" placeholder="Pilih status pemohon">
							<option value="pemilik" selected>Pemilik Kendaraan</option>
							<option value="dikuasakan">Dikuasakan</option>
						</select>
					</div>
				</div>
				
				<div id="pemilik">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nomor KTP/SIM Pemilik</label>
						<div class="col-sm-8">
							<input type="text" id="no_ktp_pemilik" name="no_ktp_pemilik" placeholder="Nomor KTP Pemilik" class="col-xs-12" autofocus />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nama Pemilik</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Nama Pemilik" id="nama_pemilik" name="nama_pemilik" class="col-xs-12" value="<?php echo $row->nama;?>" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Alamat Pemilik </label>
						<div class="col-sm-8">
							<textarea class="autosize-transition form-control" id="alamat_pemilik" name="alamat_pemilik" placeholder="Alamat Pemilik"><?php echo $row->alamat;?></textarea>
						</div>
					</div>
				</div>
				
				<div id="dikuasakan" style="display: none;">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nomor KTP/SIM Pemohon</label>
						<div class="col-sm-8">
							<input type="text" id="no_ktp_pemohon" name="no_ktp_pemohon" placeholder="Nomor KTP Pemohon" class="col-xs-12"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Nama Pemohon</label>
						<div class="col-sm-8">
							<input type="text" id="nama_pemohon" name="nama_pemohon" placeholder="Nama Pemohon" class="col-xs-12" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-left"> Alamat Pemohon </label>
						<div class="col-sm-8">
							<textarea id="alamat_pemohon" name="alamat_pemohon" class="autosize-transition form-control" placeholder="Alamat Pemohon"></textarea>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Nomor Whatsapp</label>
					<div class="col-sm-8">
						<input type="text" id="no_telp" name="no_telp" value="<?php echo $row->telp;?>" placeholder="Nomor whatsapp ex. 628xxxx" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label bolder blue no-padding-left">Status Pemilik</label>
					<div class="col-sm-8">
						<select class="form-control" id="status_pemilik" name="status_pemilik" placeholder="Pilih status pemilik">
							<option value="tetap" selected>Tetap</option>
							<option value="ubah_data">Ubah Data</option>
							<option value="ganti_nama">Ganti Nama</option>
						</select>
					</div>
				</div>
				
				<div id="form_status_pemilik"></div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Pendaftaran Untuk </label>
					<div class="col-sm-8">
						<select class="select2" id="jenis_uji" name="jenis_uji" data-placeholder="Pilih jenis pendaftaran">
							<option value="<?php echo $row->jenis_pendaftaran;?>" selected><?php echo $row->jenis_pendaftaran;?></option>
							<option>-</option>
							<option value="Pertama">Uji Pertama</option>
							<option value="Berkala">Uji Berkala</option>
							<option value="Numpang Masuk">Numpang Uji Masuk</option>
							<option value="Numpang Keluar">Numpang Uji Keluar</option>
							<option value="Mutasi Masuk">Mutasi Uji Masuk</option>
							<option value="Mutasi Keluar">Mutasi Uji Keluar</option>
							<option value="Penilaian Teknis">Penilaian Teknis</option>
							<option value="Penggantian">Penggantian Tanda Uji</option>
							<option value="Kehilangan">Kehilangan Buku Uji</option>
						</select>
					</div>
				</div>
				
				<div id="form_jenis_pendaftaran"></div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Status Penerbitan </label>
					<div class="col-sm-8">
						<select class="select2" id="status_terbit" name="status_terbit" data-placeholder="Pilih status penerbitan..." required>
							<option></option>
							<?php foreach($terbit as $tbt){ ?>
							<option value="<?php echo $tbt->statuspenerbitan;?>"><?php echo $tbt->keterangan;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div id="form_status_terbit"></div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanggal Pendaftaran </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_daftar_uji" name="tgl_daftar_uji" type="text" value="<?php echo date("Y-m-d");?>" data-date-format="yyyy-mm-dd" readonly />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Merek</label>
					<div class="col-sm-8">
						<input type="text" id="merek" name="merek" value="<?php echo $row->merek;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="tipe" name="tipe" value="<?php echo $row->tipe;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis </label>
					<div class="col-sm-8">
						<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis kendaraan..." required>
							<option></option>
							<?php foreach($dt_jenis as $jns){ 
							if($row->jenis==$jns->jenis){?>
							<option value="<?php echo $row->jenis;?>" selected><?php echo $row->jenis;?></option>
							<?php } else { ?>
							<option value="<?php echo $jns->jenis;?>"><?php echo $jns->jenis;?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-8">
						<select id="jenis_kendaraan" name="jenis_kendaraan" class="select2" data-placeholder="Pilih jenis kendaraan..." required>
							<option></option>
							<?php foreach($dt_jenis_kendaraan as $jnsken){ 
							if($row->jenis_kendaraan==$jnsken->jenis_kendaraan){?>
							<option value="<?php echo $row->jenis_kendaraan;?>" selected><?php echo $row->jenis_kendaraan;?></option>
							<?php } else { ?>
							<option value="<?php echo $jnsken->jenis_kendaraan;?>"><?php echo $jnsken->jenis_kendaraan;?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Bentuk Kendaraan </label>
					<div class="col-sm-8">
						<select id="bentuk" name="bentuk" class="select2" data-placeholder="Pilih bentuk kendaraan..." required>
							<option></option>
							<?php foreach($dt_jenis_bentuk as $jnsben){
							if($row->bentuk==$jnsben->jenis_kendaraan){?>
							<option value="<?php echo $row->bentuk;?>" selected><?php echo $row->bentuk;?></option>
							<?php } else { ?>
							<option value="<?php echo $jnsben->jenis_kendaraan;?>"><?php echo $jnsben->jenis_kendaraan;?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Bahan Bakar </label>
					<div class="col-sm-8">
						<select id="bahan_bakar" name="bahan_bakar" class="select2" data-placeholder="Pilih bahan bakar..." required>
							<option></option>
							<?php foreach($dt_bahanbakar as $bbm){ 
							if($row->bahan_bakar==$bbm->bahan_bakar){ ?>
							<option value="<?php echo $row->bahan_bakar;?>" selected><?php echo $row->bahan_bakar;?></option>
							<?php } else { ?>
							<option value="<?php echo $bbm->bahan_bakar;?>"><?php echo $bbm->bahan_bakar;?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tahun Pembuatan</label>
					<div class="col-sm-8">
						<input type="text" id="tahun" name="tahun" value="<?php echo $row->tahun;?>" class="col-xs-12" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Rangka </label>
					<div class="col-sm-8">
						<input type="text" id="no_rangka" name="no_rangka" value="<?php echo $row->no_rangka;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Mesin </label>
					<div class="col-sm-8">
						<input type="text" id="no_mesin" name="no_mesin" value="<?php echo $row->no_mesin;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> JBB Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="jbb" name="jbb" placeholder="JBB Kendaraan" value="<?php echo $row->jbb;?>" class="col-xs-12" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Status Penggunaan </label>
					<div class="col-sm-8">
						<select class="select2" id="sifat" name="sifat" data-placeholder="Pilih sifat penggunaan...">
							<option value="<?php echo $row->sifat;?>" selected><?php echo $row->sifat;?></option>
							<option value="UMUM">UMUM</option>
							<option value="TIDAK UMUM">TIDAK UMUM</option>
							<option value="DINAS">DINAS</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanggal Habis Uji </label>
					<div class="col-sm-5">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_habis_uji" name="tgl_habis_uji" type="text" value="<?php if($row->temp_tgl_habis_uji==''){ echo date("Y-m-d");} else { echo $row->temp_tgl_habis_uji;}?>" data-date-format="yyyy-mm-dd" />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">			
			<div class="col-xs-12 col-sm-12">
				<h4 class="header smaller lighter blue">
					DATA PEMBAYARAN
				</h4>
				
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-left"> Metode Pembayaran </label>
					<div class="col-sm-4">
						<select class="select2" id="metode_bayar" name="metode_bayar" data-placeholder="Pilih metode pembayaran" required >
							<option value="<?php echo $row->metode_bayar;?>" selected><?php echo $row->metode_bayar;?></option>
							<option>-</option>
							<option value="tunai">Tunai</option>
							<option value="online">Online</option>
						</select>
					</div>
					
					<label class="col-sm-2 control-label no-padding-left"> Status Bayar</label>
					<div class="col-sm-4">
						<input type="text" id="status_bayar" name="status_bayar" class="col-xs-12" value="<?php if($row->status_bayar=="0"){ echo "BELUM BAYAR"; } else { echo"LUNAS"; } ?>" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-left"> Kode Billing</label>
					<div class="col-sm-4">
						<input type="text" id="kode_billing" name="kode_billing" class="col-xs-12" value="<?php echo $row->id_billing; ?>" readonly />
					</div>
					
					<label class="col-sm-2 control-label no-padding-left"> Expired Billing</label>
					<div class="col-sm-4">
						<input type="text" id="exp_billing" name="exp_billing" class="col-xs-12" value="<?php echo $row->exp_billing; ?>" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-left"> Retribusi</label>
					<div class="col-sm-3">
						<input type="text" id="retribusi" name="retribusi" class="col-xs-12" required=""/>
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> Tanda Uji</label>
					<div class="col-sm-2">
						<select class="form-control" id="tanda" name="tanda" data-placeholder="Pilih tanda uji">
							<option value="0">-</option>
						<?php 
						if(isset($tanda)){
							foreach($tanda as $row){
							?>
							<option value="<?php echo $row->tarif;?>"><?php echo $row->nama_retribusi; ?></option>
							<?php
							}
						}
						?>
						</select>
					</div>
					
					<?php foreach($denda as $row){ $retdenda = $row->tarif; } ?> 
					<label class="col-sm-1 control-label no-padding-left"> Denda</label>
					<div class="col-sm-1">
						<input type="text" id="denda" name="denda" value="0" class="col-xs-12" readonly />
					</div>
					<div class="col-sm-2">
						<input type="text" id="jml_denda" name="jml_denda" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-left"> Total</label>
					<div class="col-sm-4">
						<input type="hidden" id="total_retribusi" name="total_retribusi" value="" class="col-xs-12" readonly />
						<input type="text" id="total_semua" name="total_semua" value="" class="col-xs-12" readonly />
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> Terbilang </label>
					<div class="col-sm-5">
						<input type="text" id="terbilang" name="terbilang" value="" class="col-xs-12" readonly />
					</div>
				</div>
			</div>
		</div>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit" onclick="return confirm('Anda yakin data pendaftaran sudah benar?')">
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
	<?php }} else { ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger">
					<center>
						<p>	
							<strong>Data tidak ditemukan, harap masukan nomor uji kembali dengan benar.</strong>
						</p>
						
						
					</center>
				</div>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<form action="<?php echo site_url('pendaftaran/ujiberkala')?>" method="post">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="ace-icon fa fa-search blue"></i>
						</span>
						
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." autofocus/>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-info btn-sm">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								Cari
							</button>
						</span>
					</div>
				</form>
				
				<div class="space space-12"></div>
				
				
				<center>
					<a href="<?php echo site_url('pendaftaran/uji');?>">
					<button class="btn btn-primary btn-round">
						<i class="ace-icon fa fa-list-alt bigger-125"></i>
						PENDAFTARAN
					</button>
					</a>
				</center>
			</div>
		</div>
		
	<?php }} ?>
</div>

<script type="text/javascript">
	jQuery(function($) {
		setInterval(function(){
			var metode = $('#metode_bayar').val();
			if(metode === "tunai"){
				
				var jns = $('#jenis').val();
				var jbb = parseFloat($('#jbb').val());
				
				$.ajax({
					url: "<?php echo base_url('pendaftaran/get_retribusi'); ?>",
					type: 'GET',
					data: {
						'jns':jns,
						'jbb':jbb,
					},
					success: function(data){
						var obj = JSON.parse(data);
						if(obj == ""){
							$("#retribusi").val("");
						}
						else {
							$("#retribusi").val(obj[0].tarif);
						}
					}
				});
				
				var th = ['','Ribu','Juta', 'Milyar','Triliun'];
				var dg = ['Nol','Satu','Dua','Tiga','Empat', 'Lima','Enam','Tujuh','Delapan','Sembilan']; var tn = ['Sepuluh','Sebelas','Dua Belas','Tiga Belas', 'Empat Belas','Lima Belas','Enam Belas', 'Tujuh Belas','Delapan Belas','Sembilan Belas']; var tw = ['Dua Puluh','Tiga Puluh','Empat Puluh','Lima Puluh', 'Enam Puluh','Tujuh Puluh','Delapan Puluh','Sembilan Puluh'];
				function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'Bukan Angka'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'Angka Terlalu Besar'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'Ratus ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'Koma '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ').replace("Satu Ratus","Seratus").replace("Satu Ribu","Seribu").replace("Satu Puluh","Sepuluh");}
				
				var hbs_uji = new Date($('#tgl_habis_uji').val());
				var dhb = hbs_uji.getDate();
				var mhb = hbs_uji.getMonth();
				var yhb = hbs_uji.getFullYear();
				if (dhb < 10) {
				  dhb = '0' + dhb;
				} 
				if (mhb < 10) {
				  mhb = '0' + mhb;
				}
				var hbs_uji = yhb + '-' + mhb + '-' + dhb;
				<?php $tgl = date("Y-m-d",strtotime('-1 days')); ?>
				var a = moment([<?php echo date("Y",strtotime($tgl));?>, <?php echo date("m",strtotime($tgl));?>, <?php echo date("d",strtotime($tgl));?>]);
				var b = moment([yhb, mhb, dhb]);
				var selisih = a.diff(b, 'months');
				
				if(a > b){
					denda = selisih;
				} else {
					denda = 0;
				}
				
				var ret = parseFloat($('#retribusi').val());
				var tan = parseFloat($('#tanda').val());
				
				var jml_denda = ret * denda * 0.02;
				var jml = ret+tan+jml_denda;
				var jml_retribusi = ret+tan;

				$('#denda').val(denda);
				$('#jml_denda').val(jml_denda);
				$('#total_retribusi').val(jml_retribusi);
				$('#total_semua').val(jml);
				$('#terbilang').val(toWords(jml));
			}
		}, 3000);
		
		$("#tanda").click(function(e){
			var jns = $('#jenis').val();
			var jbb = parseFloat($('#jbb').val());
			
			$.ajax({
				url: "<?php echo base_url('pendaftaran/get_retribusi'); ?>",
				type: 'GET',
				data: {
					'jns':jns,
					'jbb':jbb,
				},
				success: function(data){
					var obj = JSON.parse(data);
					if(obj == ""){
						$("#retribusi").val("");
					}
					else {
						$("#retribusi").val(obj[0].tarif);
					}
				}
			});
			
			var th = ['','Ribu','Juta', 'Milyar','Triliun'];
			var dg = ['Nol','Satu','Dua','Tiga','Empat', 'Lima','Enam','Tujuh','Delapan','Sembilan']; var tn = ['Sepuluh','Sebelas','Dua Belas','Tiga Belas', 'Empat Belas','Lima Belas','Enam Belas', 'Tujuh Belas','Delapan Belas','Sembilan Belas']; var tw = ['Dua Puluh','Tiga Puluh','Empat Puluh','Lima Puluh', 'Enam Puluh','Tujuh Puluh','Delapan Puluh','Sembilan Puluh'];
			function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'Bukan Angka'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'Angka Terlalu Besar'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'Ratus ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'Koma '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ').replace("Satu Ratus","Seratus").replace("Satu Ribu","Seribu").replace("Satu Puluh","Sepuluh");}
			
			var hbs_uji = new Date($('#tgl_habis_uji').val());
			var dhb = hbs_uji.getDate();
			var mhb = hbs_uji.getMonth();
			var yhb = hbs_uji.getFullYear();
			if (dhb < 10) {
			  dhb = '0' + dhb;
			} 
			if (mhb < 10) {
			  mhb = '0' + mhb;
			}
			var hbs_uji = yhb + '-' + mhb + '-' + dhb;
			<?php $tgl = date("Y-m-d",strtotime('-1 days')); ?>
			var a = moment([<?php echo date("Y",strtotime($tgl));?>, <?php echo date("m",strtotime($tgl));?>, <?php echo date("d",strtotime($tgl));?>]);
			var b = moment([yhb, mhb, dhb]);
			var selisih = a.diff(b, 'months');
			
			if(a > b){
				denda = selisih;
			} else {
				denda = 0;
			}
			
			var ret = parseFloat($('#retribusi').val());
			var tan = parseFloat($('#tanda').val());
			
			var jml_denda = ret * denda * 0.02;
			var jml = ret+tan+jml_denda;
			var jml_retribusi = ret+tan;
			
			$('#denda').val(denda);
			$('#jml_denda').val(jml_denda);
			$('#total_retribusi').val(jml_retribusi);
			$('#total_semua').val(jml);
			$('#terbilang').val(toWords(jml));
		});
		
		$("#status_terbit").on("change",function(e){
			if( ($(this).val()==="5") || ($(this).val()==="6")){
				$('#form_status_terbit').empty();
				$("#form_status_terbit").load("<?php echo base_url('pendaftaran/numpang');?>");
			} else {
				$('#form_status_terbit').empty();
			}
		});
				
		$("#jenis_uji").on("change",function(e){
			if( ($(this).val()==="Numpang Masuk") || ($(this).val()==="Mutasi Masuk")){
				$('#form_jenis_pendaftaran').empty();
				$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_masuk');?>");
			} else if($(this).val()==="Numpang Keluar"){
				$('#form_jenis_pendaftaran').empty();
				$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_numpang');?>");
			} else if($(this).val()==="Mutasi Keluar"){
				$('#form_jenis_pendaftaran').empty();
				$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_mutasi');?>");
			} else if($(this).val()==="Kehilangan"){
				$('#form_jenis_pendaftaran').empty();
				$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_kehilangan');?>");
			} else {
				$('#form_jenis_pendaftaran').empty();
			}
		});
		
		$('#status_pemilik').on('change',function(){
			if( $(this).val()==="ubah_data"){
				$('#form_status_pemilik').empty();
				$("#form_status_pemilik").load("<?php echo base_url('pendaftaran/ubah_data/'.$idp);?>");
			} else if($(this).val()==="ganti_nama"){
				$('#form_status_pemilik').empty();
				$("#form_status_pemilik").load("<?php echo base_url('pendaftaran/ganti_nama');?>");
			} else {
				$('#form_status_pemilik').empty();
			}
		});
		
		$('#status_pemohon').on('change',function(){
			if( $(this).val()==="dikuasakan"){
				$("#dikuasakan").show();
				$("#pemilik").hide();
			} else {
				$("#dikuasakan").hide();
				$("#pemilik").show();
			}
		});
		
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
		});
		
		$("#no_ktp_pemohon").keyup(function(){
			if($("#no_ktp_pemohon").val().length>11){
				var no_ktp = $("#no_ktp_pemohon").val();
				
				var post_data = {
				   'no_ktp': no_ktp,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('pendaftaran/get_cek_pemohon'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						if(obj[0].cek == "1"){
							alert("Nomor KTP sudah terdaftar pada pengujian hari ini. Harap gunakan identitas lainnya.");
						}
						else {
							$.ajax({
								type: "post",
								url : "<?php echo base_url('pendaftaran/get_pemohon'); ?>",
								cache: false,    
								data: post_data,
								success: function(response){
									var obj = JSON.parse(response);
									if(obj == ""){
										$("#nama_pemohon").val("");
										$("#alamat_pemohon").val("");
										//$("#no_telp").val("");
									}
									else {
										$("#nama_pemohon").val(obj[0].nama);
										$("#alamat_pemohon").val(obj[0].alamat);
										$("#no_telp").val(obj[0].telp);
									}
								}
							});
						}
					}
				});
				
				
			}
			return false;
		});
		
		$("#no_kendaraan").keyup(function(){
			if($("#no_kendaraan").val().length>6){
				var no_kendaraan = $("#no_kendaraan").val();
				
				var post_data = {
				   'no_kendaraan': no_kendaraan,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('pendaftaran/cek_nomor_kendaraan'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						if(obj[0].cek == "1"){
							$("#cek_noken").html("<label class='col-sm-4'></label><label class='col-sm-8 text-danger'>NOMOR KENDARAAN SUDAH ADA</label>");
						} else {
							$("#cek_noken").html("");
						}
					}
				});
			} 
			else {
				$("#cek_noken").html("");
			}
		});
		
		$("#no_ktp_pemilik").keyup(function(){
			if($("#no_ktp_pemilik").val().length>11){
				var no_ktp = $("#no_ktp_pemilik").val();
				
				var post_data = {
				   'no_ktp': no_ktp,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('pendaftaran/get_pemohon'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						$("#nama_pemilik").val(obj[0].nama);
						$("#alamat_pemilik").val(obj[0].alamat);
						$("#no_telp").val(obj[0].telp);
					}
				});
			}
			return false;
		});
		
		$("#no_ktp").keyup(function(){
			if($("#no_ktp").val().length>15){
				var no_ktp = $("#no_ktp").val();
				
				var post_data = {
				   'no_ktp': no_ktp,
				   '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};
				
				$.ajax({
					type: "post",
					url : "<?php echo base_url('pendaftaran/get_pemilik'); ?>",
					cache: false,    
					data: post_data,
					success: function(response){
						var obj = JSON.parse(response);
						$("#nama").val(obj[0].nama);
						$("#alamat").val(obj[0].alamat);
						$("#kecamatan").val(obj[0].kecamatan);
						$("#kota").val(obj[0].kota);
					}
				});
			}
			return false;
		});
	});
</script>	