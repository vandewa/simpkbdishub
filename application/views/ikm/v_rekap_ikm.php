<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Rekap Survei IKM
				</h1>
			</div>
			
			<div class="col-xs-12 col-sm-4" align="right">
				<form action="<?php echo site_url('ikm/export_rekap')?>" method="post" id="search-form">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<div class="input-group">
						<div class="input-daterange input-group">
							<input type="text" name="tgl_awal" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal awal" />
							<span class="input-group-addon">
								<i class="fa fa-exchange"></i>
							</span>

							<input type="text" name="tgl_akhir" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal akhir" />
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
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="center">Tanggal</th>
						<th class="center">Usia</th>
						<th class="center">Jenis Kelamin</th>
						<th class="center">Pendidikan</th>
						<th class="center">Pekerjaan</th>
						<th class="center">Nilai</th>
						<th class="center">Saran</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$no = $start+1;
				if(isset($dt_ikm)){
					foreach($dt_ikm as $row){
					?>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo strftime("%d %b %Y %H:%M:%S", strtotime($row->tgl_ikm));?></td>
						<td><?php echo $row->usia;?></td>
						<td><?php echo $row->jenis_kelamin;?></td>
						<td><?php echo $row->pendidikan;?></td>
						<td><?php echo $row->pekerjaan;?></td>
						<td><?php echo round(($row->kesesuaian+$row->kemudahan+$row->kecepatan+$row->sistem+$row->kompetensi+$row->kesopanan+$row->sarana)/7,2);?></td>
						<td><?php echo $row->saran;?></td>
					</tr>
				<?php }} ?>
				</tbody>
			</table>
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>