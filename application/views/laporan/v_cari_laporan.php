<div class="page-content">
	<div class="page-header">
		<h1>
			Cari Data Pengujian Kendaraan Bermotor
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-6">
			<form action="<?php echo site_url('laporan/caridata')?>" method="post">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="input-group">
					<select class="form-control" placeholder="Pilih kategori" name="kategori" >
						<option value="">Pilih Kategori</option>
						<option value="no_uji">Nomor Uji</option>
						<option value="jenis">Jenis Kendaraan</option>
						<option value="status">Status Kendaraan</option>
						<option value="merek">Merek Kendaraan</option>
						<option value="jenis_uji">Jenis Uji</option>
						<option value="kecamatan">Kecamatan</option>
					</select>
					<span class="input-group-addon">
						<i class="ace-icon fa fa-search blue"></i>
					</span>
					<input type="text" class="form-control search-query" id="cari" name="cari"/>
					<span class="input-group-btn">
						<button type="submit" class="btn btn-info btn-sm">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Cari
						</button>
					</span>
				</div>
			</form>
		</div>
	</div>
	
	<div class="space space-4"></div>
	<?php echo form_error('kategori','<p class="text-danger">');?><?php echo form_error('cari','<p class="text-danger">');?>
	<div class="space space-4"></div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<td>No</th>
						<th>No Kendaraan</th>
						<th>No Uji</th>
						<th class="hidden-480">Kecamatan</th>
						<th class="hidden-480">Merk</th>
						<th class="hidden-480">Jenis</th>
						<th>Jenis Uji</th>
						<th>Masa Berlaku</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php 
				$no=1;
				if(isset($cari_kendaraan)){
					foreach($cari_kendaraan as $row){
				?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td class="hidden-480"><?php echo $row->kecamatan;?></td>
						<td class="hidden-480"><?php echo $row->merek;?></td>
						<td class="hidden-480"><?php echo $row->jenis;?></td>
						<td><?php echo $row->jenis_uji;?></td>
						<td>
						<?php if($row->max_tgl_habis_uji <= unix_to_human($now)){ ?>
							<span class="label label-sm label-warning">Kadaluarsa / <?php echo $row->max_tgl_habis_uji;?></span>
						<?php }  else { echo $row->max_tgl_habis_uji; } ?>
						</td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('kendaraan/detail/'.$row->no_kendaraan);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-search bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('kendaraan/edit/'.$row->no_kendaraan)?>" class="tooltip-success" data-rel="tooltip" title="Edit">
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
											<a href="<?php echo site_url('kendaraan/detail')?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
												<span class="blue">
													<i class="ace-icon fa fa-search-plus bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('kendaraan/edit')?>" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
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