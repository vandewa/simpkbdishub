<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pengujian
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
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
		<form action="<?php echo site_url('uji/rekap_tanggal')?>" method="post">
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
						<th class="hidden-480">Kode Uji</th>
						<th class="hidden-480">Nomor Kendaraan</th>
						<th class="center">No Antrian</th>
						<th class="hidden-480">Jenis</th>
						<th>Tanggal Uji</th>
						<th class="hidden-480">Tanggal Habis Uji</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				$no = $start+1;
				if(isset($data_pengujian)){
					foreach($data_pengujian as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><strong><?php echo $row->no_uji;?></strong></td>
						<td class="hidden-480"><?php echo $row->kode_uji;?></td>
						<td class="hidden-480"><strong><?php echo $row->no_kendaraan;?></strong></td>
						<td class="center"><strong><?php echo $row->no_antrian;?></strong></td>
						<td class="hidden-480"><?php echo $row->jenis_kendaraan;?> (<?php echo $row->bentuk?>)</td>
						<td><?php echo strftime("%d %B %Y", strtotime($row->tgl_uji));?></td>
						<td class="hidden-480">
						<?php
							if($row->hasil=="LULUS"){
								$tgl_akhir = $row->tgl_habis_uji;
								if($tgl_akhir < date("Y-m-d")){ ?>
								<span class="label label-sm label-danger"><?php echo strftime("%d %B %Y", strtotime($tgl_akhir));?></span>
								<?php } else { ?>
								<span class="label label-sm label-primary"><?php echo strftime("%d %B %Y", strtotime($tgl_akhir));?></span>
								<?php }
							} else if($row->hasil=="TIDAK LULUS") { ?>
								<span class="label label-sm label-danger">TIDAK LULUS</span>
							<?php 
							} else if($row->hasil==''){ ?>
								<span class="label label-sm label-success"><?php echo $row->jenis_uji;?></span>
							<?php } ?>
						</td>
						<td>
							<?php if($row->status_kendaraan=="2"){ ?>
							<span class="label label-sm label-danger">KENDARAAN DI BLOKIR</span>	
							<?php } else { ?>
							<a href="<?php echo site_url('uji/detail/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-search bigger-120"></i>
								</button>
							</a>
							
							<!--
							<a href="<?php echo site_url('uji/cetak_lhp?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-info" data-rel="tooltip" title="Cetak Lembar Hasil Pemeriksaan">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</button>
							</a>
							-->
							
							<?php if($row->hasil=="LULUS"){?>
							<a href="<?php echo site_url('uji/edit/'.$row->kode_uji);?>" onclick="return confirm('Anda yakin akan merubah data hasil pengujian?')" class="tooltip-warning" data-rel="tooltip" title="Edit Hasil Uji">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							
							<?php if($row->uji=="1"){ ?>
							<a href="<?php echo site_url('uji/perso/'.$row->kode_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Perso Hasil Uji">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-exchange bigger-120"></i>
								</button>
							</a>
							<?php } else { ?>
							<a href="<?php echo site_url('uji/perso/'.$row->kode_uji);?>" onclick="return confirm('Anda yakin akan memperso ulang data pengujian?')" class="tooltip-warning" data-rel="tooltip" title="Perso Hasil Uji">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-exchange bigger-120"></i>
								</button>
							</a>
							<?php } ?>
							
							<!--
							<a href="#cetak_kartu_baru-<?php echo $row->kode_uji;?>" data-toggle="modal" class="tooltip-info" data-rel="tooltip" title="Cetak Kartu Induk Baru">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</button>
							</a>
							-->
							
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-sm btn-info dropdown-toggle">
									<i class="ace-icon fa fa-print bigger-125"></i>
								</button>

								<ul class="dropdown-menu dropdown-info">
									<li>
										<a href="#cetak_kartu_baru-<?php echo $row->kode_uji;?>" data-toggle="modal" class="tooltip-info" data-rel="tooltip" title="Cetak Kartu Induk Baru">Kartu Baru</a>
									</li>

									<li>
										<a href="#cetak_kartu-<?php echo $row->kode_uji;?>" data-toggle="modal" class="tooltip-info" data-rel="tooltip" title="Cetak Kartu Induk Lama">Kartu Lama</a>
									</li>
								</ul>
							</div>
							
							<?php if($row->jenis_uji=="Numpang Masuk") { ?>
							<a href="<?php echo site_url('uji/cetak_stiker?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak stiker barang">
									<button class="btn btn-xs btn-warning">
										<i class="ace-icon fa fa-truck bigger-120"></i>
									</button>
								</a>
								
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-sm btn-muted dropdown-toggle">
									<i class="ace-icon fa fa-book bigger-125"></i>
								</button>

								<ul class="dropdown-menu dropdown-muted">
									<li>
										<a href="<?php echo site_url('uji/cetak_buku_kanan?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Buku Kanan">Buku Kanan</a>
									</li>

									<li>
										<a href="<?php echo site_url('uji/cetak_buku_kiri?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Buku Kanan">Buku Kiri</a>
									</li>
								</ul>
							</div>
							<?php } ?>
							
							<?php if($row->uji=="2"){ ?>
							<br/>
							<span class="label label-sm label-info">SUDAH PERSO</span>
							<?php } ?>
							
							<?php } else if($row->hasil=="TIDAK LULUS") { 
							if($row->aktif=="3"){ ?>
							<a href="#proses_sktl-<?php echo $row->kode_uji;?>" data-toggle="modal" class="tooltip-info" data-rel="tooltip" title="Buat SKTL">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-envelope bigger-120"></i>
								</button>
							</a>
							<?php } else if($row->aktif=="4"){ ?>
							<a href="<?php echo site_url('uji/cetak_sktl?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak SKTL">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</button>
							</a>
							<?php }}} ?>					
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
	foreach($data_pengujian as $row){
	?>
	<div id="cetak_kartu-<?php echo $row->kode_uji;?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Cetak Kartu Lama</h4>
				</div>
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('uji/cetak_kartu_uji/'.$row->kode_uji);?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Masukan Baris Cetak</label>
									<div class="col-sm-8">
										<input type="text" id="baris" name="baris" class="col-xs-12" required=""/>
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

						<button type="submit" class="btn btn-sm btn-success">
							<i class="ace-icon fa fa-check"></i>
							Cetak
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="cetak_kartu_baru-<?php echo $row->kode_uji;?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Cetak Kartu Baru</h4>
				</div>
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('uji/cetak_kartu_uji_baru/'.$row->kode_uji);?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Masukan Baris Cetak</label>
									<div class="col-sm-8">
										<input type="text" id="baris" name="baris" class="col-xs-12" required=""/>
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

						<button type="submit" class="btn btn-sm btn-success">
							<i class="ace-icon fa fa-check"></i>
							Cetak
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php if($row->aktif=="3"){ ?>
	<div id="proses_sktl-<?php echo $row->kode_uji;?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Proses Surat Keterangan Tidak Lulus Uji</h4>
				</div>
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('uji/proses_sktl?id='.$row->kode_uji.'&no='.$row->no_uji);?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-left bolder blue">Batas Perbaikan </label>
							<div class="col-sm-9">
								<div class="input-group">
									<input class="form-control date-picker" id="tgl_batas_perbaikan" name="tgl_batas_perbaikan" value="<?php echo $row->tgl_batas_perbaikan;?>" type="text" data-date-format="yyyy-mm-dd"/>
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-left bolder blue"> Penguji</label>
							<div class="col-sm-9">
								<select class="select2" id="penguji" name="penguji" data-placeholder="Pilih penguji" required>
									<option value=""></option>
									<?php foreach($dt_penguji as $pgj){ 
									if($row->penguji==$pgj->idx){ ?>
									<option value="<?php echo $row->penguji;?>" selected><?php echo $row->nama_penguji; ?></option>
									<?php } else { ?>
									<option value="<?php echo $pgj->idx;?>"><?php echo $pgj->nama; ?></option>
									<?php }} ?>
								</select>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-sm" data-dismiss="modal">
							<i class="ace-icon fa fa-times"></i>
							Batal
						</button>

						<button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Anda yakin data sudah benar?')">
							<i class="ace-icon fa fa-check"></i>
							Proses
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>
<?php } ?>
