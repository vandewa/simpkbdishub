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
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-8">
						<input type="text" id="jenis" name="jenis" class="col-xs-12" value="<?php echo $row->jenis;?>"  readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-left"> Merk dan Tipe </label>
					<div class="col-sm-8">
						<input type="text" id="merktipe" name="merktipe" class="col-xs-12" value="<?php echo $row->merek;?> / <?php echo $row->tipe;?>" readonly />
					</div>
				</div>
				
				<input type="hidden" id="tahun" name="tahun" class="col-xs-12" value="<?php echo $row->tahun;?>"  readonly />
				<input type="hidden" id="bahan_bakar" name="bahan_bakar" class="col-xs-12" value="<?php echo $row->bahan_bakar;?>"  readonly />
			</div>
		</div>
	</form>
	
	<?php if($catatan>0){ ?>
	<h3 class="header smaller red">CATATAN KERUSAKAN</h3>
	
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
		
	<form class="form-horizontal" role="form" action="<?php echo site_url('uji/tambahproses_ujivisual?kode='.$kode_uji.'&uji='.$jenis_uji.'&sts='.$status);?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		
		<h3 class="header smaller blue">Uji Visual</h3>
		
		<div class="row">
			<div class="col-md-4 col-xl-4">
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
			
			<div class="col-md-4 col-xl-4">
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
			
			<div class="col-md-4 col-xl-4">
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
								<label class="col-sm-6 control-label">Ke1an Ban</label>
								<div class="col-sm-5">
								  <input name="ke1an_ban" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="ke1an_ban" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Ke1an Kembang Ban</label>
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
								<label class="col-sm-6 control-label">Ke1an Pelek</label>
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
			
			<div class="col-md-4 col-xl-4">
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
								<label class="col-sm-6 control-label">Tempat Roda C1ngan</label>
								<div class="col-sm-5">
								  <input name="tempat_roda_c1ngan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="tempat_roda_c1ngan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Ke1an Body</label>
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
			
			<div class="col-md-4 col-xl-4">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">SISTEM KEMUDI</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label class="col-sm-6 control-label">Roda Kemudi</label>
								<div class="col-sm-5">
								  <input name="roda_kemudi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="roda_kemudi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Speling Roda Kemudi</label>
								<div class="col-sm-5">
								  <input name="speling_roda_kemudi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="speling_roda_kemudi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Batang Kemudi</label>
								<div class="col-sm-5">
								  <input name="batang_kemudi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="batang_kemudi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Roda Gigi Kemudi</label>
								<div class="col-sm-5">
								  <input name="roda_gigi_kemudi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="roda_gigi_kemudi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Sambungan Kemudi</label>
								<div class="col-sm-5">
								  <input name="sambungan_kemudi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sambungan_kemudi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Penyambungan Sendi Peluru</label>
								<div class="col-sm-5">
								  <input name="penyambungan_sendi_peluru" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="penyambungan_sendi_peluru" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Power Steering</label>
								<div class="col-sm-5">
								  <input name="power_steering" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="power_steering" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Slide Slipe</label>
								<div class="col-sm-5">
								  <input name="slide_slipe" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="slide_slipe" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">SISTEM KEMUDI</label>
								<div class="col-sm-5">
								  <input name="sistem_kemudi" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
								  <input name="sistem_kemudi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-4 col-xl-4">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">AS & SUSPENSI</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label class="col-sm-6 control-label">Suspensi Roda Depan</label>
								<div class="col-sm-5">
								  <input name="suspensi_roda_depan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="suspensi_roda_depan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Suspensi Roda Belakang</label>
								<div class="col-sm-5">
								  <input name="suspensi_roda_belakang" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="suspensi_roda_belakang" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Sumbu</label>
								<div class="col-sm-5">
								  <input name="sumbu" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sumbu" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Pemasangan Sumbu</label>
								<div class="col-sm-5">
								  <input name="pemasangan_sumbu" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="pemasangan_sumbu" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Pegas</label>
								<div class="col-sm-5">
								  <input name="pegas" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="pegas" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Bantalan Bantalan Roda</label>
								<div class="col-sm-5">
								  <input name="bantalan_bantalan_roda" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="bantalan_bantalan_roda" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">AS DAN SUSPENSI</label>
								<div class="col-sm-5">
								  <input name="as_dan_suspensi" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
								  <input name="as_dan_suspensi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-4 col-xl-4">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">MESIN & TRANSMISI</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label class="col-sm-6 control-label">Dudukan Mesin</label>
								<div class="col-sm-5">
								  <input name="dudukan_mesin" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="dudukan_mesin" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Kondisi Mesin</label>
								<div class="col-sm-5">
								  <input name="kondisi_mesin" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kondisi_mesin" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Transmisi</label>
								<div class="col-sm-5">
								  <input name="transmisi" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="transmisi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Sistem Gas Buang</label>
								<div class="col-sm-5">
								  <input name="sistem_gas_buang" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sistem_gas_buang" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Emisi Asap</label>
								<div class="col-sm-5">
								  <input name="emisi_asap" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="emisi_asap" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Emisi Co</label>
								<div class="col-sm-5">
								  <input name="emisi_co" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="emisi_co" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">MESIN DAN TRANSMISI</label>
								<div class="col-sm-5">
								  <input name="mesin_transmisi" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
								  <input name="mesin_transmisi" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-4 col-xl-4">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">SISTEM REM</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label class="col-sm-6 control-label">Pedal Rem</label>
								<div class="col-sm-5">
								  <input name="pedal_rem" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="pedal_rem" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Speling Pedal</label>
								<div class="col-sm-5">
								  <input name="speling_pedal" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="speling_pedal" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Kebocoran Kelemahan</label>
								<div class="col-sm-5">
								  <input name="kebocoran_kelemahan_1" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kebocoran_kelemahan_1" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Sambungan Tuas Kabel</label>
								<div class="col-sm-5">
								  <input name="sambungan_tuas_kabel_1" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sambungan_tuas_kabel_1" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Pipa Selang</label>
								<div class="col-sm-5">
								  <input name="pipa_selang" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="pipa_selang" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">Silinder Katup</label>
								<div class="col-sm-5">
								  <input name="silinder_katup" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="silinder_katup" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Tromol Cakram</label>
								<div class="col-sm-5">
								  <input name="tromol_cakram" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="tromol_cakram" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Peroda/Plat/Pelapis</label>
								<div class="col-sm-5">
								  <input name="peroda_plat_pelapis" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="peroda_plat_pelapis" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Sistem Vacum</label>
								<div class="col-sm-5">
								  <input name="sistem_vacum" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sistem_vacum" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Fungsi</label>
								<div class="col-sm-5">
								  <input name="fungsi_1" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="fungsi_1" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Kebocoran Kelemahan</label>
								<div class="col-sm-5">
								  <input name="kebocoran_kelemahan_2" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kebocoran_kelemahan_2" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Sistem Tekanan Angin</label>
								<div class="col-sm-5">
								  <input name="sistem_tekanan_angin" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sistem_tekanan_angin" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Kebocoran</label>
								<div class="col-sm-5">
								  <input name="kebocoran" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kebocoran" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Waktu Pengisian</label>
								<div class="col-sm-5">
								  <input name="waktu_pengisian" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="waktu_pengisian" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Penggerak Rem</label>
								<div class="col-sm-5">
								  <input name="penggerak_rem" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="penggerak_rem" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Pengisian Krt Gandengan</label>
								<div class="col-sm-5">
								  <input name="pengisian_krt_gandengan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="pengisian_krt_gandengan" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div><div class="form-group">
								<label class="col-sm-6 control-label">Tekanan Angin</label>
								<div class="col-sm-5">
								  <input name="tekanan_angin" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="tekanan_angin" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Rem Parkir</label>
								<div class="col-sm-5">
								  <input name="rem_parkir" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="rem_parkir" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Tuas Tangan / Pedal</label>
								<div class="col-sm-5">
								  <input name="tuas_tangan_pedal" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="tuas_tangan_pedal" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Spelling Tuas Tangan / Pedal</label>
								<div class="col-sm-5">
								  <input name="speling_tuas_tangan_pedal" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="speling_tuas_tangan_pedal" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Kebocoran Kelemahan</label>
								<div class="col-sm-5">
								  <input name="kebocoran_kelemahan_3" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="kebocoran_kelemahan_3" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Sambungan Tuas Kabel</label>
								<div class="col-sm-5">
								  <input name="sambungan_tuas_kabel_2" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sambungan_tuas_kabel_2" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Sistem Ruang Gas Buang</label>
								<div class="col-sm-5">
								  <input name="sistem_ruang_gas_buang" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="sistem_ruang_gas_buang" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-6 control-label">Fungsi</label>
								<div class="col-sm-5">
								  <input name="fungsi_2" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
								  <input name="fungsi_2" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-6 control-label">SISTEM REM</label>
								<div class="col-sm-5">
								  <input name="sistem_rem" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
								  <input name="sistem_rem" class="minimal" type="radio" value="0"> TIDAK
								</div>
							  </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-4 col-xl-4">
				<div class="widget-box widget-color-blue collapsed">
					<div class="widget-header">
						<h6 class="widget-title bigger">LAIN-LAIN</h6>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
			
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
							<label class="col-sm-6 control-label">Sistem Bahan Bakar</label>
							<div class="col-sm-5">
							  <input name="sistem_bahan_bakar" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
							  <input name="sistem_bahan_bakar" class="minimal" type="radio" value="0"> TIDAK
							</div>
						  </div>
						   <div class="form-group">
							<label class="col-sm-6 control-label">Sistem Kelistrikan</label>
							<div class="col-sm-5">
							  <input name="sistem_kelistrikan" class="minimal" type="radio" value="1" checked> ADA &nbsp;&nbsp;
							  <input name="sistem_kelistrikan" class="minimal" type="radio" value="0"> TIDAK
							</div>
						  </div>
						  <div class="form-group">
							<label class="col-sm-6 control-label">LAIN LAIN</label>
							<div class="col-sm-5">
							  <input name="lain_lain" class="minimal" type="radio" value="1" checked> LULUS &nbsp;&nbsp;
							  <input name="lain_lain" class="minimal" type="radio" value="0"> TIDAK
							</div>
						  </div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<h3 class="header smaller blue">Catatan</h3>
		
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
			<div class="col-md-offset-6 col-md-12">
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

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
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
		$('input').keyup(function(e){
			$(this).val($(this).val().toUpperCase());
		});
	});
</script>	
