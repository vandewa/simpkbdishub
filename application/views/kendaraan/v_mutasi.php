<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Mutasi Kendaraan
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-6">
		<form action="<?php echo site_url('kendaraan/carimutasi')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" class="form-control search-query" id="cari" name="cari" placeholder="Masukan Nomor Pengujian..." required="" autofocus/>
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
	&nbsp;
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<td>No</th>
						<th>No Kendaraan</th>
						<th>No Uji</th>
						<th class="hidden-480">Merk</th>
						<th class="hidden-480">Jenis / Tipe</th>
						<th class="hidden-480">Pemilik</th>
						<th class="hidden-480">Tanggal Mutasi</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php 
				$no = $start+1;
				if(isset($dt_mutasi)){
					foreach($dt_mutasi as $row){
				?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><b><?php echo $row->no_kendaraan;?></b></td>
						<td><b><?php echo $row->no_uji;?></b></td>
						<td class="hidden-480"><?php echo $row->merek;?></td>
						<td class="hidden-480"><?php echo $row->jenis;?> / <?php echo $row->tipe;?></td>
						<td class="hidden-480"><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo strftime("%d %B %Y", strtotime($row->tgl_daftar_uji));?></td>
						<td>
							<a href="<?php echo site_url('kendaraan/detail/'.$row->no_uji);?>" target="_blank" class="tooltip-info" data-rel="tooltip" title="Lihat">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-search bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('kendaraan/batalmutasi/'.$row->no_uji);?>" onclick="return confirm('Anda yakin membatalkan mutasi kendaran?')" class="tooltip-success" data-rel="tooltip" title="Batal Mutasi Kendaraan">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-unlock bigger-120"></i>
								</button>
							</a>
						</td>
					</tr>
				</tbody>
					<?php 
					}
				} ?>
			</table>
			<?php echo $this->pagination->create_links();?>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>
