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


<center>
	<table class="sample" style="font-size:14px;">
    	<tr>
        	<td align="center" width="40%">
            	<b>
				LAPORAN JUMLAH KENDARAAN BERMOTOR WAJIB UJI<br/>
				BERDASARKAN DAYA ANGKUT BARANG, JENIS KENDARAAN, DAN SIFAT<br/>
                PERIODE TANGGAL <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglakhir)));?>
				</b>
            </td>
        </tr>
    </table>
	<br/>
	<table class="sample" border="1px solid">
    	<thead>
        	<tr>
				<td rowspan="3">NO</td>
				<td rowspan="3">DAYA ANGKUT BARANG (KG)</td>
				<td colspan="18">JENIS KENDARAAN</td>
				<td colspan="4" rowspan="2">JUMLAH TOTAL</td>
			</tr>
			<tr>
				<td colspan="3">MOBIL PENUMPANG</td>
				<td colspan="3">MOBIL BUS</td>
				<td colspan="3">KENDARAAN KHUSUS</td>
				<td colspan="3">MOBIL BARANG</td>
				<td colspan="3">KERETA GANDENGAN</td>
				<td colspan="3">KERETA TEMPELAN</td>
			</tr>
			<tr>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<td>DN+U+TU</td>
			</tr>
		</thead>
		
		<tbody>
		
		<?php 
			$bbm = array("BENSIN","SOLAR","GAS","-");
			$jbb1 = array("0","501","1001","1501","2001","2501","3001","3501","4001","4501","5001","5501","6001","7001","8001","9001");
			$jbb2 = array("500","1000","1500","2000","2500","3000","3500","4000","4500","5000","5500","6000","7000","8000","9000","100000");
			$jns = array("MOBIL PENUMPANG","MOBIL BUS","KENDARAAN KHUSUS","MOBIL BARANG","KERETA GANDENGAN","KERETA TEMPELAN");
			$sft = array("Dinas","Umum","Tidak Umum");
			
			$c = 1;
			for($a=0;$a<16; $a++) {
				for($b=0;$b<16; $b++) {
					if($a==$b){ 
					?>
					<tr>
						<td align="center"><?php echo $c++;?></td>
						<td align="center"><?php echo $jbb1[$a].' - '.$jbb2[$b]?></td>
						<?php
						for ($i=0;$i<6; $i++) {
							for ($j=0;$j<3; $j++) {
								$jml = $this->laporan->getKendTkc2($tglawal,$tglakhir,$jbb1[$a],$jbb2[$b],$jns[$i],$sft[$j]);
								echo "<td align='center'>".$jml."</td>";
							}
						}
						
						for ($j=0;$j<3; $j++) {
							$jml_total = $this->laporan->getJmlKendTkc2($tglawal,$tglakhir,$jbb1[$a],$jbb2[$b],$sft[$j]);
							echo "<td align='center'>".$jml_total."</td>";
						}
						
						$jml_semua = $this->laporan->getJmlTotalKendTkc2($tglawal,$tglakhir,$jbb1[$a],$jbb2[$b]);
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
				for ($i=0;$i<6; $i++) {
					for ($j=0;$j<3; $j++) {
						$jml = $this->laporan->getRangeKendTkc2($tglawal,$tglakhir,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getRangeJmlKendTkc2($tglawal,$tglakhir,$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getRangeJmlTotalKendTkc2($tglawal,$tglakhir);
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
				for ($i=0;$i<6; $i++) {
					for ($j=0;$j<3; $j++) {
						$jml_bbm = $this->laporan->getBbmKendTkc2($tglawal,$tglakhir,$bbm[$z],$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml_bbm."</td>";
					}
				}
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getBbmJmlKendTkc2($tglawal,$tglakhir,$bbm[$z],$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getBbmJmlTotalKendTkc2($tglawal,$tglakhir,$bbm[$z]);
				echo "<td align='center'>".$jml_semua."</td>";
				?>
			</tr>
		<?php } ?>
		</tbody>
		<thead>
        	<tr>
				<td colspan="2" align="center">JUMLAH</td>
				<?php
				for ($i=0;$i<6; $i++) {
					for ($j=0;$j<3; $j++) {
						$jml = $this->laporan->getRangeKendTkc2($tglawal,$tglakhir,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getRangeJmlKendTkc2($tglawal,$tglakhir,$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getRangeJmlTotalKendTkc2($tglawal,$tglakhir);
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
        	<td align="center" width="40%">
            	Slawi, <?php echo date("d F Y");?><br/>
				KEPALA DINAS PERHUBUNGAN<br/>
				KABUPATEN TEGAL<br/>
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
	
	<table class="sample" style="font-size:12px;">
    	<tr>
        	<td align="center">
				<div id="divButtons" name="divButtons" style="padding-top:10px;">
					<input type="button" value="Cetak Dokumen" onclick="printPage()">
				</div>
            </td>
        </tr>
    </table>
</center>
