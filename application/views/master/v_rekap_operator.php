<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Rekap Operator SIM PKB
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-operator" data-toggle="modal">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Operator
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
						<th class="hidden-480">Hak Akses</th>
						<th class="hidden-480">Username</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($data_operator)){
					foreach($data_operator as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->nip;?> / <?php if($row->id_akses=="3") { echo $row->nrp; }?></td>
						<td><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo $row->alamat;?></td>
						<td class="hidden-480"><?php echo $row->telp;?></td>
						<td class="hidden-480"><?php echo $row->akses;?></td>
						<td class="hidden-480"><?php echo $row->username;?></td>
						<td>
							<?php if(($row->id_akses=="3") && ($row->id_penguji=="")){ ?>
							<span class="label label-sm label-warning">MOHON LENGKAPI ID PENGUJI</span>
							<?php } ?>
							
							<a href="#edit-operator-<?php echo $row->id_user;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit Data">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							
							<a href="#edit-password-<?php echo $row->id_user;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit Password">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-lock bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('master/hapusoperator/'.$row->id_user);?>" onclick="return confirm('Anda yakin Menghapus Data Operator?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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

<div id="tambah-operator" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Operator SIM PKB</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/tambahoperator')?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> NIP </label>
								<div class="col-sm-8">
									<input type="text" id="nip" name="nip" placeholder="Masukan NIP operator" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Nama </label>
								<div class="col-sm-8">
									<input type="text" id="nama" name="nama" placeholder="Masukan nama operator" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Alamat</label>
								<div class="col-sm-8">
									<textarea id="alamat" name="alamat" class="autosize-transition form-control" placeholder="Masukan alamat operator" ></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Telepon </label>
								<div class="col-sm-8">
									<input type="text" id="telp" name="telp" placeholder="Masukan nomor telepon operator" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Email </label>
								<div class="col-sm-8">
									<input type="email" id="email" name="email" placeholder="Masukan alamat email operator" class="col-xs-12" />
								</div>
							</div>
							
							<div class="space space-8"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Hak Akses </label>
								<div class="col-sm-8">
									<select class="form-control" id="akses" name="akses" placeholder="Hak Akses">
										<option></option>
										<option value="2">Operator</option>
										<option value="3">Penguji</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Username </label>
								<div class="col-sm-8">
									<input type="text" id="username" name="username" placeholder="Masukan username operator" class="col-xs-12" />
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
	if(isset($data_operator)){
		foreach($data_operator as $row){
		?>
		<div id="edit-operator-<?php echo $row->id_user;?>" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Edit Data Operator SIM PKB</h4>
					</div>
					<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/editoperatordata/'.$row->id_user);?>">
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
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> ID Penguji</label>
										<div class="col-sm-8">
											<select class="select2" id="penguji" name="penguji" data-placeholder="Pilih penguji">
												<option value=""></option>
												<?php foreach($dt_penguji as $pgj){ 
												if($row->id_penguji==$pgj->idx){ ?>
												<option value="<?php echo $row->id_penguji;?>" selected><?php echo $row->penguji;?> - <?php echo $row->nrp;?></option>
												<?php } else { ?>
												<option value="<?php echo $pgj->idx;?>"><?php echo $pgj->nama; ?> - <?php echo $pgj->nrp;?></option>
												<?php }} ?>
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
		
		<div id="edit-password-<?php echo $row->id_user;?>" class="modal fade" tabindex="-2">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Edit Password Operator SIM PKB</h4>
					</div>
					<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/editoperatorpassword/'.$row->id_user);?>">
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Username </label>
										<div class="col-sm-8">
											<input type="text" id="username" name="username" value="<?php echo $row->username;?>" placeholder="Masukan username operator" class="col-xs-12" />
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