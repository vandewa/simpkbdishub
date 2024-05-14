<div class="row">
	<div class="col-xs-12 col-sm-10">
		<h4>
			Laporan KBWU Disahkan Pertama Kali Tanggal <?php echo date("d M Y", strtotime($tgl_awal));?> - <?php echo date("d M Y", strtotime($tgl_akhir));?>
		</h4>
	</div>
	
	<div class="col-xs-12 col-sm-2" align="right">
		<a href="<?php echo site_url('laporan/exportpengujian_ujipertama?awal='.$tgl_awal.'&akhir='.$tgl_akhir);?>">
			<button type="submit" class="btn btn-success btn-sm">
				<span class="ace-icon fa fa-file-excel-o icon-on-right bigger-110"></span>
				Export Laporan
			</button>
		</a>
	</div>
</div>
&nbsp;

<div class="row">
	<div class="col-xs-12">
		<table id="simple-table" class="table table-striped table-bordered table-hover">
			<thead class="thin-border-bottom">
				<tr>
					<th class="center">No</th>
					<th class="center">Jenis Kendaraan<br/>Bentuk</th>
					<th class="center">Merk/Tipe</th>
					<th class="center">Tahun</th>
					<th class="center">No Uji<br/>No Kendaraan</th>
					<th class="center">No Rangka<br/>No Mesin</th>
					<th class="center">Nama<br/>Alamat</th>
					<th class="center">Nomor SRUT</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
			$no=1;
			if(isset($laporan_ujipertama)){
				foreach($laporan_ujipertama as $row){
				?>
				<tr>
					<td class="center"><?php echo $no++;?></td>
					<td><?php echo $row->jenis;?><br/><?php echo $row->bentuk;?></td>
					<td><?php echo $row->merek;?><br/><?php echo $row->tipe;?></td>
					<td><?php echo $row->tahun;?></td>
					<td><?php echo $row->no_uji;?><br/><?php echo $row->no_kendaraan;?></td>
					<td><?php echo $row->no_rangka;?><br/><?php echo $row->no_mesin;?></td>
					<td><?php echo $row->nama;?><br/><?php echo $row->alamat;?></td>
					<td><?php echo $row->no_sertifikasi_uji;?></td>
				</tr>
				<?php }
			}?>
			</tbody>
		</table>
	</div>
</div>