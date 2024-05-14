<div class="page-content">
	<div class="page-header">
		<h1>
			Daftar Kendaraan Diblokir
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
		<form action="<?php echo site_url('kendaraan/cari')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" class="form-control search-query" id="cari" name="cari" placeholder="Masukan Nomor Pengujian..." />
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
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<td>No</th>
						<th>No Kendaraan</th>
						<th>No Uji</th>
						<th>Jenis</th>
						<th>Pemilik</th>
						<th>Tanggal Blokir</th>
						<th>Keterangan</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php 
				$no=1;
				if(isset($dt_kendaraan)){
					foreach($dt_kendaraan as $row){
				?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo strftime("%d %B %Y",strtotime($row->tgl_blokir));?></td>
						<td><?php echo $row->ket_blokir;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">	
								<a href="<?php echo site_url('kendaraan/hapus_blokir/'.$row->no_uji);?>" onclick="return confirm('Anda yakin menghapus blokir kendaran?')" class="tooltip-success" data-rel="tooltip" title="Hapus Blokir Kendaraan">
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
											<a href="<?php echo site_url('kendaraan/hapus_blokir/'.$row->no_uji);?>" onclick="return confirm('Anda yakin menghapus blokir kendaran?')" class="tooltip-success" data-rel="tooltip" title="Hapus Blokir Kendaraan">
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
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>