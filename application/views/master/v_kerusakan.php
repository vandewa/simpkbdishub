<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Master Kerusakan
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-kerusakan" data-toggle="modal">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Kerusakan
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
						<th>Kerusakan</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no = $start+1;
				if(isset($dt_kerusakan)){
					foreach($dt_kerusakan as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->kategori_kerusakan;?></td>
						<td><?php echo $row->kerusakan;?></td>
						<td>
							<a href="#edit-kerusakan-<?php echo $row->id_kerusakan;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('master/hapus_kerusakan/'.$row->id_kerusakan);?>" onclick="return confirm('Anda yakin Menghapus Data kerusakan?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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
			<?php echo $this->pagination->create_links();?>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>

<div id="tambah-kerusakan" class="modal fade"  tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Kerusakan</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/tambah_kerusakan')?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Kategori Kerusakan </label>
								<div class="col-sm-8">
									<select class="select2" id="kategori_kerusakan" name="kategori_kerusakan" data-placeholder="Pilih kategori">
										<option></option>
										<option value="prauji">Pra Uji</option>
										<option value="bawah">Bawah Kendaraan</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Kerusakan</label>
								<div class="col-sm-9">
									<input type="text" id="kerusakan" name="kerusakan" class="col-xs-12"/>
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

<?php foreach($dt_kerusakan as $row){ ?>
<div id="edit-kerusakan-<?php echo $row->id_kerusakan;?>" class="modal fade"  tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Edit Kerusakan</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/edit_kerusakan/'.$row->id_kerusakan)?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Kategori Kerusakan </label>
								<div class="col-sm-8">
									<select class="select2" id="kategori_kerusakan" name="kategori_kerusakan" data-placeholder="Pilih kategori">
										<option value="<?php echo $row->kategori_kerusakan;?>"><?php echo $row->kategori_kerusakan;?></option>
										<option></option>
										<option value="prauji">Pra Uji</option>
										<option value="bawah">Bawah Kendaraan</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Kerusakan</label>
								<div class="col-sm-9">
									<input type="text" id="kerusakan" name="kerusakan" value="<?php echo $row->kerusakan;?>" class="col-xs-12"/>
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