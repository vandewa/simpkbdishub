<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Pengesahan Hasil Uji
				</h1>
			</div>
			<?php if($this->session->userdata('id_akses') == '1'){ ?>
			<div class="col-xs-12 col-sm-4" align="right">
				<a href="<?php echo site_url('uji/pengesahanadmin');?>" class="tooltip-success" data-rel="tooltip" title="Tampil Semua Kendaraan">
					<button class="btn btn-sm btn-info">
						<i class="ace-icon fa fa-check-square-o align-top bigger-125"></i>
						Pengesahan Administrator
					</button>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="center">No Uji</th>
						<th class="center hidden-480">Kode Uji</th>
						<th class="center">No Kendaraan</th>
						<th class="center">No Antrian</th>
						<th class="center hidden-480">Nama Pemilik</th>
						<th class="center hidden-480">Tanggal Pengujian</th>
						<?php if($this->session->userdata('id_akses') == '1'){ ?>
						<th class="center hidden-480">Penguji</th>
						<?php } ?>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$no=1;
				if(isset($data_pengesahan)){
					foreach($data_pengesahan as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><strong><?php echo $row->no_uji;?></strong></td>
						<td class="hidden-480"><?php echo $row->kode_uji;?></td>
						<td><strong><?php echo $row->no_kendaraan;?></strong></td>
						<td class="center"><strong><?php echo $row->no_antrian;?></strong></td>
						<td class="hidden-480"><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo strftime("%d %B %Y", strtotime($row->tgl_uji));?></td>
						<?php if($this->session->userdata('id_akses') == '1'){ ?>
						<td class="hidden-480"><?php echo $row->penguji;?></td>
						<?php } ?>
						<td>
							<a href="<?php echo site_url('uji/proses_pengesahan/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Input Pengujian">
								<button class="btn btn-xs btn-info">
									Proses Pengesahan
								</button>
							</a>				
						</td>
					</tr>
				<?php }} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>