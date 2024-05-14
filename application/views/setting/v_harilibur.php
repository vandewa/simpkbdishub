<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Daftar Hari Libur
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-libur" data-toggle="modal">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-plus bigger-120 blue"></i>
						Tambah Libur
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
						<th>Tanggal Libur</th>
						<th>Keterangan</th>
						<th>Opsi</th>
					</tr>
				</thead>

				<tbody>
				<?php
					$no=1;
					foreach($dt_libur as $row){
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo date("d F Y",strtotime($row->tgl_libur)); ?></td>
						<td><?php echo $row->keterangan; ?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="#edit-libur<?php echo $row->id_harilibur?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('setting/hapuslibur/'.$row->id_harilibur);?>" onclick="return confirm('Anda yakin Menghapus Data Hari Libur?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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
											<a href="#edit-libur<?php echo $row->id_harilibur?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('setting/hapuslibur/'.$row->id_harilibur);?>" onclick="return confirm('Anda yakin Menghapus Data Hari Libur?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
												<span class="red">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div id="tambah-libur" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Hari Libur</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/tambahlibur')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Tanggal Libur </label>
								<div class="col-sm-9">
									<div class="input-group">
										<input class="form-control date-picker" id="tgl_libur" name="tgl_libur" type="text" data-date-format="yyyy-mm-dd" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							<label class="col-sm-3 control-label no-padding-left"> Keterangan </label>
								<div class="col-sm-9">
									<input type="text" id="keterangan" name="keterangan" placeholder="Keterangan hari libur" class="col-xs-12" />
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

<?php foreach($dt_libur as $row){ ?>
<div id="edit-libur<?php echo $row->id_harilibur?>" class="modal fade" tabindex="-1">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Edit Hari Libur</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/editlibur/'.$row->id_harilibur)?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Tanggal Libur </label>
								<div class="col-sm-9">
									<div class="input-group">
										<input class="form-control date-picker" id="tgl_libur" name="tgl_libur" value="<?php echo $row->tgl_libur;?>" type="text" data-date-format="yyyy-mm-dd" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							<label class="col-sm-3 control-label no-padding-left"> Keterangan </label>
								<div class="col-sm-9">
									<input type="text" id="keterangan" name="keterangan" value="<?php echo $row->keterangan;?>" placeholder="Keterangan hari libur" class="col-xs-12" />
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
<?php } ?>