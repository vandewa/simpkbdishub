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
body { font-size: 12;}
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
            	<b>PEMERINTAH KABUPATEN TEGAL<br/>
				DINAS PERHUBUNGAN</b><br/>
				Jln. Gatot Subroto Dukuhsalam Slawi
            </td>
			<td align="center" width="40%">
				<b>DAFTAR JUMLAH KENDARAAN BERMOTOR UJI<br/>
                BERDASARKAN UMUR DAN JBB</b><br/> 
				PERIODE TANGGAL <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglakhir))); ?>
            </td>
			<td align="right" width="30%">
				<br/><br/>
            	<b>FORM TKB-7</b>
            </td>
        </tr>
    </table>
	<br/>
	<table class="sample" border="1px solid" style="font-size:11px;">
    	<thead>
        	<tr align="center">
				<td rowspan="2">NO</td>
				<td rowspan="2">JENIS<br/>KENDARAAN</td>
				<td rowspan="2">UMUR<br/>(TAHUN)</td>
				<td colspan="2">0 S/D 3500</td>
				<td colspan="2">3501 S/D 6000</td>
				<td colspan="2">6001 S/D 9000</td>
				<td colspan="2">9001 S/D 12000</td>
				<td colspan="2">DIATAS 12001</td>
				<td colspan="3">JUMLAH</td>
			</tr>
			<tr align="center">
				<?php for($z=0;$z<5;$z++){ ?>
				<td>U</td>
				<td>TU</td>
				<?php } ?>
				<td>U</td>
				<td>TU</td>
				<td>U+TU</td>
			</tr>
		</thead>
		<?php
			$ketumur = array("0 - 5","6 - 10","> 10");
			$umur1 = array(date('Y',strtotime("-4 year")),date('Y',strtotime("-9 year")),date('Y',strtotime("-50 year")));
			$umur2 = array(date("Y"),date('Y',strtotime("-5 year")),date('Y',strtotime("-10 year")));
			$jbb1 = array("0","3501","6001","9001","12001");
			$jbb2 = array("3500","6000","9000","12000","100000");
			$jns = array("MOBIL PENUMPANG","MOBIL BUS","KENDARAAN KHUSUS","MOBIL BARANG","KERETA GANDENGAN","KERETA TEMPELAN");
			$sft = array("Umum","Tidak Umum");
		?>
		<tbody>
		
		<?php for ($x=0;$x<6; $x++) { ?>
			<tr align="center">
				<td rowspan="4"><?php echo $x+1;?></td>
				<td rowspan="3"><?php echo $jns[$x];?></td>
				<td>0 - 5</td>
				<?php
				for ($a=0;$a<5; $a++) {
					for ($b=0;$b<5; $b++) {
						for ($c=0;$c<2; $c++) {
							if($a==$b){ 
								$jml = $this->laporan->getKendTkb7($tglawal,$tglakhir,$jbb1[$a],$jbb2[$b],$jns[$x],$sft[$c]);
								echo "<td align='center'>".$jml."</td>";
							}
						}
					}
				}
				?>
			</tr>
			<?php 
			for ($i=1;$i<3; $i++) {
				for($j=1;$j<3; $j++) {
					if($i==$j){ ?>
						<tr align="center">
							<td><?php echo $ketumur[$i];?></td>
						<?php
						for ($a=0;$a<5; $a++) {
							for ($b=0;$b<5; $b++) {
								for ($c=0;$c<2; $c++) {
									if($a==$b){ 
										$jml = $this->laporan->getTahunKendTkb7($tglawal,$tglakhir,$jbb1[$a],$jbb2[$b],$umur1[$i],$umur2[$j],$jns[$x],$sft[$c]);
										echo "<td align='center'>".$jml."</td>";
									}
								}
							}
						}
						?>
						</tr>
						<?php
					}
				}
			}
			?>
			<!--
			<tr align="center">
				<td>6 - 10</td>
			</tr>
			<tr align="center">
				<td>> 10</td>
			</tr>
			-->
			<tr align="center">
				<td colspan="2">JUMLAH</td>
				<?php
				for ($a=0;$a<5; $a++) {
					for ($b=0;$b<5; $b++) {
						for ($c=0;$c<2; $c++) {
							if($a==$b){ 
								$jml = $this->laporan->getJmlKendTkb7($tglawal,$tglakhir,$jbb1[$a],$jbb2[$b],$jns[$x],$sft[$c]);
								echo "<td align='center'>".$jml."</td>";
							}
						}
					}
				}
				?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<br/>
	<table class="sample" style="font-size:12px;">
    	<tr>
        	<td align="left">
				
            </td>
        	<td align="center" width="40%">
            	Slawi, <?php echo strftime("%d %B %Y");?><br/>
				KEPALA DINAS PERHUBUNGAN<br/>
				KABUPATEN TEGAL
				<br/><br/><br/><br/>
				<b><u>
				<?php foreach($pengesahan as $row){
					echo $row->nama;
				?>
				</b></u><br/>
				NIP. <?php echo $row->nip; } ?>
				
            </td>
        </tr>
    </table>
</center>

