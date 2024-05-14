<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Master Pejabat
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-pejabat" data-toggle="modal">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Pejabat
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
						<td>NIP</th>
						<th>Nama</th>
						<th>Pangkat</th>
						<th>Jabatan</th>
						<th>Nama Jabatan</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$no=1;
				if(isset($dt_pejabat)){
					foreach($dt_pejabat as $row){
					if($row->aktif=="0"){ $tr="red";} else { $tr="";}
					?>
					<tr class="<?php echo $tr;?>">
						<td><?php echo $no++;?></td>
						<td><?php echo $row->nip;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->pangkat;?></td>
						<td><?php echo $row->jabatan;?></td>
						<td><?php echo $row->nama_jabatan;?></td>
						<td><?php if($row->aktif=="1") { echo "Aktif"; } else { echo "Tidak Aktif";}?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="#edit-pejabat<?php echo $row->id_pejabat;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('master/hapus_pejabat/'.$row->id_pejabat);?>" onclick="return confirm('Anda yakin Menghapus Data Pejabat?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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
											<a href="#edit-pejabat<?php echo $row->id_pejabat;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('master/hapus_pejabat/'.$row->id_pejabat);?>" onclick="return confirm('Anda yakin Menghapus Data Pejabat?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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

<div id="tambah-pejabat" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Pejabat</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/tambah_pejabat')?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> NIP </label>
								<div class="col-sm-8">
									<input type="text" id="nip" name="nip" placeholder="Masukan NIP" class="col-xs-12"/>
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Nama </label>
								<div class="col-sm-8">
									<input type="text" id="nama" name="nama" placeholder="Masukan nama" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Pangkat </label>
								<div class="col-sm-8">
									<input type="text" id="pangkat" name="pangkat" placeholder="Masukan Pangkat" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Jabatan </label>
								<div class="col-sm-8">
									<select class="select2" id="jabatan" name="jabatan" data-placeholder="Pilih jabatan">
										<option></option>
										<option value="kadis">Kepala Dinas</option>
										<option value="kabid">Kepala Bidang</option>
										<option value="kasie">Kepala Seksi</option>
										<option value="bendahara">Bendahara</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Nama Jabatan </label>
								<div class="col-sm-8">
									<input type="text" id="nama_jabatan" name="nama_jabatan" placeholder="Nama jabatan" class="col-xs-12"/>
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

<?php foreach($dt_pejabat as $row){ ?>
<div id="edit-pejabat<?php echo $row->id_pejabat;?>" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Edit Pejabat</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/edit_pejabat/'.$row->id_pejabat)?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> NIP </label>
								<div class="col-sm-8">
									<input type="text" id="nip" name="nip" placeholder="Masukan NIP" value="<?php echo $row->nip;?>" class="col-xs-12"/>
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Nama </label>
								<div class="col-sm-8">
									<input type="text" id="nama" name="nama" placeholder="Masukan nama" value="<?php echo $row->nama;?>" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Pangkat </label>
								<div class="col-sm-8">
									<input type="text" id="pangkat" name="pangkat" placeholder="Masukan Pangkat" value="<?php echo $row->pangkat;?>" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Jabatan </label>
								<div class="col-sm-8">
									<select class="select2" id="jabatan" name="jabatan" data-placeholder="Pilih jabatan">
										<option value="<?php echo $row->jabatan;?>" selected><?php echo $row->jabatan;?></option>
										<option value="kadis">Kepala Dinas</option>
										<option value="kabid">Kepala Bidang</option>
										<option value="kasie">Kepala Seksi</option>
										<option value="bendahara">Bendahara</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Status </label>
								<div class="col-sm-8">
									<select class="select2" id="status" name="status" data-placeholder="Pilih status">
										<option value="<?php echo $row->aktif;?>" selected><?php if($row->aktif=="1") { echo "Aktif"; } else { echo "Tidak Aktif";}?></option>
										<option value="1">Aktif</option>
										<option value="0">Tidak Aktif</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Nama Jabatan </label>
								<div class="col-sm-8">
									<input type="text" id="nama_jabatan" name="nama_jabatan" placeholder="Nama jabatan" value="<?php echo $row->nama_jabatan;?>" class="col-xs-12"/>
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