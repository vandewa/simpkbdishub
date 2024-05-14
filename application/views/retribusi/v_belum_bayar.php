<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Retribusi Belum Lunas
		</h1>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>No Uji</th>
						<th>No Kendaraan</th>
						<th>Nama Pemilik</th>
						<th>Tanggal Daftar</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($daftar_retribusi)){
					foreach($daftar_retribusi as $row){
					?>
					
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->tgl_daftar_uji;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('retribusi/proses_pembayaran/'.$this->encryption->encode($row->id_retribusi));?>" class="tooltip-success" data-rel="tooltip" title="Proses Pembayaran">
									<button class="btn btn-xs btn-info">
										Proses Pembayaran
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
											<a href="<?php echo site_url('retribusi/proses_pembayaran/'.$this->encryption->encode($row->id_retribusi));?>" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-check-square-o bigger-120"></i>
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
		</div>
	</div>
</div>