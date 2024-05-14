<div class="page-content">
	<div class="page-header">
		<h1>
			Profile User
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#user">
							<i class="blue ace-icon fa fa-user bigger-120"></i>
							Informasi User
						</a>
					</li>

					<li>
						<a data-toggle="tab" href="#password">
							<i class="blue ace-icon fa fa-lock bigger-120"></i>
							Informasi Keamanan
						</a>
					</li>
					
					<li>
						<a data-toggle="tab" href="#printer">
							<i class="blue ace-icon fa fa-print bigger-120"></i>
							Printer
						</a>
					</li>
				</ul>
				
				<div class="tab-content">
					<?php foreach($data_user as $row){ ?>
					<div id="user" class="tab-pane fade in active">
						<form class="form-horizontal" role="form" action="<?php echo site_url('user/updateprofile')?>" method="post">
						<div class="row">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> NIP</label>
									<div class="col-sm-9">
										<input type="text" id="nip" name="nip" value="<?php echo $row->nip;?>" placeholder="NIP"  class="col-xs-12"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Nama</label>
									<div class="col-sm-9">
										<input type="text" id="nama" name="nama" value="<?php echo $row->nama;?>" placeholder="Nama" class="col-xs-12" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Alamat</label>
									<div class="col-sm-9">
										<textarea id="alamat" name="alamat" class="autosize-transition form-control" placeholder="Alamat" ><?php echo $row->alamat;?></textarea>
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Telepon</label>
									<div class="col-sm-9">
										<input type="text" id="telp" name="telp" value="<?php echo $row->telp;?>" placeholder="Telepon" class="col-xs-12" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Email</label>
									<div class="col-sm-9">
										<input type="email" id="email" name="email" value="<?php echo $row->email;?>" placeholder="Email" class="col-xs-12" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12">
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
							</div>
						</div>
						</form>
					</div>

					<div id="password" class="tab-pane fade">
						<form class="form-horizontal" role="form" action="<?php echo site_url('user/updatepassword')?>" method="post">
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Username</label>
									<div class="col-sm-9">
										<input type="text" id="username" name="username" value="<?php echo $row->username;?>" class="col-xs-12" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Password Baru</label>
									<div class="col-sm-9">
										<input type="password" id="newpass" name="newpass" placeholder="Masukan password baru anda" class="col-xs-12" />
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Password</label>
									<div class="col-sm-9">
										<input type="password" id="password" name="password" value="<?php echo $row->password;?>" class="col-xs-12" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-left"> Ulangi Password</label>
									<div class="col-sm-9">
										<input type="password" id="confnewpass" name="confnewpass" placeholder="Ulangi password baru anda" class="col-xs-12" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12">
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
							</div>
						</div>
						</form>
					</div>
					<?php } ?>
					
					<div id="printer" class="tab-pane fade">
						<?php foreach($data_printset as $pr){ ?>
						<form class="form-horizontal" role="form" action="<?php echo site_url('user/simpanprinter/'.$this->session->userdata('id_user'));?>" method="post">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Pendaftaran</label>
								<div class="col-sm-6">
									<select class="select2" name="ip_print_daftar" placeholder="Pilih alamat printer pendaftaran">
										<option value="<?php echo $pr->pendaftaran;?>" selected><?php echo $pr->pendaftaran;?></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Pembayaran</label>
								<div class="col-sm-6">
									<select class="select2" name="ip_print_bayar" placeholder="Pilih alamat printer pembayaran">
										<option value="<?php echo $pr->pembayaran;?>" selected><?php echo $pr->pembayaran;?></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Stiker</label>
								<div class="col-sm-6">
									<select class="select2" name="ip_print_stiker" placeholder="Pilih alamat printer stiker">
										<option value="<?php echo $pr->stiker;?>" selected><?php echo $pr->stiker;?></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Buku uji</label>
								<div class="col-sm-6">
									<select class="select2" name="ip_print_buku" placeholder="Pilih alamat printer buku">
										<option value="<?php echo $pr->buku_uji;?>" selected><?php echo $pr->buku_uji;?></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Kartu Induk</label>
								<div class="col-sm-6">
									<select class="select2" name="ip_print_kartu" placeholder="Pilih alamat printer kartu induk">
										<option value="<?php echo $pr->kartu_induk;?>" selected><?php echo $pr->kartu_induk;?></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label bolder blue no-padding-left">Surat</label>
								<div class="col-sm-6">
									<select class="select2" name="ip_print_surat" placeholder="Pilih alamat printer surat">
										<option value="<?php echo $pr->surat;?>" selected><?php echo $pr->surat;?></option>
										<?php foreach($data_printer as $row){?>
											<option value="<?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?>"><?php echo $row->ip_printer;?>-<?php echo $row->nama_printer;?></option>
										<?php } ?>
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
				</div>
			</div>
		</div>
	</div>
</div>