<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Kendaraan Uji
		</h1>
	</div>
	
	<?php foreach($dt_setting as $set){
		$kd_buku = $set->kd_buku;
		$kd_stiker = $set->kd_stiker;
	} ?>
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="center">Kode Uji</th>
						<th class="center">Tanggal</th>
						<th class="center">No Uji</th>
						<th class="center">No Ken</th>
						<th class="center">Jenis</th>
						<th class="center">Habis Uji</th>
						<th class="center">JBB</th>
						<th class="center">Jenis Uji</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no=1;
				if(isset($rekap_kendaraan)){
					foreach($rekap_kendaraan as $row){
					?>
					
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->kode_uji;?></td>
						<td><?php echo strftime("%d %B %Y", strtotime($row->tgl_daftar_uji));?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->jenis;?> / <?php echo $row->bentuk;?></td>
						<td><?php echo strftime("%d %B %Y",strtotime($row->tgl_habis_uji));?></td>
						<td><?php echo $row->jbb;?></td>
						<td><?php echo $row->jenis_uji;?></td>
						<td class="center">
							<a href="#verifikasi-<?php echo $row->kode_uji;?>" data-toggle="modal" class="tooltip-warning" data-rel="tooltip" title="Verifikasi Data">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-check bigger-120"></i>
								</button>
							</a>
						</td>
					</tr>
				</tbody>
				<?php 
				}
			} ?>	
			</table>
		</div>
	</div>
</div>

<?php 
	foreach($rekap_kendaraan as $row){
	?>
	<div id="verifikasi-<?php echo $row->kode_uji;?>" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">VERIFIKASI DAN PENGELUARAN BARANG</h4>
				</div>
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('barang/proses_pengeluaran?kd='.$row->kode_uji.'&tgl='.$row->tgl_daftar_uji);?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> No Uji </label>
									<div class="col-sm-4">
										<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
									</div>
									
									<label class="col-sm-2 control-label no-padding-left"> No Kendaraan </label>
									<div class="col-sm-4">
										<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" readonly />
									</div>
									
									
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Jenis Kendaraan </label>
									<div class="col-sm-4">
										<input type="text" id="jenis" name="jenis" value="<?php echo $row->bentuk;?>" class="col-xs-12" readonly />
									</div>
									
									<label class="col-sm-2 control-label no-padding-left"> Pemilik </label>
									<div class="col-sm-4">
										<input type="text" id="nama" name="nama" value="<?php echo $row->nama;?>" class="col-xs-12" readonly />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-left"> Jenis Uji </label>
									<div class="col-sm-4">
										<input type="text" id="jenis_uji" name="jenis_uji" value="<?php echo $row->jenis_uji;?>" class="col-xs-12" readonly />
									</div>
									
									<label class="col-sm-2 control-label no-padding-left"> JBB </label>
									<div class="col-sm-4">
										<input type="text" id="jbb" name="jbb" value="<?php echo $row->jbb;?>" class="col-xs-12" readonly />
									</div>
								</div>
				
								<h5 class="header smaller lighter blue">BARANG</h5>
								<div class="form-group">
									<label class="col-sm-1 control-label no-padding-left"> Plat </label>
									<div class="col-sm-1">
										<select class="form-control" id="jml_plat" name="jml_plat">
											<option value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
										</select>
									</div>
									
									<label class="col-sm-1 control-label no-padding-left"> Buku </label>
									
									<div class="col-sm-1">
										<input type="text" id="kd_buku" name="kd_buku" value="<?php echo $kd_buku; ?>" class="col-xs-12"/>
									</div>
									
									<div class="col-sm-3">
										<input type="text" id="no_buku" name="no_buku" value="<?php foreach($dt_buku as $buk){ echo $buk->no_buku+1; }?>" class="col-xs-12"/>
									</div>
									
									<label class="col-sm-1 control-label no-padding-left"> Stiker </label>
									
									<div class="col-sm-1">
										<input type="text" id="kd_stiker" name="kd_stiker" value="<?php echo $kd_stiker;?>" class="col-xs-12"/>
									</div>
									
									<div class="col-sm-3">
										<input type="text" id="no_stiker" name="no_stiker" value="<?php foreach($dt_stiker as $stik){ echo $stik->no_stiker+1;}?>" class="col-xs-12"/>
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

						<button type="submit" class="btn btn-sm btn-success">
							<i class="ace-icon fa fa-check"></i>
							Kirim
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>	
