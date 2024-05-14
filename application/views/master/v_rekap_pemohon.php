<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pemohon
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
		<form action="<?php echo site_url('master/caripemohon')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" class="form-control search-query" id="cari" name="cari" placeholder="Masukan Nomor KTP/SIM..." />
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Cari
					</button>
				</span>
			</div>
		</form>
		</div>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<td>No</th>
						<th>KTP/SIM</th>
						<th>Nama</th>
						<th class="hidden-480">Alamat</th>
						<th class="hidden-480">Telepon</th>
					</tr>
				</thead>
				
				<?php 
				$no = $start+1;
				if(isset($data_pemohon)){
					foreach($data_pemohon as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->no_ktp;?></td>
						<td><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo $row->alamat;?></td>
						<td class="hidden-480"><?php echo $row->telp;?></td>
					</tr>
				</tbody>
				<?php 
				}
			} ?>	
			</table>
		<?php echo $this->pagination->create_links();?>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>