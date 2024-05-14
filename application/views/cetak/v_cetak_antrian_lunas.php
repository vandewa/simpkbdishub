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
body { font-family:Monospace; font-size: 11;}
h2 {font-size:14; font-weight:bold;text-transform:uppercase; }
table.sample {
	border-style: none;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
	font-size: 12;
	font-family:Monospace;
	width:80mm;
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
	
}
.kiri{text-align:left;}
</style>
<?php 
	foreach($dt_antrian as $row){ 
		$total_retribusi = number_format($row->total_semua, 0, ".", ","); 
		$total = $row->total_semua+2000;
		?>
<div>
	<table class="sample">	
		<tr class="tengah">
			<td colspan="3" style="font-size:16px;"><b>AGEN DUTA (LAKUPANDAI)</b></td>
		</tr>
		<tr class="tengah">
			<td colspan="3" style="font-size:16px;"><b>BANK BPD JATENG</b></td>
		</tr>
		<tr class="tengah">
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr class="tengah">
			<td colspan="3" style="font-size:14px;"><b>PEMBAYARAN UJI KIR<b/></td>
		</tr>
		<tr class="left">
			<td style="font-size:13px;">Kode Billing</td>
			<td>:</td>
			<td style="font-size:13px;"><b><?php echo $row->id_billing;?></b></td>
		</tr>
		<tr class="left">
			<td style="font-size:13px;">No Uji</td>
			<td>:</td>
			<td style="font-size:13px;"><?php echo $row->no_uji;?></td>
		</tr>		
		<tr class="left">
			<td style="font-size:13px;">No Kendaraan</td>
			<td>:</td>
			<td style="font-size:13px;"><?php echo $row->no_kendaraan;?></td>
		</tr>
		<tr class="left">
			<td style="font-size:13px;">Pemohon</td>
			<td>:</td>
			<td style="font-size:13px;"><?php echo $row->nama_pemohon;?></td>
		</tr>
		
		<tr class="left">
			<td style="font-size:13px;">Status Bayar</td>
			<td>:</td>
			<td style="font-size:13px;"><B>LUNAS</b></td>
		</tr>
		
		<tr class="left">
			<td style="font-size:13px;">No Referensi</td>
			<td>:</td>
			<td style="font-size:13px;"><?php echo $row->noreff;?> / <?php echo $row->tgl_reff;?></td>
		</tr>
	
		<tr class="left">
			<td style="font-size:16px;"><b>Retribusi</b></td>
			<td>:</td>
			<td style="font-size:16px;"><b>Rp. <?php echo $total_retribusi;?></b></td>
		</tr>
		
		<tr class="left">
			<td style="font-size:16px;"><b>Biaya Admin</b></td>
			<td>:</td>
			<td style="font-size:16px;"><b>Rp. 2,000</b></td>
		</tr>
		
		<tr class="left">
			<td style="font-size:16px;"><b>Total Bayar</b></td>
			<td>:</td>
			<td style="font-size:16px;"><b>Rp. <?php echo number_format($total, 0, ".", ",");?></b></td>
		</tr>
		
		<tr class="tengah">
			<td colspan="3">&nbsp;</td>
		</tr>
		
		<tr class="tengah">
			<td colspan="3" style="font-size:13px;"><i>Struk ini merupakan bukti sah pembayaran uji kir Dinas Perhubungan Kabupaten Wonosobo, simpanlah baik-baik</i></td>
		</tr>	
		<tr class="tengah">
			<td colspan="3">&nbsp;</td>
		</tr>		
	</table>
</div>
<?php } ?>
<!--
<div id="divButtons" name="divButtons" style="padding-top:10px;">
	<input type="button" value="Cetak Dokumen" onclick="printPage()">
</div>
-->

