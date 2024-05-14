<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Rekap Penguji
				</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>NRP</th>
						<th>Nama</th>
						<th>Pangkat</th>
						<th>TTD Smartcard</th>
						<th>TTD Sistem</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($data_penguji)){
					foreach($data_penguji as $row){
					?>

				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->nrp;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->pangkat;?></td>
						<td><img width="150px" src="data:image/png;base64,<?php echo base64_encode($row->tandatangan2);?>"/></td>
						<td><?php if($row->ttd!=""){ ?><img width="150px" class="img-responsive" src="<?php echo base_url('files/ttd/'.$row->ttd.'.png');?>"><?php } ?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<?php if($row->flag_aktif=='1'){ ?>
								<a href="<?php echo site_url('master/disablepenguji/'.$row->idx);?>" class="tooltip-success" data-rel="tooltip" title="Aktifkan penguji">
									<button class="btn btn-xs btn-danger">
										Non Aktifkan TTD
									</button>
								</a>
								<?php } else { ?>
								<a href="<?php echo site_url('master/enablepenguji/'.$row->idx);?>" class="tooltip-success" data-rel="tooltip" title="Nonaktifkan penguji">
									<button class="btn btn-xs btn-success">
										Aktifkan TTD
									</button>
								</a>
								<?php } ?>
								
								<a href="#edit-penguji<?php echo $row->idx;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit Penguji">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
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
											<a href="#edit-penguji<?php echo $row->idx;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit Penguji">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
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

<?php 
	$no=1;
	if(isset($data_penguji)){
		foreach($data_penguji as $row){
		?>
		<div id="edit-penguji<?php echo $row->idx;?>" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Edit Data Penguji</h4>
					</div>
					<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/editpenguji/'.$row->idx);?>" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left"> No Reg </label>
										<div class="col-sm-8">
											<input type="text" id="nrp" name="nrp" value="<?php echo $row->nrp;?>" class="col-xs-12" />
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left"> Nama </label>
										<div class="col-sm-8">
											<input type="text" id="nama" name="nama" value="<?php echo $row->nama;?>" class="col-xs-12"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left"> Pangkat </label>
										<div class="col-sm-8">
											<input type="text" id="pangkat" name="pangkat" value="<?php echo $row->pangkat;?>" class="col-xs-12"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left"> Upload TTD</label>
										<div class="col-sm-8">
											<input type="file" id="foto1" name="ttd"/>
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