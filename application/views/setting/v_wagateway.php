<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					WhatsApp Gateway
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-wagateway" data-toggle="modal">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-plus bigger-120 blue"></i>
						Tambah Server WhatsApp
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
						<th>Jenis</th>
						<th>Server WhatsApp</th>
						<th>No WhatsApp</th>
						<th>API WhatsApp</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>

				<tbody>
				<?php
					$no=1;
					foreach($dt_wagateway as $row){
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo $row->server_wa;?></td>
						<td><?php echo $row->no_wa;?></td>
						<td><?php echo $row->api_wa;?></td>
						<td><?php if($row->aktif=="1"){ echo "AKTIF"; } else { echo "TIDAK AKTIF"; } ?></td>
						<td>
							<a href="#edit-wagateway<?php echo $row->id_server?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('setting/hapuswagateway/'.$row->id_server);?>" onclick="return confirm('Anda yakin Menghapus Server WhatsApp?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</button>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div id="tambah-wagateway" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Server WhatsApp</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/tambahwagateway')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Jenis Server</label>
								<div class="col-sm-8">
									<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis server...">
										<option></option>
										<option value="wakita">Wakita</option>
										<option value="wablas">Wablas</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Server WhatsApp</label>
								<div class="col-sm-9">
									<input type="text" id="server_wa" name="server_wa" placeholder="Server WhatsApp" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Nomor WhatsApp</label>
								<div class="col-sm-9">
									<input type="text" id="no_wa" name="no_wa" placeholder="Nomor WhatsApp" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> API WhatsApp </label>
								<div class="col-sm-9">
									<textarea id="api_wa" name="api_wa" class="autosize-transition form-control" placeholder="Api WhatsApp"></textarea>
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

<?php foreach($dt_wagateway as $row){ ?>
<div id="edit-wagateway<?php echo $row->id_server?>" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Edit Server WhatsApp</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/editwagateway/'.$row->id_server)?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Jenis Server</label>
								<div class="col-sm-8">
									<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis server...">
										<option value="<?php echo $row->jenis;?>" selected><?php echo $row->jenis;?></option>
										<option></option>
										<option value="wakita">Wakita</option>
										<option value="wablas">Wablas</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Server WhatsApp</label>
								<div class="col-sm-9">
									<input type="text" id="server_wa" name="server_wa" value="<?php echo $row->server_wa;?>" placeholder="Server WhatsApp" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Nomor WhatsApp</label>
								<div class="col-sm-9">
									<input type="text" id="no_wa" name="no_wa" value="<?php echo $row->no_wa;?>" placeholder="Nomor WhatsApp" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> API WhatsApp </label>
								<div class="col-sm-9">
									<textarea id="api_wa" name="api_wa" class="autosize-transition form-control" placeholder="Api WhatsApp"><?php echo $row->api_wa;?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Aktif</label>
								<div class="col-sm-9">
									<select class="select2" id="aktif" name="aktif" data-placeholder="Pilih status" required>
										<option value="<?php echo $row->aktif;?>" selected><?php if($row->aktif=='1'){ echo 'YA'; } else { echo "TIDAK"; } ?></option>
										<option value="1">YA</option>
										<option value="0">TIDAK</option>
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