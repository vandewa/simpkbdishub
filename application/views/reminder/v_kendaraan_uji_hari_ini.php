<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pengujian Kendaraan Hari Ini
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-8" align="right">
			<a href="<?php echo site_url('reminder/kirim_terimakasih')?>">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Kirim Notifikasi
				</button>
			</a>
		</div>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">Nomor Uji</th>
						<th class="center">Nomor Kendaraan</th>
						<th class="center">Nama Pemilik</th>
						<th class="center">Telepon</th>
						<th class="center">Jenis</th>
						<th class="center">Tanggal Uji</th>
					</tr>
				</thead>
				<?php
				$no=1;
				if(isset($data_pengujian)){
					foreach($data_pengujian as $row){
					?>
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->telp;?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo $row->tgl_uji;?></td>
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