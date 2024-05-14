<div class="row">
	<div class="col-xs-12 col-sm-10">
		<h4>
			REKAP RETRIBUSI TAHUNAN <?php echo date("Y", strtotime($tgl_awal));?> - <?php echo date("Y", strtotime($tgl_akhir));?>
		</h4>
	</div>
	
	<div class="col-xs-12 col-sm-2" align="right">
		<a href="<?php echo site_url('laporan/exportretribusitahunan?awal='.$tgl_awal.'&akhir='.$tgl_akhir);?>">
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
					<th class="center">Bulan</th>
					<th class="center">Biaya Uji</th>
					<th class="center">Denda Uji</th>
					<th class="center">Tanda Uji</th>
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
					<td class="center"><?php echo date("F Y",strtotime($row->tgl_pembayaran));?></td>
					<td><?php echo $row->total_retribusi;?></td>
					<td><?php echo $row->total_denda;?></td>
					<td><?php echo $row->total_tanda;?></td>
					<td><?php $jumlah = $row->total_retribusi+$row->total_tanda+$row->total_denda; echo $jumlah;?></td>
				</tr>
				<?php }
			} 
			if(isset($total_tahunan)){
				foreach($total_tahunan as $row){
					?>
				<tr>
					<td></td>
					<td>TOTAL</td>
					<td><?php echo $row->total_retribusi;?></td>
					<td><?php echo $row->total_denda;?></td>
					<td><?php echo $row->total_tanda;?></td>
					<td><?php $jumlah = $row->total_retribusi+$row->total_tanda+$row->total_denda; echo $jumlah;?></td>
				</tr>
				<?php }
			} ?>
			</tbody>
		</table>
	</div>
</div>