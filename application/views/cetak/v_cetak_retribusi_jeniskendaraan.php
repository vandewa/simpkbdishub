<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
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
        	<td align="left">
				<strong>
					PEMERINTAH KABUPATEN SEMARANG<br/>
					DINAS PERHUBUNGAN<br/>
				</strong>
				Jl. Soekarno - Hatta No. 8 50552 Ungaran
            </td>
        	<td align="left" width="40%">
            	REKAPITULASI PENGUJIAN KENDARAAN BERMOTOR<br>
                PERIODE BULAN <?php echo strtoupper(date("F",strtotime($tgl_awal)));?> - <?php echo strtoupper(date("F Y",strtotime($tgl_akhir)));?>
            </td>
        </tr>
    </table>
	
	<table class="sample" border="1px solid">
    	<thead>
        	<tr>
				<td rowspan="3">TANGGAL</td>
				<td colspan="18">JENIS KENDARAAN</td>
				<td rowspan="3">JML KB</td>
				<td rowspan="3">RETRIBUSI<br/>UJI</td>
				<td rowspan="3">RETRIBUSI<br/>TERHUTANG</td>
				<td rowspan="3">RETRIBUSI<br/>DENDA<br/>(Rp)</td>
				<td rowspan="3">RETRIBUSI<br/>TANDA UJI<br/>(Rp)</td>
				<td rowspan="3">JUMLAH<br/>(Rp)</td>
			</tr>
			<tr>
				<td colspan="3">MBL PNM</td>
				<td colspan="3">MBL BUS</td>
				<td colspan="3">KEND KHS</td>
				<td colspan="3">MBL BRG</td>
				<td colspan="3">KRT GN</td>
				<td colspan="3">KRT TP</td>
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
			</tr>
		</thead>
		
		<tbody>
		<?php 
			foreach($laporan_retribusi as $row){ 
			$tgl = $row->tgl_pembayaran;
		?>
			<tr>
				<td align="center"><?php echo date("d M Y",strtotime($row->tgl_pembayaran));?></td>
				<?php 
				$jns = array("MOBIL PENUMPANG","MOBIL BUS","KENDARAAN KHUSUS","MOBIL BARANG","KERETA GANDENGAN","KERETA TEMPELAN");
				$sft = array("Dinas","Umum","Tidak Umum");
				
				$ci = &get_instance();
				$ci->load->model('model_laporan','laporan');
				
				for ($a=0;$a<6; $a++) {
					for ($b=0;$b<3; $b++) {
						$jml = $this->laporan->getJmlKend($tgl,$jns[$a],$sft[$b]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				?>
				<td align="center"><?php echo $row->jml_kb;?></td>
				<td align="right"><?php echo number_format($row->total_retribusi, 0, ",", ".");?></td>
				<td align="right"><?php echo number_format($row->total_retribusi_terhutang, 0, ",", ".");?></td>
				<td align="right"><?php echo number_format($row->total_tanda, 0, ",", ".");?></td>
				<td align="right"><?php echo number_format($row->total_denda, 0, ",", ".");?></td>
				<td align="right"><?php $jumlah = $row->total_retribusi+$row->total_retribusi_terhutang+$row->total_tanda+$row->total_denda; echo number_format($jumlah, 0, ",", ".");?></td>
			</tr>
		<?php } ?>
		
		<?php 
			foreach($total_retribusi as $row){ 
		?>
			<tr style="font-weight: bold;">
				<td align="center">JUMLAH</td>
				<?php
				$awal = $tgl_awal;
				$akhir = $tgl_akhir;
			
				$jns = array("MOBIL PENUMPANG","MOBIL BUS","KENDARAAN KHUSUS","MOBIL BARANG","KERETA GANDENGAN","KERETA TEMPELAN");
				$sft = array("Dinas","Umum","Tidak Umum");
				
				$ci = &get_instance();
				$ci->load->model('model_laporan','laporan');
				
				for ($a=0;$a<6; $a++) {
					for ($b=0;$b<3; $b++) {
						$jml = $this->laporan->getTotalJmlKend($awal,$akhir,$jns[$a],$sft[$b]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				?>
				<td align="center"><?php echo $row->jml_kb;?></td>
				<td align="right"><?php echo number_format($row->total_retribusi, 0, ",", ".");?></td>
				<td align="right"><?php echo number_format($row->total_retribusi_terhutang, 0, ",", ".");?></td>
				<td align="right"><?php echo number_format($row->total_tanda, 0, ",", ".");?></td>
				<td align="right"><?php echo number_format($row->total_denda, 0, ",", ".");?></td>
				<td align="right"><?php $jumlah = $row->total_retribusi+$row->total_retribusi_terhutang+$row->total_tanda+$row->total_denda; echo number_format($jumlah, 0, ",", ".");?></td>
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
            	Mejayan, <?php echo date("d F Y");?><br/>
				An. KEPALA DINAS PERHUBUNGAN<br/>
				KABUPATEN SEMARANG<br/>
				Kepala Seksi Pengujian Kendaraan Bermotor<br/>
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
<!--
<div id="divButtons" name="divButtons" style="padding-top:10px;">
	<input type="button" value="Cetak Dokumen" onclick="printPage()">
</div>
-->

