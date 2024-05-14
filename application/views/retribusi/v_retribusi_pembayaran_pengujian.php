<div class="page-content">
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Pembayaran Retribusi
				</h1>
			</div>
			<div class="col-xs-12 col-sm-4" align="right">
				<form action="<?php echo site_url('retribusi/pembayaranretribusi')?>" method="post">
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
			
			<div class="col-xs-12 col-sm-6">
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Jenis Retribusi </label>
					<div class="col-sm-9">
						<select class="chosen-select form-control" id="form-field-select-3" name="retribusi_jenis" data-placeholder="Pilih jenis retribusi">
							<option value=""></option>
							<?php
							if(isset($data_tarif)){
								foreach($data_tarif as $row){
								?>
								<option value="<?php echo $row->tarif;?>"><?php echo $row->sifat; ?> - <?php echo $row->jenis; ?></option>
								<?php
								}
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Plat Tanda Uji </label>
					<div class="col-sm-9">
						<select class="chosen-select form-control" id="plat_uji" name="plat_uji" data-placeholder="Pilih retribusi plat tanda uji">
							<option value=""></option>
							<?php
							if(isset($tarif_plat)){
								foreach($tarif_plat as $row){
								?>
								<option value="<?php echo $row->tarif;?>"><?php echo $row->jenis; ?> - <?php echo $row->sifat; ?></option>
								<?php
								}
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Buku Uji </label>
					<div class="col-sm-9">
						<select class="chosen-select form-control" id="buku_uji" name="buku_uji" data-placeholder="Pilih retribusi buku uji">
							<option value=""></option>
							<?php
							if(isset($tarif_buku)){
								foreach($tarif_buku as $row){
								?>
								<option value="<?php echo $row->tarif;?>"><?php echo $row->jenis; ?> - <?php echo $row->sifat; ?></option>
								<?php
								}
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Stiker </label>
					<div class="col-sm-9">
						<select class="chosen-select form-control" id="stiker_uji" name="stiker_uji" data-placeholder="Pilih retribusi stiker">
							<option value=""></option>
							<?php
							if(isset($tarif_stiker)){
								foreach($tarif_stiker as $row){
								?>
								<option value="<?php echo $row->tarif;?>"><?php echo $row->jenis; ?> - <?php echo $row->sifat; ?></option>
								<?php
								}
							}
							?>
						</select>
					</div>
				</div>
				
			</div>
		</div>
		
		<h3 class="header smaller lighter blue"></h3>
		
		<div class="row">
			<div class="col-xs-12 col-sm-4">	
				<div>
					<label class="control-label">RETRIBUSI PKB </label>
					<div class="input-group">
						<span class="input-group-addon">
							Rp
						</span>
						<input id="tarif_retribusi" name="tarif_retribusi" class="col-xs-12" type="text" value="0" readonly />
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2">
				<div>
					<label class="control-label">PLAT TANDA UJI </label>
					<div class="input-group">
						<span class="input-group-addon">
							Rp
						</span>
						<input class="col-xs-12" type="text" id="retribusi_plat_uji" name="retribusi_plat_uji" value="0" readonly />
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2">
				<div>
					<label class="control-label">BUKU UJI </label>
					<div class="input-group">
						<span class="input-group-addon">
							Rp
						</span>
						<input class="col-xs-12" id="retribusi_buku_uji"  name="retribusi_buku_uji" value="0" type="text" readonly />
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2">
				<div>
					<label class="control-label">STIKER </label>
					<div class="input-group">
						<span class="input-group-addon">
							Rp
						</span>
						<input class="col-xs-12" id="retribusi_stiker_uji" value="0" name="retribusi_stiker_uji" type="text" readonly />
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2">
				<div>
					<label class="control-label">DENDA </label>
					<div class="input-group">
						<span class="input-group-addon">
							Rp
						</span>
						<input class="col-xs-12" value="0" id="retribusi_denda" name="retribusi_denda" type="text" />
					</div>
				</div>
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