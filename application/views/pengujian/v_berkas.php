<div class="page-content">
	<div class="page-header">
		<h1>
			Serah Terima Berkas
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('uji/cariberkas')?>" method="post">
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
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
		<form action="<?php echo site_url('uji/rekapberkas')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-calendar blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input class="form-control date-picker" id="caritgl" name="caritgl" type="text" data-date-format="yyyy-mm-dd" placeholder="Rekap berdasar tanggal"/>
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
						<th class="hidden-480">No Kendaraan</th>
						<th class="center">Antrian</th>
						<th class="hidden-480">Jenis</th>
						<th class="hidden-480">Waktu Daftar / Selesai</th>
						<th>Waktu Pelayanan</th>
						<th class="center">IKM</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				$no = $start+1;
				if(isset($dt_berkas)){
					foreach($dt_berkas as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><strong><?php echo $row->no_uji;?></strong></td>
						<td class="hidden-480"><strong><?php echo $row->no_kendaraan;?></strong></td>
						<td class="center"><strong><?php echo $row->no_antrian;?></strong></td>
						<td class="hidden-480"><?php echo $row->bentuk?></td>
						<td class="hidden-480"><span class="label label-sm label-success"><?php echo strftime("%d %B %Y %H:%M:%S", strtotime($row->waktu_pendaftaran));?></span><?php if($row->waktu_selesai!=""){ ?><br/><span class="label label-sm label-info"><?php echo strftime("%d %B %Y %H:%M:%S", strtotime($row->waktu_selesai)); }?></span></td>
						<td><?php
						if($row->waktu_selesai!=""){
							$datea = new DateTime($row->waktu_pendaftaran);
							$dateb = new DateTime($row->waktu_selesai);
							$pelayanan = $datea->diff($dateb)->format("%h Jam %i Menit %s Detik");
							echo $pelayanan;
						} else { ?> <span class="label label-sm label-warning">Belum Selesai</span>
						<?php } ?>
						</td>
						<td class="center">
							<?php if($row->ikm=="1"){ ?>
							<button class="btn btn-xs btn-success">
								<i class="ace-icon fa fa-check bigger-150"></i>
							</button>
							<?php } else { ?>
							<button class="btn btn-xs btn-danger">
								<i class="ace-icon fa fa-close bigger-150"></i>
							</button>
							<?php } ?>
						</td>
						<td class="center">
							<div class="hidden-sm hidden-xs btn-group">
								<?php if($row->waktu_selesai==""){ ?>
								<a href="<?php echo site_url('uji/prosesberkas/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Selesaikan" onclick="return confirm('Anda yakin selesaikan pelayanan?')">
									<button class="btn btn-xs btn-info">
										PROSES <i class="ace-icon fa fa-check"></i>
									</button>
								</a>
								<?php } else { ?>
								<button class="btn btn-xs btn-info">
									SELESAI <i class="ace-icon fa fa-check bigger-150"></i>
								</button>
								<?php } ?>
							</div>
							
							<div class="hidden-md hidden-lg">
								<div class="inline pos-rel">
									<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
										<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
									</button>

									<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
										<li>
											<?php if($row->waktu_selesai=="0000-00-00 00:00:00"){ ?>
											<a href="<?php echo site_url('uji/prosesberkas/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Selesaikan" onclick="return confirm('Anda yakin selesaikan pelayanan?')">
												<button class="btn btn-xs btn-info">
													PROSES <i class="ace-icon fa fa-check"></i>
												</button>
											</a>
											<?php } ?>
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