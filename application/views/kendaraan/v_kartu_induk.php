<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>KARTU INDUK <?php echo $no_uji;?></title>
<style type="text/css">
<!--
.style17 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12px; }
.style19 {font-family: Geneva, Arial, Helvetica, sans-serif}
.style17 {font-size: 12px}
.style17 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12; }
.style17 {font-size: 12}
.style25 {font-size: 9px}
.style28 {font-size: 9}
.style30 {font-size: 12px; font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<?php 
	if(isset($detail_kendaraan)){
	foreach($detail_kendaraan as $row){
		$bahan_bakar = $row->bahan_bakar;
		$jenis = $row->jenis;
		$tahun = $row->tahun;
		$jbb = $row->jbb;
?>
<form id="form1" name="form1" method="post" action="">
	<table width="100%" border="0">
		<tr>
			<td width="70%" rowspan="2"><img src="<?php echo base_url('assets/images/logo-kartu-induk.jpg');?>" width="72%" height="65" /></td>
			<td width="16%"><strong>NO. PEMERIKSAAN </strong></td>
			<td width="14%">: <?php echo $row->no_uji;?></td>
		</tr>
		<tr>
			<td valign="top"><strong>NO. KENDARAAN </strong></td>
		<td valign="top">: <?php echo $row->no_kendaraan;?></td>
		</tr>
	</table>
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
		<tr>
			<td colspan="6" bgcolor="#999999"><span class="style30">URAIAN TENTANG KENDARAAN </span></td>
			<td colspan="3" bgcolor="#999999"><span class="style30">KETERANGAN KHUSUS </span></td>
		</tr>
		<tr>
			<td width="1%"><span class="style17">1.</span></td>
			<td width="10%"><span class="style17">Merk</span></td>
			<td width="10%"><span class="style17">: <?php echo $row->merek;?></span></td>
			<td width="1%"><span class="style17">10.</span></td>
			<td width="10%"><span class="style17">Rumah-rumah (karoseri) </span></td>
			<td width="10%"><span class="style17"></span></td>
			<td width="1%"><div align="center"><span class="style17">a.</span></div></td>
			<td width="10%"><span class="style17">Warna</span></td>
			<td width="10%"><span class="style17">: <?php echo $row->warna;?></span></td>
		</tr>
		<tr>
			<td><span class="style17">2.</span></td>
			<td><span class="style17">Type</span></td>
			<td><span class="style17">: <?php echo $row->tipe;?></span></td>
			<td><div align="left"><span class="style17">a.</span></div></td>
			<td><span class="style17">Jenis</span></td>
			<td><span class="style17">: <?php echo $row->karoseri;?></span></td>
			<td rowspan="3" valign="top"><div align="center"><span class="style17">b.</span><span class="style17"></span><span class="style17"></span></div></td>
			<td><span class="style17">Bagian yang menjulur </span></td>
			<td><span class="style17"></span></td>
		</tr>
		<tr>
			<td><span class="style17">3.</span></td>
			<td><span class="style17">Tahun Pembuatan </span></td>
			<td><span class="style17">: <?php echo $row->tahun;?></span></td>
			<td><div align="left"><span class="style17">b.</span></div></td>
			<td><span class="style17">Bahan</span></td>
			<td><span class="style17">: <?php echo $row->dbm_bahan_bak;?></span></td>
			<td><span class="style17">- Ke belakang (ROH) </span></td>
			<td><span class="style17">: <?php echo $row->uk_roh;?></span></td>
		</tr>
		<tr>
			<td><span class="style17">4.</span></td>
			<td><span class="style17">Pemakaian Pertama </span></td>
			<td><span class="style17">: <?php echo date("d M Y",strtotime($row->tgl_pemakaian_pertama));?></span></td>
			<td><div align="left"><span class="style17">c.</span></div></td>
			<td><span class="style17">Jumlah tempat duduk </span></td>
			<td><span class="style17">: <?php echo $row->tempat_duduk;?></span></td>
			<td><span class="style17">- Ke depan (FOH) </span></td>
			<td><span class="style17">: <?php echo $row->uk_foh;?></span></td>
		</tr>
		<tr>
			<td><span class="style17">5.</span></td>
			<td><span class="style17">Nomor Landasan/Rangka</span></td>
			<td><span class="style17">: <?php echo $row->no_rangka;?></span></td>
			<td><span class="style17">d.</span></td>
			<td><span class="style17">Jumlah tempat berdiri </span></td>
			<td><span class="style17">: <?php echo $row->tempat_berdiri;?></span></td>
			<td><div align="center"><span class="style17">c.</span></div></td>
			<td><span class="style17">Jarak tengah</span></td>
			<td><span class="style17">: </span></td>
		</tr>
		<tr>
			<td><span class="style17">6.</span></td>
			<td><span class="style17">Nomor Mesin </span></td>
			<td><span class="style17">: <?php echo $row->no_mesin;?></span></td>
			<td rowspan="4" valign="top"><div align="left"><span class="style17">e.</span></div>
			<span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span></td>
			<td colspan="2"><span class="style17">keterangan-keterangan lainnya </span><span class="style17"></span></td>
			<td><div align="center"><span class="style17">d.</span></div></td>
			<td><span class="style17">Konfigurasi sumbu </span></td>
			<td><span class="style17">: <?php echo $row->konf_sumbu;?></span></td>
		</tr>
		<tr>
			<td><span class="style17">7.</span></td>
			<td><span class="style17">Panjang keseluruhan </span></td>
			<td><span class="style17">: <?php echo $row->uk_panjang;?></span></td>
			<td colspan="2" rowspan="3" valign="top">
				<table width="50%" border="0">
					<tr>
						<td width="50%" class="style17">p : <?php echo $row->js_sumbup;?></td>
						<td width="50%" class="style17">r : <?php echo $row->js_sumbur;?></td>
					</tr>
				</table>        
				<span class="style17"></span>
				<table width="50%" border="0">
					<tr>
						<td width="50%" class="style17">q : <?php echo $row->js_sumbuq;?></td>
						<td width="50%" class="style17">b : <?php echo $row->js_sumbub;?></td>
					</tr>
				</table>      
				<span class="style17"></span></td>
			<td rowspan="3" valign="top"><div align="center"><span class="style17">e.</span><span class="style17"></span></div></td>
			<td rowspan="3" valign="top"><span class="style17">Jarak sumbu </span><span class="style17"></span></td>
			<td rowspan="3" valign="top">
				<table width="100%" border="0">
					<tr>
						<td width="50%" class="style17">a1: <?php echo $row->js_sumbu1;?> </td>
						<td width="50%" class="style17">a3: <?php echo $row->js_sumbu3;?></td>
					</tr>
				</table>        
				<table width="100%" border="0">
					<tr>
						<td width="50%" class="style17">a2: <?php echo $row->js_sumbu2;?></td>
						<td width="50%" class="style17">a4: <?php echo $row->js_sumbu4;?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><span class="style17">8.</span></td>
			<td><span class="style17">Lebar keseluruhan </span></td>
			<td><span class="style17">: <?php echo $row->uk_lebar;?></span></td>
		</tr>
		<tr>
			<td><span class="style17">9.</span></td>
			<td><span class="style17">Tinggi keseluruhan </span></td>
			<td><span class="style17">: <?php echo $row->uk_tinggi;?></span></td>
		</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
		<tr>
			<td colspan="5" bgcolor="#999999"><div align="center" class="style30">BERAT, DAYA ANGKUT, KELAS JALAN YANG PALING RENDAH, DAN UKURAN BAN YANG PALING RINGAN (KECIL) </div></td>
			<td colspan="3" valign="top" bgcolor="#999999"><div align="center" class="style30">SERTIFIKAT UJI TIPE DAN REGISTRASI UJI TIPE </div>        <span class="style17"></span><span class="style17"></span></td>
			<td colspan="2" bgcolor="#999999"><div align="center"><span class="style30">DAYA MESIN/MOTOR </span></div>        <span class="style17"></span><span class="style17"></span></td>
		</tr>
    
		<tr>
			<td width="1%"><span class="style17">a.</span></td>
			<td width="10%"><span class="style17">Jumlah berat yang diperbolehkan (JBB) </span></td>
			<td width="1%"><span class="style17">kg</span></td>
			<td width="5%" colspan="2"><span class="style17"><?php echo $row->jbb;?></span></td>
			<td width="1%" rowspan="3" valign="top"><div align="center"><span class="style17">a.</span></div><div align="center"><span class="style17"></span></div><div align="center"><span class="style17"></span></div></td>
			<td width="15%" colspan="2"><span class="style17">No Sertifikat Uji Tipe (SUT) : <?php echo $row->no_sertifikasi_uji;?></span></td>
			<td width="1%"><div align="center"><span class="style17">a.</span></div></td>
			<td width="8%"><span class="style17">Isi Silinder : <?php echo $row->isi_silinder;?> cc</span><span class="style17"></span></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Jumlah berat kombinasi yang diperbolehkan (JBKB)  </span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->jbb_kombinasi;?></span></td>
			<td colspan="2" rowspan="2" valign="top"><span class="style17">Tanggal diterbitkan : </span><span class="style17"><?php echo date("d M Y",strtotime($row->tgl_sertifikasi_uji));?></span></td>
			<td rowspan="2" valign="top"><div align="center"><span class="style17">b.</span><span class="style17"></span><span class="style17"></span></div></td>
			<td rowspan="2" valign="top"><span class="style17">Daya Motor : <?php echo $row->daya_motor;?></span></td>
		</tr>
		<tr>
			<td><span class="style17">b.</span></td>
			<td colspan="4"><span class="style17">Berat kendaraan </span><span class="style17"></span><span class="style17"></span><span class="style17"></span></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Berat sumbu ke-1 </span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->bk_sumbu1;?></span><span class="style17"></span></td>
			<td rowspan="4" valign="top"><div align="center"><span class="style17">b.</span></div><div align="center"><span class="style17"></span></div><div align="center"><span class="style17"></span></div><div align="center"><span class="style17"></span></div></td>
			<td colspan="2"><span class="style17">No. Sertifikat Registrasi : </span></td>
			<td colspan="2" rowspan="2" bgcolor="#CCCCCC"><div align="center" class="style30">DIMENSI BAK MUATAN / TANGKI </div></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Berat sumbu ke-2</span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->bk_sumbu2;?></span><span class="style17"></span></td>
			<td colspan="2"><span class="style17">Uji Tipe Kendaraan (UTK) </span></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Berat sumbu ke-3</span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->bk_sumbu3;?></span><span class="style17"></span></td>
			<td colspan="2" rowspan="2" valign="top"><span class="style17">Tanggal diterbitkan : </span><span class="style17"><?php echo date("d M Y",strtotime($row->tgl_sertifikasi_uji));?></span></td>
			<td colspan="2"><span class="style17"></span><span class="style17">P = <?php echo $row->dbm_panjang;?></span></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Berat sumbu ke-4</span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->bk_sumbu4;?></span><span class="style17"></span></td>
			<td colspan="2"><span class="style17"></span><span class="style17">L = <?php echo $row->dbm_lebar;?></span></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Berat sumbu ke-5</span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->bk_sumbu5;?></span><span class="style17"></span></td>
			<td rowspan="2" valign="top"><div align="center"><span class="style17">c.</span></div>        <span class="style17"></span><span class="style17"></span></td>
			<td colspan="2" rowspan="2" valign="top"><span class="style17">Karoseri : <?php echo date("d M Y",strtotime($row->tgl_sertifikasi_uji));?></span></td>
			<td colspan="2"><span class="style17"></span><span class="style17">T = <?php echo $row->dbm_tinggi;?></span></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Berat total kendaraan </span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->bk_total;?></span><span class="style17"></span></td>
			<td colspan="2"><span class="style17"></span><span class="style17">V = <?php $v=$row->dbm_lebar*$row->dbm_panjang*$row->dbm_tinggi; echo $v;?></span></td>
		</tr>
		<tr>
			<td><span class="style17">c.</span></td>
			<td><span class="style17">Daya angkut orang </span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->jml_da_orang;?></span><span class="style17"></span></td>
			<td colspan="3" bgcolor="#CCCCCC"><div align="center"><span class="style19"><span class="style17"><span class="style17"><span class="style25"><span class="style28"><span class="style17"><span class="style17"></span></span></span></span></span></span></span></div>        
			<div align="center" class="style30">PENGGUNAAN KHUSUS </div></td>
			<td colspan="2" rowspan="3" bgcolor="#CCCCCC"><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span>        <div align="center" class="style30">KODE QR </div></td>
		</tr>
		<tr>
			<td><span class="style17">d.</span></td>
			<td><span class="style17">Daya angkut barang </span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->da_barang;?></span><span class="style17"></span></td>
			<td colspan="3"><span class="style17"></span><span class="style17"></span></td>
		</tr>
	    <tr>
			<td><span class="style17">e.</span></td>
			<td><span class="style17">Jumlah berat yang diijinkan (JBI) </span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"></span><span class="style17"><?php echo $row->jbi;?></span></td>
			<td rowspan="3" valign="top"><div align="center"><span class="style17">a.</span><span class="style17"></span><span class="style17"></span></div></td>
			<td colspan="2"><span class="style17">Jenis barang khusus yang diijinkan diangkut : </span></td>
		</tr>
		<tr>
			<td><span class="style17">f.</span></td>
			<td><span class="style17">Jumlah berat kombinasi yang diijinkan (JBKBI) </span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"></span><span class="style17"><?php echo $row->jbi_kombinasi;?></span></td>
			<td colspan="2" rowspan="2" valign="top"><span class="style17">- </span><span class="style17"></span></td>
			<td colspan="2" rowspan="9"><div align="center"><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"></span><span class="style17"><img src="<?php echo base_url('files/qrcode/'.$row->qrcode);?>"></span></div></td>
		</tr>
		<tr>
			<td><span class="style17">g.</span></td>
			<td><span class="style17">Muatan sumbu terberat (MST) </span></td>
			<td><span class="style17">kg</span></td>
			<td colspan="2"><span class="style17"><?php echo $row->mst;?></span><span class="style17"></span></td>
		</tr>
		<tr>
			<td><span class="style17">h.</span></td>
			<td><span class="style17">Kelas jalan terendah yang boleh dilalui </span></td>
			<td colspan="3"><div align="center"><span class="style17"></span><span class="style17"><?php echo $row->kelas_jalan;?></span></div><span class="style17"></span></td>
			<td rowspan="3" valign="top"><div align="center"><span class="style17">b.</span><span class="style17"></span><span class="style17"></span></div></td>
			<td colspan="2"><span class="style17">Jenis penggunaan khusus yang diperbolehkan </span></td>
		</tr>
		<tr>
			<td><span class="style17">i.</span></td>
			<td colspan="4"><span class="style17">Pemakaian ban yang diijinkan </span><span class="style17"></span><span class="style17"></span><span class="style17"></span></td>
			<td colspan="2" rowspan="2" valign="top"><span class="style17">-</span><span class="style17"></span></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Sumbu ke-1 </span></td>
			<td colspan="3"><span class="style17"></span><span class="style17"><?php echo $row->ban_sumbu1;?></span><span class="style17"></span></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Sumbu ke-2</span></td>
			<td colspan="3"><span class="style17"></span><span class="style17"><?php echo $row->ban_sumbu2;?></span><span class="style17"></span></td>
			<td colspan="3" bgcolor="#CCCCCC"><div align="center" class="style30">PEMINDAHAN WILAYAH OPERASI KENDARAAN </div></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Sumbu ke-3</span></td>
			<td colspan="3"><span class="style17"></span><span class="style17"><?php echo $row->ban_sumbu3;?></span><span class="style17"></span></td>
			<td colspan="2"><span class="style17"></span><div align="center" class="style17">Tanggal</div></td>
			<td width="12%"><div align="center" class="style17">Asal/Tujuan</div></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Sumbu ke-4 </span></td>
			<td colspan="3"><span class="style17"></span><span class="style17"><?php echo $row->ban_sumbu4;?></span><span class="style17"></span></td>
			<td colspan="2" rowspan="2"><span class="style17"></span>        <div align="center"><span class="style19"><span class="style17"><span class="style17"><span class="style25"><span class="style28"><span class="style17"><span class="style17"></span></span></span></span></span></span></span>Tanggal</div>
				<span class="style17"></span>        <div align="center"><span class="style19"><span class="style17"><span class="style17"><span class="style25"><span class="style28"><span class="style17"><span class="style17"></span></span></span></span></span></span></span></div></td>
			<td rowspan="2"><div align="left"><span class="style17">
				KOTA TUJUAN
			</span></div></td>
		</tr>
		<tr>
			<td><span class="style17"></span></td>
			<td><span class="style17">Sumbu ke-5</span></td>
			<td colspan="3"><span class="style17"></span><span class="style17"><?php echo $row->ban_sumbu5;?></span><span class="style17"></span></td>
		</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
		<tr>
			<td colspan="5" bgcolor="#999999" class="style17"><div align="center"><strong>RIWAYAT UJI KABUPATEN JEPARA </strong></div></td>
		</tr>
		<tr>
			<td width="17%" class="style17">NOMOR KENDARAAN </td>
			<td colspan="4" class="style17">: <?php echo $row->no_kendaraan;?></td>
		</tr>
		<tr>
			<td class="style17">NAMA PEMILIK </td>
			<td colspan="4" class="style17">: <?php echo $row->nama;?></td>
		</tr>
		<tr>
			<td class="style17">NO KTP </td>
			<td colspan="4" class="style17">: <?php echo $row->no_ktp;?></td>
		</tr>
		<tr>
			<td class="style17">ALAMAT</td>
			<td colspan="4" class="style17">: <?php echo $row->alamat;?> <?php echo $row->kecamatan;?> <?php echo $row->kota;?></td>
		</tr>
		<tr>
			<td class="style17">JENIS KENDARAAN </td>
			<td colspan="4" class="style17">: <?php echo $row->jenis;?></td>
		</tr>
		<tr>
			<td class="style17">BAHAN BAKAR </td>
			<td colspan="4" class="style17">: <?php echo $row->bahan_bakar;?></td>
		</tr>
		<tr>
			<td class="style17">SIFAT KENDARAAN </td>
			<td colspan="4" class="style17">: <?php echo $row->sifat;?></td>
		</tr>
		<tr>
			<td width="15%" colspan="2" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>TGL UJI </strong></div></td>
			<td width="15%" colspan="2" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>HABIS UJI </strong></div></td>
			<td width="35%" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>CATATAN</strong></div></td>
			<td width="20%" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>PENANDA TANGAN BUKU UJI </strong></div></td>
			<td width="15%" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>NO REG PENGUJI </strong></div></td>
		</tr>
<?php }} 
		if(isset($data_pengujian)){
		foreach($data_pengujian as $row){
	?>
	    <tr>
			<td colspan="2" class="style17"><div align="center"><?php echo strftime("%d %B %Y", strtotime(($row->tgl_uji)));?></div></td>
			<td colspan="2" class="style17"><div align="center"><?php echo strftime("%d %B %Y", strtotime(($row->tgl_habis_uji)));?></div></td>
			<td class="style17">
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
			<td class="style17"><div align="center"><?php echo $row->nama;?></div></td>
			<td class="style17"><div align="center"><?php echo $row->nrp;?></div></td>
		</tr>
<?php }} ?>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
		<tr>
			<td colspan="5" bgcolor="#999999" class="style17"><div align="center"><strong>RIWAYAT UJI DI LUAR WILAYAH</strong></div></td>
		</tr>
		<tr>
			<td width="17%" colspan="2" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>TGL UJI </strong></div></td>
			<td width="23%" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>KOTA TUJUAN</strong></div></td>
			<td bgcolor="#CCCCCC" class="style17"><div align="center"><strong>CATATAN</strong></div></td>
		</tr>
		<?php if(isset($data_uji_keluar)){
		foreach($data_uji_keluar as $row){
		?>
		<tr>
			<td width="17%" colspan="2" class="style17"><div align="center"><?php echo date("d M Y",strtotime($row->tgl));?></div></td>
			<td width="23%" class="style17"><div align="center"><?php echo $row->tujuan_num;?></div></td>
			<td class="style17"><div align="center">No Surat : 551.2/<?php echo $row->no_surat;?>, Tanggal : <?php echo strftime("%d %B %Y", strtotime(($row->tgl_surat)));?></div></td>
		</tr>
		<?php }} ?>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
		<tr>
			<td colspan="3" bgcolor="#999999" class="style17"><div align="center"><strong>RIWAYAT WASDAL </strong></div></td>
		</tr>
		<tr>
			<td width="16%" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>TGL WASDAL </strong></div></td>
			<td width="62%" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>CATATAN PELANGGARAN</strong></div></td>
			<td width="22%" bgcolor="#CCCCCC" class="style17"><div align="center"><strong>PELAPOR</strong></div></td>
		</tr>
	</table>
	<p>&nbsp;</p>
	</form>
</body>
</html>
