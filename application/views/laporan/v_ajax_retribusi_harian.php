<div class="row">
	<div class="col-xs-12 col-sm-10">
		<h4>
			REKAP RETRIBUSI TANGGAL <?php echo date("d M Y", strtotime($tgl_awal));?> - <?php echo date("d M Y", strtotime($tgl_akhir));?>
		</h4>
	</div>
	
	<div class="col-xs-12 col-sm-2" align="right">
		<a href="<?php echo site_url('laporan/exportretribusi?awal='.$tgl_awal.'&akhir='.$tgl_akhir);?>">
			<button type="submit" class="btn btn-success btn-sm">
				<span class="ace-icon fa fa-file-excel-o icon-on-right bigger-110"></span>
				Export Laporan
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
					<th class="center">Tanggal</th>
					<th class="center">No Uji</th>
					<th class="center">No Kend</th>
					<th class="center">Nama</th>
					<th class="center">Jenis Uji</th>
					<th class="center">Jenis Kend</th>
					<th class="center">JBB</th>
					<th class="center">Plat</th>
					<th class="center">Buku</th>
					<th class="center">Stiker</th>
					<th class="center">Retribusi</th>
					<th class="center">Denda</th>
					<th class="center">Total Retribusi</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
			$no=1;
			if(isset($laporan_retribusi)){
				foreach($laporan_retribusi as $row){
				?>
				<tr>
					<td class="center"><?php echo $no++;?></td>
					<td class="center"><?php echo date("d M Y",strtotime($row->tgl_pembayaran));?></td>
					<td><?php echo $row->no_uji;?></td>
					<td><?php echo $row->no_kendaraan;?></td>
					<td><?php echo $row->nama;?></td>
					<td><?php echo $row->jenis_uji;?></td>
					<td><?php echo $row->bentuk;?></td>
					<td><?php echo $row->jbb;?></td>
					<td><?php echo $row->plat;?></td>
					<td><?php echo $row->buku;?></td>
					<td><?php echo $row->stiker;?></td>
					<td><?php echo $row->retribusi;?></td>
					<td><?php echo $row->jml_denda;?></td>
					<td><?php echo $row->total_semua;?></td>
				</tr>
				<?php }
			} 
			if(isset($total_retribusi)){
				foreach($total_retribusi as $row){
					?>
				<tr>
					<td colspan="7"></td>
					<td>TOTAL</td>
					<td><?php echo $row->total_plat;?></td>
					<td><?php echo $row->total_buku;?></td>
					<td><?php echo $row->total_stiker;?></td>
					<td><?php echo $row->total_retribusi;?></td>
					<td><?php echo $row->jml_total_denda;?></td>
					<td><?php echo $row->jml_total_semua;?></td>
				</tr>
				<?php }
			} ?>
			</tbody>
		</table>
	</div>
</div>