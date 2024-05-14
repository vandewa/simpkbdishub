<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pendaftaran Online Uji Kendaraan Bermotor
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('pendaftaran/caridaftaronline')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." autofocus/>
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
	&nbsp;
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th>No</th>
						<th>No Uji</th>
						<th>No Kendaraan</th>
						<th class="hidden-480">Kode Booking</th>
						<th class="hidden-480">Tanggal Booking</th>
						<th class="hidden-480">Nama Pemohon</th>
						<th class="hidden-480">Jenis Pendaftaran</th>
						<th class="hidden-480">Metode Bayar</th>
						<th class="hidden-480">Status Bayar</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php
				$no = $start+1;
				if(isset($dt_pendaftaran)){
					foreach($dt_pendaftaran as $row){
					?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td class="hidden-480"><?php echo $row->kode_booking;?></td>
						<td class="hidden-480"><?php echo date("d F Y",strtotime($row->tgl_booking));?></td>
						<td class="hidden-480"><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo $row->jenis_pendaftaran;?></td>
						<td class="hidden-480"><?php echo $row->metode_bayar;?></td>
						<td class="hidden-480"><?php if($row->status_bayar=="0"){?><span class="label label-sm label-danger">BELUM BAYAR</span><?php } else { ?><span class="label label-sm label-success">LUNAS</span><?php } ?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">	
								<a href="<?php echo site_url('pendaftaran/prosespra?no_uji='.$row->no_uji.'&kode='.$row->kode_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Proses pendaftaran">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-check bigger-120"></i>
									</button>
								</a>

								<a href="<?php echo site_url('pendaftaran/hapuspra?id='.$row->kode_booking.'&kode='.$row->kode_uji);?>" onclick="return confirm('Anda yakin Menghapus Data Pendaftaran?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Pendaftaran">
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
											<a href="<?php echo site_url('pendaftaran/prosespra/'.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Proses pendaftaran">
												<button class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-check bigger-120"></i>
												</button>
											</a>
										</li>
										
										<li>
											<a href="<?php echo site_url('pendaftaran/hapuspra?id='.$row->kode_booking.'&kode='.$row->kode_uji);?>" onclick="return confirm('Anda yakin Menghapus Data Pendaftaran?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Pendaftaran">
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