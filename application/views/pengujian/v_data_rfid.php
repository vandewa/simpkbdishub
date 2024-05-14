<div class="page-content">
	<div class="page-header">
		<h1>
			<?php echo $title;?>
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('uji/caridatarfid')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." required autofocus />
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
		<div class="col-xs-12 col-sm-4">
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th>Nomor Uji</th>
						<th class="hidden-480">Nomor Kendaraan</th>
						<th class="hidden-480">Tanggal Uji</th>
						<th class="hidden-480">Nama Pemilik</th>
						<th class="hidden-480">No Kendali Kartu</th>
						<th class="hidden-480">No RFID</th>
						<th class="hidden-480">Cetak Kartu</th>
						<th class="hidden-480">Cetak Sertifikat</th>
						<th class="hidden-480">Status Sinkron</th>
						<th class="center">Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = $start+1;
				if(isset($data_rfid)){
					foreach($data_rfid as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><strong><?php echo $row->nouji;?></strong></td>
						<td class="hidden-480"><?php echo $row->noregistrasikendaraan;?></td>
						<td class="hidden-480"><strong><?php echo $row->tgluji;?></strong></td>
						<td class="hidden-480"><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo $row->nokendalikartu;?></td>
						<td class="hidden-480"><?php echo $row->rfid;?></td>
						<td class="center">
							<?php if($row->datetimepersovisual!=""){?>
							<a class="btn btn-xs btn-success tooltip-info" data-rel="tooltip" title="Sudah Cetak Kartu">
								<i class="ace-icon fa fa-check bigger-120"></i>
							</a>
							<?php } else { ?>
							<a class="btn btn-xs btn-danger tooltip-info" data-rel="tooltip" title="Belum Cetak Kartu">
								<i class="ace-icon fa fa-close bigger-120"></i>
							</a>
							<?php } ?>
						</td>
						<td class="center">
							<?php if($row->datetimecetaksertifikat!=""){?>
							<a class="btn btn-xs btn-success tooltip-info" data-rel="tooltip" title="Sudah Cetak Sertifikat">
								<i class="ace-icon fa fa-check bigger-120"></i>
							</a>
							<?php } else { ?>
							<a class="btn btn-xs btn-danger tooltip-info" data-rel="tooltip" title="Belum Cetak Sertifikat">
								<i class="ace-icon fa fa-close bigger-120"></i>
							</a>
							<?php } ?>
						</td>
						<td class="center">
							<?php if($row->datetimeupload!=""){?>
							<a class="btn btn-xs btn-success tooltip-info" data-rel="tooltip" title="Sudah Sinkronasi">
								<i class="ace-icon fa fa-check bigger-120"></i>
							</a>
							<?php } else { ?>
							<a class="btn btn-xs btn-danger tooltip-info" data-rel="tooltip" title="Belum Sinkronasi">
								<i class="ace-icon fa fa-close bigger-120"></i>
							</a>
							<?php } ?>
						</td>
						<td>						
							<a href="<?php echo site_url('uji/hapusdatarfid?id='.$row->idx.'&nouji='.$row->nouji);?>" onclick="return confirm('Anda yakin menghapus data perso?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Perso">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash bigger-120"></i>
								</button>
							</a>
						</td>
					</tr>
				<?php }} ?>
				</tbody>
			</table>
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>