<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Penggunaan Barang
		</h1>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="center">Tanggal</th>
						<th class="center">Buku</th>
						<th class="center">Stiker</th>
						<th class="center">Plat</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no = $start+1;
				if(isset($dt_rekap)){
					foreach($dt_rekap as $row){
					?>
					
				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td class="center"><?php echo strftime("%d %B %Y", strtotime($row->tgl_daftar_uji));?></td>
						<td class="center"><?php echo $row->buku;?></td>
						<td class="center"><?php echo $row->stiker;?></td>
						<td class="center"><?php echo $row->plat;?></td>
						<td class="center">
							<a href="<?php echo site_url('barang/lihatrekap/'.$row->tgl_daftar_uji);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
								<button class="btn btn-xs btn-success">
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