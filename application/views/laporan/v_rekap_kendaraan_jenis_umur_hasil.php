<div class="page-content">
	<div class="page-header">
		<h1>
			Rekap Kendaraan Berdasarkan Jenis Kendaraan dan Umur
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-3">
		<form action="<?php echo site_url('laporan/rekap_kendaraan_jenis_umur')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="col-sm-12">
				<select multiple="" id="jenis_kendaraan" name="jenis_kendaraan[]" class="select2" data-placeholder="Pilih jenis kendaraan...">
					<?php foreach($kendaraan as $row){ ?>
					<option value="<?php echo $row->jenis;?>"><?php echo $row->jenis;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-2">
			<select class="form-control" id="operasi" name="operasi">
				<option value="=" selected>=</option>
				<option value=">=">Kurang dari</option>
				<option value="<=">Lebih dari</option>
			</select>
		</div>
		
		<div class="col-xs-12 col-sm-1">
			<input type="text" name="umur" placeholder="Usia Kendaraan" class="col-xs-12"/>
		</div>
		
		<div class="col-xs-12 col-sm-1" align="right">
			<div class="input-group">				
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Pilih
					</button>
				</span>
			</div>
		</form>
		</div>
		
		<div class="col-xs-12 col-sm-1">
		<form action="<?php echo site_url('laporan/export_kendaraan_jenis_umur?jenis="'.$jenis_kendaraan.'"$operasi="'.$operasi_kendaraan.'"$umur="'.$umur_kendaraan.'"')?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="input-group">
				<div class="input-group">
					<input type="hidden" name="jenis_kendaraan[]" value="<?php echo $jenis_kendaraan;?>" />
					<input type="hidden" name="operasi" value="<?php echo $operasi_kendaraan;?>" />
					<input type="hidden" name="umur" value="<?php echo $umur_kendaraan;?>" />
				</div>
			
				<span class="input-group-btn">
					<button type="submit" class="btn btn-success btn-sm">
						<span class="ace-icon fa fa-file-excel-o icon-on-right bigger-110"></span>
						Export
					</button>
				</span>
			</div>
		</form>
		</div>
	</div>
	
	&nbsp;
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h4 class="bolder center">
				REKAP PENDAFTARAN BERDASARKAN JENIS KENDARAAN <?php echo str_replace("'","",$jenis_kendaraan);?> DAN UMUR KENDARAAN <?php if($operasi_kendaraan==">=") { echo "KURANG DARI "; } else if($operasi_kendaraan=="<="){ echo "LEBIH DARI "; } else { echo " "; } echo $umur_kendaraan;?> TAHUN
			</h4>
		</div>
	</div>
	&nbsp;
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center">No</th>
						<th class="center">No Uji</th>
						<th class="center">No Kendaraan</th>
						<th class="center">Jenis</th>
						<th class="center">Merk / Tipe</th>
						<th class="center">Tahun / Umur</th>
						<th class="center">Nama Pemilik</th>
						<th class="center">Alamat</th>
						<th class="center">Wilayah</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				$no=1;
				if(isset($rekap_kendaraan)){
					foreach($rekap_kendaraan as $row){
					?>
					<tr>
						<td class="center"><?php echo $no++;?></td>
						<td><?php echo $row->no_uji;?></td>
						<td><?php echo $row->no_kendaraan;?></td>
						<td><?php echo $row->jenis;?></td>
						<td><?php echo $row->merek;?> / <?php echo $row->tipe;?></td>
						<td><?php echo $row->tahun; ?> / <?php echo date("Y") - $row->tahun;?> Tahun</td>
						<td><?php echo $row->nama;?> </td>
						<td><?php echo $row->alamat;?> </td>
						<td><?php echo $row->kecamatan;?> </td>
					</tr>
					<?php }
				} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>