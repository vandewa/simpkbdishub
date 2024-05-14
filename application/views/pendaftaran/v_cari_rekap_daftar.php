<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pendaftaran Uji Kendaraan Bermotor
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('pendaftaran/cari')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." value="<?php echo set_value('cari');?>" />
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Cari
					</button>
				</span>
			</div>
		</form>
		</div>
		<div class="col-xs-12 col-sm-8" align="right">
			<a href="<?php echo site_url('pendaftaran/uji')?>">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Pendaftaran
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
						<th>No</th>
						<th>No Uji</th>
						<th>No Kendaraan</th>
						<th class="hidden-480">Jenis Kendaraan</th>
						<th class="hidden-480">Kode Uji</th>
						<th class="hidden-480">Nama Pemohon</th>
						<th class="hidden-480">Jenis Uji</th>
						<th>Tanggal Daftar</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php
				$no=1;
				if(isset($cari_pendaftaran)){
					foreach($cari_pendaftaran as $row){
					?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td class="hidden-480"><?php echo $row->jenis;?></td>
						<td class="hidden-480"><?php echo $row->kode_uji;?></td>
						<td class="hidden-480"><?php echo $row->nama_pemohon;?></td>
						<td class="hidden-480"><?php echo $row->jenis_uji;?></td>
						<td><?php echo date("d M Y", strtotime($row->tgl_daftar_uji));?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
							
								<?php if($row->jenis_uji=='Numpang Keluar') { ?> 
								<a href="<?php echo site_url('surat/numpangkeluar/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Buat Surat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-envelope bigger-120"></i>
									</button>
								</a>
								<?php } else if($row->jenis_uji=='Mutasi Keluar') { ?>
								<a href="<?php echo site_url('surat/mutasikeluar/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Buat Surat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-envelope bigger-120"></i>
									</button>
								</a>
								<?php } ?>
								
								<a href="<?php echo site_url('pendaftaran/edit/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Edit Pendaftaran">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>	
								
								<a href="<?php echo site_url('pendaftaran/cetak_pendaftaran/'.$row->kode_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Pendaftaran">
									<button class="btn btn-xs btn-warning">
										<i class="ace-icon fa fa-print bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('pendaftaran/cetak_pembayaran/'.$row->kode_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Pembayaran">
									<button class="btn btn-xs btn-default">
										<i class="ace-icon fa fa-money bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('pendaftaran/hapus/'.$row->kode_uji);?>" onclick="return confirm('Anda yakin Menghapus Data Pendaftaran?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Pendaftaran">
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
											<?php if($row->jenis_uji=='Numpang Keluar') { ?> 
											<a href="<?php echo site_url('surat/numpangkeluar/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Buat Surat">
												<button class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-envelope bigger-120"></i>
												</button>
											</a>
										</li>
										
										<li>
											<?php } else if($row->jenis_uji=='Mutasi Keluar') { ?>
											<a href="<?php echo site_url('surat/mutasikeluar/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Buat Surat">
												<button class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-envelope bigger-120"></i>
												</button>
											</a>
											<?php } ?>
										</li>
										
										<li>
											<a href="<?php echo site_url('pendaftaran/edit/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Edit Pendaftaran">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('pendaftaran/cetak_pendaftaran/'.$row->kode_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Pendaftaran">
												<button class="btn btn-xs btn-warning">
													<i class="ace-icon fa fa-print bigger-120"></i>
												</button>
											</a>
										</li>
										
										<li>
											<a href="<?php echo site_url('pendaftaran/hapus/'.$row->kode_uji);?>" onclick="return confirm('Anda yakin Menghapus Data Pendaftaran?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Pendaftaran">
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
		</div>
	</div>
</div>