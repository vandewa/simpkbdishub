<div class="page-content">
	<div class="page-header">
		<h1>
			Master Kendaraan
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('master/cari')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" class="form-control search-query" id="cari" name="cari" placeholder="Masukan Nomor Pengujian..." autofocus/>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Cari
					</button>
				</span>
			</div>
		</form>
		</div>
		<div class="col-xs-12 col-sm-8" align="right">
			<a href="<?php echo site_url('master/tambah_master_kendaraan')?>">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Kendaraan
				</button>
			</a>
		</div>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<td>No</th>
						<th>Merek</th>
						<th>Tipe</th>
						<th>Jenis</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php 
				$no = $start+1;
				if(isset($dt_kendaraan)){
					foreach($dt_kendaraan as $row){
				?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->merek;?></td>
						<td><?php echo $row->tipe;?></td>
						<td><?php echo $row->jenis;?> / <?php echo $row->jenis_kendaraan;?> / <?php echo $row->bentuk;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">								
								<a href="<?php echo site_url('master/edit_master_kendaraan/'.$row->id_kendaraan);?>" class="tooltip-success" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('master/hapus_master_kendaraan/'.$row->id_kendaraan);?>" onclick="return confirm('Anda yakin akan menghapus data kendaraan?')" class="tooltip-success" data-rel="tooltip" title="Hapus Kendaraan">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-trash bigger-120"></i>
									</button>
								</a>
							</div>
							
							<div class="hidden-md hidden-lg">
								<div class="inline pos-rel">
									<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
										<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
									</button>

									<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
										<li>
											<a href="<?php echo site_url('master/edit/'.$row->id_kendaraan);?>" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
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