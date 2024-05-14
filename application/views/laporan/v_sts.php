<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Surat Tanda Setoran
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-8" align="right">
			<a href="<?php echo site_url('laporan/tambah_sts')?>">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Buat STS
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
						<th class="center">Tanggal</th>
						<th class="center">Nomor STS</th>
						<th class="center">Biaya Uji</th>
						<th class="center">Denda Uji</th>
						<th class="center">Tanda Uji</th>
						<th class="center">Total Retribusi</th>
						<th class="center hidden-480">Opsi</th>
					</tr>
				</thead>
				<?php
				$no = $start+1;
				if(isset($data_sts)){
					foreach($data_sts as $row){
					?>
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td class="center"><?php echo date("d M Y",strtotime($row->tgl_sts));?></td>
						<td class="center"><?php echo $row->no_sts;?></td>
						<td class="center"><?php echo $row->retribusi;?></td>
						<td class="center"><?php echo $row->denda;?></td>
						<td class="center"><?php echo $row->tanda;?></td>
						<td class="center"><?php echo $row->total;?></td>
						<td class="center">
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('laporan/sts_detail/'.$row->id_sts);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-search bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('laporan/sts_cetak?id='.$row->id_sts.'&no='.$row->no_sts);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
									<button class="btn btn-xs btn-warning">
										<i class="ace-icon fa fa-print bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('laporan/sts_hapus/'.$row->id_sts);?>" onclick="return confirm('Anda yakin Menghapus Data STS?')" class="tooltip-warning" data-rel="tooltip" title="Hapus">
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
											<a href="<?php echo site_url('laporan/sts_detail/'.$row->id_sts);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
												<button class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-search bigger-120"></i>
												</button>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('laporan/sts_cetak/'.$row->id_sts);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
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
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>