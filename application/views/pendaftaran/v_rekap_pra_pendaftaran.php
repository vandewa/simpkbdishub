<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pra Pendaftaran Uji Kendaraan Bermotor
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12" align="right">
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
						<th>Kode Uji</th>
						<th>No Uji</th>
						<th>No Kendaraan</th>
						<th class="hidden-480">Jenis / Bentuk Kendaraan</th>
						<th class="hidden-480">No Antrian</th>
						<th class="hidden-480">Nama Pemilik</th>
						<th class="hidden-480">Jenis Uji</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php
				$no = 1;
				if(isset($dt_pendaftaran)){
					foreach($dt_pendaftaran as $row){
					?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->kode_uji;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td class="hidden-480"><?php echo $row->jenis;?> / <?php echo $row->bentuk;?></td>
						<td class="hidden-480"><?php echo $row->no_antrian;?></td>
						<td class="hidden-480"><?php echo $row->nama_pemohon;?></td>
						<td class="hidden-480"><?php echo $row->jenis_uji;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('pendaftaran/prosesdaftaruji/'.$row->no_uji);?>" class="tooltip-success" data-rel="tooltip" title="Proses Pendaftaran">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-check bigger-120"></i>
									</button>
								</a>

								<a href="<?php echo site_url('pendaftaran/cetak_antiran/'.$row->kode_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Nomor Antrian">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-print bigger-120"></i>
									</button>
								</a>

								<a href="<?php echo site_url('pendaftaran/hapuspra/'.$row->kode_uji);?>" onclick="return confirm('Anda yakin Menghapus Data Pendaftaran?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Pendaftaran">
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
											<a href="<?php echo site_url('pendaftaran/prosesdaftar/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Proses Pendaftaran">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-check bigger-120"></i>
												</button>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('pendaftaran/cetak_antiran/'.$row->kode_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Nomor Antrian">
												<button class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-print bigger-120"></i>
												</button>
											</a>
										</li>
										
										<li>
											<a href="<?php echo site_url('pendaftaran/hapuspra/'.$row->kode_uji);?>" onclick="return confirm('Anda yakin Menghapus Data Pendaftaran?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Pendaftaran">
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