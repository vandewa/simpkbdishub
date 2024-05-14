<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Tanda Tangan Surat
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-ttd" data-toggle="modal">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-plus bigger-120 blue"></i>
						Tambah Tanda Tangan Surat
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
						<th>Jenis Surat</th>
						<th>Penandatangan</th>
						<th>Opsi</th>
					</tr>
				</thead>

				<tbody>
				<?php
					$no=1;
					foreach($dt_ttd as $row){
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->jnsttd;?></td>
						<td><?php echo $row->ttd;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="#edit-ttd<?php echo $row->id_surat_setting?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('setting/hapusttd/'.$row->id_surat_setting);?>" onclick="return confirm('Anda yakin menghapus tanda tangan?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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
											<a href="#edit-ttd<?php echo $row->id_surat_setting?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('setting/hapusttd/'.$row->id_surat_setting);?>" onclick="return confirm('Anda yakin menghapus tanda tangan?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div id="tambah-ttd" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Tanda Tangan Surat</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/tambahttdsurat')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Jenis TTD Surat </label>
								<div class="col-sm-8">
									<select id="jnsttd" name="jnsttd" class="select2" data-placeholder="Pilih jenis tanda tangan surat...">
										<option></option>
										<option value="surat">Surat</option>
										<option value="laporan">Laporan</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Tanda Tangan Surat </label>
								<div class="col-sm-8">
									<select id="ttd" name="ttd" class="select2" data-placeholder="Pilih tanda tangan surat...">
										<option></option>
										<option value="kadis">Kepala Dinas</option>
										<option value="kabid">Kepala Bidang</option>
										<option value="kasie">Kepala Seksi</option>
									</select>
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

<?php foreach($dt_ttd as $row){ ?>
<div id="edit-ttd<?php echo $row->id_surat_setting?>" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Edit Tanda Tangan Surat</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/updatettdsurat/'.$row->id_surat_setting)?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Jenis TTD Surat </label>
								<div class="col-sm-8">
									<select id="jnsttd" name="jnsttd" class="select2" data-placeholder="Pilih jenis tanda tangan surat...">
										<option value="<?php echo $row->jnsttd;?>" selected><?php echo $row->jnsttd;?></option>
										<option></option>
										<option value="surat">Surat</option>
										<option value="laporan">Laporan</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-left"> Tanda Tangan Surat </label>
								<div class="col-sm-8">
									<select id="ttd" name="ttd" class="select2" data-placeholder="Pilih tanda tangan surat...">
										<option value="<?php echo $row->ttd;?>" selected><?php echo $row->ttd;?></option>
										<option></option>
										<option value="kadis">Kepala Dinas</option>
										<option value="kabid">Kepala Bidang</option>
										<option value="kasie">Kepala Seksi</option>
									</select>
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