<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pembayaran Retribusi
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('retribusi/cari')?>" method="post">
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
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
		<form action="<?php echo site_url('retribusi/rekap_tanggal')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-calendar blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input class="form-control date-picker" id="cari" name="cari" type="text" data-date-format="yyyy-mm-dd" placeholder="Rekap berdasar tanggal"/>
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
						<th class="center">Nama</th>
						<th class="center">Tanggal</th>
						<th class="center">Kode Billing</th>
						<th class="center">Retribusi</th>
						<th class="center">Status Bayar</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$no = $start+1;
				if(isset($dt_retribusi)){
					foreach($dt_retribusi as $row){
						if($row->status_bayar=="0"){ $tr="red";} else { $tr="";}
					?>
					<tr class="<?php echo $tr;?>">
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo strftime("%d %B %Y",strtotime($row->tgl_pembayaran));?></td>
						<td><?php echo $row->id_billing;?></td>
						<td>Rp <?php echo number_format($row->total_semua, 0, ".", ",");?></td>
						<td class="center">
							<?php if($row->status_bayar=="1"){ ?>
							<a class="btn btn-xs btn-success tooltip-info" data-rel="tooltip" title="Sudah Bayar">
								<i class="ace-icon fa fa-check bigger-120"></i>
							</a>
							<?php } else { ?>
							<a class="btn btn-xs btn-danger tooltip-info" data-rel="tooltip" title="Belum Bayar">
								<i class="ace-icon fa fa-close bigger-120"></i>
							</a>
							<?php } ?></td>
						<td>
							<?php if($row->status_bayar=="0"){ ?>
							<a href="#proses-retribusi-<?php echo $row->kode_uji;?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Proses pembayaran">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-check bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('retribusi/cetak/'.$row->kode_uji);?>" target="_blank" class="tooltip-warning" data-rel="tooltip" title="Cetak">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</button>
							</a>
							<?php } else { ?>
							<a href="<?php echo site_url('retribusi/cetaklunas/'.$row->kode_uji);?>" target="_blank" class="tooltip-error" data-rel="tooltip" title="Cetak Lunas">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</button>
							</a>
							<?php } ?>
						</td>
					</tr>
				<?php }} ?>	
				</tbody>
			</table>
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>

<?php foreach($dt_retribusi as $row){ ?>
<div id="proses-retribusi-<?php echo $row->kode_uji;?>" class="modal fade"  tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Proses Pembayaran Manual</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('retribusi/prosespembayaran/'.$row->kode_uji)?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Nomor Referensi</label>
								<div class="col-sm-9">
									<input type="text" id="noreff" name="noreff" value="<?php echo $row->noreff;?>" class="col-xs-12"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Tanggal Referensi</label>
								<div class="col-sm-9">
									<input type="text" id="tgl_reff" name="tgl_reff" value="<?php echo $row->tgl_reff;?>" class="col-xs-12"/>
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