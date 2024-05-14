<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pendaftaran Per Periode
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-7">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
		<form action="<?php echo site_url('laporan/pendaftaran_periode')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="input-group">
				<div class="input-daterange input-group">
					<input type="text" name="tgl_awal" data-date-format="yyyy-mm-dd" value="<?php echo $tgl_awal;?>" class="form-control date-picker" placeholder="Tanggal awal" />
					<span class="input-group-addon">
						<i class="fa fa-exchange"></i>
					</span>

					<input type="text" name="tgl_akhir" data-date-format="yyyy-mm-dd" value="<?php echo $tgl_akhir;?>" class="form-control date-picker" placeholder="Tanggal akhir" />
				</div>
				
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Pilih
					</button>
				</span>
			</div>
		</form>
		</div>

		<div class="col-xs-12 col-sm-1">
		<form action="<?php echo site_url('laporan/export_pendaftaran_periode')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="input-group">
				<div class="input-group">
					<input type="hidden" name="tgl_awal" value="<?php echo $tgl_awal;?>" />
					<input type="hidden" name="tgl_akhir" value="<?php echo $tgl_akhir;?>" />
				</div>
			
				<span class="input-group-btn">
					<button type="submit" class="btn btn-success btn-sm">
						<span class="ace-icon fa fa-file-excel-o icon-on-right bigger-110"></span>
						Export
					</button>
				</span>
			</div>
		</form>
		</div>
	</div>
	
	&nbsp;
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h4 class="bolder center">
				REKAP PENDAFTARAN PER PERIODE
			</h4>
				<center><?php echo date("d M Y",strtotime($tgl_awal));?> - <?php echo date("d M Y", strtotime($tgl_akhir));?><center>
		</div>
	</div>
	&nbsp;
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">Tanggal</th>
						<th class="center">No Uji</th>
						<th class="center">No Kendaraan</th>
						<th class="center">Jenis Kendaraan</th>
						<th class="center">Jenis Uji</th>
						<th class="center">Pemohon</th>
						<th class="center">Alamat Pemohon</th>
						<th class="center">Telp</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				$no=1;
				if(isset($laporan_pendaftaran)){
					foreach($laporan_pendaftaran as $row){
						$tanggal = $row->tgl_daftar_uji;
						$daftar = date("d M Y", strtotime($tanggal));
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td class="center"><?php echo $daftar;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo $row->jenis_uji;?></td>
						<td><?php echo $row->nama_pemohon;?></td>
						<td><?php echo $row->alamat_pemohon;?> </td>
						<td><?php echo $row->telp;?> </td>
					</tr>
					<?php }
				} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>