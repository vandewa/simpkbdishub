<?php 
if(!empty($dt_kendaraan)){
	foreach($dt_kendaraan as $row){ 
	if($row->tgl_habis_uji==""){
		$hbs_uji = "";
		$hbs_uji_txt = "";
	} else {
		$hbs_uji = $row->tgl_habis_uji;
		$hbs_uji_txt = strftime("%d %B %Y",strtotime($row->tgl_habis_uji));
	}?>
	
<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<td>NO UJI</td>
			<td><?php echo $row->no_uji;?></td>
		</tr>
		<tr>
			<td>NO KENDARAAN</td>
			<td><?php echo $row->no_kendaraan;?></td>
		</tr>
		<tr>
			<td>JENIS</td>
			<td><?php echo $row->jenis;?> / <?php echo $row->jenis_kendaraan;?> / <?php echo $row->bentuk;?></td>
		</tr>
		<tr>
			<td>MERK / TIPE</td>
			<td><?php echo $row->merek;?> / <?php echo $row->tipe;?></td>
		</tr>
		<tr>
			<td>TAHUN</td>
			<td><?php echo $row->tahun;?></td>
		</tr>
		<tr>
			<td>JBB</td>
			<td><?php echo $row->jbb;?></td>
		</tr>
		<tr>
			<td>HABIS UJI</td>
			<td><?php echo $hbs_uji_txt;?></td>
		</tr>
	</table>
</div>

<?php }} else { ?>
<div class="alert alert-danger margin-bottom-30"><!-- DANGER -->
	<strong>Data Tidak Ditemukan !</strong><br/>Harap masukan nomor pengujian atau nomor kendaraan anda dengan benar.
</div>
<?php } ?>

<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>