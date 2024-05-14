&nbsp;
<?php  if(!empty($dt_kendaraan)){ ?>
	<?php foreach($dt_kendaraan as $row){ ?>
		<div class="row">
			<div class="col-xl-6">
				<div class="table-responsive">
					<table class="table datatable-perijinan table-bordered">
						<tr>
							<td class="font-weight-black">NOMOR UJI</td>
							<td><?php echo $row->no_uji;?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">NOMOR KENDARAAN</td>
							<td><?php echo $row->no_kendaraan;?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">JENIS</td>
							<td><?php echo $row->jenis;?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">TAHUN</td>
							<td><?php echo $row->tahun;?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">NAMA PEMILIK</td>
							<td><?php echo $row->nama_pemilik;?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">ALAMAT PEMILIK</td>
							<td><?php echo $row->alamat_pemilik;?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">TRAYEK</td>
							<td><?php echo $row->nama_trayek;?></td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="col-xl-6">
				<div class="table-responsive">
					<table class="table datatable-perijinan table-bordered">
						<tr>
							<td class="font-weight-black">NO SK TRAYEK</td>
							<td><?php echo $row->no_sktrayek;?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">TANGGAL SK TRAYEK</td>
							<td><?php echo date("d F Y",strtotime($row->tgl_sktrayek));?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">MASA BERLAKU SK TRAYEK</td>
							<td><?php echo date("d F Y",strtotime($row->tgl_mulaitrayek));?> - <?php echo date("d F Y",strtotime($row->tgl_hbstrayek));?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">NO KP/KJP</td>
							<td><?php echo $row->no_kp;?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">TANGGAL KP/KJP</td>
							<td><?php echo date("d F Y",strtotime($row->tgl_kp));?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">MASA BERLAKU KP/KJP</td>
							<td><?php echo date("d F Y",strtotime($row->tgl_mulaikp));?> - <?php echo date("d F Y",strtotime($row->tgl_hbskp));?></td>
						</tr>
						
						<tr>
							<td class="font-weight-black">MASA BERLAKU UJI</td>
							<td><a href="https://simpkbslawi.com/beranda/datauji/<?php echo $row->no_uji;?>" target="_blank"><button type="button" class="btn btn-primary">Cek Habis Uji</button></a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	<?php } ?>
<?php } else { ?>
<div class="alert alert-danger border-0 alert-dismissible">
	<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
	<span class="font-weight-semibold">Maaf!</span> data yang anda cari tidak ditemukan.
</div>
<?php } ?>