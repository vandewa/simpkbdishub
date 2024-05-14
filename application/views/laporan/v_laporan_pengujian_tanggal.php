<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Uji Kendaraan
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-2">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
		<form action="<?php echo site_url('laporan/rekap_pengujian_tanggal')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="input-group">
				<div class="input-daterange input-group">
					<input type="text" name="tgl_awal" data-date-format="yyyy-mm-dd" value="<?php echo $tgl_awal;?>" class="form-control date-picker" />
					<span class="input-group-addon">
						<i class="fa fa-exchange"></i>
					</span>

					<input type="text" name="tgl_akhir" data-date-format="yyyy-mm-dd" value="<?php echo $tgl_akhir;?>" class="form-control date-picker" />
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
		<form action="<?php echo site_url('laporan/cetak_pengujian_tanggal')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="input-group">
				<div class="input-group">
					<input type="hidden" name="tgl_awal" value="<?php echo $tgl_awal;?>" />
					<input type="hidden" name="tgl_akhir" value="<?php echo $tgl_akhir;?>" />
				</div>
			
				<span class="input-group-btn">
					<button type="submit" class="btn btn-warning btn-sm">
						<span class="ace-icon fa fa-print icon-on-right bigger-110"></span>
						Cetak
					</button>
				</span>
			</div>
		</form>
		</div>
		
		<div class="col-xs-12 col-sm-1">
		<form action="<?php echo site_url('laporan/export_pengujian')?>" method="post">
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
	&nbsp
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="bolder center">
				REKAP PENGUJIAN KENDARAAN BERMOTOR
			</h3>
				<center><?php echo $tgl_awal;?> - <?php echo $tgl_akhir;?><center>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">Tanggal</th>
						<th class="center">No Uji</th>
						<th class="center">No Kend</th>
						<th class="center">Jenis</th>
						<th class="center">Jenis Uji</th>
						<th class="center">Nama</th>
						<th class="center">Hasil Uji</th>
						<th class="center">Penguji</th>
						<th class="center">Habis Uji</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				$no=1;
				if(isset($dt_pengujian)){
					foreach($dt_pengujian as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td class="center"><?php echo date("d M Y",strtotime($row->tgl_daftar_uji));?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo $row->jenis_uji;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->hasil;?></td>
						<td><?php echo $row->penguji;?></td>
						<td class="center"><?php echo date("d M Y",strtotime($row->tgl_habis_uji));?></td>
					</tr>
					<?php }} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>