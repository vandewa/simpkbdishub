<div class="row">
	<div class="col-xs-12 col-sm-10">
		<h4>
			REKAP <?php echo strtoupper($jenis);?> UJI TANGGAL <?php echo strftime("%d %b %Y", strtotime($awal));?> - <?php echo strftime("%d %b %Y", strtotime($akhir));?>
		</h4>
	</div>
	
	<div class="col-xs-12 col-sm-2" align="right">
		<a href="<?php echo site_url('laporan/exportsurat?jenis='.$jenis.'&awal='.$awal.'&akhir='.$akhir);?>">
			<button type="submit" class="btn btn-success btn-sm">
				<span class="ace-icon fa fa-file-excel-o icon-on-right bigger-110"></span>
				Export Surat
			</button>
		</a>
	</div>
</div>
&nbsp;

<div class="row">
	<div class="col-xs-12">
		<table id="simple-table" class="table table-striped table-bordered table-hover">
			<thead class="thin-border-bottom">
				<tr>
					<th class="center">No</th>
					<th class="center">Tanggal Surat</th>
					<th class="center">No Uji</th>
					<th class="center">No Kend</th>
					<th class="center">Nama</th>
					<th class="center">Jenis Kendaraan</th>
					<th class="center">Nomor Surat</th>
					<th class="center">Tujuan <?php echo $jenis;?></th>
					<th class="center">Kota</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
			$no=1;
			if(isset($dtrekap)){
				foreach($dtrekap as $row){
				?>
				<tr>
					<td class="center"><?php echo $no++;?></td>
					<td class="center"><?php echo strftime("%d %b %Y", strtotime($row->tgl_surat));?></td>
					<td><?php echo $row->no_uji;?></td>
					<td><?php echo $row->no_kendaraan;?></td>
					<td><?php echo $row->nama;?></td>
					<td><?php echo $row->bentuk;?></td>
					<td><?php echo $row->no_surat;?></td>
					<td><?php echo $row->kota_dinas;?></td>
					<td><?php echo $row->kota_tujuan;?></td>
				</tr>
				<?php }} ?> 
			</tbody>
		</table>
	</div>
</div>