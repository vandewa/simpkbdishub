<div class="page-content">
	<div class="page-header">
		<h1>
			Cetak Pembayaran
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
			<form action="<?php echo site_url('cetak/cr_pembayaran')?>" method="post">
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
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="center">No Retribusi</th>
						<th class="center">No Kendaraan</th>
						<th class="center">No Uji</th>
						<th class="center">Nama Pemilik</th>
						<th class="center">Tanggal Pembayaran</th>
						<th class="center">Jumlah Pembayaran</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($cari_pembayaran)){
					foreach($cari_pembayaran as $row){
					?>
					
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->id_retribusi;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->tgl_pembayaran;?></td>
						<td>Rp. <?php echo $this->cart->format_number($row->total_retribusi);?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('retribusi/detailpembayaran/'.$this->encryption->encode($row->id_retribusi));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-search bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('retribusi/cetak/'.$this->encryption->encode($row->id_retribusi));?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
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
											<a href="<?php echo site_url('retribusi/detailpembayaran/'.$this->encryption->encode($row->id_retribusi));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
												<span class="blue">
													<i class="ace-icon fa fa-search-plus bigger-120"></i>
												</span>
											</a>
										</li>	
										<li>
											<a href="<?php echo site_url('retribusi/cetak/'.$this->encryption->encode($row->id_retribusi));?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
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