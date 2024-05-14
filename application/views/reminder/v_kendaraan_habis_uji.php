<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Kendaraan Habis Uji
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-8" align="right">
			<a href="<?php echo site_url('reminder/kirim_notifikasi')?>">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Kirim Notifikasi
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
						<th class="center">No Uji</th>
						<th class="center">No Ken</th>
						<th class="center">Telp</th>
						<th class="center">Jenis</th>
						<th class="center">Tgl Uji</th>
						<th class="center">Tgl Habis Uji</th>
						<th class="center">Notif</th>
						<th class="center hidden-480">Opsi</th>
					</tr>
				</thead>
				<?php
				$no = $start+1;
				if(isset($data_pengujian)){
					foreach($data_pengujian as $row){
					?>
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->telp;?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo date("d M Y",strtotime($row->tgl_uji));?></td>
						<td>
						<?php
							$tgl_akhir = $row->max_tgl_habis_uji;
							$habis = date("d M Y", strtotime($tgl_akhir));
							if($tgl_akhir <= unix_to_human($now)){ ?>
							<span class="label label-sm label-danger">Kadaluarsa / <?php echo $habis;?></span>
						<?php }  else { echo $habis; } ?>
						</td>
						<td class="center hidden-480"><?php echo $row->notif;?></td>
						<td class="center">
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('reminder/kirim_notifikasi_pengguna/'.$this->encryption->encode($row->no_uji));?>" class="tooltip-success" data-rel="tooltip" title="Kirim Notifikasi">
									<button class="btn btn-xs btn-danger">
										Kirim Notifikasi
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
											<a href="<?php echo site_url('reminder/kirim_notifikasi_pengguna/'.$this->encryption->encode($row->no_uji));?>" class="tooltip-success" data-rel="tooltip" title="Kirim Notifikasi">
												<button class="btn btn-xs btn-danger">
													Kirim Notifikasi
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