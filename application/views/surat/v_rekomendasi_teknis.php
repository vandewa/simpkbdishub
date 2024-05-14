<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Surat Rekomendasi Teknis Kendaraan Baru
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<form action="<?php echo site_url('surat/carirekom')?>" method="post">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-search blue"></i>
					</span>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<input type="text" class="form-control search-query" id="cari" name="cari" placeholder="Masukan No Surat, Nama Pemilik atau No Rangka..." autofocus/>
					<span class="input-group-btn">
						<button type="submit" class="btn btn-info btn-sm">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Cari
						</button>
					</span>
				</div>
			</form>
		</div>
		
		<div class="col-xs-12 col-sm-6" align="right">
			<a href="<?php echo site_url('surat/tambahrekom')?>">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Surat Rekomendasi
				</button>
			</a>
		</div>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">Nomor Surat</th>
						<th class="center">Tanggal Surat</th>
						<th class="center">Nama Pemilik</th>
						<th class="center">Jenis Kendaraan</th>
						<th class="center">Merek / Tipe</th>
						<th class="center hidden-480">Opsi</th>
					</tr>
				</thead>
				<?php
				$no=1;
				if(isset($dt_rekomendasi)){
					foreach($dt_rekomendasi as $row){
					?>
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_rekom;?></td>
						<td><?php echo date("d M Y",strtotime($row->tgl_rekom));?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->jenis_kendaraan;?> (<?php echo $row->jenis;?>)</td>
						<td><?php echo $row->merek;?> / <?php echo $row->tipe;?></td>
						<td class="center">
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('surat/lihatrekom/'.$row->id_kendaraan);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-search bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('surat/editrekom/'.$row->id_kendaraan);?>" class="tooltip-info" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('surat/cetakrekom/'.$row->id_kendaraan);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
									<button class="btn btn-xs btn-warning">
										<i class="ace-icon fa fa-print bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('surat/hapusrekom/'.$row->id_kendaraan);?>" onclick="return confirm('Anda yakin Menghapus Surat Rekomendasi?')" class="tooltip-warning" data-rel="tooltip" title="Hapus">
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
											<a href="<?php echo site_url('surat/lihatrekom/'.$row->id_kendaraan);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
												<button class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-search bigger-120"></i>
												</button>
											</a>
										</li>
										<li>.
											<a href="<?php echo site_url('surat/editrekom/'.$row->id_kendaraan);?>" class="tooltip-info" data-rel="tooltip" title="Edit">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</a>
										</li>
										<li>.	
											<a href="<?php echo site_url('surat/cetakrekom/'.$row->id_kendaraan);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
												<button class="btn btn-xs btn-warning">
													<i class="ace-icon fa fa-print bigger-120"></i>
												</button>
											</a>
										</li>
										<li>.	
											<a href="<?php echo site_url('surat/hapusrekom/'.$row->id_kendaraan);?>" onclick="return confirm('Anda yakin Menghapus Surat Rekomendasi?')" class="tooltip-warning" data-rel="tooltip" title="Hapus">
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