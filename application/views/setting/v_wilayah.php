<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Pengaturan Kode Wilayah
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
						<th>Kode Wilayah</th>
						<th>Nama Wilayah</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($dt_wilayah)){
					foreach($dt_wilayah as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->kodewilayah;?></td>
						<td><?php echo $row->namawilayah;?></td>
					</tr>
				</tbody>
				<?php 
				}
			} ?>	
			</table>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>