<div class="page-content">	
	<?php
		$admin = $this->session->userdata('id_akses') == '1';
		$petugas = $this->session->userdata('id_akses') == '2';
		$penguji = $this->session->userdata('id_akses') == '3';
		$pengguna = $this->session->userdata('id_akses') == '4';
		?>
	
	<!--
	<div class="row">
		<?php 
		if($petugas || $admin){ ?>
		<div class="col-xs-12 col-sm-4">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat">
					<h4 class="widget-title lighter">
						<i class="ace-icon fa fa-star orange"></i>
						DATA KBWU BULAN <?php echo strtoupper(date("F"));?>
					</h4>

					<div class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="ace-icon fa fa-chevron-up"></i>
						</a>
					</div>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-bordered table-striped">							
							<tbody>
								<tr>
									<th>KBWU Bulan ini</th>
									<th class="text-center"><?php echo $dt_kbwu_habis;?></th>
								</tr>
								<tr>
									<th>KBWU Aktif</th>
									<th class="text-center"><?php echo $dt_kbwu;?> / <?php if($dt_kbwu=="0"){ $persena = 0; } else {$persena = $dt_kbwu/$dt_kbwu_habis*100;} echo round($persena,2);?>%</th>
								</tr>
								<tr>
									<th>KBWU Disisihkan</th>
									<th class="text-center"><?php $sisa = $dt_kbwu_habis-$dt_kbwu; echo $sisa;?> / <?php if($dt_kbwu=="0"){ $persenb = 0;} else { $persenb = $sisa/$dt_kbwu_habis*100;} echo round($persenb,2);?>%</th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	-->
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat">
					<h4 class="widget-title lighter">
						<i class="ace-icon fa fa-check orange"></i>
						PENGUJIAN HARI INI <?php echo strtoupper(strftime("%A, %d %B %Y"));?>
					</h4>

					<div class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="ace-icon fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				
				<?php 
					$ci = &get_instance();
					$ci->load->model('model_dashboard','dashboard');
					
					$jmldaftar = $this->dashboard->getJmlDaftar();
					$jmluji = $this->dashboard->getJmlUji();
					$jmlbelumuji = $this->dashboard->getJmlBelumUji();
					$jmlpengesahan = $this->dashboard->getJmlPengesahan();
					$jmllulus = $this->dashboard->getJmlLulus();
					$jmltidaklulus = $this->dashboard->getJmlTidakLulus();
					$jmlperso = $this->dashboard->getJmlPerso();
				?>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<div class="row">
							<?php if($admin || $petugas){ ?>
							<div class="col-xs-6 col-sm-2">
								<a href="<?php echo site_url('pendaftaran');?>">
								<div class="infobox infobox-orange2">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-list-alt"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?php echo $jmldaftar;?></span>
										<div class="infobox-content">DAFTAR UJI</div>
									</div>
								</div>
								</a>
							</div>
							<?php }  if($admin || $penguji){ ?>
							<div class="col-xs-6 col-sm-2">
								<a href="<?php echo site_url('uji/kendaraan');?>">
								<div class="infobox infobox-pink">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-exchange"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?php echo $jmlbelumuji;?></span>
										<div class="infobox-content">BELUM UJI</div>
									</div>
								</div>
								</a>
							</div>
							
							<div class="col-xs-6 col-sm-2">
								<a href="<?php echo site_url('uji/pengesahan');?>">
								<div class="infobox infobox-orange">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-pencil-square-o"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?php echo $jmlpengesahan;?></span>
										<div class="infobox-content">PENGESAHAN</div>
									</div>
								</div>	
								</a>
							</div>
							
							<div class="col-xs-6 col-sm-2">
								<a href="<?php echo site_url('uji/pengesahan');?>">
								<div class="infobox infobox-orange2">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-pencil-square-o"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?php echo $jmluji;?></span>
										<div class="infobox-content">TOTAL PENGESAHAN</div>
									</div>
								</div>	
								</a>
							</div>
							<?php }  if($admin || $petugas || $penguji){ ?>
							<div class="col-xs-6 col-sm-2">
								<a href="<?php echo site_url('uji');?>">
								<div class="infobox infobox-blue">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-truck"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?php echo $jmluji;?></span>
										<div class="infobox-content">SUDAH UJI</div>
									</div>
								</div>	
								</a>
							</div>
							
							<div class="col-xs-6 col-sm-2">
								<a href="<?php echo site_url('uji');?>">
								<div class="infobox infobox-green">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-check"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?php echo $jmllulus;?></span>
										<div class="infobox-content">LULUS</div>
									</div>
								</div>
								</a>
							</div>
							
							<div class="col-xs-6 col-sm-2">
								<a href="<?php echo site_url('uji/perbaikan');?>">
								<div class="infobox infobox-red">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-ban"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?php echo $jmltidaklulus;?></span>
										<div class="infobox-content">TIDAK LULUS</div>
									</div>
								</div>
								</a>
							</div>
							<?php }  if($admin || $petugas){ ?>
							<div class="col-xs-6 col-sm-2">
								<a href="<?php echo site_url('uji/data');?>">
								<div class="infobox infobox-orange">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-print"></i>
									</div>

									<div class="infobox-data">
										<span class="infobox-data-number"><?php echo $jmlperso;?></span>
										<div class="infobox-content">PERSO/CETAK</div>
									</div>
								</div>
								</a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--
	<div class="row">
		<?php 
		if($petugas || $admin){ ?>

		<div class="col-xs-12 col-sm-12">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat">
					<h4 class="widget-title lighter">
						<i class="ace-icon fa fa-star orange"></i>
						DATA PELAYANAN
					</h4>

					<div class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="ace-icon fa fa-chevron-up"></i>
						</a>
					</div>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">
										<i class="ace-icon fa fa-caret-right blue"></i> Nomor Uji
									</th>

									<th class="hidden-480 text-center">
										<i class="ace-icon fa fa-caret-right blue"></i> Nomor Kendaraan
									</th>
									
									<th class="hidden-480 text-center">
										<i class="ace-icon fa fa-caret-right blue"></i> Jenis Kendaraan
									</th>
									
									<th class="hidden-480 text-center">
										<i class="ace-icon fa fa-caret-right blue"></i> Jenis Pelayanan
									</th>

									<th class="hidden-480 text-center">
										<i class="ace-icon fa fa-caret-right blue"></i> Waktu Daftar
									</th>
									
									<th class="hidden-480 text-center">
										<i class="ace-icon fa fa-caret-right blue"></i> Waktu Selesai
									</th>
									
									<th class="text-center">
										<i class="ace-icon fa fa-caret-right blue"></i> Waktu Pelayanan
									</th>
								</tr>
							</thead>
							
							<tbody>
								<?php foreach($dt_pelayanan as $row){ ?>
								<tr>
									<td><?php echo $row->no_uji;?></td>
									<td class="hidden-480"><?php echo $row->no_kendaraan;?></td>
									<td class="hidden-480"><?php echo $row->jenis;?></td>
									<td class="hidden-480"><?php echo $row->jenis_uji;?></td>
									<td class="hidden-480"><?php echo date("d M Y H:i:s",strtotime($row->waktu_pendaftaran));?></td>
									<td class="hidden-480"><?php echo date("d M Y H:i:s",strtotime($row->waktu_selesai));?></td>
									<td class="hidden-480"><?php 
										$datea = new DateTime($row->waktu_pendaftaran);
										$dateb = new DateTime($row->waktu_selesai);
										$pelayanan = $datea->diff($dateb)->format("%h Jam %i Menit %s Detik");
										echo $pelayanan;
									?> </td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	-->
</div>