<div class="page-content">
	<div class="page-header">
		<h1>
			WhatsApp Gateway - Pesan Masuk
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('wagateway/cari_inbox')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Cari pesan keluar..." autofocus/>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Cari
					</button>
				</span>
			</div>
		</form>
		</div>
		<div class="col-xs-12 col-sm-48">
		</div>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th>No</th>
						<th>No WhatsApp</th>
						<th>No Uji</th>
						<th>Nama</th>
						<th class="hidden-480">Pesan</th>
						<th class="hidden-480">Tanggal</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php
				$no = $start+1;
				if(isset($dt_pesan)){
					foreach($dt_pesan as $row){
					?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->phone;?></td>
						<td></td>
						<td><?php echo $row->pushName ;?></td>
						<td class="hidden-480"><?php echo $row->message ;?></td>
						<td class="hidden-480"><?php echo date("d-m-Y H:i:s",strtotime($row->tgl_pesan));?></td>
						<td>
							<a href="<?php echo site_url('wagateway/lihatpesan/'.$row->phone);?>" class="tooltip-primary" data-rel="tooltip" title="Lihat Pesan">
								<button class="btn btn-xs btn-primary">
									<i class="ace-icon fa fa-search bigger-120"></i>
								</button>
							</a>
						</td>
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