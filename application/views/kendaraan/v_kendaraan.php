<div class="page-content">
	<?php 
		$admin = $this->session->userdata('id_akses') == '1';
		$petugas = $this->session->userdata('id_akses') == '2';
		$penguji = $this->session->userdata('id_akses') == '3';
		$pengguna = $this->session->userdata('id_akses') == '4';
	?>
	
	<div class="page-header">
		<h1>
			Daftar Kendaraan
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-6">
		<form action="<?php echo site_url('kendaraan/cari')?>" method="post">
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
		<!--
		<div class="col-xs-12 col-sm-8" align="right">
			<a href="<?php echo site_url('kendaraan/tambah')?>">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Kendaraan
				</button>
			</a>
		</div>
		-->
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
						<th class="hidden-480">Jenis / Bentuk</th>
						<th class="hidden-480">Pemilik</th>
						<th class="hidden-480">Masa Berlaku</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php 
				$no = $start+1;
				if(isset($dt_kendaraan)){
					foreach($dt_kendaraan as $row){
				?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><b><?php echo $row->no_kendaraan;?></b></td>
						<td><b><?php echo $row->no_uji;?></b></td>
						<td class="hidden-480"><?php echo $row->merek;?></td>
						<td class="hidden-480"><?php echo $row->jenis_kendaraan;?> / <?php echo $row->bentuk;?></td>
						<td class="hidden-480"><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php if($row->tgl_habis_uji=="") { echo strftime("%d %B %Y", strtotime($row->temp_tgl_habis_uji)); } else { echo strftime("%d %B %Y", strtotime($row->tgl_habis_uji)); } ;?></td>
						<td>
							<a href="<?php echo site_url('kendaraan/lihatkendaraan/'.$row->no_uji);?>" target="_blank" class="tooltip-info" data-rel="tooltip" title="Lihat">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-search bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('kendaraan/cetak_kartu_induk/'.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Kartu Induk">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</button>
							</a>
							
							<?php if($row->aktif=="1"){ ?>
							<?php if(($row->status=="0")||($row->status=="1")){ ?>
							<?php if($admin || $petugas){ ?>
							<a href="<?php echo site_url('kendaraan/edit/'.$row->no_uji);?>" class="tooltip-success" data-rel="tooltip" title="Edit">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							<!--
							<a href="<?php echo site_url('kendaraan/cetak_kartu_induk_baru/'.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak Kartu Induk">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</button>
							</a>
							-->
							
							<a href="#blokir_kendaraan<?php echo $row->no_uji;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Blokir Kendaraan">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-ban bigger-120"></i>
								</button>
							</a>
							
							
							<a href="<?php echo site_url('kendaraan/hapuskendaraan/'.$row->no_uji);?>" onclick="return confirm('Anda yakin Menghapus Data Seluruh Kendaraan?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</button>
							</a>
							<?php }} ?>
							<?php if($row->status=="1"){ ?>
							<span class="label label-lg label-info arrowed-in arrowed-in-right">NUMPANG</span>
							<?php } else if($row->status=="2"){ ?>
							<span class="label label-lg label-warning arrowed-in arrowed-in-right">DIBLOKIR</span>
							<?php } else if($row->status=="3"){ ?>
							<span class="label label-lg label-danger arrowed-in arrowed-in-right">MUTASI</span>
							<?php } ?>
							
							<?php } if($row->aktif=="0"){ ?>
							<span class="label label-lg label-danger arrowed-in arrowed-in-right">HAPUS</span>
							<?php } ?>
						</td>
					</tr>
				</tbody>
					<?php 
					}
				} ?>
			</table>
			<?php echo $this->pagination->create_links();?>
			<?php if(isset($jml_kendaraan)){ ?>
			<h4 class="pull-right">
				Jumlah Kendaraan :
				<span class="red"><?php  echo $jml_kendaraan;?></span>
			</h4>
			<?php } ?>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>

<?php 
	if(isset($dt_kendaraan)){
		foreach($dt_kendaraan as $row){
	?>
		<div id="blokir_kendaraan<?php echo $row->no_uji;?>" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Blokir Kendaraan</h4>
					</div>
					<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('kendaraan/blokir_kendaraan/'.$row->no_uji);?>">
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12">
									
									<div class="form-group">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										
										<label class="col-sm-2 control-label no-padding-left"> Nomor Uji </label>
										<div class="col-sm-4">
											<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
										</div>
										
										<label class="col-sm-2 control-label no-padding-left"> Tgl Blokir </label>
										<div class="col-sm-4">
											<input type="text" id="tgl_blokir" name="tgl_blokir" value="<?php echo date("Y-m-d");?>" class="col-xs-12" readonly />
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> Keterangan</label>
										<div class="col-sm-10">
											<textarea id="ket_blokir" name="ket_blokir" class="autosize-transition form-control" placeholder="Keterangan kendaraan diblokir" required="" ></textarea>
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

							<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin akan memblokir kendaran ini?')">
								<i class="ace-icon fa fa-check"></i>
								Blokir
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php }
	}
?>