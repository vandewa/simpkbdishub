<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Informasi
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-informasi" data-toggle="modal">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-plus bigger-120 blue"></i>
						Tambah Informasi
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
						<th>Informasi</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>

				<tbody>
				<?php
					$no=1;
					foreach($dt_informasi as $row){
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->informasi; ?></td>
						<td><?php echo date("d F Y",strtotime($row->tgl_informasi)); ?></td>
						<td><?php if($row->aktif=="1"){ echo "DIPUBLIKASI"; } else { echo "TIDAK TAMPIL"; } ?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="#edit-informasi<?php echo $row->id_informasi?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('setting/hapusinformasi/'.$row->id_informasi);?>" onclick="return confirm('Anda yakin Menghapus Informasi?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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
											<a href="#edit-informasi<?php echo $row->id_informasi?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('setting/hapusinformasi/'.$row->id_informasi);?>" onclick="return confirm('Anda yakin Menghapus Informasi?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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


<div id="tambah-informasi" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Informasi</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/tambahinformasi')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Informasi </label>
								<div class="col-sm-9">
									<textarea id="informasi" name="informasi" class="autosize-transition form-control" placeholder="Informasi"></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Tanggal Informasi </label>
								<div class="col-sm-9">
									<div class="input-group">
										<input class="form-control date-picker" id="tgl_informasi" name="tgl_informasi" type="text" data-date-format="yyyy-mm-dd" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
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

<?php foreach($dt_informasi as $row){ ?>
<div id="edit-informasi<?php echo $row->id_informasi?>" class="modal fade" tabindex="-1">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Edit Hari informasi</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/editinformasi/'.$row->id_informasi)?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Informasi </label>
								<div class="col-sm-9">
									<textarea id="informasi" name="informasi" class="autosize-transition form-control" placeholder="Informasi"><?php echo $row->informasi;?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Tanggal Informasi </label>
								<div class="col-sm-9">
									<div class="input-group">
										<input class="form-control date-picker" id="tgl_informasi" name="tgl_informasi" value="<?php echo $row->tgl_informasi;?>" type="text" data-date-format="yyyy-mm-dd" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
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