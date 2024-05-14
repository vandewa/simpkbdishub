<div class="page-content">
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h1>
					Edit Surat Numpang Uji Keluar
				</h1>
			</div>
		</div>
	</div>
	
	<?php 
	if(isset($dt_surat)){
		foreach($dt_surat as $row){
		?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('surat/proses_editnumpang?kd='.$row->kode_uji.'&nouji='.$row->no_uji.'&iduser='.$row->id_user)?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<h4 class="header smaller lighter blue no-padding">
			Data Kendaraan
		</h4>
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Uji </label>
					<div class="col-sm-8">
						<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji; ?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left">Nama Pemilik</label>
					<div class="col-sm-8">
						<input type="text" id="nama" name="nama" value="<?php echo $row->nama; ?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Alamat </label>
					<div class="col-sm-8">
						<textarea id="alamat" name="alamat" class="autosize-transition form-control" placeholder="Alamat"><?php echo $row->alamat;?></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kecamatan </label>
					<div class="col-sm-8">
						<input type="text" id="kecamatan" name="kecamatan" placeholder="Kecamatan" value="<?php echo $row->kecamatan;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kota </label>
					<div class="col-sm-8">
						<input type="text" id="kota" name="kota" placeholder="Kota" value="<?php echo $row->kota;?>" class="col-xs-12" />
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="bentuk" name="bentuk" placeholder="Bentuk" value="<?php echo $row->bentuk;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Merek </label>
					<div class="col-sm-8">
						<input type="text" id="merek" name="merek" placeholder="Merek" value="<?php echo $row->merek;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="tipe" name="tipe" placeholder="Tipe" value="<?php echo $row->tipe;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tahun Pembuatan </label>
					<div class="col-sm-8">
						<input type="text" id="tahun" name="tahun" value="<?php echo $row->tahun;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Rangka </label>
					<div class="col-sm-8">
						<input type="text" id="no_rangka" name="no_rangka" value="<?php echo $row->no_rangka;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Mesin </label>
					<div class="col-sm-8">
						<input type="text" id="no_mesin" name="no_mesin" value="<?php echo $row->no_mesin;?>" class="col-xs-12" />
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<h4 class="header smaller lighter blue no-padding">
				Dasar Mutasi
			</h4>	
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tanggal Surat </label>
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control date-picker" id="tgl_surat" name="tgl_surat" type="text" value="<?php echo $row->tgl_surat; ?>" data-date-format="yyyy-mm-dd" />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left bolder blue"> Nomor Surat </label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">551.2/</span>
							<input type="text" id="no_surat" name="no_surat" value="<?php echo $row->no_surat;?>" class="col-xs-12"/>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tujuan Numpang</label>
					<div class="col-sm-8">
						<input type="text" id="kota_dinas" name="kota_dinas" placeholder="Tujuan Numpang" value="<?php echo $row->tujuan_num;?>" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Kota</label>
					<div class="col-sm-8">
						<input type="text" id="kota_tujuan" name="kota_tujuan" placeholder="Kota Mutasi" value="<?php echo $row->kota_num;?>" class="col-xs-12" />
					</div>
				</div>		
			</div>
		</div>
		
		<?php 
			}
		} ?>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit" onclick="return confirm('Anda yakin data sudah benar?')">
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
</div>