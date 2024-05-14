<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Master Bahan Bakar
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-bahanbakar" data-toggle="modal">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Bahan Bakar
				</button>
				</a>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<td>No</th>
						<th>Nama Bahan Bakar</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($dt_bahanbakar)){
					foreach($dt_bahanbakar as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->bahan_bakar;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="#edit-bahanbakar<?php echo $row->id_bahan_bakar;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('master/hapus_bahanbakar/'.$row->id_bahan_bakar);?>" onclick="return confirm('Anda yakin Menghapus Data Bahan Bakar?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
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
											<a href="#edit-bahanbakar<?php echo $row->id_bahan_bakar;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('master/hapus_bahanbakar/'.$row->id_bahan_bakar);?>" onclick="return confirm('Anda yakin Menghapus Data Bahan Bakar?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
												<button class="btn btn-xs btn-danger">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</button>
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
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>

<div id="tambah-bahanbakar" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Bahan Bakar</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/tambah_bahanbakar')?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Bahan Bakar </label>
								<div class="col-sm-8">
									<input type="text" id="bahan_bakar" name="bahan_bakar" placeholder="Bahan Bakar" class="col-xs-12"/>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i>
						Batal
					</button>

					<button type="submit" class="btn btn-sm btn-primary">
						<i class="ace-icon fa fa-check"></i>
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 
	$no=1;
	if(isset($dt_bahanbakar)){
		foreach($dt_bahanbakar as $row){
		?>
		<div id="edit-bahanbakar<?php echo $row->id_bahan_bakar;?>" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Edit Bahan Bakar</h4>
					</div>
					<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/edit_bahanbakar/'.$row->id_bahan_bakar);?>">
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Bahan Bakar </label>
										<div class="col-sm-8">
											<input type="text" id="bahan_bakar" name="bahan_bakar" placeholder="Bahan Bakar" value="<?php echo $row->bahan_bakar;?>"class="col-xs-12"/>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button class="btn btn-sm" data-dismiss="modal">
								<i class="ace-icon fa fa-times"></i>
								Batal
							</button>

							<button type="submit" class="btn btn-sm btn-primary">
								<i class="ace-icon fa fa-check"></i>
								Simpan
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php }
	}
?>