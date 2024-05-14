<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Master Printer
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-printer" data-toggle="modal">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Printer
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
						<td>IP Printer</th>
						<th>Nama Printer</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
					$no=1;
					foreach($dt_printer as $row){ ?>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->ip_printer;?></td>
						<td><?php echo $row->nama_printer;?></td>
						<td>
							<a href="#edit-printer<?php echo $row->id_printer;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('master/hapus_printer/'.$row->id_printer);?>" onclick="return confirm('Anda yakin Menghapus Data printer?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</button>
							</a>
						</td>
					</tr>
				</tbody>
				<?php } ?>	
			</table>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>

<div id="tambah-printer" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah printer</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/tambahprinter')?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> IP Printer </label>
								<div class="col-sm-8">
									<input type="text" id="ip_printer" name="ip_printer" placeholder="Masukan IP printer" class="col-xs-12"/>
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Nama Printer </label>
								<div class="col-sm-8">
									<input type="text" id="nama_printer" name="nama_printer" placeholder="Masukan nama printer" class="col-xs-12"/>
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

<?php foreach($dt_printer as $row){ ?>
<div id="edit-printer<?php echo $row->id_printer;?>" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Edit printer</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/editprinter/'.$row->id_printer)?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> IP Printer </label>
								<div class="col-sm-8">
									<input type="text" id="ip_printer" name="ip_printer" value="<?php echo $row->ip_printer;?>" placeholder="Masukan IP printer" class="col-xs-12"/>
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Nama Printer </label>
								<div class="col-sm-8">
									<input type="text" id="nama_printer" name="nama_printer" value="<?php echo $row->nama_printer;?>" placeholder="Masukan nama printer" class="col-xs-12"/>
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