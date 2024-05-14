<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
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
			<td align="center" width="45%">
				<b>LAPORAN JUMLAH KENDARAAN BERMOTOR WAJIB UJI<br/>
				BERDASARKAN DAYA ANGKUT ORANG, JENIS KENDARAAN, DAN SIFAT<br/>
                PERIODE TANGGAL <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglakhir)));?></b>
            </td>
			<td align="right" width="25%">
				<br/><br/>
            	<b>FORM TKC-7</b>
            </td>
        </tr>
    </table>
	<br/>
	<table class="sample" border="1px solid">
    	<thead>
        	<tr>
				<td rowspan="3">NO</td>
				<td rowspan="3">DAYA ANGKUT ORANG<br/>(PNP)</td>
				<td colspan="6">JENIS KENDARAAN</td>
				<td colspan="4" rowspan="2">JUMLAH TOTAL</td>
			</tr>
			<tr>
				<td colspan="3">MOBIL PENUMPANG</td>
				<td colspan="3">MOBIL BUS</td>
			</tr>
			<tr>
				<?php for($z=0;$z<3;$z++){ ?>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<?php } ?>
				<td>DN+U+TU</td>
			</tr>
		</thead>
		
		<tbody>
		
		<?php 
			$bbm = array("BENSIN","SOLAR","GAS","-");
			$do1 = array("0","9","12","17","25","33","46","56","61");
			$do2 = array("8","11","16","25","32","45","55","60","100");
			$jns = array("MOBIL PENUMPANG","MOBIL BUS");
			$sft = array("Dinas","Umum","Tidak Umum");
			
			$c = 1;
			for($a=0;$a<9; $a++) {
				for($b=0;$b<9; $b++) {
					if($a==$b){ 
					?>
					<tr>
						<td align="center"><?php echo $c++;?></td>
						<td align="center"><?php echo $do1[$a].' - '.$do2[$b]?></td>
						<?php
						for ($i=0;$i<2; $i++) {
							for ($j=0;$j<3; $j++) {
								$jml = $this->laporan->getKendTkc7($tglawal,$tglakhir,$do1[$a],$do2[$b],$jns[$i],$sft[$j]);
								echo "<td align='center'>".$jml."</td>";
							}
						}
						
						for ($j=0;$j<3; $j++) {
							$jml_total = $this->laporan->getJmlKendTkc7($tglawal,$tglakhir,$do1[$a],$do2[$b],$sft[$j]);
							echo "<td align='center'>".$jml_total."</td>";
						}
						
						$jml_semua = $this->laporan->getJmlTotalKendTkc7($tglawal,$tglakhir,$do1[$a],$do2[$b]);
						echo "<td align='center'>".$jml_semua."</td>";
						?>
					</tr>
					<?php 
					}
				}
			} 
			?>
		</tbody>
		<thead>
        	<tr>
				<td colspan="2" align="center">JUMLAH</td>
				<?php
				for ($i=0;$i<2; $i++) {
					for ($j=0;$j<3; $j++) {
						$jml = $this->laporan->getRangeKendTkc7($tglawal,$tglakhir,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getRangeJmlKendTkc7($tglawal,$tglakhir,$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getRangeJmlTotalKendTkc7($tglawal,$tglakhir);
				echo "<td align='center'>".$jml_semua."</td>";
				?>
			</tr>
		</thead>
		
		<thead>
        	<tr>
				<td colspan="2">JENIS BAHAN BAKAR</td>
				<td colspan="26"></td>
			</tr>
		</thead>
		<tbody>
		
		<?php
			$d = 1;
			for($z=0;$z<4; $z++) { ?>
			<tr>
				<td align="center"><?php echo $d++;?></td>
				<td align="center"><?php echo $bbm[$z]?></td>
				<?php
				for ($i=0;$i<2; $i++) {
					for ($j=0;$j<3; $j++) {
						$jml_bbm = $this->laporan->getBbmKendTkc7($tglawal,$tglakhir,$bbm[$z],$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml_bbm."</td>";
					}
				}
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getBbmJmlKendTkc7($tglawal,$tglakhir,$bbm[$z],$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getBbmJmlTotalKendTkc7($tglawal,$tglakhir,$bbm[$z]);
				echo "<td align='center'>".$jml_semua."</td>";
				?>
			</tr>
		<?php } ?>
		</tbody>
		<thead>
        	<tr>
				<td colspan="2" align="center">JUMLAH</td>
				<?php
				for ($i=0;$i<2; $i++) {
					for ($j=0;$j<3; $j++) {
						$jml = $this->laporan->getRangeKendTkc7($tglawal,$tglakhir,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getRangeJmlKendTkc7($tglawal,$tglakhir,$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getRangeJmlTotalKendTkc7($tglawal,$tglakhir);
				echo "<td align='center'>".$jml_semua."</td>";
				?>
			</tr>
		</thead>
	</table>
	<br/>
	<table class="sample" style="font-size:12px;">
    	<tr>
        	<td align="left">
				<u><i>KETERANGAN</u></i><br/>
				- DN &emsp;: DINAS / PEMERINTAH<br/> 
				- U&emsp;   : UMUM<br/> 
				- TU &emsp;: TIDAK UMUM<br/> 
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
	<!--
	<table class="sample" style="font-size:12px;">
    	<tr>
        	<td align="center">
				<div id="divButtons" name="divButtons" style="padding-top:10px;">
					<input type="button" value="Cetak Dokumen" onclick="printPage()">
				</div>
            </td>
        </tr>
    </table>
	-->
</center>

