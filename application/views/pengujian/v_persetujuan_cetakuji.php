<div class="page-content">
	<div class="page-header">
		<h1>
			Persetujuan Cetak Hasil Uji
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('uji/cari')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." autofocus />
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
						<th>Nomor Uji</th>
						<th>Nomor Kendaraan</th>
						<th class="hidden-480">Jenis</th>
						<th class="hidden-480">Nama Pemilik</th>
						<th class="hidden-480">Pelayanan</th>
						<th class="hidden-480">Hasil</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				$no = $start+1;
				if(isset($dt_persetujuan)){
					foreach($dt_persetujuan as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><strong><?php echo $row->no_uji;?></strong></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td class="hidden-480"><?php echo $row->jenis;?> (<?php echo $row->jenis_kendaraan;?>)</td>
						<td class="hidden-480"><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo $row->jenis_uji;?></td>
						<td class="hidden-480"><?php echo $row->hasil;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">								
								<a href="#lihat-<?php echo $row->kode_uji;?>" data-toggle="modal" class="tooltip-warning" data-rel="tooltip" title="Lihat hasil uji">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-search bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('uji/setujui_cetakuji/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" onclick="return confirm('Anda yakin menyetujui hasil uji?')" title="Setujui cetak hasil uji">
									<button class="btn btn-xs btn-warning">
										<i class="ace-icon fa fa-check bigger-120"></i>
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
											<a href="<?php echo site_url('uji/setujui_cetakuji/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" onclick="return confirm('Anda yakin menyetujui hasil uji?')" title="Setujui cetak hasil uji">
												<button class="btn btn-xs btn-warning">
													<i class="ace-icon fa fa-check bigger-120"></i>
												</button>
											</a>
										</li>
										
										<li>
											<a href="#lihat-<?php echo $row->kode_uji;?>" data-toggle="modal" class="tooltip-warning" data-rel="tooltip" title="Lihat hasil uji">
												<button class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-search bigger-120"></i>
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

<?php 
	foreach($dt_persetujuan as $row){
	?>
	<div id="lihat-<?php echo $row->kode_uji;?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Lihat Hasil Uji</h4>
				</div>
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('uji/setujui_cetakuji/'.$row->kode_uji);?>">
					<div class="modal-body">
						<div class="row">
							<div class="profile-user-info">
								<div class="profile-info-row">
									<div class="profile-info-name"><b>Nomor Uji / Kendaraan</b></div>

									<div class="profile-info-value">
										<span class="bolder"><?php echo $row->no_uji;?> / <?php echo $row->no_kendaraan;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"> Nama Pemilik</div>

									<div class="profile-info-value">
										<span><?php echo $row->nama;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Jenis Kendaraan </div>

									<div class="profile-info-value">
										<span><?php echo $row->jenis;?> (<?php echo $row->jenis_kendaraan;?>)</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Merek dan Tipe </div>

									<div class="profile-info-value">
										<span><?php echo $row->merek;?> / <?php echo $row->tipe;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"> Tahun Pembuatan </div>

									<div class="profile-info-value">
										<span><?php echo $row->tahun;?></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"><strong> Hasil Uji </strong></div>

									<div class="profile-info-value">
										<span><strong><?php echo $row->hasil;?></strong></span>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"> Masa Berlaku Uji </div>

									<div class="profile-info-value">
										<span><?php echo date("d M Y",strtotime($row->tgl_habis_uji));?></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-sm" data-dismiss="modal">
							<i class="ace-icon fa fa-times"></i>
							Batal
						</button>

						<button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Anda yakin menyetujui hasil uji?')">
							<i class="ace-icon fa fa-check"></i>
							Setujui
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>
