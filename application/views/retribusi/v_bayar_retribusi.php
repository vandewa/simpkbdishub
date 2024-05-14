<div class="page-content">
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Pembayaran Retribusi
				</h1>
			</div>
			<div class="col-xs-12 col-sm-4" align="right">
				<form action="<?php echo site_url('retribusi/bayar_retribusi')?>" method="post">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="ace-icon fa fa-search blue"></i>
						</span>
						
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." />
						<span class="input-group-btn">
							<button type="submit" class="btn btn-info btn-sm">
								<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
								OK
							</button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php 
	if(!empty($data_retribusi_kendaraan)){
		foreach($data_retribusi_kendaraan as $row){
		?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('retribusi/tambahretribusi')?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-10" align="right">
				<div class="form-group">
				</div>
			</div>
			<div class="col-xs-12 col-sm-2" align="right">
				<input type="text" id="tgl_retribusi" name="tgl_retribusi" value="<?php echo unix_to_human($now);?>" class="col-xs-12" readonly />
			</div>
		</div>
		
		<div class="space space-8"></div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> No Retribusi </label>
					<div class="col-sm-9">
						<input type="text" id="no_retribusi" name="no_retribusi" value="RT-<?php echo $now;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Nomor Kendaraan </label>
					<div class="col-sm-9">
						<input type="text" id="no_kendaraan_retribusi" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" readonly />
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Nomor Pengujian </label>
					<div class="col-sm-9">
						<input type="text" id="retribusi_no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Nama Pemilik </label>
					<div class="col-sm-9">
						<input type="text" id="retribusi_nama" name="nama" value="<?php echo $row->nama;?>" class="col-xs-12" readonly />
					</div>
				</div>	
			</div>
		</div>
		
		<h3 class="header smaller lighter blue"></h3>
		<div class="row">
			<div class="col-xs-12 col-sm-10">
			</div>
			<div class="col-xs-12 col-sm-2" align="right">
				<a href="#tambah-retribusi" data-toggle="modal">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-plus bigger-120 blue"></i>
						Tambah
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
							<th>No</th>
							<th>Jenis</th>
							<th>Retribusi</th>
							<th>Qty</th>
							<th>Sub Total</th>
						</tr>
					</thead>
					
					<tbody>
					<?php $i=1; $no=1;?>
					<?php foreach($this->cart->contents() as $items): ?>
						<?php echo form_hidden('rowid[]', $items['rowid']); ?>
						<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $items['name']; ?></td>
						<td><?php echo $items['qty']; ?></td>
						<td>Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
						<td>Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
						</tr>
						<?php $i++; $no++;?>
					<?php endforeach; ?>
					</tbody>
			</table>
			</div>
		</div>
		&nbsp;
		<div class="row">
			<div class="col-xs-12">
			
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left bolder blue"> Jumlah Retribusi Yang Harus Dibayar</label>
					<div class="col-sm-6">
						<div class="input-group">
							<span class="input-group-addon">
								Rp
							</span>
							<input type="text" id="jumlah_retribusi" name="jumlah_retribusi" value="" class="col-xs-12" readonly />
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left bolder blue"> Terbilang</label>
					<div class="col-sm-9">
						<input type="text" id="terbilang" name="terbilang" value="" class="col-xs-12" readonly />
					</div>
				</div>
			</div>
		</div>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Kirim
				</button>

				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</div>
	</form>
	<?php }
	} ?>
</div>

<div id="tambah-retribusi" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Retribusi</h4>
			</div>
			<form id="frm" name="frm" class="form-horizontal" role="form" method="post" action="<?php echo site_url('retribusi/tambah_retribusi_to_cart')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							
							<div class="form-group">
								<label class="col-xs-3 control-label no-padding-left"> Pilih Retribusi </label>
								<div class="col-xs-9">
									<select class="form-control" id="kd_tarif" name="kd_tarif" data-placeholder="Pilih jenis retribusi">
										<option value=""></option>
										<?php
										if(isset($data_tarif)){
											foreach($data_tarif as $row){
											?>
											<option value="<?php echo $row->kd_tarif;?>"><?php echo $row->sifat; ?> - <?php echo $row->jenis; ?></option>
											<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							
							<div id="detail_retribusi"></div>
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