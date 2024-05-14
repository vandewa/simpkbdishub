<div class="page-content">
	<div class="page-header">
		<h1>
			Surat Keterangan Tidak Lulus Uji
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-8">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
			<form action="<?php echo site_url('surat/filter_tanggalsktl')?>" method="post">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="input-group">
					<div class="input-daterange input-group">
						<input type="text" name="tgl_awal" data-date-format="yyyy-mm-dd" class="form-control date-picker" placeholder="Tanggal awal" />
						<span class="input-group-addon">
							<i class="fa fa-exchange"></i>
						</span>

						<input type="text" name="tgl_akhir" data-date-format="yyyy-mm-dd" class="form-control date-picker" placeholder="Tanggal akhir" />
					</div>
					
					<span class="input-group-btn">
						<button type="submit" class="btn btn-info btn-sm">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Pilih
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
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">Nomor Surat</th>
						<th class="center">Tanggal Surat</th>
						<th class="center">Jenis Surat</th>
						<th class="center">Nomor Uji</th>
						<th class="center">Jenis Kendaraan</th>
						<th class="center">Tanggal Batas Perbaikan</th>
						<th class="center hidden-480">Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no=1;
				if(isset($dt_sktl)){
					foreach($dt_sktl as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_surat;?></td>
						<td><?php echo strftime("%d %B %Y",strtotime($row->tgl_surat));?></td>
						<td><?php echo strtoupper($row->jenis_surat);?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->jenis;?>/<?php echo $row->bentuk;?></td>
						<td><?php if($row->tgl_batas_perbaikan!=""){ echo strftime("%d %B %Y",strtotime($row->tgl_batas_perbaikan));} else { ?><span class="label label-sm label-success">SUDAH LULUS</span><?php } ?></td>
						<td class="center">
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('uji/cetak_sktl?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak SKTL">
									<button class="btn btn-xs btn-warning">
										<i class="ace-icon fa fa-print bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('surat/hapusrekom/'.$row->id_surat);?>" onclick="return confirm('Anda yakin Menghapus Surat SKTL?')" class="tooltip-warning" data-rel="tooltip" title="Hapus">
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
											<a href="<?php echo site_url('uji/cetak_sktl?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak SKTL">
												<button class="btn btn-xs btn-warning">
													<i class="ace-icon fa fa-print bigger-120"></i>
												</button>
											</a>
										</li>
										<li>
											<a href="<?php echo site_url('surat/hapusrekom/'.$row->id_surat);?>" onclick="return confirm('Anda yakin Menghapus Surat SKTL?')" class="tooltip-warning" data-rel="tooltip" title="Hapus">
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
				<?php }} ?>
				</tbody>
			</table>
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>