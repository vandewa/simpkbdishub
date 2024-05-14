<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Uji Kendaraan
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
		<form action="<?php echo site_url('laporan/rekap__kendaraan_tanggal')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-calendar blue"></i>
				</span>

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
				<thead class="thin-border-bottom">
					<tr>
						<th rowspan="2" class="center">M.Baru</th>
						<th rowspan="2" class="center">NUM</th>
						<th rowspan="2" class="center">NUK</th>
						<th rowspan="2" class="center">MM</th>
						<th rowspan="2" class="center">MK</th>
						<th rowspan="2" class="center">M.PNM</th>
						<th colspan="2" class="center">JBB 0-4000kg</th>
						<th colspan="2" class="center">JBB 4001-8000kg</th>
						<th colspan="2" class="center">JBB 8001-14000kg</th>
						<th colspan="4" class="center">JBB 14000kg Ke atas</th>
					</tr>
					<tr>
						<th class="center">M.BUS</th>
						<th class="center">M.BARANG</th>
						<th class="center">M.BUS</th>
						<th class="center">M.BARANG</th>
						<th class="center">M.BUS</th>
						<th class="center">M.BARANG</th>
						<th class="center">M.BUS</th>
						<th class="center">M.BARANG</th>
						<th class="center">GANDENG</th>
						<th class="center">TEMPELAN</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
					<?php 
					foreach($m_baru as $row){
						?>
						<td class="center"><?php echo $row->no_kendaraan;?></td>
					<?php } ?>
					<?php 
					foreach($m_num as $row){
						?>
						<td class="center"><?php echo $row->no_kendaraan;?></td>
					<?php } ?>
					<?php 
					foreach($m_nuk as $row){
						?>
						<td class="center"><?php echo $row->no_kendaraan;?></td>
					<?php } ?>
					<?php 
					foreach($m_mm as $row){
						?>
						<td class="center"><?php echo $row->no_kendaraan;?></td>
					<?php } ?>
					<?php 
					foreach($m_mk as $row){
						?>
						<td class="center"><?php echo $row->no_kendaraan;?></td>
					<?php } ?>
					<?php 
					foreach($m_pnm as $row){
						?>
						<td class="center"><?php echo $row->no_kendaraan;?></td>
					<?php } ?>
					<?php 
					foreach($m_mbus4 as $row){
						?>
						<td class="center"><?php echo $row->no_kendaraan;?></td>
					<?php } ?>
						
					<?php 
					foreach($m_mtruck4 as $row){
						?>
						<td class="center"><?php echo $row->no_kendaraan;?></td>
					<?php } ?>
					</tr>
				</tbody>
			</table>
			<?php // echo $this->pagination->create_links();?>
		</div>
	</div>
</div>