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
				BERDASARKAN MUATAS SUMBU TERBERAT, JENIS KENDARAAN, DAN SIFAT<br/>
                PERIODE TANGGAL <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglakhir)));?></b>
            </td>
			<td align="right" width="25%">
				<br/><br/>
            	<b>FORM TKC-4</b>
            </td>
        </tr>
    </table>
	<br/>
	<table class="sample" border="1px solid">
    	<thead>
        	<tr>
				<td rowspan="3">NO</td>
				<td rowspan="3">MUATAN SUMBU<br/>TERBERAT<br/>(KG)</td>
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
				<?php for($z=0;$z<7;$z++){ ?>
				<td>DN</td>
				<td>U</td>
				<td>TU</td>
				<?php } ?>
				<td>DN+U+TU</td>
			</tr>
		</thead>
		
		<tbody>
		
		<?php 
			$mst1 = array("0","1001","2001","3001","4001","5001","6001","7001","8001","9001");
			$mst2 = array("1000","2000","3000","4000","5000","6000","7000","8000","9000","20000");
			$jns = array("MOBIL PENUMPANG","MOBIL BUS","KENDARAAN KHUSUS","MOBIL BARANG","KERETA GANDENGAN","KERETA TEMPELAN");
			$sft = array("Dinas","Umum","Tidak Umum");
			
			$c = 1;
			for($a=0;$a<10; $a++) {
				for($b=0;$b<10; $b++) {
					if($a==$b){ 
					?>
					<tr>
						<td align="center"><?php echo $c++;?></td>
						<td align="center"><?php echo $mst1[$a].' - '.$mst2[$b]?></td>
						<?php
						for ($i=0;$i<6; $i++) {
							for ($j=0;$j<3; $j++) {
								$jml = $this->laporan->getKendTkc4($tglawal,$tglakhir,$mst1[$a],$mst2[$b],$jns[$i],$sft[$j]);
								echo "<td align='center'>".$jml."</td>";
							}
						}
						
						for ($j=0;$j<3; $j++) {
							$jml_total = $this->laporan->getJmlKendTkc4($tglawal,$tglakhir,$mst1[$a],$mst2[$b],$sft[$j]);
							echo "<td align='center'>".$jml_total."</td>";
						}
						
						$jml_semua = $this->laporan->getJmlTotalKendTkc4($tglawal,$tglakhir,$mst1[$a],$mst2[$b]);
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
						$jml = $this->laporan->getRangeKendTkc4($tglawal,$tglakhir,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getRangeJmlKendTkc4($tglawal,$tglakhir,$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getRangeJmlTotalKendTkc4($tglawal,$tglakhir);
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

