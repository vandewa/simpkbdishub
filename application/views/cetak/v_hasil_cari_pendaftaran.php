<div class="page-content">
	<div class="page-header">
		<h1>
			Cetak Pendaftaran
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
			<form action="<?php echo site_url('cetak/cr_pendaftaran')?>" method="post">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-search blue"></i>
					</span>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<input type="text" class="form-control search-query" id="cari" name="cari" placeholder="Masukan nomor pengujian"/>
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
				<thead class="thin-border-bottom">
					<tr>
						<th>No</th>
						<th>No Uji</th>
						<th class="hidden-480">Kode Uji</th>
						<th>No Kendaraan</th>
						<th>Nama Pemilik</th>
						<th>Tanggal Daftar</th>
						<th class="hidden-480">Status Pembayaran</th>
						<th class="hidden-480">Status Pengujian</th>
						<th class="hidden-480">Status Cetak</th>
						<th class="hidden-480">Opsi</th>
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
						<td class="hidden-480"><?php echo $row->kode_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->tgl_daftar_uji;?></td>
						<td class="hidden-480"><?php $status_bayar = $row->status_bayar;
													if($status_bayar=='1') { ?> <span class="label label-success">Lunas</span>
													<?php } else { ?><span class="label label-danger">Belum Bayar</span><?php }?></td>
						<td class="hidden-480"><?php $status_uji = $row->status_uji;
													if($status_uji=='1') { ?> <span class="label label-success">Sudah Uji</span>
													<?php } else { ?><span class="label label-danger">Belum Uji</span><?php }?></td>
						<td class="hidden-480"><?php $cetak = $row->status_cetak;
													if($cetak=='1') { ?> Dicetak
													<?php } else { ?><span class="label label-danger">Belum dicetak</span><?php } 
													$tanggal_cetak = $row->tgl_cetak;
													if($tanggal_cetak=='0000-00-00 00:00:00'){
														echo "";
													} else {
														echo $tanggal_cetak;
													}?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('pendaftaran/detail/'.$this->encryption->encode($row->id_daftar));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-search bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('pendaftaran/edit/'.$this->encryption->encode($row->id_daftar));?>" class="tooltip-success" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('pendaftaran/cetak/'.$this->encryption->encode($row->id_daftar));?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
									<button class="btn btn-xs btn-warning">
										<i class="ace-icon fa fa-print bigger-120"></i>
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
											<a href="<?php echo site_url('uji/detail/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
												<span class="blue">
													<i class="ace-icon fa fa-search-plus bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('uji/edit/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>
										
										<li>
											<a href="<?php echo site_url('pendaftaran/cetak/'.$this->encryption->encode($row->id_daftar));?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
												<button class="btn btn-xs btn-warning">
													<i class="ace-icon fa fa-print bigger-120"></i>
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