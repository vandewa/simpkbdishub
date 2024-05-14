<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<h1>
					Tarif Retribusi Pengujian Kendaraan Bermotor
				</h1>
			</div>
			<div class="col-xs-12 col-sm-3" align="right">
				<a href="#tambah-tarif" data-toggle="modal">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-plus bigger-120 blue"></i>
						Tambah Retribusi
					</button>
				</a>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Jenis Uji</th>
						<th>Jenis Retribusi</th>
						<th>Nama Retribusi</th>
						<th>Jenis Kendaraan</th>
						<th>JBB</th>
						<th>Retribusi</th>
						<th>Opsi</th>
					</tr>
				</thead>

				<tbody>
				<?php
					$no=1;
					foreach($dt_retribusi as $row){
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->jenis_uji; ?></td>
						<td><?php echo $row->jenis_retribusi; ?></td>
						<td><?php echo $row->nama_retribusi; ?></td>
						<td><?php echo $row->jenis; ?></td>
						<td><?php echo $row->jbb_awal;?> - <?php echo $row->jbb_akhir;?></td>
						<td>Rp. <?php echo $row->tarif; ?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="#edit-tarif<?php echo $row->kd_tarif?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>
								
								<a href="<?php echo site_url('master/hapustarif/'.$row->kd_tarif);?>" onclick="return confirm('Anda yakin Menghapus Data Tarif Retribusi?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
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
											<a href="#edit-tarif<?php echo $row->kd_tarif?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="<?php echo site_url('master/hapustarif/'.$row->kd_tarif);?>" onclick="return confirm('Anda yakin Menghapus Data Tarif Retribusi?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
												<span class="red">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>


<div id="tambah-tarif" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Tarif Retribusi Pengujian Kendaraan Bermotor</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/tambahtarif')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left bolder blue"> Jenis Uji </label>
								<div class="col-sm-8">
									<select class="select2" id="jenis_uji" name="jenis_uji" data-placeholder="Pilih jenis uji">
										<option></option>
										<option value="Pertama">Uji Pertama</option>
										<option value="Berkala">Uji Berkala</option>
										<option value="Numpang Masuk">Numpang Uji Masuk</option>
										<option value="Numpang Keluar">Numpang Uji Keluar</option>
										<option value="Mutasi Masuk">Mutasi Uji Masuk</option>
										<option value="Mutasi Keluar">Mutasi Uji Keluar</option>
										<option value="Penilaian Teknis">Penilaian Teknis</option>
										<option value="Penggantian">Penggantian Tanda Uji</option>
										<option value="Kehilangan">Kehilangan Buku Uji</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Jenis Retribusi</label>
								<div class="col-sm-8">
									<select id="jenis_retribusi" name="jenis_retribusi" class="select2" data-placeholder="Pilih jenis retribusi">
										<option></option>
										<option value="Retribusi">Retribusi</option>
										<option value="Plat">Plat</option>
										<option value="Buku">Buku</option>
										<option value="Stiker">Stiker</option>
										<option value="Denda">Denda</option>
										<option value="Tanda">Tanda</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Jenis Kendaraan </label>
								<div class="col-sm-8">
									<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis kendaraan...">
										<option></option>
										<?php foreach($dt_jenis as $jns){ ?>
										<option value="<?php echo $jns->jenis;?>"><?php echo $jns->jenis;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> JBB </label>
								<div class="col-sm-4">
									<input type="text" id="jbb_awal" name="jbb_awal" placeholder="JBB Awal" class="col-xs-12" />
								</div>
								<div class="col-sm-4">
									<input type="text" id="jbb_akhir" name="jbb_akhir" placeholder="JBB Akhir" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
							<label class="col-sm-3 control-label no-padding-left"> Nama Retribusi </label>
								<div class="col-sm-8">
									<input type="text" id="nama_retribusi" name="nama_retribusi" placeholder="Nama Retribusi" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
							<label class="col-sm-3 control-label no-padding-left"> Tarif </label>
								<div class="col-sm-8">
									<input type="text" id="tarif" name="tarif" placeholder="Tarif Retribusi Kendaraan" class="col-xs-12" />
								</div>
							</div>
							
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i>
						Batal
					</button>

					<button type="submit" class="btn btn-sm btn-primary">
						<i class="ace-icon fa fa-check"></i>
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach($dt_retribusi as $row){ ?>
<div id="edit-tarif<?php echo $row->kd_tarif?>" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Ubah Data Tarif Retribusi Pengujian Kendaraan Bermotor</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('master/edittarif/'.$row->kd_tarif)?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left bolder blue"> Jenis Uji </label>
								<div class="col-sm-8">
									<select class="select2" id="jenis_uji" name="jenis_uji" data-placeholder="Pilih jenis uji">
										<option value="<?php echo $row->jenis_uji;?>" selected><?php echo $row->jenis_retribusi;?></option>
										<option>-</option>
										<option value="Pertama">Uji Pertama</option>
										<option value="Berkala">Uji Berkala</option>
										<option value="Numpang Masuk">Numpang Uji Masuk</option>
										<option value="Numpang Keluar">Numpang Uji Keluar</option>
										<option value="Mutasi Masuk">Mutasi Uji Masuk</option>
										<option value="Mutasi Keluar">Mutasi Uji Keluar</option>
										<option value="Penilaian Teknis">Penilaian Teknis</option>
										<option value="Penggantian">Penggantian Tanda Uji</option>
										<option value="Kehilangan">Kehilangan Buku Uji</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Jenis Retribusi</label>
								<div class="col-sm-8">
									<select id="jenis_retribusi" name="jenis_retribusi" class="select2" data-placeholder="Pilih jenis retribusi">
										<option value="<?php echo $row->jenis_retribusi;?>" selected><?php echo $row->jenis_retribusi;?></option>
										<option>-</option>
										<option value="Retribusi">Retribusi</option>
										<option value="Plat">Plat</option>
										<option value="Buku">Buku</option>
										<option value="Stiker">Stiker</option>
										<option value="Denda">Denda</option>
										<option value="Tanda">Tanda</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Jenis Kendaraan </label>
								<div class="col-sm-8">
									<select id="jenis" name="jenis" class="select2" data-placeholder="Pilih jenis kendaraan...">
										<option value="<?php echo $row->jenis;?>"><?php echo $row->jenis;?></option>
										<option>-</option>
										<?php foreach($dt_jenis as $jns){ ?>
										<option value="<?php echo $jns->jenis;?>"><?php echo $jns->jenis;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> JBB </label>
								<div class="col-sm-4">
									<input type="text" id="jbb_awal" name="jbb_awal" value="<?php echo $row->jbb_awal;?>" placeholder="JBB Awal" class="col-xs-12" />
								</div>
								<div class="col-sm-4">
									<input type="text" id="jbb_akhir" name="jbb_akhir" value="<?php echo $row->jbb_akhir;?>" placeholder="JBB Akhir" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Nama Retribusi </label>
								<div class="col-sm-8">
									<input type="text" id="nama_retribusi" name="nama_retribusi" value="<?php echo $row->nama_retribusi;?>" class="col-xs-12" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Tarif </label>
								<div class="col-sm-8">
									<input type="text" id="tarif" name="tarif" placeholder="Tarif Retribusi Kendaraan" value="<?php echo $row->tarif;?>" class="col-xs-12" />
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i>
						Batal
					</button>

					<button type="submit" class="btn btn-sm btn-primary">
						<i class="ace-icon fa fa-check"></i>
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>