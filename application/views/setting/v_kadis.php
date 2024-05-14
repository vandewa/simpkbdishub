<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Pengaturan Kode kadis
				</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>NIP</th>
						<th>Pangkat</th>
						<th>TTD 1</th>
						<th>TTD 2</th>
						<th>TTD 3</th>
						<th>Kode Wilayah</th>
						<th>TTD Aktif</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($dt_kadis)){
					foreach($dt_kadis as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->nip;?></td>
						<td><?php echo $row->pangkat;?></td>
						<td><img width="150px" src="data:image/png;base64,<?php echo base64_encode($row->tandatangan);?>"/></td>
						<td><img width="150px" src="data:image/png;base64,<?php echo base64_encode($row->tandatangan2);?>"/></td>
						<td><img width="150px" src="data:image/png;base64,<?php echo base64_encode($row->tandatangan3);?>"/></td>
						<td><?php echo $row->kodewilayah;?></td>
						<td><?php echo $row->flag_tandatangan_aktif;?></td>
						<td></td>
					</tr>
				</tbody>
				<?php 
				}
			} ?>	
			</table>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>