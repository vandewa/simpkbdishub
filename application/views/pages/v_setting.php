<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<h1>
					Pengaturan Sistem
				</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#umum">
							<i class="blue ace-icon fa fa-cogs bigger-120"></i>
							Umum
						</a>
					</li>
					
					<li>
						<a data-toggle="tab" href="#printer">
							<i class="blue ace-icon fa fa-print bigger-120"></i>
							Printer
						</a>
					</li>
					
					<li>
						<a data-toggle="tab" href="#masterprinter">
							<i class="blue ace-icon fa fa-list-alt bigger-120"></i>
							Master Printer
						</a>
					</li>
					
					<li>
						<a data-toggle="tab" href="#mastertarget">
							<i class="blue ace-icon fa fa-money bigger-120"></i>
							Master Traget
						</a>
					</li>
				</ul>
				
				<div class="tab-content">
					<div id="umum" class="tab-pane fade in active">
						<form class="form-horizontal" role="form" action="<?php echo site_url('setting/updatesetting')?>" method="post">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<?php 
						if(isset($data_setting)){
							foreach($data_setting as $row){
							?>
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<input type="hidden" value="<?php echo $row->id;?>" name="id">
					
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Dinas</label>
									<div class="col-sm-10">
										<input type="text" id="dinas" name="dinas" value="<?php echo $row->dinas;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Alamat</label>
									<div class="col-sm-10">
										<textarea id="alamat" name="alamat" class="autosize-transition form-control"  ><?php echo $row->alamat;?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Telepon</label>
									<div class="col-sm-10">
										<input type="text" id="telepon" name="telepon" value="<?php echo $row->telepon;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Email</label>
									<div class="col-sm-10">
										<input type="email" id="email" name="email" value="<?php echo $row->email;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Website</label>
									<div class="col-sm-10">
										<input type="text" id="website" name="website" value="<?php echo $row->website;?>" class="col-xs-12"  />
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-6">							
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Kode Buku</label>
									<div class="col-sm-8">
										<input type="text" id="kd_buku" name="kd_buku" value="<?php echo $row->kd_buku;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Kode Stiker</label>
									<div class="col-sm-8">
										<input type="text" id="kd_stiker" name="kd_stiker" value="<?php echo $row->kd_stiker;?>" class="col-xs-12"  />
									</div>
								</div>
								
								<?php
									if(!empty($_SERVER['HTTP_CLIENT_IP'])){
									$ip=$_SERVER['HTTP_CLIENT_IP'];
									}
									elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
									$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
									}
									else{
									$ip=$_SERVER['REMOTE_ADDR'];
									}
									$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
								?>
								
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> Cek IP Publik</label>
									<div class="col-sm-8">
										<input type="text" id="ipcam" name="ipcam" value="<?php echo $ip;?>" class="col-xs-12" readonly />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding-left"> IP Kamera</label>
									<div class="col-sm-8">
										<input type="text" id="ipcam" name="ipcam" value="<?php echo $row->ipcam;?>" class="col-xs-12"  />
									</div>
								</div>
							</div>
						</div>
						<?php 
							}
						} ?>
						<div class="clearfix form-actions">
							<div class="col-md-offset-4 col-md-8">
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Simpan
								</button>

								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									Reset
								</button>
							</div>
						</div>
						</form>
					</div>
					
					<div id="printer" class="tab-pane fade">
						<?php foreach($data_printset as $pr){ ?>
						<form class="form-horizontal" role="form" action="<?php echo site_url('setting/simpanprinter/'.$this->session->userdata('id_user'));?>" method="post">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Pendaftaran</label>
								<div class="col-sm-3">
									<select class="select2" multiple="" name="ip_print_daftar" placeholder="Pilih alamat printer pendaftaran">
										<option value="<?php echo $pr->pendaftaran;?>" selected><?php echo $pr->pendaftaran;?></option>
										<option></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="col-sm-3">
									<select class="select2" multiple="" name="nama_print_daftar" placeholder="Pilih alamat printer pendaftaran">
										<option></option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Pembayaran</label>
								<div class="col-sm-3">
									<select class="select2" multiple="" name="ip_print_bayar" placeholder="Pilih alamat printer pembayaran">
										<option value="<?php echo $pr->pembayaran;?>" selected><?php echo $pr->pembayaran;?></option>
										<option></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="col-sm-3">
									<select class="select2" multiple="" name="nama_print_bayar" placeholder="Pilih alamat printer pembayaran">
										<option></option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Stiker</label>
								<div class="col-sm-3">
									<select class="select2" multiple="" name="ip_print_stiker" placeholder="Pilih alamat printer stiker">
										<option value="<?php echo $pr->stiker;?>" selected><?php echo $pr->stiker;?></option>
										<option></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="col-sm-3">
									<select class="select2" multiple="" name="nama_print_stiker" placeholder="Pilih alamat printer stiker">
										<option></option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Buku uji</label>
								<div class="col-sm-3">
									<select class="select2" multiple="" name="ip_print_buku" placeholder="Pilih alamat printer buku">
										<option value="<?php echo $pr->buku_uji;?>" selected><?php echo $pr->buku_uji;?></option>
										<option></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="col-sm-3">
									<select class="select2" multiple="" name="nama_print_buku" placeholder="Pilih alamat printer buku">
										<option></option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Kartu Induk</label>
								<div class="col-sm-3">
									<select class="select2" multiple="" name="ip_print_kartu" placeholder="Pilih alamat printer kartu induk">
										<option value="<?php echo $pr->kartu_induk;?>" selected><?php echo $pr->kartu_induk;?></option>
										<option></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="col-sm-3">
									<select class="select2" multiple="" name="nama_print_kartu" placeholder="Pilih alamat printer kartu induk">
										<option></option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Surat</label>
								<div class="col-sm-3">
									<select class="select2" multiple="" name="ip_print_surat" placeholder="Pilih alamat printer surat">
										<option value="<?php echo $pr->surat;?>" selected><?php echo $pr->surat;?></option>
										<option></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="col-sm-3">
									<select class="select2" multiple="" name="nama_print_surat" placeholder="Pilih alamat printer surat">
										<option></option>
									</select>
								</div>
							</div>
							
							<div class="clearfix form-actions">
							<div class="col-md-offset-4 col-md-8">
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Simpan
								</button>

								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									Reset
								</button>
							</div>
						</div>
						</form>
						<?php } ?>
					</div>
					
					<div id="masterprinter" class="tab-pane fade">
						<div class="row">
							<div class="col-xs-12 col-sm-9">
							</div>
							<div class="col-xs-12 col-sm-3" align="right">
								<a href="#tambah-printer" data-toggle="modal">
								<button class="btn btn-white btn-info btn-round">
									<i class="ace-icon fa fa-plus bigger-120 blue"></i>
									Tambah Printer
								</button>
								</a>
							</div>
						</div>
						&nbsp;
						<div class="row">
							<div class="col-xs-12">
								<table id="simple-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<td>No</th>
											<td>IP Printer</th>
											<th>Nama Printer</th>
											<th>Opsi</th>
										</tr>
									</thead>
									
									<?php 
									$no=1;
									if(isset($data_printer)){
										foreach($data_printer as $row){
										?>

									<tbody>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $row->ip_printer;?></td>
											<td><?php echo $row->nama_printer;?></td>
											<td>
												<div class="hidden-sm hidden-xs btn-group">
													<a href="<?php echo site_url('setting/hapusprinter/'.$row->id_printer);?>" onclick="return confirm('Anda yakin menghapus data printer?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
														<button class="btn btn-xs btn-danger">
															<i class="ace-icon fa fa-trash-o bigger-120"></i>
														</button>
													</a>

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
						
						<div id="tambah-printer" class="modal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Tambah Printer</h4>
									</div>
									<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/tambahprinter')?>">
										<div class="modal-body">
											<div class="row">
												<div class="col-xs-12 col-sm-12">
													<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left"> IP Printer </label>
														<div class="col-sm-9">
															<input type="text" id="ip_printer" name="ip_printer" class="col-xs-12"/>
														</div>
													</div>
												
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left"> Nama Printer</label>
														<div class="col-sm-9">
															<input type="text" id="nama_printer" name="nama_printer" class="col-xs-12"/>
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
					</div>
					
					<div id="mastertarget" class="tab-pane fade">
						<div class="row">
							<div class="col-xs-12 col-sm-9">
							</div>
							<div class="col-xs-12 col-sm-3" align="right">
								<a href="#tambah-target" data-toggle="modal">
								<button class="btn btn-white btn-info btn-round">
									<i class="ace-icon fa fa-plus bigger-120 blue"></i>
									Tambah Target
								</button>
								</a>
							</div>
						</div>
						&nbsp;
						<div class="row">
							<div class="col-xs-12">
								<table id="simple-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<td>No</th>
											<td>Tahun</th>
											<th>Kategori</th>
											<th>Target</th>
											<th>Opsi</th>
										</tr>
									</thead>
									
									<?php 
									$no=1;
									if(isset($data_target)){
										foreach($data_target as $row){
										?>

									<tbody>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $row->dpa;?></td>
											<td><?php echo $row->kategori;?></td>
											<td><?php echo $row->target;?></td>
											<td>
												<div class="hidden-sm hidden-xs btn-group">
													<a href="<?php echo site_url('setting/hapustarget/'.$row->id_target);?>" onclick="return confirm('Anda yakin menghapus data target?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
														<button class="btn btn-xs btn-danger">
															<i class="ace-icon fa fa-trash-o bigger-120"></i>
														</button>
													</a>

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
						
						<div id="tambah-target" class="modal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Tambah Target</h4>
									</div>
									<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('setting/tambahtarget')?>">
										<div class="modal-body">
											<div class="row">
												<div class="col-xs-12 col-sm-12">
													<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left"> Tahun Anggaran </label>
														<div class="col-sm-9">
															<input type="text" id="tahun" name="tahun" class="col-xs-12"/>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left"> Kategori Kendaraan</label>
														<div class="col-sm-9">
															<select class="form-control" id="kategori" name="kategori" data-placeholder="Pilih kategori kendaraan">
																<option value=""></option>
																<option value="Mobil Penumpang Taxi">Mobil Penumpang Taxi</option>
																<option value="Mobil Mini Bus">Mobil Mini Bus</option>
																<option value="Mobil Bus">Mobil Bus</option>
																<option value="Mobil Barang Pick Up">Mobil Barang Pick Up</option>
																<option value="Mobil Barang Truck">Mobil Barang Truck</option>
															</select>
														</div>
													</div>
												
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-left"> Target</label>
														<div class="col-sm-9">
															<input type="text" id="target" name="target" class="col-xs-12"/>
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
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>