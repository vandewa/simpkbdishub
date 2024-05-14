<div class="row">
	<div class="col-xs-12 col-sm-8">
		<h4>
			Laporan Setoran Bulan <?php echo date("F Y", strtotime($tgl_awal));?> - <?php echo date("F Y", strtotime($tgl_akhir));?>
		</h4>
	</div>
	
	<div class="col-xs-12 col-sm-4" align="right">
		<a href="<?php echo site_url('laporan/cetakstsbulanan?jns=retribusi&awal='.$tgl_awal.'&akhir='.$tgl_akhir);?>">
			<button type="submit" class="btn btn-success btn-sm">
				<span class="ace-icon fa fa-file-pdf-o icon-on-right bigger-110"></span>
				Cetak Retribusi
			</button>
		</a>

		<a href="<?php echo site_url('laporan/cetakstsbulanan?jns=denda&awal='.$tgl_awal.'&akhir='.$tgl_akhir);?>">
			<button type="submit" class="btn btn-warning btn-sm">
				<span class="ace-icon fa fa-file-pdf-o icon-on-right bigger-110"></span>
				Cetak Denda
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
					<td class="center"><?php echo date("d F Y",strtotime($row->tgl_pembayaran));?></td>
					<td><?php $retribusi = $row->total_retribusi+$row->total_retribusi_terhutang+$row->total_tanda; echo $retribusi;?></td>
					<td><?php echo $row->total_denda;?></td>
					<td><?php $jumlah = $retribusi+$row->total_denda; echo $jumlah;?></td>
				</tr>
				<?php }
			} 
			if(isset($total_retribusi)){
				foreach($total_retribusi as $row){
					?>
				<tr>
					<td></td>
					<td>TOTAL</td>
					<td><?php $retribusi_total = $row->total_retribusi+$row->total_retribusi_terhutang+$row->total_tanda; echo $retribusi_total;?></td>
					<td><?php echo $row->total_denda;?></td>
					<td><?php $jumlah_total = $retribusi_total+$row->total_denda; echo $jumlah_total;?></td>
				</tr>
				<?php }
			} ?>
			</tbody>
		</table>
	</div>
</div>