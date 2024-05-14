<div class="page-content">
	<div class="page-header">
		<h1>
			Kendaraan tidak lulus/ Perbaikan
		</h1>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('uji/cariperbaikan')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." />
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
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="center">No Uji</th>
						<th class="center hidden-480">Kode Uji</th>
						<th class="center">No Kendaraan</th>
						<th class="center hidden-480">Nama Pemilik</th>
						<th class="center hidden-480">Tgl Uji</th>
						<th class="center hidden-480">Tgl Batas Perbaikan</th>
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
						<td class="hidden-480"><?php echo $row->kode_uji;?></td>
						<td><strong><?php echo $row->no_kendaraan;?></strong></td>
						<td class="hidden-480"><?php echo $row->pemilik;?></td>
						<td class="hidden-480"><?php echo strftime("%d %B %Y", strtotime($row->tgl_uji));?></td>
						<td class="hidden-480"><?php echo strftime("%d %B %Y", strtotime($row->tgl_batas_perbaikan));?></td>
						<td>
							<?php if($row->aktif=="3"){ ?>
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
							<?php } ?>
							
							<a href="<?php echo site_url('uji/proses_pengujian/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Input Pengujian">
								<button class="btn btn-xs btn-info">
									Uji ulang
								</button>
							</a>				
						</td>
					</tr>
				<?php }} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php foreach($dt_kendaraan as $row){ ?>
	<?php if($row->aktif=="3"){ ?>
	<div id="proses_sktl-<?php echo $row->kode_uji;?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Proses Surat Keterangan Tidak Lulus Uji</h4>
				</div>
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('uji/proses_sktl?id='.$row->kode_uji.'&no='.$row->no_uji);?>">
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