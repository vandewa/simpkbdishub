<div class="page-content">
	<div class="page-header">
		<h1>
			WhatsApp Gateway - Cronjob
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th>No</th>
						<th>Cronjob</th>
						<th class="hidden-480">Tanggal</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php
				$no = $start+1;
				if(isset($dt_cronlog)){
					foreach($dt_cronlog as $row){
					?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->cron;?></td>
						<td class="hidden-480"><?php echo date("d-m-Y H:i:s",strtotime($row->tanggal));?></td>
						<td>
							<a href="<?php echo site_url('wagateway/hapuscronlog/'.$row->id_cronlog);?>" onclick="return confirm('Anda yakin menghapus log?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Log">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
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