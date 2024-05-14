<div class="page-content">
	<div class="page-header">
		<h1>
			Cetak Laporan Pengujian
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
			<form action="<?php echo site_url('cetak/cr_laporan_uji')?>" method="post">
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
						<th class="center">No</th>
						<th class="center">Nomor Uji</th>
						<th class="center">Kode Uji</th>
						<th class="center">Nomor Kendaraan</th>
						<th class="center">Tanggal Uji</th>
						<th class="center">Tanggal Habis Uji</th>
						<th class="center">Status Uji</th>
						<th class="center hidden-480">Opsi</th>
					</tr>
				</thead>
				<?php
				$no=1;
				if(isset($cari_laporan_uji)){
					foreach($cari_laporan_uji as $row){
					?>
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->kode_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->tgl_uji;?></td>
						<td>
						<?php
							$tgl_akhir = $row->tgl_habis_uji;
							$habis = date("Y-m-d", strtotime($tgl_akhir));
							if($tgl_akhir <= unix_to_human($now)){ ?>
							<span class="label label-sm label-danger">Kadaluarsa / <?php echo $habis;?></span>
						<?php }  else { echo $habis; } ?>
						</td>
						<td class="center hidden-480">
							<?php if($row->hasil=='LULUS') {?>
							<span class="label label-success">Lulus Uji</span>
							<?php } else if($row->hasil=='GAGAL') { ?>
							<span class="label label-danger">Tidak Lulus Uji</span>
							<?php } else { ?>
							<span class="label label-warning">Belum Uji</span>
							<?php } ?>
						</td>
						<td class="center">
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('uji/detail/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-search bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('uji/cetak/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
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
											<a href="<?php echo site_url('uji/cetak/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-warning" data-rel="tooltip" title="Cetak">
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