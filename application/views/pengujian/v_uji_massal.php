<div class="page-content">
	<div class="page-header">
		<h1>
			Kendaraan Uji Massal
		</h1>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12 col-sm-9">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<form action="<?php echo site_url('uji/cari_belum_uji')?>" method="post">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="ace-icon fa fa-search blue"></i>
							</span>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan nomor pengujian..." autofocus/>
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
		</div>
		
		<div class="col-xs-12 col-sm-3">
		</div>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="center">No Uji</th>
						<th class="center hidden-480">Kode Uji</th>
						<th class="center">No Kendaraan</th>
						<th class="center">No Antrian</th>
						<th class="center hidden-480">Jenis Kendaraan</th>
						<th class="center hidden-480">Tanggal Daftar</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<?php $no=1; foreach($dt_kendaraan as $row){ ?>
					
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><strong><?php echo $row->no_uji;?></strong></td>
						<td class="hidden-480"><?php echo $row->kode_uji;?></td>
						<td><strong><?php echo $row->no_kendaraan;?></strong></td>
						<td class="center"><strong><?php echo $row->no_antrian;?></strong></td>
						<td class="hidden-480"><?php echo $row->jenis_kendaraan;?></td>
						<td class="hidden-480"><?php echo date("d M Y", strtotime($row->tgl_daftar_uji));?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('uji/proses_uji_massal/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Input Pengujian">
									<button class="btn btn-xs btn-info">
										Input Pengujian
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
											<a href="<?php echo site_url('uji/proses_pengujian/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Input Pengujian">
												<button class="btn btn-xs btn-info">
													Input Pengujian
												</button>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
				<?php } ?>	
			</table>
		</div>
	</div>
</div>