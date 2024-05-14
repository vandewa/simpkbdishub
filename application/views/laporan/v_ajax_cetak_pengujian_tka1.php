<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
<script type="text/javascript">
jQuery(function($) {
	$(document).ready(function () {
		window.print();
	});
});
</script>
<style>
@page { size: auto;  margin: 2mm; }
body { font-family:arial; font-size: 12;}
h2 {font-size:11; font-weight:bold;text-transform:uppercase; }
table.sample {
	border-width: 0px;
	border-spacing: ;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
	font-size: 12;
	font-family:Arial;
	width:95%;
}
table.sample th {
	border-width: thin;
	padding: 3px;
	border-style: inset;
	border-color: black;
	background-color: white;
	-moz-border-radius: ;
}
table.sample td {
	background-color: white;
	vertical-align:top;
}
.tengah{
	text-align:center;
}
.induk td{
	font-weight:bold;
}
.kanan{
	text-align:right !important;
}
.kananbold{
	text-align:right !important;
	font-weight:bold;
}
thead tr td{
	text-align:center !important;
	vertical-align:middle !important;
	font-size:12px;
	font-weight:bold;
	
}
.kiri{text-align:left;}
</style>

<head>
	<title><?php echo $title ?></title>
</head>

<center>
	<table class="sample" style="font-size:14px;">
    	<tr>
        	<td align="left" width="30%">
            	<b>PEMERINTAH KABUPATEN WONOSOBO<br/>
				DISPERKIMHUB</b><br/>
				Jl. Soepardjo Rustam Andongsili
            </td>
			<td align="center" width="40%">
				<br/><b>CATATAN HARIAN PENGUJIAN KENDARAAN BERMOTOR</b><br/>
                PERIODE <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglakhir))); ?>
            </td>
			<td align="right" width="30%">
				<br/><br/>
            	<b>FORM TKA-1</b>
            </td>
        </tr>
    </table>
	<br/>
	<table class="sample" border="1px solid" style="font-size:12px;">
    	<thead>
        	<tr align="center">
				<td>NO</td>
				<td>TANGGAL<br/>UJI</td>
				<td>TANGGAL<br/>HABIS UJI</td>
				<td>NOMOR<br/>KENDARAAN</td>
				<td>NOMOR<br/>UJI</td>
				<td>BENTUK<br/>KENDARAAN</td>
				<td>SIFAT</td>
				<td>TAHUN</td>
				<td>BBM</td>
				<td>NAMA PEMILIK</td>
				<td>ALAMAT PEMILIK</td>
				<td>JENIS UJI</td>
			</tr>
		</thead>
		
		<tbody>
			<?php $no=1;
				foreach($dt_laporan_ujitka1 as $row){ ?>
				<tr>
					<td align="center"><?php echo $no++;?></td>
					<td><?php echo date("d/m/Y",strtotime($row->tgl_daftar_uji));?></td>
					<td><?php echo date("d/m/Y",strtotime($row->tgl_habis_uji));?></td>
					<td><?php echo $row->no_kendaraan;?></td>
					<td><?php echo $row->no_uji;?></td>
					<td><?php echo $row->bentuk;?></td>
					<td align="center"><?php 
						$sifat = explode(" ",$row->sifat);
						foreach ($sifat as $s) { echo $s[0];}
					?></td>
					<td align="center"><?php echo $row->tahun;?></td>
					<td align="center"><?php echo $row->bahan_bakar;?></td>
					<td><?php echo $row->nama;?></td>
					<td><?php echo $row->alamat;?></td>
					<td align="center"><?php 
						$jenisuji = explode(" ",$row->jenis_uji);
						foreach ($jenisuji as $j) { echo $j[0];}
					?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<br/>
	<table class="sample" style="font-size:12px;">
    	<tr>
        	<td align="left">
				<u><i>KETERANGAN</u></i><br/>
				<?php $ketsifat = $this->laporan->getJmlSifatTka1($tglawal,$tglakhir); 
				foreach($ketsifat as $sft){ ?>
				- <?php $sifatken = explode(" ",$sft->sifat); foreach ($sifatken as $sftken) { echo $sftken[0];} ?> (<?php echo $sft->sifat;?>) : <b><?php echo $sft->jumlah;?></b><br/>
				<?php } $ketjenis = $this->laporan->getJmlJenisTka1($tglawal,$tglakhir); 
				foreach($ketjenis as $jns){ ?>
				- <?php $jenuji = explode(" ",$jns->jenis_uji); foreach ($jenuji as $jnsken) { echo $jnsken[0];} ?> (<?php echo $jns->jenis_uji;?>) : <b><?php echo $jns->jumlah;?></b><br/>
				<?php } ?>
            </td>
        	<?php 
			foreach($pengesahan as $row){
			if($ttd=='kadis'){
				$an = '';
				$namajabatan = $row->nama_jabatan;
			} else {
				$an = 'An.';
				$namajabatan = $row->nama_jabatan;
			} ?>
        	<td align="center" width="40%">
            	Wonosobo, <?php echo strftime("%d %B %Y");?><br/>
				<?php echo $an;?> KEPALA DINAS PERKIMHUB<br/>
				KABUPATEN WONOSOBO<br/>
				<?php echo $namajabatan;?>
				<br/><br/><br/><br/>
				<b><u>
				<?php echo $row->nama; ?>
				</b></u><br/>
				NIP. <?php echo $row->nip; ?>
            </td>
			<?php } ?>
        </tr>
    </table>
</center>

