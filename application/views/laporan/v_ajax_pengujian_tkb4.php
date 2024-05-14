<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
<script type="text/javascript">
jQuery(function($) {
	$(document).ready(function () {
		window.print();
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
            	<b>PEMERINTAH KABUPATEN WONOSOBO<br/>
				DINAS PERKIMHUB</b><br/>
				Jl. Soepardjo Rustam Andongsili
            </td>
			<td align="center" width="40%">
				<br/><b>REKAPITULASI KENDARAAN UJI MINGGUAN</b><br/> 
				PERIODE <?php if($rekap=="MONTH"){ echo "BULAN "; echo strtoupper(strftime("%B %Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%B %Y", strtotime($tglakhir))); }
				else if($rekap=="YEAR"){ echo "TAHUN "; echo strtoupper(strftime("%Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%Y", strtotime($tglakhir))); }?>
            </td>
			<td align="right" width="30%">
				<br/><br/>
            	<b>FORM TKB-4</b>
            </td>
        </tr>
    </table>
	<br/>
	<table class="sample" border="1px solid" style="font-size:11px;">
    	<thead>
        	<tr align="center">
				<td rowspan="5">MINGGU<br/>KE-</td>
				<td colspan="56">JENIS KENDARAAN</td>
				<td colspan="3" rowspan="4">JUMLAH</td>
			</tr>
			<tr align="center">
				<td colspan="2">MPU</td>
				<td colspan="6">MOBIL BUS</td>
				<td colspan="32">MOBIL BARANG</td>
				<td colspan="6">KRT GANDENG</td>
				<td colspan="6">KRT TEMPEL</td>
				<td colspan="2" rowspan="3">M.PNRK</td>
				<td colspan="2" rowspan="3">RANSUS</td>
			</tr>
			<tr align="center">
				<td colspan="2" rowspan="2">TAXI</td>
				<td colspan="2" rowspan="2">MINI</td>
				<td colspan="2" rowspan="2">MCB</td>
				<td colspan="2" rowspan="2">BUS</td>
				<td colspan="10">PICK UP</td>
				<td colspan="12">TRUCK SUMBU II</td>
				<td colspan="10">TRUCK SUMBU III</td>
				<td colspan="2" rowspan="2">BRG</td>
				<td colspan="2" rowspan="2">BOX</td>
				<td colspan="2" rowspan="2">TGKI</td>
				<td colspan="2" rowspan="2">BRG</td>
				<td colspan="2" rowspan="2">BOX</td>
				<td colspan="2" rowspan="2">TGKI</td>
			</tr>
			<tr>
				<td colspan="2">PU</td>
				<td colspan="2">BOX</td>
				<td colspan="2">LOS</td>
				<td colspan="2">BW</td>
				<td colspan="2">DC</td>
				<td colspan="2">KAYU</td>
				<td colspan="2">BESI</td>
				<td colspan="2">DUMP</td>
				<td colspan="2">BOX</td>
				<td colspan="2">LOS</td>
				<td colspan="2">TGKI</td>
				<td colspan="2">BESI</td>
				<td colspan="2">DUMP</td>
				<td colspan="2">BOX</td>
				<td colspan="2">LOS</td>
				<td colspan="2">TGKI</td>
			</tr>
			<tr align="center">
				<?php for($z=0;$z<28;$z++){ ?>
				<td>U</td>
				<td>TU</td>
				<?php } ?>
				<td>U</td>
				<td>TU</td>
				<td>U+TU</td>
			</tr>
		</thead>
		
		<tbody>
		
		<?php 
		if($rekap=="MONTH"){ $no=1; }
		foreach($laporan_ujitkb4 as $row){
			if($rekap=="MONTH"){
				$week = $row->minggu;
				$tgl = date("m",strtotime($row->tgl_daftar_uji));
				$tglyear = date("Y",strtotime($row->tgl_daftar_uji));
			} else if($rekap=="YEAR"){
				$week = $row->minggu;
				$tgl = date("Y",strtotime($row->tgl_daftar_uji));
				$tglyear = date("Y",strtotime($row->tgl_daftar_uji));
			}
			?>
			<tr>
				<td align="center"><?php if($rekap=="MONTH"){ echo numberToRoman($no++);} else { echo $row->minggu; }?></td>
			<?php
				$jns = array("TAXI","MOBIL PENUMPANG','MINIBUS","MICROBUS","BUS","PICK UP","PICK UP BOX","PICK UP LOS BAK","BLIND VAN','DELIVERY VAN','BESTEL WAGON","DOUBLE CABIN","LIGHT TRUCK','LIGHT TRUCK BAK KA","LIGHT TRUCK BAK BE','TRUCK","LIGHT TRUCK DUMP','TRUCK DUMP","LIGHT TRUCK BOX','TRUCK BOX","LIGHT TRUCK LOS BAK','TRUCK LOS BAK","LIGHT TRUCK TANGKI','TRUCK TANGKI","TRUCK TRONTON","TRUCK TRONTON DUMP","TRUCK TRONTON BOX","TRUCK TRONTON LOS BAK","TRUCK TRONTON TANGKI","KERETA GANDENG","KERETA GANDENG BOX","KERETA GANDENG TANGKI","KERETA TEMPELAN","KERETA TEMPELAN BOX","KERETA TEMPELAN TANGKI","TRACKTOR HEAD","LIGHT TRUCK PEMADAM','TRUCK PEMADAM','AMBULANCE','MOBIL JENAZAH','KENDARAAN KHUSUS");
				$sft = array("Umum","Tidak Umum");
				
				for ($i=0;$i<28; $i++) {
					for ($j=0;$j<2; $j++) {
						$jml = $this->laporan->getUjiTkb4($week,$tglyear,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<2; $j++) {
					$jml_total = $this->laporan->getJmlUjiTkb4($week,$tglyear,$sft[$j]);
					echo "<td align='center'><b>".$jml_total."</b></td>";
				}
				
				$jml_semua = $this->laporan->getJmlTotalUjiTkb4($week,$tglyear);
				echo "<td align='center'><b>".$jml_semua."</b></td>";
			?>
			</tr>
		<?php } ?>
		</tbody>
		<thead>
			<tr>
				<td align="center">JUMLAH</td>
			<?php
				$jns = array("TAXI","MOBIL PENUMPANG','MINIBUS","MICROBUS","BUS","PICK UP","PICK UP BOX","PICK UP LOS BAK","BLIND VAN','DELIVERY VAN','BESTEL WAGON","DOUBLE CABIN","LIGHT TRUCK','LIGHT TRUCK BAK KA","LIGHT TRUCK BAK BE','TRUCK","LIGHT TRUCK DUMP','TRUCK DUMP","LIGHT TRUCK BOX','TRUCK BOX","LIGHT TRUCK LOS BAK','TRUCK LOS BAK","LIGHT TRUCK TANGKI','TRUCK TANGKI","TRUCK TRONTON","TRUCK TRONTON DUMP","TRUCK TRONTON BOX","TRUCK TRONTON LOS BAK","TRUCK TRONTON TANGKI","KERETA GANDENG","KERETA GANDENG BOX","KERETA GANDENG TANGKI","KERETA TEMPELAN","KERETA TEMPELAN BOX","KERETA TEMPELAN TANGKI","TRACKTOR HEAD","LIGHT TRUCK PEMADAM','TRUCK PEMADAM','AMBULANCE','MOBIL JENAZAH','KENDARAAN KHUSUS");
				$sft = array("Umum","Tidak Umum");
				
				for ($i=0;$i<28; $i++) {
					for ($j=0;$j<2; $j++) {
						$jml = $this->laporan->getRangeUjiTkb4($tglawal,$tglakhir,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<2; $j++) {
					$jml_total = $this->laporan->getRangeJmlUjiTkb4($tglawal,$tglakhir,$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getRangeJmlTotalUjiTkb4($tglawal,$tglakhir);
				echo "<td align='center'>".$jml_semua."</td>";
			?>
			</tr>
		</thead>
	</table>
	<br/>
	<table class="sample" style="font-size:12px;">
    	<tr>
        	<td align="left">
				
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

<?php 
function numberToRoman($num){ 
    $n = intval($num);
    $result = ''; 
 
    $lookup = array(
        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
    ); 
 
    foreach ($lookup as $roman => $value)  {
        $matches = intval($n / $value); 
        $result .= str_repeat($roman, $matches); 
        $n = $n % $value; 
    }
	return $result; 
}
?>