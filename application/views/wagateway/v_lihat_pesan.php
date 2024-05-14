<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12">
				<h1>
					
				</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">WhatsApp Gateway - Rekap Pesan - <?php echo $phone;?></h5>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<table id="simple-table" class="table table-striped table-bordered table-hover">
									<thead class="thin-border-bottom">
										<tr>
											<th>No</th>
											<th>Pesan</th>
											<th>Tanggal</th>
											<th>Jenis Pesan</th>
										</tr>
									</thead>
									<?php
									$no = 1;
									if(isset($dt_pesan)){
										foreach($dt_pesan as $row){
										?>
									<tbody>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $row->message ;?></td>
											<td><?php echo date("d-m-Y H:i:s",strtotime($row->tgl_pesan));?></td>
											<td><?php echo $row->jeniswa ;?></td>
										</tr>
									</tbody>
									<?php 
									}
								} ?>	
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>