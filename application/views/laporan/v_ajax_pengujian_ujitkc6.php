<div class="row">
	<div class="col-xs-12 col-sm-10"></div>
	<div class="col-xs-12 col-sm-2" align="right">
		<a href="<?php echo site_url('laporan/cetak_ujitkc6?jenis='.$kategori.'&status='.$status);?>" target="_blank">
			<button type="submit" class="btn btn-warning btn-sm">
				<span class="ace-icon fa fa-print icon-on-right bigger-110"></span>
				Cetak Laporan
			</button>
		</a>
	</div>
</div>

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
<script type="text/javascript">
jQuery(function($) {
	$(document).ready(function () { 
	  //window.print(); 
	});
});

function printPage(){
	if(document.all){
		document.all.divButtons.style.visibility = 'hidden';
		window.print();
		document.all.divButtons.style.visibility = 'visible';
	}else{
		document.getElementById('divButtons').style.visibility = 'hidden';
		window.print();
		document.getElementById('divButtons').style.visibility = 'visible';
	}
}
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


<center>
	<table class="sample" style="font-size:14px;">
    	<tr>
        	<td align="left" width="30%">
            	<b>PEMERINTAH KABUPATEN WONOSOBO<br/>
				DINAS PERKIMHUB</b><br/>
				Jl. Soepardjo Rustam Andongsili
            </td>
			<td align="center" width="40%">
				<br/><b>DATA KENDARAAN BERMOTOR WAJIB UJI<br/>
                BERDASARKAN <?php echo strtoupper($kategori);?>
            </td>
			<td align="right" width="30%">
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
				<td colspan="2" align="right">TOTAL</td>
				<?php if(($status=="semua")||($status=="aktif")){ ?>
				<td align="right"><?php echo $jml_aktif;?></td>
				<?php } if(($status=="semua")||($status=="tidak aktif")){ ?>
				<td align="right"><?php echo $jml_tidak;?></td>
				<?php } ?>
				<td align="right"><?php if($status=="aktif"){ echo $jml_aktif; } else if($status=="tidak aktif"){ echo $jml_tidak; } else { echo $jml_total;}?></td>
			</tr>
		</tbody>
	</table>
</center>

