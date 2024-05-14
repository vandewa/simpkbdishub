<div class="page-content">
	<div class="page-header">
		<h1>
			<?php echo ucfirst($title);?>
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<form action="<?php echo site_url('uji/carikendaraan')?>" method="post">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-search blue"></i>
					</span>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan nomor pengujian..." autofocus/>
					<span class="input-group-btn">
						<button type="submit" class="btn btn-info btn-sm">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Cari
						</button>
					</span>
				</div>
			</form>
		</div>
		
		<div class="col-xs-12 col-sm-4" align="center">
			<a href="<?php echo site_url('uji/semuakendaraan');?>" class="tooltip-success" data-rel="tooltip" title="Tampil Semua Kendaraan">
				<button class="btn btn-sm btn-info">
					<i class="ace-icon fa fa-truck align-top bigger-125"></i>
					Tampil Semua
				</button>
			</a>
		</div>
		
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('uji/caritglkendaraan')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-calendar blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input class="form-control date-picker" id="caritgl" name="caritgl" type="text" data-date-format="yyyy-mm-dd" placeholder="Pilih tanggal uji"/>
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
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="center">No Uji</th>
						<th class="center">No Kendaraan</th>
						<th class="center">No Antrian</th>
						<th class="center hidden-480">Nama Pemilik</th>
						<th class="center hidden-480">Tanggal Daftar</th>
						<th class="center">Pengujian</th>
					</tr>
				</thead>
				
				<tbody>
				<?php $no=1;
				foreach($dt_uji as $row){ ?>	
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><strong><?php echo $row->no_uji;?></strong></td>
						<td><strong><?php echo $row->no_kendaraan;?></strong></td>
						<td class="center"><strong><?php echo $row->no_antrian;?></strong></td>
						<td class="hidden-480"><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo strftime("%d %B %Y", strtotime($row->tgl_daftar_uji));?></td>
						<td class="center"><strong>
							<?php
								if($row->alur_ban>"0"){ ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=prauji&sts=1');?>" class="tooltip-success" data-rel="tooltip" title="Prauji">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-truck bigger-175"></i>
									</button>
								</a>
								<?php } else { ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=prauji&sts=1');?>" class="tooltip-success" data-rel="tooltip" title="Prauji">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-truck bigger-175"></i>
									</button>
								</a>
								<?php } 
								if(($row->asap>"0") || ($row->asap_co>"0") || ($row->asap_hc>"0")){ ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=emisi&sts=2');?>" class="tooltip-success" data-rel="tooltip" title="Emisi">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-fire bigger-175"></i>
									</button>
								</a>
								<?php } else { ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=emisi&sts=2');?>" class="tooltip-success" data-rel="tooltip" title="Emisi">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-fire bigger-175"></i>
									</button>
								</a>
								<?php } 
								if($row->foto=="1"){ ?>
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-sm btn-success dropdown-toggle">
										<i class="ace-icon fa fa-camera bigger-175"></i>
									</button>

									<ul class="dropdown-menu dropdown-danger">
										<li>
											<a href="<?php echo site_url('uji/ambil_foto_kendaraan_dekat/'.$row->kode_uji);?>">FOTO DEKAT</a>
										</li>

										<li>
											<a href="<?php echo site_url('uji/ambil_foto_kendaraan_jauh/'.$row->kode_uji);?>">FOTO JAUH</a>
										</li>
									</ul>
								</div>
								<?php } else { ?>							
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle">
										<i class="ace-icon fa fa-camera bigger-175"></i>
									</button>

									<ul class="dropdown-menu dropdown-danger">
										<li>
											<a href="<?php echo site_url('uji/ambil_foto_kendaraan_dekat/'.$row->kode_uji);?>">FOTO DEKAT</a>
										</li>

										<li>
											<a href="<?php echo site_url('uji/ambil_foto_kendaraan_jauh/'.$row->kode_uji);?>">FOTO JAUH</a>
										</li>
									</ul>
								</div>
								<?php }
								if($row->uji_bawah>"0"){ ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=bawah&sts=3');?>" class="tooltip-success" data-rel="tooltip" title="Uji Bawah">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-gavel bigger-175"></i>
									</button>
								</a>
								<?php } else { ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=bawah&sts=3');?>" class="tooltip-success" data-rel="tooltip" title="Uji Bawah">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-gavel bigger-175"></i>
									</button>
								</a>
								<?php }
								if(($row->tint_meter>"0") || ($row->sound_level>"0")){ ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=sound&sts=4');?>" class="tooltip-success" data-rel="tooltip" title="Uji Sound & Kaca">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-bullhorn bigger-175"></i>
									</button>
								</a>
								<?php } else { ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=sound&sts=4');?>" class="tooltip-success" data-rel="tooltip" title="Uji Sound & Kaca">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-bullhorn bigger-175"></i>
									</button>
								</a>
								<?php }
								if(($row->lampu_kiri>"0") || ($row->lampu_kanan>"0")){ ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=lampu&sts=5');?>" class="tooltip-success" data-rel="tooltip" title="Uji Lampu">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-lightbulb-o bigger-175"></i>
									</button>
								</a>
								<?php } else { ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=lampu&sts=5');?>" class="tooltip-success" data-rel="tooltip" title="Uji Lampu">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-lightbulb-o bigger-175"></i>
									</button>
								</a>
								<?php }
								if(($row->ax_total_s1>"0") || ($row->side_slip_in>"0")){ ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=berat&sts=6');?>" class="tooltip-success" data-rel="tooltip" title="Uji Berat & Sideslip">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-cog bigger-175"></i>
									</button>
								</a>
								<?php } else { ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=berat&sts=6');?>" class="tooltip-success" data-rel="tooltip" title="Uji Berat & Sideslip">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-cog bigger-175"></i>
									</button>
								</a>
								<?php }
								if(($row->speedometer>"0") || ($row->br_kiri_s1>"0") || ($row->br_tangan_kiri>"0")){ ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=kecepatan&sts=7');?>" class="tooltip-success" data-rel="tooltip" title="Uji Rem & Kecepatan">
									<button class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-tachometer bigger-175"></i>
									</button>
								</a>
								<?php } else { ?>
								<a href="<?php echo site_url('uji/proses_uji?id='.$row->kode_uji.'&uji=kecepatan&sts=7');?>" class="tooltip-success" data-rel="tooltip" title="Uji Rem & Kecepatan">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-tachometer bigger-175"></i>
									</button>
								</a>
							<?php } ?>
						</strong></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>