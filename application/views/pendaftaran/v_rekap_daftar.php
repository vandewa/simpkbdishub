<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Pendaftaran Uji Kendaraan Bermotor
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('pendaftaran/cari')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Masukan Nomor Pengujian..." autofocus/>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Cari
					</button>
				</span>
			</div>
		</form>
		</div>
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
		<form action="<?php echo site_url('pendaftaran/rekap_tanggal')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-calendar blue"></i>
				</span>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input class="form-control date-picker" id="caritgl" name="caritgl" type="text" data-date-format="yyyy-mm-dd" placeholder="Rekap berdasar tanggal"/>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Pilih
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
						<th>No</th>
						<th>No Uji</th>
						<th>No Kendaraan</th>
						<th class="hidden-480">Jenis Kendaraan</th>
						<th class="hidden-480">Kode Uji</th>
						<th class="hidden-480">Kode Billing</th>
						<th class="hidden-480">No Antrian</th>
						<th class="hidden-480">Nama Pemohon</th>
						<th class="hidden-480">Jenis Uji</th>
						<th>Tanggal Daftar</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				$no = $start+1;
				if(isset($dt_pendaftaran)){
					foreach($dt_pendaftaran as $row){
						if($row->status_bayar=="0"){ $tr="red";} else { $tr="";}
					?>
					<tr class="<?php echo $tr;?>">
						<td><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td class="hidden-480"><?php echo $row->jenis_kendaraan;?> (<?php echo $row->bentuk;?>)</td>
						<td class="hidden-480"><?php echo $row->kode_uji;?></td>
						<td class="hidden-480"><?php echo $row->id_billing;?></td>
						<td class="hidden-480"><?php echo $row->no_antrian;?></td>
						<td class="hidden-480"><?php echo $row->nama_pemohon;?></td>
						<td class="hidden-480"><?php echo $row->jenis_uji;?></td>
						<td><?php echo strftime("%d %B %Y", strtotime($row->tgl_daftar_uji));?></td>
						<td>
							<?php if($row->jenis_uji=='Numpang Keluar') { ?> 
							<a href="<?php echo site_url('surat/numpangkeluar/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Buat Surat">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-envelope bigger-120"></i>
								</button>
							</a>
							<?php } else if($row->jenis_uji=='Mutasi Keluar') { ?>
							<a href="<?php echo site_url('surat/mutasikeluar/'.$row->kode_uji);?>" class="tooltip-info" data-rel="tooltip" title="Buat Surat">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-envelope bigger-120"></i>
								</button>
							</a>
							<?php } ?>

							<a href="<?php echo site_url('pendaftaran/edit/'.$row->kode_uji);?>" class="tooltip-success" data-rel="tooltip" title="Edit Pendaftaran">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('pendaftaran/cetak_antrian?id='.$row->kode_uji.'&no='.$row->no_uji);?>" target="_blank" class="tooltip-warning" data-rel="tooltip" title="Cetak Pendaftaran">
								<button class="btn btn-xs btn-primary">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</button>
							</a>
							
							<?php if($row->status_bayar=='1'){ ?>
							<a href="<?php echo site_url('pendaftaran/cetak_skrd?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak SKRD">
								<button class="btn btn-xs btn-primary">
									<i class="ace-icon fa fa-file bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('pendaftaran/cetak_lhp?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak LHP">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-money bigger-120"></i>
								</button>
							</a>
							<?php } else { ?>
							
							<a href="<?php echo site_url('pendaftaran/cetak_skrd?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak SKRD">
								<button class="btn btn-xs btn-primary">
									<i class="ace-icon fa fa-file bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('pendaftaran/cetak_lhp?id='.$row->kode_uji.'&no='.$row->no_uji);?>" class="tooltip-warning" data-rel="tooltip" title="Cetak LHP">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-money bigger-120"></i>
								</button>
							</a>
							
							<?php } ?>
							
							<a href="<?php echo site_url('pendaftaran/hapus/'.$row->kode_uji);?>" onclick="return confirm('Anda yakin Menghapus Data Pendaftaran?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Pendaftaran">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
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