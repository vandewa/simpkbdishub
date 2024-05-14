<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
<script type="text/javascript">
jQuery(function($) {
	$(document).ready(function () {
		window.print();
	});
});
</script>
<style>
@page { size: auto;  margin: 0mm; }
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
	width:200mm;
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
	padding: 2px;
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
				DINAS PERKIMHUB</b><br/>
				Jl. Soepardjo Rustam Andongsili
            </td>
			<td align="center" width="40%">
				<b>DATA KENDARAAN BERMOTOR WAJIB UJI BERDASARKAN <?php echo strtoupper($kategori);?>
            </td>
			<td align="right" width="20%">
				<br/><br/>
            	<b>FORM TKC-6</b>
            </td>
        </tr>
    </table>
	
	<table class="sample" border="1px solid">
    	<thead>
        	<tr>
				<td>NO</td>
				<td>JENIS KBWU</td>
				<?php if(($status=="semua")||($status=="aktif")){ ?>
				<td>AKTIF</td>
				<?php } if(($status=="semua")||($status=="tidak aktif")){ ?>
				<td>TIDAK</td>
				<?php } ?>
				<td>JUMLAH</td>
			</tr>
		</thead>
		
		<tbody>
			<?php
			$tgl = date('Y-m-d',strtotime("-2 year"));
			if($kategori=='Jenis'){ $kat = 'jenis_kendaraan'; } else { $kat=$kategori;} 
			$no=1;
			foreach($dt_laporan as $row){
				$jns = $row->jenis_kendaraan;
				$total = $this->laporan->getJmlTkc6($kat,$jns);
				$aktif = $this->laporan->getJmlAktifTkc6($kat,$jns,$tgl);
				$tidak = $total-$aktif;
				?>
			<tr>
				<td align="center"><?php echo $no++;?></td>
				<td><?php echo $jns;?></td>
				<?php if(($status=="semua")||($status=="aktif")){ ?>
				<td align="right"><?php echo $aktif;?></td>
				<?php } if(($status=="semua")||($status=="tidak aktif")){ ?>
				<td align="right"><?php echo $tidak;?></td>
				<?php } ?>
				<td align="right"><?php if($status=="aktif"){ echo $aktif; } else if($status=="tidak aktif"){ echo $tidak; } else { echo $total;}?></td>
			</tr>
			<?php } ?>
			<tr>
				<?php 
					$jml_total = $this->laporan->getTotalJmlTkc6($kat);
					$jml_aktif = $this->laporan->getTotalJmlAktifTkc6($kat,$tgl);
					$jml_tidak = $jml_total-$jml_aktif;
				?>
				<td colspan="2" align="right"><b>TOTAL</b></td>
				<?php if(($status=="semua")||($status=="aktif")){ ?>
				<td align="right"><b><?php echo $jml_aktif;?></b></td>
				<?php } if(($status=="semua")||($status=="tidak aktif")){ ?>
				<td align="right"><b><?php echo $jml_tidak;?></b></td>
				<?php } ?>
				<td align="right"><b><?php if($status=="aktif"){ echo $jml_aktif; } else if($status=="tidak aktif"){ echo $jml_tidak; } else { echo $jml_total;}?></b></td>
			</tr>
		</tbody>
	</table>
	<br/>
	<table class="sample" style="font-size:12px;">
    	<tr>
        	<td align="left">
				
            </td>
        	<td align="center" width="40%">
            	Wonosobo, <?php echo strftime("%d %B %Y");?><br/>
				KEPALA DINAS PERKIMHUB<br/>
				KABUPATEN WONOSOBO
				<br/><br/><br/><br/>
				<b><u>
				<?php foreach($pengesahan as $row){
					echo $row->nama;
				?>
				</b></u><br/>
				<?php echo $row->pangkat; ?><br/>
				NIP. <?php echo $row->nip; } ?>
            </td>
        </tr>
    </table>
</center>

