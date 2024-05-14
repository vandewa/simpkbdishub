<div class="page-content">
	<div class="page-header">
		<h1>
			Daftar Pemilik Kendaraan
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-4">
		<form action="<?php echo site_url('kendaraan/caripemilik')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" class="form-control search-query" id="cari" name="cari" placeholder="Masukan Nama / Nomor Uji..." required=""/>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Cari
					</button>
				</span>
			</div>
		</form>
		</div>
		<div class="col-xs-12 col-sm-8" align="right">
			<a href="<?php echo site_url('kendaraan/tambahpemilik')?>">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Tambah Pemilik
				</button>
			</a>
		</div>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">No</th>
						<th class="hidden-480">No KTP</th>
						<th>Nama</th>
						<th class="hidden-480">Alamat</th>
						<th class="hidden-480">Telepon</th>
						<th>No Uji</th>
						<th>No Kendaraan</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				
				<?php 
				$no = $start+1;
				if(isset($dt_pemilik)){
					foreach($dt_pemilik as $row){
					?>

				<tbody>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td class="hidden-480"><?php echo $row->no_ktp;?></td>
						<td><?php echo $row->nama;?></td>
						<td class="hidden-480"><?php echo $row->alamat;?></td>
						<td class="hidden-480"><?php echo $row->telp;?></td>
						<td><b><?php echo $row->no_uji;?></b></td>
						<td><b><?php echo $row->no_kendaraan;?></b></td>
						<td><b><?php if($row->aktif=="1"){ echo "AKTIF"; } else { echo "TIDAK AKTIF"; };?></b></td>
						<td>
							<a href="<?php echo site_url('kendaraan/detail/'.$row->no_uji);?>" class="tooltip-info" data-rel="tooltip" title="Lihat">
								<button class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-search bigger-120"></i>
								</button>
							</a>
							
							<a href="<?php echo site_url('kendaraan/editpemilik/'.$row->id_user);?>" class="tooltip-success" data-rel="tooltip" title="Edit">
								<button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</button>
							</a>
							<?php if($row->aktif=="1"){ ?>
							<a href="<?php echo site_url('kendaraan/hapuspemilik/'.$row->id_user);?>" onclick="return confirm('Anda yakin Menghapus Data Pemilik Kendaraan?')" class="tooltip-error" data-rel="tooltip" title="Hapus">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</button>
							</a>
							<?php } else { ?>
							<a href="<?php echo site_url('kendaraan/batalhapuspemilik/'.$row->no_uji);?>" onclick="return confirm('Anda yakin mengaktifkan pemilik kembali?')" class="tooltip-success" data-rel="tooltip" title="Aktifkan pemilik">
								<button class="btn btn-xs btn-warning">
									<i class="ace-icon fa fa-unlock bigger-120"></i>
								</button>
							</a>
							<?php } ?>
						</td>
					</tr>
				</tbody>
				<?php 
				}
			} ?>	
			</table>
		<?php echo $this->pagination->create_links();?>
		<?php if(isset($jml_pemilik)){ ?>
		<h4 class="pull-right">
			Jumlah Pemilik :
			<span class="red"><?php echo $jml_pemilik;?></span>
		</h4>
		<?php } ?>
		</div><!-- /.span -->
	</div><!-- /.row -->
</div>