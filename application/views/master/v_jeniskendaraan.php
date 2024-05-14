<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Master Jenis Kendaraan
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-jeniskendaraan" data-toggle="modal">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Jenis Kendaraan
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
						<th>No</th>
						<th>Kategori</th>
						<th>Jenis</th>
						<th>Jenis Kendaraan</th>
						<th>Kode Kendaraan</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($dt_jeniskendaraan)){
					foreach($dt_jeniskendaraan as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->kategori;?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo $row->jenis_kendaraan;?></td>
						<td><?php echo $row->kode_jenis_kendaraan;?></td>
						<td>
							<a href="#edit-jeniskendaraan<?php echo $row->id_jenis_kendaraan;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('master/hapus_jeniskendaraan/'.$row->id_jenis_kendaraan);?>" onclick="return confirm('Anda yakin Menghapus Data Bahan Bakar?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</button>
							</a>
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

<div id="tambah-jeniskendaraan" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Jenis Kendaraan</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/tambah_jeniskendaraan')?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Jenis </label>
								<div class="col-sm-8">
									<select id="jenis" name="jenis" class="form-control" data-placeholder="Pilih jenis kendaraan...">
										<option>-</option>
										<?php foreach($dt_jenis as $row){ ?>
										<option value="<?php echo $row->id_jenis;?>"><?php echo $row->jenis;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Kategori </label>
								<div class="col-sm-8">
									<select id="kategori" name="kategori" class="form-control" data-placeholder="Pilih kategori">
										<option value="JENIS">JENIS</option>
										<option value="BENTUK">BENTUK</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Jenis/Bentuk Kendaraan </label>
								<div class="col-sm-8">
									<input type="text" id="jenis_kendaraan" name="jenis_kendaraan" placeholder="Jenis Kendaraan" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Kode Kendaraan </label>
								<div class="col-sm-8">
									<input type="text" id="kode_jenis_kendaraan" name="kode_jenis_kendaraan" placeholder="Kode Jenis Kendaraan" class="col-xs-12"/>
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
	if(isset($dt_jeniskendaraan)){
		foreach($dt_jeniskendaraan as $row){
		?>
		<div id="edit-jeniskendaraan<?php echo $row->id_jenis_kendaraan;?>" class="modal fade" tabindex="-2">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Edit Jenis Kendaraan</h4>
					</div>
					<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/edit_jeniskendaraan/'.$row->id_jenis_kendaraan);?>">
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-left"> Jenis </label>
										<div class="col-sm-8">
											<select id="jenis" name="jenis" class="form-control" data-placeholder="Pilih jenis kendaraan...">
												<option value="<?php echo $row->id_jenis;?>" selected><?php echo $row->jenis;?></option>
												<option>-</option>
												<?php foreach($dt_jenis as $jns){ ?>
												<option value="<?php echo $jns->id_jenis;?>"><?php echo $jns->jenis;?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-left"> Kategori </label>
										<div class="col-sm-8">
											<select id="kategori" name="kategori" class="form-control" data-placeholder="Pilih kategori">
												<option value="<?php echo $row->kategori;?>" selected><?php echo $row->kategori;?></option>
												<option value="JENIS">JENIS</option>
												<option value="BENTUK">BENTUK</option>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-left"> Jenis/Bentuk Kendaraan </label>
										<div class="col-sm-8">
											<input type="text" id="jenis_kendaraan" name="jenis_kendaraan" value="<?php echo $row->jenis_kendaraan;?>" placeholder="Jenis Kendaraan" class="col-xs-12"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-left"> Kode Kendaraan </label>
										<div class="col-sm-8">
											<input type="text" id="kode_jenis_kendaraan" name="kode_jenis_kendaraan" value="<?php echo $row->kode_jenis_kendaraan;?>" placeholder="Kode Jenis Kendaraan" class="col-xs-12"/>
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