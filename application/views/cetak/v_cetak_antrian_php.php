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
body { font-family:arial; font-size: 11;}
h2 {font-size:14; font-weight:bold;text-transform:uppercase; }
table.sample {
	border-style: none;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
	font-size: 12;
	font-family:Arial;
	width:75mm;
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
	foreach($dt_antrian as $row){ $total_retribusi = number_format($row->total_semua, 0, ".", ","); ?>
<div>
	<table class="sample">	
		<tr class="tengah">
			<td colspan="3" style="font-size:13px;"><b>PENGUJIAN KENDARAAN BERMOTOR</b></td>
		</tr>
		<tr class="tengah">
			<td colspan="3" style="font-size:13px;"><b>DISPERKIMHUB KAB. WONOSOBO</b></td>
		</tr>
		<tr class="tengah">
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr class="tengah">
			<td colspan="3" style="font-size:16px;">NOMOR ANTRIAN</td>
		</tr>
		<tr class="tengah">
			<td colspan="3" align="center" style="font-size:60px;"><b><?php echo $row->no_antrian;?></b></td>
		</tr>
		<tr class="left">
			<td style="font-size:14px;">Tanggal Daftar</td>
			<td>:</td>
			<td style="font-size:14px;"><b><?php echo strftime("%d %B %Y", strtotime($row->tgl_daftar_uji));?></b></td>
		</tr>
		<tr class="left">
			<td style="font-size:14px;">Permohonan Uji</td>
			<td>:</td>
			<td style="font-size:14px;"><b><?php echo $row->jenis_uji;?></b></td>
		</tr>
		<tr class="left">
			<td style="font-size:14px;">No Uji</td>
			<td>:</td>
			<td style="font-size:14px;"><?php echo $row->no_uji;?></td>
		</tr>		
		<tr class="left">
			<td style="font-size:14px;">No Kendaraan</td>
			<td>:</td>
			<td style="font-size:14px;"><?php echo $row->no_kendaraan;?></td>
		</tr>
		<tr class="left">
			<td style="font-size:14px;">Pemohon</td>
			<td>:</td>
			<td style="font-size:14px;"><?php echo $row->nama_pemohon;?></td>
		</tr>
		<tr class="left">
			<td style="font-size:16px;"><b>Retribusi</b></td>
			<td>:</td>
			<td style="font-size:16px;"><b>Rp. <?php echo $total_retribusi;?></b></td>
		</tr>
		
		<tr class="tengah">
			<td colspan="3"><img style="width:100px;height:auto;" src="<?php echo base_url('files/pembayaran/'.date("Y-m-d",strtotime($row->tgl_daftar_uji)).'/'.$row->id_billing.'.png');?>"></td>
		</tr>
		<tr class="tengah">
			<td align="center" colspan="3" style="font-size:24px;"><b><?php echo $row->id_billing;?></b></td>
		</tr>
		<tr class="tengah">
			<td colspan="3"><i>Struk ini digunakan untuk proses selanjutnya, simpanlah baik-baik</i></td>
		</tr>
		<tr class="tengah">
			<td colspan="3"><i><strong>Keselamatan Tanggung Jawab Kita Bersama</strong></i></td>
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

