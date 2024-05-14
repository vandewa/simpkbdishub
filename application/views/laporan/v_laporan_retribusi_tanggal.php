<div class="page-content">
	<div class="page-header">
		<h1>
			Laporan Retribusi Harian
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-7">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
		<form action="<?php echo site_url('laporan/rekap_retribusi_tanggal')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="input-group">
				<div class="input-daterange input-group">
					<input type="text" name="tgl_awal" data-date-format="yyyy-mm-dd" value="<?php echo $tgl_awal;?>" class="form-control date-picker" placeholder="Tanggal awal" />
					<span class="input-group-addon">
						<i class="fa fa-exchange"></i>
					</span>

					<input type="text" name="tgl_akhir" data-date-format="yyyy-mm-dd" value="<?php echo $tgl_akhir;?>" class="form-control date-picker"  placeholder="Tanggal akhir" />
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
		<form action="<?php echo site_url('laporan/export_retribusi')?>" method="post">
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
	
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 class="bolder center">
				REKAP RETRIBUSI PENGUJIAN KENDARAAN BERMOTOR
			</h3>
				<center><?php echo date("d M Y", strtotime($tgl_awal));?> - <?php echo date("d M Y", strtotime($tgl_akhir));?><center>
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
						<th class="center">Nama</th>
						<th class="center">No Uji</th>
						<th class="center">No Kend</th>
						<th class="center">Jenis Uji</th>
						<th class="center">Jenis Kend</th>
						<th class="center">Plat</th>
						<th class="center">Stiker</th>
						<th class="center">Buku</th>
						<th class="center">Retribusi</th>
						<th class="center">Total Retribusi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				$no=1;
				if(isset($laporan_retribusi)){
					foreach($laporan_retribusi as $row){
						$tanggal = $row->tgl_pembayaran;
						$bayar = date("d M Y", strtotime($tanggal));
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td class="center"><?php echo $bayar;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->jenis_uji;?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo $row->plat;?></td>
						<td><?php echo $row->stiker;?></td>
						<td><?php echo $row->buku;?></td>
						<td><?php echo $row->retribusi;?></td>
						<td><?php echo $row->total_retribusi;?></td>
					</tr>
					<?php }
				} 
				if(isset($total_retribusi)){
					foreach($total_retribusi as $row){
						?>
					<tr>
						<td colspan="6"></td>
						<td>TOTAL</td>
						<td><?php echo $row->jml_plat;?></td>
						<td><?php echo $row->jml_stiker;?></td>
						<td><?php echo $row->jml_buku;?></td>
						<td><?php echo $row->jml_retribusi;?></td>
						<td><?php echo $row->jml_total_retribusi;?></td>
					</tr>
					<?php }
				} ?>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">
							<i class="ace-icon fa fa-caret-right blue"></i> Jenis Kendaraan
						</th>

						<th class="hidden-480 text-center">
							<i class="ace-icon fa fa-caret-right blue"></i> Jenis Retribusi
						</th>
						
						<th class="hidden-480 text-center">
							<i class="ace-icon fa fa-caret-right blue"></i> Retribusi
						</th>
						
						<th class="hidden-480 text-center">
							<i class="ace-icon fa fa-caret-right blue"></i> Buku
						</th>

						<th class="hidden-480 text-center">
							<i class="ace-icon fa fa-caret-right blue"></i> Jumlah
						</th>
						
						<th class="text-center">
							<i class="ace-icon fa fa-caret-right blue"></i> Total Retribusi
						</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($dt_jenis_retribusi as $row){ ?>
					<tr>
						<td><?php echo $row->jenis_kendaraan;?></td>
						<td class="hidden-480"><?php echo $row->kategori;?></td>
						<td class="hidden-480"><?php echo $row->retribusi;?></td>
						<td class="hidden-480"><?php echo $row->buku;?></td>
						<td class="hidden-480 text-center">
							<?php if($row->jumlah=="0"){ ?>
							<b class="red"><?php echo $row->jumlah;?></b>
							<?php } else {  ?>
							<b class="green"><?php echo $row->jumlah;?></b>
							<?php } ?>
						</td>

						<td class="text-center">
							<?php if($row->total<"60000"){ ?>
							<b class="red"><?php echo $row->total;?></b>
							<?php } else {  ?>
							<b class="green"><?php echo $row->total;?></b>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>