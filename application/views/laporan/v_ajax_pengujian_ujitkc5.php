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
				LAPORAN <?php if($rekap==""){ echo "BULANAN"; } else if($rekap=="MONTH"){ echo "TAHUNAN"; }?> DAFTAR KENDARAAN BERMOTOR WAJIB UJI<br/>
				YANG DISAHKAN PERTAMA KALI<br/>
                PERIODE <?php if($rekap==""){ echo "TANGGAL "; echo strtoupper(strftime("%d %B %Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglakhir)));} 
				else if($rekap=="MONTH"){ echo "BULAN "; echo strtoupper(strftime("%d %B %Y", strtotime($tglawal)));?> - <?php echo strtoupper(strftime("%d %B %Y", strtotime($tglakhir))); }?>
				</b>
            </td>
        </tr>
    </table>
	<br/>
	<table class="sample" border="1px solid">
    	<thead>
        	<tr>
				<td rowspan="3"><?php if($rekap==""){ echo "TANGGAL"; } else if($rekap=="MONTH"){ echo "BULAN"; }?></td>
				<td colspan="18">JENIS KENDARAAN</td>
				<td colspan="4" rowspan="2">JUMLAH SEMUA</td>
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
		foreach($laporan_ujitkc5 as $row){
			if($rekap==""){ 
				$tgl = $row->tgl_daftar_uji;
				$tglyear = date("Y",strtotime($row->tgl_daftar_uji));
			} else if($rekap=="MONTH"){ 
				$tgl = date("m",strtotime($row->tgl_daftar_uji));
				$tglyear = date("Y",strtotime($row->tgl_daftar_uji));
			}
			?>
			<tr>
				<td align="center"><?php if($rekap==""){ echo strftime("%d %b %Y", strtotime($row->tgl_daftar_uji)); } else if($rekap=="MONTH"){ echo strftime("%B", strtotime($row->tgl_daftar_uji)); }?></td>
			<?php
				$jns = array("MOBIL PENUMPANG","MOBIL BUS","KENDARAAN KHUSUS","MOBIL BARANG","KERETA GANDENGAN","KERETA TEMPELAN");
				$sft = array("Dinas","Umum","Tidak Umum");
				
				for ($i=0;$i<6; $i++) {
					for ($j=0;$j<3; $j++) {
						$jml = $this->laporan->getUjiTkc5($tgl,$tglyear,$rekap,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getJmlUjiTkc5($tgl,$tglyear,$rekap,$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getJmlTotalUjiTkc5($tgl,$tglyear,$rekap);
				echo "<td align='center'>".$jml_semua."</td>";
			?>
						
			</tr>
		<?php } ?>
		
			<tr>
				<td align="center">JUMLAH</td>
			<?php
				$jns = array("MOBIL PENUMPANG","MOBIL BUS","KENDARAAN KHUSUS","MOBIL BARANG","KERETA GANDENGAN","KERETA TEMPELAN");
				$sft = array("Dinas","Umum","Tidak Umum");
				
				for ($i=0;$i<6; $i++) {
					for ($j=0;$j<3; $j++) {
						$jml = $this->laporan->getRangeUjiTkc5($tglawal,$tglakhir,$jns[$i],$sft[$j]);
						echo "<td align='center'>".$jml."</td>";
					}
				}
				
				for ($j=0;$j<3; $j++) {
					$jml_total = $this->laporan->getRangeJmlUjiTkc5($tglawal,$tglakhir,$sft[$j]);
					echo "<td align='center'>".$jml_total."</td>";
				}
				
				$jml_semua = $this->laporan->getRangeJmlTotalUjiTkc5($tglawal,$tglakhir);
				echo "<td align='center'>".$jml_semua."</td>";
			?>
						
			</tr>
		</tbody>
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

