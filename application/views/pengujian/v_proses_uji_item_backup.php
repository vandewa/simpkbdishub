<div class="page-content">
	
	<?php 
	foreach($proses_uji_kendaraan as $row){
		$kode_uji = $row->kode_uji;
		$no_uji = $row->no_uji;
		$bahan_bakar = $row->bahan_bakar;
	?>

		<div class="page-header">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<h1>
						Input Hasil Pengujian
					</h1>
				</div>
			</div>
		</div>
	<form class="form-horizontal" role="form">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<input type="hidden" id="kode_uji" name="kode_uji" value="<?php echo $row->kode_uji;?>" />
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Pengujian </label>
					<div class="col-sm-8">
						<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Nomor Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>"  class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="jenis" name="jenis" class="col-xs-12" value="<?php echo $row->jenis_kendaraan;?> / <?php echo $row->bentuk;?>"  readonly />
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Merk dan Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="merktipe" name="merktipe" class="col-xs-12" value="<?php echo $row->merek;?> / <?php echo $row->tipe;?>" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Tahun </label>
					<div class="col-sm-8">
						<input type="text" id="tahun" name="tahun" class="col-xs-12" value="<?php echo $row->tahun;?>" readonly />
					</div>
				</div>
				
				<input type="hidden" id="bahan_bakar" name="bahan_bakar" class="col-xs-12" value="<?php echo $row->bahan_bakar;?>"  readonly />
			</div>
		</div>
	</form>
	
	<?php if($catatan>0){ ?>
	<h3 class="header smaller lighter red">CATATAN KERUSAKAN</h3>
	
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-striped table-bordered table-hover">					
					<tbody>
					<?php $no=1; foreach($dt_catatan as $ctt){ ?>
						<tr class="red">
							<td class="center"><?php echo $no++;?></td>
							<td><?php echo $ctt->catatan;?></td>
							<td>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php } ?>
		
	<form class="form-horizontal" role="form" action="<?php echo site_url('uji/proses_uji_item?kode='.$kode_uji.'&no='.$no_uji.'&uji='.$jenis_uji.'&sts='.$status);?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		
		<?php if($jenis_uji=="prauji"){ ?>
		<h3 class="header smaller lighter blue">PRAUJI</h3>
		
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">PERALATAN</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label class="col-sm-6 control-label">No Chasis</label>
								<div class="col-sm-5">
									<input name="no_chasiss" type="radio" value="1" checked> ADA &nbsp;&nbsp;
									<input name="no_chasis" type="radio" value="0"> TIDAK
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-6 control-label">Plat Pabrik Pembuat</label>
								<div class="col-sm-5">
									<input name="plat_pabrik_pembuat" type="radio" value="1" checked> ADA &nbsp;&nbsp;
									<input name="plat_pabrik_pembuat" type="radio" value="0"> TIDAK
								</div>
							</div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Plat Nomor</label>
								<div class="col-sm-5">
								  <input name="plat_nomor" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="plat_nomor" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Tulisan</label>
								<div class="col-sm-5">
								  <input name="tulisan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="tulisan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Penghapus Kaca Depan</label>
								<div class="col-sm-5">
								  <input name="penghapus_kaca_depan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="penghapus_kaca_depan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Klakson</label>
								<div class="col-sm-5">
								  <input name="klakson" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="klakson" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Kaca Spion</label>
								<div class="col-sm-5">
								  <input name="kaca_spion" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kaca_spion" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Pandangan Kedepan</label>
								<div class="col-sm-5">
								  <input name="pandangan_kedepan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="pandangan_kedepan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Kaca Penahan Sinar</label>
								<div class="col-sm-5">
								  <input name="kaca_penahan_sinar" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kaca_penahan_sinar" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Alat Alat Pengendalian</label>
								<div class="col-sm-5">
								  <input name="alat_alat_pengendalian" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="alat_alat_pengendalian" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Indikasi</label>
								<div class="col-sm-5">
								  <input name="lampu_indikasi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_indikasi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Speedometer</label>
								<div class="col-sm-5">
								  <input name="spedometer" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="spedometer" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Perlengkapan</label>
								<div class="col-sm-5">
								  <input name="perlengkapan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="perlengkapan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">PERALATAN</label>
								<div class="col-sm-5">
								  <input name="peralatan" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
								  <input name="peralatan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 col-xs-6">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">SISTEM PENERANGAN</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label class="col-sm-6 control-label">Lampu Jauh</label>
								<div class="col-sm-5">
								  <input name="lampu_jauh" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_jauh" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Tambahan Lampu</label>
								<div class="col-sm-5">
								  <input name="tambahan_lampu" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="tambahan_lampu" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Dekat</label>
								<div class="col-sm-5">
								  <input name="lampu_dekat" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_dekat" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Arah Lampu</label>
								<div class="col-sm-5">
								  <input name="arah_lampu" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="arah_lampu" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Kabut</label>
								<div class="col-sm-5">
								  <input name="lampu_kabut" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_kabut" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Posisi</label>
								<div class="col-sm-5">
								  <input name="lampu_posisi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_posisi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Belakang</label>
								<div class="col-sm-5">
								  <input name="lampu_belakang" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_belakang" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Rem</label>
								<div class="col-sm-5">
								  <input name="lampu_rem" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_rem" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Plat Nomor</label>
								<div class="col-sm-5">
								  <input name="lampu_plat_nomor" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_plat_nomor" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Mundur</label>
								<div class="col-sm-5">
								  <input name="lampu_mundur" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_mundur" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Kabut Belakang</label>
								<div class="col-sm-5">
								  <input name="lampu_kabut_belakang" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_kabut_belakang" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Arah Peringatan</label>
								<div class="col-sm-5">
								  <input name="lampu_arah_peringatan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_arah_peringatan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Reflektor Merah</label>
								<div class="col-sm-5">
								  <input name="reflektor_merah" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="reflektor_merah" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Lampu Tambahan Lainnya</label>
								<div class="col-sm-5">
								  <input name="lampu_tambahan_lainnya" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="lampu_tambahan_lainnya" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">SISTEM PENERANGAN</label>
								<div class="col-sm-5">
								  <input name="sistem_penerangan" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
								  <input name="sistem_penerangan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-xs-6">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">BAN & PELEK</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label class="col-sm-6 control-label">Ukuran dan Jenis Ban</label>
								<div class="col-sm-5">
								  <input name="ukuran_dan_jenis_ban" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="ukuran_dan_jenis_ban" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Keadaan Ban</label>
								<div class="col-sm-5">
								  <input name="ke1an_ban" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="ke1an_ban" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Keadaan Kembang Ban</label>
								<div class="col-sm-5">
								  <input name="kedalaman_kembang_ban" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kedalaman_kembang_ban" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Ukuran dan Jenis Pelek</label>
								<div class="col-sm-5">
								  <input name="ukuran_dan_jenis_pelek" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="ukuran_dan_jenis_pelek" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Keadaan Pelek</label>
								<div class="col-sm-5">
								  <input name="ke1an_pelek" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="ke1an_pelek" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Penguaran Ban/Pelek</label>
								<div class="col-sm-5">
								  <input name="penguatan_ban_pelek" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="penguatan_ban_pelek" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">BAN DAN PELEK</label>
								<div class="col-sm-5">
								  <input name="ban_dan_pelek" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
								  <input name="ban_dan_pelek" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>	
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 col-xs-6">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">RANGKA & BODY</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label class="col-sm-6 control-label">Rangka Penumpang</label>
								<div class="col-sm-5">
								  <input name="rangka_penompang" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="rangka_penompang" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Bamper</label>
								<div class="col-sm-5">
								  <input name="bamper" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="bamper" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Tempat Roda Cadangan</label>
								<div class="col-sm-5">
								  <input name="tempat_roda_c1ngan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="tempat_roda_c1ngan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Keadaan Body</label>
								<div class="col-sm-5">
								  <input name="ke1an_body" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="ke1an_body" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Kondisi Body</label>
								<div class="col-sm-5">
								  <input name="kondisi_body" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kondisi_body" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Ruang Kemudi</label>
								<div class="col-sm-5">
								  <input name="ruang_kemudi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="ruang_kemudi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Tempat Duduk/Berdiri</label>
								<div class="col-sm-5">
								  <input name="tempat_duduk_berdiri" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="tempat_duduk_berdiri" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Sam. Krt Gandengan</label>
								<div class="col-sm-5">
								  <input name="sam_krt_gandengan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sam_krt_gandengan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">RANGKA DAN BODY</label>
								<div class="col-sm-5">
								  <input name="rangka_dan_body" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
								  <input name="rangka_dan_body" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller lighter blue">PEMERIKSAAN KESESUAIAN KENDARAAN</h3>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Nomor Rangka </label>
					<div class="col-sm-9">
						<input type="text" id="no_rangka" name="no_rangka" placeholder="Nomor Rangka Landasan" value="<?php echo $row->no_rangka;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Nomor Mesin </label>
					<div class="col-sm-9">
						<input type="text" id="no_mesin" name="no_mesin" placeholder="Nomor Mesin" value="<?php echo $row->no_mesin;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Bentuk </label>
					<div class="col-sm-9">
						<input type="text" id="bentuk" name="bentuk" placeholder="Bentuk Kendaraan" value="<?php echo $row->bentuk;?>" class="col-xs-12" readonly />
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left"> Panjang </label>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" placeholder="Panjang Ukuran Utama" value="<?php echo $row->uk_panjang;?>" class="col-xs-12" readonly />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" id="uk_panjang" name="uk_panjang" placeholder="Panjang Ukuran Utama" value="<?php echo $row->uk_panjang;?>" class="col-xs-12" />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left"> Lebar </label>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" placeholder="Lebar Ukuran Utama" value="<?php echo $row->uk_lebar;?>" class="col-xs-12" readonly />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" id="uk_lebar" name="uk_lebar" placeholder="Lebar Ukuran Utama" value="<?php echo $row->uk_lebar;?>" class="col-xs-12" />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left"> Tinggi </label>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" placeholder="Tinggi Ukuran Utama" value="<?php echo $row->uk_tinggi;?>" class="col-xs-12" readonly />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" id="uk_tinggi" name="uk_tinggi" placeholder="Tinggi Ukuran Utama" value="<?php echo $row->uk_tinggi;?>" class="col-xs-12" />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left"> Julur Belakang </label>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" placeholder="Julur Belakang" value="<?php echo $row->uk_roh;?>" class="col-xs-12" readonly />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" id="uk_roh" name="uk_roh" placeholder="Julur Belakang" value="<?php echo $row->uk_roh;?>" class="col-xs-12"/>
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left"> Julur Depan </label>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" placeholder="Julur Depan" value="<?php echo $row->uk_foh;?>" class="col-xs-12" readonly />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" id="uk_foh" name="uk_foh" placeholder="Julur Depan" value="<?php echo $row->uk_foh;?>" class="col-xs-12" />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left"> Sumbu I-II </label>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" placeholder="Jarak Sumbu I-II" value="<?php echo $row->js_sumbu1;?>" class="col-xs-12" readonly />
							<span class="input-group-addon">mm</span>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<input type="text" id="js_sumbu1" name="js_sumbu1" placeholder="Jarak Sumbu I-II" value="<?php echo $row->js_sumbu1;?>" class="col-xs-12"/>
							<span class="input-group-addon">mm</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller lighter blue">ALUR BAN</h3>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group" id="alur">
					<label class="col-xs-3 control-label no-padding-left text-right"> ALUR BAN </label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="alur_ban" name="alur_ban" placeholder="Alur ban" class="col-xs-12" value="<?php echo $row->alur_ban;?>"/>
							<span class="input-group-addon">mm</span>
						</div>
						<span class="help-block">Min : 1 mm</span>
					</div>
					<div id="cek_alur"></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group" id="alur">
					<label class="col-xs-3 control-label no-padding-left text-right"> UKURAN BAN </label>
					<div class="col-xs-7">
						<input type="text" placeholder="Ukuran ban" class="col-xs-12" value="<?php echo $row->ban_sumbu1;?>" readonly />
					</div>
				</div>
			</div>
		</div>
		
		<?php } else if($jenis_uji=="emisi"){ ?>
		<h3 class="header smaller lighter blue">EMISI</h3>
		<div class="row">
			<?php 
				if($bahan_bakar=="SOLAR"){
					$rasap = "";
					$rco = "readonly";
					$rhc = "readonly";
				} else { 
					$rasap = "readonly";
					$rco = "";
					$rhc = "";
				} ?>
			<div class="col-sm-6">
				<div class="form-group" id="as">
					<label class="col-xs-2 control-label no-padding-left text-right"> ASAP </label>
					<div class="col-xs-8">
						<div class="input-group">
							<input type="tel" id="asap" name="asap" placeholder="Asap Kendaraan" class="col-xs-12" value="<?php echo $row->asap;?>" <?php echo $rasap;?>/>
							<span class="input-group-addon">%</span>
						</div>
						<span class="help-block">Tahun <= 2010 : max 70%, > 2010 : max 40%</span>
					</div>
					<div id="cek_asap"></div>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group" id="co">
					<label class="col-xs-2 control-label no-padding-left text-right"> CO </label>
					<div class="col-xs-8">
						<div class="input-group">
							<input type="tel" id="asap_co" name="asap_co" placeholder="CO Asap Kendaraan" class="col-xs-12" value="<?php echo $row->asap_co;?>" <?php echo $rco;?>/>
							<span class="input-group-addon">%</span>
						</div>
						<span class="help-block">Tahun <= 2007 : max 4.5%, > 2007 : max 1.5%</span>
					</div>
					<div id="cek_co"></div>
				</div>
				<div class="form-group" id="hc">
					<label class="col-xs-2 control-label no-padding-left text-right"> HC </label>
					<div class="col-xs-8">
						<div class="input-group">
							<input type="tel" id="asap_hc" name="asap_hc" placeholder="HC Asap Kendaraan" class="col-xs-12" value="<?php echo $row->asap_hc;?>" <?php echo $rhc;?>/>
							<span class="input-group-addon">ppm</span>
						</div>
						<span class="help-block">Tahun <= 2007 max 1200 ppm, > 2007 : max 200 ppm</span>
					</div>
					<div id="cek_hc"></div>
				</div>
			</div>
		</div>
		
		<?php } else if($jenis_uji=="bawah"){?>
		
		<h3 class="header smaller lighter blue">PEMERIKSAAN BAGIAN BAWAH KENDARAAN</h3>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Sistem Kemudi </label>
					<div class="col-sm-9">
						<input type="text" id="no_rangka" name="no_rangka" placeholder="Sistem kemudi" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> As dan Supensi </label>
					<div class="col-sm-9">
						<input type="text" id="no_mesin" name="no_mesin" placeholder="As dan Supensi" class="col-xs-12" />
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Rangka dan Bodi </label>
					<div class="col-sm-9">
						<input type="text" id="bentuk" name="bentuk" placeholder="Rangka dan Bodi" class="col-xs-12" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Sistem Rem </label>
					<div class="col-sm-9">
						<input type="text" id="bentuk" name="bentuk" placeholder="Sistem Rem" class="col-xs-12" />
					</div>
				</div>
			</div>
		</div>
			
		<?php } else if($jenis_uji=="sound"){?>
		
		<h3 class="header smaller lighter blue">KEBISINGAN & KACA</h3>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group" id="tint">
					<label class="col-xs-3 control-label no-padding-left text-right"> KACA </label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="tint_meter" name="tint_meter" placeholder="Tembus kaca" class="col-xs-12" value="<?php echo $row->tint_meter;?>"/>
							<span class="input-group-addon">%</span>
						</div>
						<span class="help-block">Min : 70%</span>
					</div>
					<div id="cek_tint"></div>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group" id="sound">
					<label class="col-xs-3 control-label no-padding-left text-right"> KEBISINGAN </label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="sound_level" name="sound_level" placeholder="Kebisingan suara" class="col-xs-12" value="<?php echo $row->sound_level;?>"/>
							<span class="input-group-addon">db</span>
						</div>
						<span class="help-block">Min : 83 db, Max : 118 db</span>
					</div>
					<div id="cek_sound"></div>
				</div>
			</div>
		</div>
		
		<?php } else if($jenis_uji=="lampu"){?>
		
		<h3 class="header smaller lighter blue">LAMPU</h3>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group" id="daya_kiri">
					<label class="col-xs-3 control-label no-padding-left text-right"> 	DAYA LAMPU KIRI </label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="lampu_kiri" name="lampu_kiri" placeholder="Lampu Kiri" class="col-xs-12" value="<?php echo $row->lampu_kiri;?>"/>
							<span class="input-group-addon">cd</span>
						</div>
						<span class="help-block">Min : 12.000 cd</span>
					</div>
					<div id="cek_daya_kiri"></div>
				</div>
				<div class="form-group" id="derajat_kiri">
					<label class="col-xs-3 control-label no-padding-left text-right"> 	DERAJAT LAMPU KIRI </label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="derajat_lampu_kiri" name="derajat_lampu_kiri" placeholder="Derajat Kiri" class="col-xs-12" value="<?php echo $row->derajat_lampu_kiri;?>"/>
							<span class="input-group-addon">&deg;</span>
						</div>
						<span class="help-block">Max : 1.09&deg; </span>
					</div>
					<div id="cek_derajat_kiri"></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group" id="daya_kanan">
					<label class="col-xs-3 control-label no-padding-left text-right"> DAYA LAMPU KANAN </label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="lampu_kanan" name="lampu_kanan" placeholder="Lampu Kanan" class="col-xs-12" value="<?php echo $row->lampu_kanan;?>"/>
							<span class="input-group-addon">cd</span>
						</div>
						<span class="help-block">Min : 12.000 cd</span>
					</div>
					<div id="cek_daya_kanan"></div>
				</div>
				<div class="form-group" id="derajat_kanan">
					<label class="col-xs-3 control-label no-padding-left text-right"> 	DERAJAT LAMPU KANAN </label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="derajat_lampu_kanan" name="derajat_lampu_kanan" placeholder="Derajat Kanan" class="col-xs-12" value="<?php echo $row->derajat_lampu_kanan;?>" />
							<span class="input-group-addon">&deg;</span>
						</div>
						<span class="help-block">Max : 0.34&deg; </span>
					</div>
					<div id="cek_derajat_kanan"></div>
				</div>
			</div>
		</div>
		
		<?php } else if($jenis_uji=="berat"){?>
		
		<h3 class="header smaller lighter blue">BERAT KENDARAAN</h3>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left text-right"> TOTAL S1 </label>
					<div class="col-xs-8">
						<div class="input-group">
							<input type="tel" id="axel_total_s1" name="axel_total_s1" value="<?php if($row->ax_total_s1=="0"){ echo $row->bk_sumbu1; } else { echo $row->ax_total_s1;}?>" placeholder="Total Sumbu 1" class="col-xs-12" />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left text-right"> TOTAL S2 </label>
					<div class="col-xs-8">
						<div class="input-group">
							<input type="tel" id="axel_total_s2" name="axel_total_s2" value="<?php if($row->ax_total_s2=="0"){ echo $row->bk_sumbu2; } else { echo $row->ax_total_s2;}?>" placeholder="Total Sumbu 2" class="col-xs-12" />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left text-right"> TOTAL S3 </label>
					<div class="col-xs-8">
						<div class="input-group">
							<input type="tel" id="axel_total_s3" name="axel_total_s3" value="<?php if($row->ax_total_s3=="0"){ echo $row->bk_sumbu3; } else { echo $row->ax_total_s3;}?>" placeholder="Total Sumbu 3" class="col-xs-12" />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left text-right"> TOTAL S4 </label>
					<div class="col-xs-8">
						<div class="input-group">
							<input type="tel" id="axel_total_s4" name="axel_total_s4" value="<?php if($row->ax_total_s4=="0"){ echo $row->bk_sumbu4; } else { echo $row->ax_total_s4;}?>" placeholder="Total Sumbu 4" class="col-xs-12" />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-3 control-label no-padding-left text-right"> BERAT TOTAL </label>
					<div class="col-xs-8">
						<div class="input-group">
							<input type="tel" id="axel_total" name="axel_total" value="<?php echo $row->bk_total;?>" placeholder="Berat Kosong Total" class="col-xs-12" />
							<span class="input-group-addon">kg</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller lighter blue">KINCUP RODA </h3>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group" id="in">
					<label class="col-xs-3 control-label no-padding-left text-right"> SIDE SLIP</label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="side_slip_in" name="side_slip_in" placeholder="Side Slip In" class="col-xs-12" value="<?php echo $row->side_slip_in;?>"/>
							<span class="input-group-addon">mm</span>
						</div>
						<span class="help-block">Max : 5 mm</span>
					</div>
					<div id="cek_in"></div>
				</div>
			</div>
		</div>
		
		<?php } else if($jenis_uji=="kecepatan"){?>
		
		<input type="hidden" id="axel_total_s1" name="axel_total_s1" class="col-xs-12" value="<?php if($row->ax_total_s1=="0"){ echo $row->bk_sumbu1; } else { echo $row->ax_total_s1;}?>"  readonly />
		<input type="hidden" id="axel_total_s2" name="axel_total_s2" class="col-xs-12" value="<?php if($row->ax_total_s2=="0"){ echo $row->bk_sumbu2; } else { echo $row->ax_total_s2;}?>"  readonly />
		<input type="hidden" id="axel_total_s3" name="axel_total_s3" class="col-xs-12" value="<?php if($row->ax_total_s3=="0"){ echo $row->bk_sumbu3; } else { echo $row->ax_total_s3;}?>"  readonly />
		<input type="hidden" id="axel_total_s4" name="axel_total_s4" class="col-xs-12" value="<?php if($row->ax_total_s4=="0"){ echo $row->bk_sumbu4; } else { echo $row->ax_total_s4;}?>"  readonly />

		<h3 class="header smaller lighter blue">REM</h3>
		
		<div class="row">
			<div class="col-lg-9">
				<?php if($row->bk_sumbu1!="0") { ?>
				<div class="form-group text-center">
					<h6 class="col-xs-4 header blue">RODA KIRI</h6>
					<h6 class="col-xs-4 header blue">RODA KANAN</h6>
					<h6 class="col-xs-4 header blue">PENYIMPANGAN SUMBU</h6>
				</div>
				
				<div class="form-group" id="br_ps1">
					<label class="col-sm-2 control-label no-padding-left text-right"> S1 KIRI </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kiri_s1" name="brake_kiri_s1" placeholder="Rem Sumbu1 Kiri" class="col-xs-12" value="<?php echo $row->br_kiri_s1;?>"/>
					</div>
					
					<label class="col-sm-2 control-label no-padding-left text-right"> S1 KANAN </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kanan_s1" name="brake_kanan_s1" placeholder="Rem Sumbu1 Kanan" class="col-xs-12" value="<?php echo $row->br_kanan_s1;?>"/>
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> PS1 </label>
					<div class="col-sm-1">
						<input type="tel" id="ps1" name="ps1" placeholder="PS1" class="col-xs-12" readonly />
					</div>
					<div id="cek_ps1"></div>
				</div>
				<?php } ?>
				
				<?php if($row->bk_sumbu2!="0") { ?>
				<div class="form-group" id="br_ps2">
					<label class="col-sm-2 control-label no-padding-left text-right"> S2 KIRI </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kiri_s2" name="brake_kiri_s2" placeholder="Rem Sumbu2 Kiri" class="col-xs-12" value="<?php echo $row->br_kiri_s2;?>"/>
					</div>
					
					<label class="col-sm-2 control-label no-padding-left text-right"> S2 KANAN </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kanan_s2" name="brake_kanan_s2" placeholder="Rem Sumbu2 Kanan" class="col-xs-12" value="<?php echo $row->br_kanan_s2;?>"/>
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> PS2 </label>
					<div class="col-sm-1">
						<input type="tel" id="ps2" name="ps2" placeholder="PS2" class="col-xs-12" readonly />
					</div>
					<div id="cek_ps2"></div>
				</div>
				<?php } ?>
				
				<?php if($row->bk_sumbu3!="0") { ?>
				<div class="form-group" id="br_ps3">
					<label class="col-sm-2 control-label no-padding-left text-right"> S3 KIRI </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kiri_s3" name="brake_kiri_s3" placeholder="Rem Sumbu3 Kiri" class="col-xs-12" value="<?php echo $row->br_kiri_s3;?>"/>
					</div>
					
					<label class="col-sm-2 control-label no-padding-left text-right"> S3 KANAN </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kanan_s3" name="brake_kanan_s3" placeholder="Rem Sumbu3 Kanan" class="col-xs-12" value="<?php echo $row->br_kanan_s3;?>"/>
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> PS3 </label>
					<div class="col-sm-1">
						<input type="tel" id="ps3" name="ps3" placeholder="PS3" class="col-xs-12" readonly />
					</div>
					<div id="cek_ps3"></div>
				</div>
				<?php } else { ?>
				
				<input type="hidden" id="brake_kiri_s3" name="brake_kiri_s3" placeholder="Rem Sumbu3 Kiri" class="col-xs-12" value="<?php echo $row->br_kiri_s3;?>"/>
				<input type="hidden" id="brake_kanan_s3" name="brake_kanan_s3" placeholder="Rem Sumbu3 Kanan" class="col-xs-12" value="<?php echo $row->br_kanan_s3;?>"/>
				
				<?php } if($row->bk_sumbu4!="0") { ?>
				<div class="form-group" id="br_ps4">
					<label class="col-sm-2 control-label no-padding-left text-right"> S4 KIRI </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kiri_s4" name="brake_kiri_s4" placeholder="Rem Sumbu4 Kiri" class="col-xs-12" value="<?php echo $row->br_kiri_s4;?>"/>
					</div>
					
					<label class="col-sm-2 control-label no-padding-left text-right"> S4 KANAN </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kanan_s4" name="brake_kanan_s4" placeholder="Rem Sumbu4 Kanan" class="col-xs-12" value="<?php echo $row->br_kanan_s4;?>"/>
					</div>
					
					<label class="col-sm-1 control-label no-padding-left"> PS4 </label>
					<div class="col-sm-1">
						<input type="tel" id="ps4" name="ps4" placeholder="PS4" class="col-xs-12" readonly />
					</div>
					<div id="cek_ps4"></div>
				</div>
				<?php } else { ?>
				
				<input type="hidden" id="brake_kiri_s4" name="brake_kiri_s4" placeholder="Rem Sumbu4 Kiri" class="col-xs-12" value="<?php echo $row->br_kiri_s4;?>"/>
				<input type="hidden" id="brake_kanan_s4" name="brake_kanan_s4" placeholder="Rem Sumbu4 Kanan" class="col-xs-12" value="<?php echo $row->br_kanan_s4;?>"/>
				
				<?php } ?>
			</div>
			<div class="col-lg-3">
				<div class="form-group text-center">
					<h6 class="col-xs-12 header blue">HASIL REM</h6>
				</div>
				
				<div class="form-group" id="remu">
					<label class="col-sm-2 control-label no-padding-left"> BEF </label>
					<div class="col-sm-8">
						<input type="text" id="rem_utama" name="rem_utama" placeholder="BEF" class="col-xs-12" readonly />
						<span class="help-block">Rem utama min 50%<br/>Penyimpangan sumbu max 8%</span>
					</div>
					<div id="cek_remu"></div>
					
				</div>
				
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-9">
				<div class="form-group" id="parkir">
					<label class="col-sm-2 control-label no-padding-left text-right"> PARKIR KIRI </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kiri_parkir" name="brake_kiri_parkir" placeholder="Rem Parkir Kiri" class="col-xs-12" value="<?php echo $row->br_tangan_kiri;?>"/>
					</div>
					
					<label class="col-sm-2 control-label no-padding-left text-right"> PARKIR KANAN </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kanan_parkir" name="brake_kanan_parkir" placeholder="Rem Parkir Kanan" class="col-xs-12" value="<?php echo $row->br_tangan_kanan?>"/>
					</div>
					<label class="col-sm-1 control-label no-padding-left"> PS  </label>
					<div class="col-sm-1">
						<input type="tel" id="psp" name="psp" placeholder="PSP" class="col-xs-12" readonly />
					</div>
					
					<div id="cek_psp"></div>
				</div>
				
				<input type="hidden" id="brake_kaki_kiri" name="brake_kaki_kiri" placeholder="Rem Parkir Kaki Kiri" class="col-xs-12" value="<?php echo $row->br_kaki_kiri;?>"/>
				<input type="hidden" id="brake_kaki_kanan" name="brake_kaki_kanan" placeholder="Rem Parkir Kaki Kanan" class="col-xs-12" value="<?php echo $row->br_kaki_kanan;?>"/>
				
				<!--
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-left"> KAKI KIRI </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kaki_kiri" name="brake_kaki_kiri" placeholder="Rem Parkir Kaki Kiri" class="col-xs-12" value="<?php echo $row->br_kaki_kiri;?>"/>
					</div>
					
					<label class="col-sm-2 control-label no-padding-left"> KAKI KANAN </label>
					<div class="col-sm-2">
						<input type="tel" id="brake_kaki_kanan" name="brake_kaki_kanan" placeholder="Rem Parkir Kaki Kanan" class="col-xs-12" value="<?php echo $row->br_kaki_kanan;?>"/>
					</div>
					<label class="col-sm-1 control-label no-padding-left"> PS </label>
					<div class="col-sm-1">
						<input type="tel" id="psk" name="psk" placeholder="PSK" class="col-xs-12" readonly />
					</div>
					<div id="cek_psk"></div>
				</div>
				-->
				
			</div>
			<div class="col-lg-3">
				<div class="form-group" id="remu_parkir">
					<label class="col-sm-2 control-label no-padding-left"> PEF </label>
					<div class="col-sm-8">
						<input type="text" id="rem_parkir" name="rem_parkir" placeholder="PEF" class="col-xs-12" readonly />
						<span class="help-block">Barang min 12%<br/>Penumpang min 16%</span>
					</div>
					<div id="cek_parkir"></div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller lighter blue">KECEPATAN</h3>
		
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group" id="kec">
					<label class="col-xs-3 control-label no-padding-left"> Kecepatan </label>
					<div class="col-xs-7">
						<div class="input-group">
							<input type="tel" id="kecepatan" name="kecepatan" placeholder="Kecepatan Kendaraan" class="col-xs-12" value="<?php echo $row->speedometer;?>"/>
							<span class="input-group-addon">kpj</span>
						</div>
						<span class="help-block">Min 36 kpj, max 46 kpj</span>
					</div>
					<div id="cek_kecepatan"></div>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<h3 class="header smaller lighter blue">Catatan</h3>
		
		<div id="formcatatan">
			<div class="form-group">
				<label class="col-xs-1 control-label no-padding-left"> Catatan </label>
				<div class="col-xs-10">
					<input type="text" id="catatan" name="catatan[]" placeholder="catatan kerusakan kendaraan" class="col-xs-12"/>
				</div>
				<div class="col-xs-1">
					<a href="javascript:void(0);" class="add_catatan" title="Tambah catatan">
						<i class="ace-icon fa fa-plus bigger-120"></i>
					</a>
				</div>
			</div>
		</div>
		
		<div class="clearfix form-actions">
			<div class="col-lg-offset-4 col-lg-12 col-sm-offset-4 col-sm-12 col-xs-offset-2 col-xs-12">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Kirim
				</button>

				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</div>
	</form>
	<?php } ?>
</div>

<script>
	$(document).ready(function(){
		var maxField = 100; //Input fields increment limitation
		var addButton = $('.add_catatan'); //Add button selector
		var wrapper = $('#formcatatan'); //Input field wrapper
		var fieldHTML = '<div class="form-group"><label class="col-xs-1 control-label no-padding-left"> Catatan </label><div class="col-xs-10"><input type="text" id="catatan" name="catatan[]" placeholder="catatan kerusakan kendaraan" class="col-xs-12"/></div><div class="col-xs-1"><a href="javascript:void(0);" class="hapus_catatan" title="Hapus catatan"><i class="ace-icon fa fa-times bigger-120"></i></a></div></div>'; //New input field html 
		var x = 1; //Initial field counter is 1
		$(addButton).click(function(){ //Once add button is clicked
			if(x < maxField){ //Check maximum number of input fields
				x++; //Increment field counter
				$(wrapper).append(fieldHTML); // Add field html
			}
		});
		$(wrapper).on('click', '.hapus_catatan', function(e){ //Once remove button is clicked
			e.preventDefault();
			$(this).parent('div').remove(); //Remove field html
			x--; //Decrement field counter
		});
	});
</script>
<script type="text/javascript">
	jQuery(function($) {
		$(document).ready(function() {
			$(this).val($(this).val().toUpperCase());
			var kecepatan = parseFloat($('#kecepatan').val());
			if((kecepatan>=36) && (kecepatan<=46)){
				$("#kec").removeClass("has-error");
				$("#kec").addClass("has-success");
				$("#cek_kecepatan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#kec").removeClass("has-success");
				$("#kec").addClass("has-error");
				$("#cek_kecepatan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
		
			var tint_meter = parseFloat($('#tint_meter').val());
			if(tint_meter>=70){
				$("#tint").removeClass("has-error");
				$("#tint").addClass("has-success");
				$("#cek_tint").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#tint").removeClass("has-success");
				$("#tint").addClass("has-error");
				$("#cek_tint").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var sound_level = parseFloat($('#sound_level').val());
			if((sound_level>=83) && (sound_level<=118)){
				$("#sound").removeClass("has-error");
				$("#sound").addClass("has-success");
				$("#cek_sound").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#sound").removeClass("has-success");
				$("#sound").addClass("has-error");
				$("#cek_sound").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var alur_ban = parseFloat($('#alur_ban').val());
			if(alur_ban>=1){
				$("#alur").removeClass("has-error");
				$("#alur").addClass("has-success");
				$("#cek_alur").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#alur").removeClass("has-success");
				$("#alur").addClass("has-error");
				$("#cek_alur").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var asap = parseFloat($('#asap').val());
			var co = parseFloat($('#asap_co').val());
			var hc = parseFloat($('#asap_hc').val());
			var tahun = parseFloat($('#tahun').val());
			var bahan_bakar = $('#bahan_bakar').val();
			//$('#lampu_kiri').val(bahan_bakar);
			if(bahan_bakar=="SOLAR"){
				if(tahun<=2010){
					if(asap<=70){
						$("#as").removeClass("has-error");
						$("#as").addClass("has-success");
						$("#cek_asap").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(asap>70){
						$("#as").removeClass("has-success");
						$("#as").addClass("has-error");
						$("#cek_asap").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
				} else {
					if(asap<=40){
						$("#as").removeClass("has-error");
						$("#as").addClass("has-success");
						$("#cek_asap").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(asap>40){
						$("#as").removeClass("has-success");
						$("#as").addClass("has-error");
						$("#cek_asap").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
				}
			} else {
				if(tahun<=2007){
					if(co<=4.5){
						$("#co").removeClass("has-error");
						$("#co").addClass("has-success");
						$("#cek_co").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(co>4.5){
						$("#co").removeClass("has-success");
						$("#co").addClass("has-error");
						$("#cek_co").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
					if(hc<=1200){
						$("#hc").removeClass("has-error");
						$("#hc").addClass("has-success");
						$("#cek_hc").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(hc>1200){
						$("#hc").removeClass("has-success");
						$("#hc").addClass("has-error");
						$("#cek_hc").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
				} else {
					if(co<=1.5){
						$("#co").removeClass("has-error");
						$("#co").addClass("has-success");
						$("#cek_co").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(co>1.5){
						$("#co").removeClass("has-success");
						$("#co").addClass("has-error");
						$("#cek_co").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
					if(hc<=200){
						$("#hc").removeClass("has-error");
						$("#hc").addClass("has-success");
						$("#cek_hc").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(hc>200){
						$("#hc").removeClass("has-success");
						$("#hc").addClass("has-error");
						$("#cek_hc").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
				}
			}
			
			var lampu_kiri = parseFloat($('#lampu_kiri').val());
			var d_lampu_kiri = parseFloat($('#derajat_lampu_kiri').val());
			var m_lampu_kiri = parseFloat($('#menit_lampu_kiri').val());
			var lampu_kanan = parseFloat($('#lampu_kanan').val());
			var d_lampu_kanan = parseFloat($('#derajat_lampu_kanan').val());
			var m_lampu_kanan = parseFloat($('#menit_lampu_kanan').val());
			
			if(lampu_kiri>=12000){
				$("#daya_kiri").removeClass("has-error");
				$("#daya_kiri").addClass("has-success");
				$("#cek_daya_kiri").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#daya_kiri").removeClass("has-success");
				$("#daya_kiri").addClass("has-error");
				$("#cek_daya_kiri").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			if(d_lampu_kiri<=1.09){
				$("#derajat_kiri").removeClass("has-error");
				$("#derajat_kiri").addClass("has-success");
				$("#cek_derajat_kiri").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			} else {
				$("#derajat_kiri").removeClass("has-success");
				$("#derajat_kiri").addClass("has-error");
				$("#cek_derajat_kiri").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			if(lampu_kanan>=12000){
				$("#daya_kanan").removeClass("has-error");
				$("#daya_kanan").addClass("has-success");
				$("#cek_daya_kanan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#daya_kanan").removeClass("has-success");
				$("#daya_kanan").addClass("has-error");
				$("#cek_daya_kanan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			if(d_lampu_kanan<=0.34){
				$("#derajat_kanan").removeClass("has-error");
				$("#derajat_kanan").addClass("has-success");
				$("#cek_derajat_kanan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			} else {
				$("#derajat_kanan").removeClass("has-success");
				$("#derajat_kanan").addClass("has-error");
				$("#cek_derajat_kanan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var ss_in = parseFloat($('#side_slip_in').val());
			var ss_out = parseFloat($('#side_slip_out').val());
			
			if((ss_in>=-5) && (ss_in<=5)){
				$("#in").removeClass("has-error");
				$("#in").addClass("has-success");
				$("#cek_in").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#in").removeClass("has-success");
				$("#in").addClass("has-error");
				$("#cek_in").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			if(ss_out<=5){
				$("#out").removeClass("has-error");
				$("#out").addClass("has-success");
				$("#cek_out").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#out").removeClass("has-success");
				$("#out").addClass("has-error");
				$("#cek_out").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var br_total_s1, br_total_s2,  br_total_s3,  br_total_s4, br_total_parkir, rem_utama, rem_parkir, ps1, ps2, ps3, ps4, psp, psk;
			var hasil_asap, hasil_utama, hasil_parkir, hasil_ps1, hasil_ps2, hasil_side_slip;
			
			var ax_total_s1 = parseFloat($('#axel_total_s1').val());
			var ax_total_s2 = parseFloat($('#axel_total_s2').val());
			var ax_total_s3 = parseFloat($('#axel_total_s3').val());
			var ax_total_s4 = parseFloat($('#axel_total_s4').val());
			
			var ax_total = ax_total_s1+ax_total_s2+ax_total_s3+ax_total_s4;
			$("#axel_total").val(ax_total);
			
			var br_kiri_s1 = parseFloat($('#brake_kiri_s1').val());
			var br_kanan_s1 = parseFloat($('#brake_kanan_s1').val());
			var br_kiri_s2 = parseFloat($('#brake_kiri_s2').val());
			var br_kanan_s2 = parseFloat($('#brake_kanan_s2').val());
			var br_kiri_s3 = parseFloat($('#brake_kiri_s3').val());
			var br_kanan_s3 = parseFloat($('#brake_kanan_s3').val());
			var br_kiri_s4 = parseFloat($('#brake_kiri_s4').val());
			var br_kanan_s4 = parseFloat($('#brake_kanan_s4').val());
			var br_kiri_parkir = parseFloat($('#brake_kiri_parkir').val());
			var br_kanan_parkir = parseFloat($('#brake_kanan_parkir').val());
			
			br_total_s1 = br_kiri_s1 + br_kanan_s1;
			br_total_s2 = br_kiri_s2 + br_kanan_s2;
			br_total_s3 = br_kiri_s3 + br_kanan_s3;
			br_total_s4 = br_kiri_s4 + br_kanan_s4;
			br_total_parkir = br_kiri_parkir + br_kanan_parkir;
			
			rem_utama = (br_total_s1 + br_total_s2 + br_total_s3 + br_total_s4)/(ax_total_s1 + ax_total_s2 + ax_total_s3 + ax_total_s4)*100;
			ps1 = ((Math.abs(br_kiri_s1-br_kanan_s1))/ax_total_s1)*100;
			ps2 = ((Math.abs(br_kiri_s2-br_kanan_s2))/ax_total_s2)*100;
			ps3 = ((Math.abs(br_kiri_s3-br_kanan_s3))/ax_total_s3)*100;
			ps4 = ((Math.abs(br_kiri_s4-br_kanan_s4))/ax_total_s4)*100;
			rem_parkir = br_total_parkir/(ax_total_s1 + ax_total_s2 + ax_total_s3 + ax_total_s4)*100;
			
			if(rem_utama>=50){
				$("#remu").removeClass("has-error");
				$("#remu").addClass("has-success");
				$("#cek_remu").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				
				if(ps1<=8){
					$("#br_ps1").removeClass("has-error");
					$("#br_ps1").addClass("has-success");
					$("#cek_ps1").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps1").removeClass("has-success");
					$("#br_ps1").addClass("has-error");
					$("#cek_ps1").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps2<=8){
					$("#br_ps2").removeClass("has-error");
					$("#br_ps2").addClass("has-success");
					$("#cek_ps2").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps2").removeClass("has-success");
					$("#br_ps2").addClass("has-error");
					$("#cek_ps2").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps3<=8){
					$("#br_ps3").removeClass("has-error");
					$("#br_ps3").addClass("has-success");
					$("#cek_ps3").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps3").removeClass("has-success");
					$("#br_ps3").addClass("has-error");
					$("#cek_ps3").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps4<=8){
					$("#br_ps4").removeClass("has-error");
					$("#br_ps4").addClass("has-success");
					$("#cek_ps4").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps4").removeClass("has-success");
					$("#br_ps4").addClass("has-error");
					$("#cek_ps4").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
			
			} else{
				$("#remu").removeClass("has-success");
				$("#remu").addClass("has-error");
				$("#cek_remu").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				
				if(ps1<=8){
					$("#br_ps1").removeClass("has-success");
					$("#br_ps1").addClass("has-error");
					$("#cek_ps1").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps1").removeClass("has-success");
					$("#br_ps1").addClass("has-error");
					$("#cek_ps1").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps2<=8){
					$("#br_ps2").removeClass("has-success");
					$("#br_ps2").addClass("has-error");
					$("#cek_ps2").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps2").removeClass("has-success");
					$("#br_ps2").addClass("has-error");
					$("#cek_ps2").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps3<=8){
					$("#br_ps3").removeClass("has-success");
					$("#br_ps3").addClass("has-error");
					$("#cek_ps3").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps3").removeClass("has-success");
					$("#br_ps3").addClass("has-error");
					$("#cek_ps3").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps4<=8){
					$("#br_ps4").removeClass("has-success");
					$("#br_ps4").addClass("has-error");
					$("#cek_ps4").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps4").removeClass("has-success");
					$("#br_ps4").addClass("has-error");
					$("#cek_ps4").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
			}
			
			var jenis = $('#jenis').val();
			if((jenis=="MINIBUS") || (jenis="MICROBUS") || (jenis=="BUS")){
				if(rem_parkir>=16){
					$("#parkir").removeClass("has-error");
					$("#parkir").addClass("has-success");
					$("#remu_parkir").removeClass("has-error");
					$("#remu_parkir").addClass("has-success");
					$("#cek_parkir").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				} else {
					$("#parkir").removeClass("has-success");
					$("#parkir").addClass("has-error");
					$("#remu_parkir").removeClass("has-success");
					$("#remu_parkir").addClass("has-error");
					$("#cek_parkir").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
			} else {
				if(rem_parkir>=12){
					$("#parkir").removeClass("has-error");
					$("#parkir").addClass("has-success");
					$("#remu_parkir").removeClass("has-error");
					$("#remu_parkir").addClass("has-success");
					$("#cek_parkir").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				} else {
					$("#parkir").removeClass("has-success");
					$("#parkir").addClass("has-error");
					$("#remu_parkir").removeClass("has-success");
					$("#remu_parkir").addClass("has-error");
					$("#cek_parkir").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
			}
			
			$('#hasil_rem_parkir').val(hasil_parkir);
			$('#hasil_rem_utama').val(hasil_utama);
			$('#hasil_ps1').val(hasil_ps1);
			$('#hasil_ps2').val(hasil_ps2);
			$('#brake_total_s1').val(br_total_s1);
			$('#brake_total_s2').val(br_total_s2);
			$('#brake_total_parkir').val(br_total_parkir);
			$('#rem_utama').val(rem_utama);
			$('#ps1').val(ps1);
			$('#ps2').val(ps2);
			$('#ps3').val(ps3);
			$('#ps4').val(ps4);
			$('#rem_parkir').val(rem_parkir);
		});
		
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
			
			var tint_meter = parseFloat($('#tint_meter').val());
			if(tint_meter>=70){
				$("#tint").removeClass("has-error");
				$("#tint").addClass("has-success");
				$("#cek_tint").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#tint").removeClass("has-success");
				$("#tint").addClass("has-error");
				$("#cek_tint").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var sound_level = parseFloat($('#sound_level').val());
			if((sound_level>=83) && (sound_level<=118)){
				$("#sound").removeClass("has-error");
				$("#sound").addClass("has-success");
				$("#cek_sound").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#sound").removeClass("has-success");
				$("#sound").addClass("has-error");
				$("#cek_sound").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var alur_ban = parseFloat($('#alur_ban').val());
			if(alur_ban>=1){
				$("#alur").removeClass("has-error");
				$("#alur").addClass("has-success");
				$("#cek_alur").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#alur").removeClass("has-success");
				$("#alur").addClass("has-error");
				$("#cek_alur").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var asap = parseFloat($('#asap').val());
			var co = parseFloat($('#asap_co').val());
			var hc = parseFloat($('#asap_hc').val());
			var tahun = parseFloat($('#tahun').val());
			var bahan_bakar = $('#bahan_bakar').val();
			//$('#lampu_kiri').val(bahan_bakar);
			if(bahan_bakar=="SOLAR"){
				if(tahun<=2010){
					if(asap<=70){
						$("#as").removeClass("has-error");
						$("#as").addClass("has-success");
						$("#cek_asap").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(asap>70){
						$("#as").removeClass("has-success");
						$("#as").addClass("has-error");
						$("#cek_asap").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
				} else {
					if(asap<=40){
						$("#as").removeClass("has-error");
						$("#as").addClass("has-success");
						$("#cek_asap").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(asap>40){
						$("#as").removeClass("has-success");
						$("#as").addClass("has-error");
						$("#cek_asap").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
				}
			} else {
				if(tahun<=2007){
					if(co<=4.5){
						$("#co").removeClass("has-error");
						$("#co").addClass("has-success");
						$("#cek_co").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(co>4.5){
						$("#co").removeClass("has-success");
						$("#co").addClass("has-error");
						$("#cek_co").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
					if(hc<=1200){
						$("#hc").removeClass("has-error");
						$("#hc").addClass("has-success");
						$("#cek_hc").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(hc>1200){
						$("#hc").removeClass("has-success");
						$("#hc").addClass("has-error");
						$("#cek_hc").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
				} else {
					if(co<=1.5){
						$("#co").removeClass("has-error");
						$("#co").addClass("has-success");
						$("#cek_co").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(co>1.5){
						$("#co").removeClass("has-success");
						$("#co").addClass("has-error");
						$("#cek_co").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
					if(hc<=200){
						$("#hc").removeClass("has-error");
						$("#hc").addClass("has-success");
						$("#cek_hc").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
					} else if(hc>200){
						$("#hc").removeClass("has-success");
						$("#hc").addClass("has-error");
						$("#cek_hc").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
					}
				}
			}
			
			var lampu_kiri = parseFloat($('#lampu_kiri').val());
			var d_lampu_kiri = parseFloat($('#derajat_lampu_kiri').val());
			var m_lampu_kiri = parseFloat($('#menit_lampu_kiri').val());
			var lampu_kanan = parseFloat($('#lampu_kanan').val());
			var d_lampu_kanan = parseFloat($('#derajat_lampu_kanan').val());
			var m_lampu_kanan = parseFloat($('#menit_lampu_kanan').val());
			
			if(lampu_kiri>=12000){
				$("#daya_kiri").removeClass("has-error");
				$("#daya_kiri").addClass("has-success");
				$("#cek_daya_kiri").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#daya_kiri").removeClass("has-success");
				$("#daya_kiri").addClass("has-error");
				$("#cek_daya_kiri").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			if(d_lampu_kiri<=1.09){
				$("#derajat_kiri").removeClass("has-error");
				$("#derajat_kiri").addClass("has-success");
				$("#cek_derajat_kiri").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			} else {
				$("#derajat_kiri").removeClass("has-success");
				$("#derajat_kiri").addClass("has-error");
				$("#cek_derajat_kiri").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			if(lampu_kanan>=12000){
				$("#daya_kanan").removeClass("has-error");
				$("#daya_kanan").addClass("has-success");
				$("#cek_daya_kanan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#daya_kanan").removeClass("has-success");
				$("#daya_kanan").addClass("has-error");
				$("#cek_daya_kanan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			if(d_lampu_kanan<=0.34){
				$("#derajat_kanan").removeClass("has-error");
				$("#derajat_kanan").addClass("has-success");
				$("#cek_derajat_kanan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			} else {
				$("#derajat_kanan").removeClass("has-success");
				$("#derajat_kanan").addClass("has-error");
				$("#cek_derajat_kanan").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var ss_in = parseFloat($('#side_slip_in').val());
			var ss_out = parseFloat($('#side_slip_out').val());
			
			if((ss_in>=-5) && (ss_in<=5)){
				$("#in").removeClass("has-error");
				$("#in").addClass("has-success");
				$("#cek_in").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#in").removeClass("has-success");
				$("#in").addClass("has-error");
				$("#cek_in").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			if(ss_out<=5){
				$("#out").removeClass("has-error");
				$("#out").addClass("has-success");
				$("#cek_out").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#out").removeClass("has-success");
				$("#out").addClass("has-error");
				$("#cek_out").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
			}
			
			var br_total_s1, br_total_s2,  br_total_s3,  br_total_s4, br_total_parkir, rem_utama, rem_parkir, ps1, ps2, ps3, ps4, psp, psk;
			var hasil_asap, hasil_utama, hasil_parkir, hasil_ps1, hasil_ps2, hasil_side_slip;
			
			var ax_total_s1 = parseFloat($('#axel_total_s1').val());
			var ax_total_s2 = parseFloat($('#axel_total_s2').val());
			var ax_total_s3 = parseFloat($('#axel_total_s3').val());
			var ax_total_s4 = parseFloat($('#axel_total_s4').val());
			
			var ax_total = ax_total_s1+ax_total_s2+ax_total_s3+ax_total_s4;
			$("#axel_total").val(ax_total);
			
			var br_kiri_s1 = parseFloat($('#brake_kiri_s1').val());
			var br_kanan_s1 = parseFloat($('#brake_kanan_s1').val());
			var br_kiri_s2 = parseFloat($('#brake_kiri_s2').val());
			var br_kanan_s2 = parseFloat($('#brake_kanan_s2').val());
			var br_kiri_s3 = parseFloat($('#brake_kiri_s3').val());
			var br_kanan_s3 = parseFloat($('#brake_kanan_s3').val());
			var br_kiri_s4 = parseFloat($('#brake_kiri_s4').val());
			var br_kanan_s4 = parseFloat($('#brake_kanan_s4').val());
			var br_kiri_parkir = parseFloat($('#brake_kiri_parkir').val());
			var br_kanan_parkir = parseFloat($('#brake_kanan_parkir').val());
			
			br_total_s1 = br_kiri_s1 + br_kanan_s1;
			br_total_s2 = br_kiri_s2 + br_kanan_s2;
			br_total_s3 = br_kiri_s3 + br_kanan_s3;
			br_total_s4 = br_kiri_s4 + br_kanan_s4;
			br_total_parkir = br_kiri_parkir + br_kanan_parkir;
			
			rem_utama = (br_total_s1 + br_total_s2 + br_total_s3 + br_total_s4)/(ax_total_s1 + ax_total_s2 + ax_total_s3 + ax_total_s4)*100;
			ps1 = ((Math.abs(br_kiri_s1-br_kanan_s1))/ax_total_s1)*100;
			ps2 = ((Math.abs(br_kiri_s2-br_kanan_s2))/ax_total_s2)*100;
			ps3 = ((Math.abs(br_kiri_s3-br_kanan_s3))/ax_total_s3)*100;
			ps4 = ((Math.abs(br_kiri_s4-br_kanan_s4))/ax_total_s4)*100;
			rem_parkir = br_total_parkir/(ax_total_s1 + ax_total_s2 + ax_total_s3 + ax_total_s4)*100;
			
			if(rem_utama>=50){
				$("#remu").removeClass("has-error");
				$("#remu").addClass("has-success");
				$("#cek_remu").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				
				if(ps1<=8){
					$("#br_ps1").removeClass("has-error");
					$("#br_ps1").addClass("has-success");
					$("#cek_ps1").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps1").removeClass("has-success");
					$("#br_ps1").addClass("has-error");
					$("#cek_ps1").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps2<=8){
					$("#br_ps2").removeClass("has-error");
					$("#br_ps2").addClass("has-success");
					$("#cek_ps2").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps2").removeClass("has-success");
					$("#br_ps2").addClass("has-error");
					$("#cek_ps2").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps3<=8){
					$("#br_ps3").removeClass("has-error");
					$("#br_ps3").addClass("has-success");
					$("#cek_ps3").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps3").removeClass("has-success");
					$("#br_ps3").addClass("has-error");
					$("#cek_ps3").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps4<=8){
					$("#br_ps4").removeClass("has-error");
					$("#br_ps4").addClass("has-success");
					$("#cek_ps4").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps4").removeClass("has-success");
					$("#br_ps4").addClass("has-error");
					$("#cek_ps4").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
			
			} else{
				$("#remu").removeClass("has-success");
				$("#remu").addClass("has-error");
				$("#cek_remu").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				
				if(ps1<=8){
					$("#br_ps1").removeClass("has-success");
					$("#br_ps1").addClass("has-error");
					$("#cek_ps1").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps1").removeClass("has-success");
					$("#br_ps1").addClass("has-error");
					$("#cek_ps1").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps2<=8){
					$("#br_ps2").removeClass("has-success");
					$("#br_ps2").addClass("has-error");
					$("#cek_ps2").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps2").removeClass("has-success");
					$("#br_ps2").addClass("has-error");
					$("#cek_ps2").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps3<=8){
					$("#br_ps3").removeClass("has-success");
					$("#br_ps3").addClass("has-error");
					$("#cek_ps3").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps3").removeClass("has-success");
					$("#br_ps3").addClass("has-error");
					$("#cek_ps3").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
				
				if(ps4<=8){
					$("#br_ps4").removeClass("has-success");
					$("#br_ps4").addClass("has-error");
					$("#cek_ps4").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				}
				else{
					$("#br_ps4").removeClass("has-success");
					$("#br_ps4").addClass("has-error");
					$("#cek_ps4").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
			}
			
			var jenis = $('#jenis').val();
			if((jenis=="MINIBUS") || (jenis="MICROBUS") || (jenis=="BUS")){
				if(rem_parkir>=16){
					$("#parkir").removeClass("has-error");
					$("#parkir").addClass("has-success");
					$("#remu_parkir").removeClass("has-error");
					$("#remu_parkir").addClass("has-success");
					$("#cek_parkir").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				} else {
					$("#parkir").removeClass("has-success");
					$("#parkir").addClass("has-error");
					$("#remu_parkir").removeClass("has-success");
					$("#remu_parkir").addClass("has-error");
					$("#cek_parkir").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
			} else {
				if(rem_parkir>=12){
					$("#parkir").removeClass("has-error");
					$("#parkir").addClass("has-success");
					$("#remu_parkir").removeClass("has-error");
					$("#remu_parkir").addClass("has-success");
					$("#cek_parkir").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> LULUS </div>");
				} else {
					$("#parkir").removeClass("has-success");
					$("#parkir").addClass("has-error");
					$("#remu_parkir").removeClass("has-success");
					$("#remu_parkir").addClass("has-error");
					$("#cek_parkir").html("<div class='help-block col-xs-1 col-sm-reset inline bolder'> GAGAL </div>");
				}
			}
			
			$('#hasil_rem_parkir').val(hasil_parkir);
			$('#hasil_rem_utama').val(hasil_utama);
			$('#hasil_ps1').val(hasil_ps1);
			$('#hasil_ps2').val(hasil_ps2);
			$('#brake_total_s1').val(br_total_s1);
			$('#brake_total_s2').val(br_total_s2);
			$('#brake_total_parkir').val(br_total_parkir);
			$('#rem_utama').val(rem_utama);
			$('#ps1').val(ps1);
			$('#ps2').val(ps2);
			$('#ps3').val(ps3);
			$('#ps4').val(ps4);
			$('#rem_parkir').val(rem_parkir);
			
			var kecepatan = parseFloat($('#kecepatan').val());
			if((kecepatan>=36) && (kecepatan<=46)){
				$("#kec").removeClass("has-error");
				$("#kec").addClass("has-success");
				$("#cek_kecepatan").html("<div class='help-block col-xs-12 col-sm-reset inline bolder'> LULUS </div>");
			}
			else{
				$("#kec").removeClass("has-success");
				$("#kec").addClass("has-error");
				$("#cek_kecepatan").html("<div class='help-block col-xs-12 col-sm-reset inline bolder'> GAGAL </div>");
			}
		});
	});
</script>	
