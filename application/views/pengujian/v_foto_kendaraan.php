<div class="page-content">
	<div class="page-header">
		<h1>
			Daftar Foto Kendaraan
		</h1>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<form action="#" method="post">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-search blue"></i>
					</span>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." autofocus>
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
			<a href="<?php echo site_url('uji/fotoskrg');?>" class="tooltip-success" data-rel="tooltip" title="Tampil Semua Kendaraan">
				<button class="btn btn-sm btn-info">
					<i class="ace-icon fa fa-camera align-top bigger-125"></i>
					Kendaraan Hari Ini
				</button>
			</a>
		</div>
		<div class="col-xs-12 col-sm-4">
			<form action="<?php echo site_url('uji/rekaptglfoto')?>" method="post">
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
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$no=1;
				if(isset($dt_kendaraan)){
					foreach($dt_kendaraan as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><strong><?php echo $row->no_uji;?></strong></td>
						<td><strong><?php echo $row->no_kendaraan;?></strong></td>
						<td class="center"><strong><?php echo $row->no_antrian;?></strong></td>
						<td class="hidden-480"><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo strftime("%d %B %Y", strtotime($row->tgl_daftar_uji));?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="<?php echo site_url('uji/ambil_foto_kendaraan/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Foto Kendaraan">
									<button class="btn btn-xs btn-info">
										Ambil Foto
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
											<a href="<?php echo site_url('uji/ambil_foto_kendaraan/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Input Pra Pengujian">
												<button class="btn btn-xs btn-info">
													Ambil Foto
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
		</div>
	</div>
</div>