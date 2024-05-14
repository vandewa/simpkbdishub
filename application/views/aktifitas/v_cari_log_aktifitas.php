<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Log Aktifitas
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-6">
			<form action="<?php echo site_url('aktifitas/cari')?>" method="post">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="input-group">
					<select class="form-control" placeholder="Pilih kategori" name="kategori" >
						<option value="aktifitas">Pilih Kategori</option>
						<option value="aktifitas">No Uji</option>
						<option value="nama">Nama</option>
						<option value="modul">Modul</option>
						<option value="aktifitas">Aktifitas</option>
					</select>
					<span class="input-group-addon">
						<i class="ace-icon fa fa-search blue"></i>
					</span>
					<input type="text" class="form-control search-query" id="cari" name="cari" autofocus />
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
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">Nama</th>
						<th class="center">Modul</th>
						<th class="center">Aktifitas</th>
						<th class="center">Tanggal</th>
					</tr>
				</thead>
				<?php
				if(isset($cari_aktifitas)){
					foreach($cari_aktifitas as $row){
					?>
				<tbody>
					<tr>
						<td class="center"><?php echo $row->id_log;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->modul;?></td>
						<td><?php echo $row->aktifitas;?></td>
						<td><?php echo date("d M Y H:i:s",strtotime($row->tanggal));?></td>
					</tr>
				</tbody>
				<?php 
				}
			} ?>	
			</table>
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>