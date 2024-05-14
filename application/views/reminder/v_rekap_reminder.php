<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Notifikasi Pengingat
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">Nomor Uji</th>
						<th class="center">Tanggal Notif</th>
						<th class="center">Nama Penerima</th>
						<th class="center">Nomor HP</th>
					</tr>
				</thead>
				<?php
				$no=1;
				if(isset($data_reminder)){
					foreach($data_reminder as $row){
					?>
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->tgl_notif;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->telp;?></td>
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