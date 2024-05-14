<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Rekap Admin SIM PKB
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-admin" data-toggle="modal">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Admin
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
						<th>NIP</th>
						<th>Nama</th>
						<th class="hidden-480">Alamat</th>
						<th class="hidden-480">Telepon</th>
						<th class="hidden-480">Username</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($data_admin)){
					foreach($data_admin as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->nip;?></td>
						<td><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo $row->alamat;?></td>
						<td class="hidden-480"><?php echo $row->telp;?></td>
						<td class="hidden-480"><?php echo $row->username;?></td>
						<td>
							<a href="#edit-admin<?php echo $row->id_user;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('master/hapusadmin/'.$row->id_user);?>" onclick="return confirm('Anda yakin Menghapus Data Admin?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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

<div id="tambah-admin" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Admin SIM PKB</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/tambahadmin')?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> NIP </label>
								<div class="col-sm-8">
									<input type="text" id="nip" name="nip" placeholder="Masukan NIP admin" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Nama </label>
								<div class="col-sm-8">
									<input type="text" id="nama" name="nama" placeholder="Masukan nama admin" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Alamat</label>
								<div class="col-sm-8">
									<textarea id="alamat" name="alamat" class="autosize-transition form-control" placeholder="Masukan alamat admin" ></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Telepon </label>
								<div class="col-sm-8">
									<input type="text" id="telp" name="telp" placeholder="Masukan nomor telepon admin" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Email </label>
								<div class="col-sm-8">
									<input type="email" id="email" name="email" placeholder="Masukan alamat email admin" class="col-xs-12" />
								</div>
							</div>
							
							<div class="space space-8"></div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Username </label>
								<div class="col-sm-8">
									<input type="text" id="username" name="username" placeholder="Masukan username admin" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Password </label>
								<div class="col-sm-8">
									<input type="password" id="password" name="password" placeholder="Masukan password" class="col-xs-12" />
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
	if(isset($data_admin)){
		foreach($data_admin as $row){
		?>
		<div id="edit-admin<?php echo $row->id_user;?>" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Edit Data Admin PKB</h4>
					</div>
					<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/editadmin/'.$row->id_user);?>">
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> NIP </label>
										<div class="col-sm-8">
											<input type="text" id="nip" name="nip" value="<?php echo $row->nip;?>" class="col-xs-12"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Nama </label>
										<div class="col-sm-8">
											<input type="text" id="nama" name="nama" value="<?php echo $row->nama;?>" class="col-xs-12"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Alamat</label>
										<div class="col-sm-8">
											<textarea id="alamat" name="alamat" class="autosize-transition form-control"><?php echo $row->alamat;?></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Telepon </label>
										<div class="col-sm-8">
											<input type="text" id="telp" name="telp" value="<?php echo $row->telp;?>" class="col-xs-12" />
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Email </label>
										<div class="col-sm-8">
											<input type="email" id="email" name="email" value="<?php echo $row->email;?>" class="col-xs-12" />
										</div>
									</div>
									
									<div class="space space-8"></div>
							
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Username </label>
										<div class="col-sm-8">
											<input type="text" id="username" name="username" value="<?php echo $row->username;?>" placeholder="Masukan username admin" class="col-xs-12" />
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Password </label>
										<div class="col-sm-8">
											<input type="password" id="password" name="password" value="<?php echo $row->password;?>" class="col-xs-12" />
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