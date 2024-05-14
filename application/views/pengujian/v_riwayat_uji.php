<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pengujian
		</h1>
	</div>
	
	&nbsp
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">Nomor Uji</th>
						<th class="center">Kode Uji</th>
						<th class="center">Nomor Kendaraan</th>
						<th class="center">Jenis</th>
						<th class="center">Tanggal Uji</th>
						<th class="center">Tanggal Habis Uji</th>
						<th class="center">Status Uji</th>
						<th class="center hidden-480">Opsi</th>
					</tr>
				</thead>
				<?php
				$no=1;
				if(isset($data_pengujian)){
					foreach($data_pengujian as $row){
					?>
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->kode_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->jenis;?></td>
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
								<a href="<?php echo site_url('uji/detail_riwayat/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-search bigger-120"></i>
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
											<a href="<?php echo site_url('uji/detail_riwayat/'.$this->encryption->encode($row->kode_uji));?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
												<span class="blue">
													<i class="ace-icon fa fa-search-plus bigger-120"></i>
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