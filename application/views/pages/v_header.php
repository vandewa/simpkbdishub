<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title ?></title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css')?>" />
		
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.custom.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/chosen.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/daterangepicker.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css')?>" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/fonts.googleapis.com.css')?>" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace.min.css')?>" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-skins.min.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-rtl.min.css')?>" />

		<script src="<?php echo base_url('assets/js/ace-extra.min.js')?>"></script>
		
		<!-- page javascript -->
		<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
		</script>
		
		<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>

		<script src="<?php echo base_url('assets/js/jquery-ui.custom.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.ui.touch-punch.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/chosen.jquery.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/moment.js')?>"></script>
		<script src="<?php echo base_url('assets/js/daterangepicker.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/autosize.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.inputlimiter.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/select2.min.js')?>"></script>
		
		<!-- ace scripts -->
		<script src="<?php echo base_url('assets/js/ace-elements.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/ace.min.js')?>"></script>
	</head>
	
	<?php 
		$admin = $this->session->userdata('id_akses') == '1';
		$petugas = $this->session->userdata('id_akses') == '2';
		$penguji = $this->session->userdata('id_akses') == '3';
		$pengguna = $this->session->userdata('id_akses') == '4';
	?>

	<body class="no-skin" onload=display_ct();>
		<div id="navbar" class="navbar navbar-default">
			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?php echo site_url('dashboard')?>" class="navbar-brand">
						<small>
							<i class="fa fa-truck"></i>
							SIMPKB
						</small>
					</a>

				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url('assets/images/logo-dishub-kab.png')?>" alt="User" />
								<span class="user-info">
									<small><?php echo $this->session->userdata('akses');?></small>
									<?php echo $this->session->userdata('nama');?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<?php 
									if($admin || $petugas){
								?>
								<li>
									<a href="<?php echo site_url('user/profile')?>">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>
								
								<li>
									<a href="<?php echo site_url('aktifitas')?>">
										<i class="ace-icon fa fa-bookmark"></i>
										Log Aktifitas
									</a>
								</li>
								
								<li>
									<a href="<?php echo site_url('liveuji')?>" target="_blank">
										<i class="ace-icon fa fa-list"></i>
										Status Pengujian
									</a>
								</li>
								
								<?php } ?>

								<li class="divider"></li>

								<li>
									<a href="<?php echo site_url('login/logout')?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>

					</ul>
				</div>

			</div>
		</div>

		<div class="main-container" id="main-container">
			<div id="sidebar" class="sidebar responsive">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<?php 
							if($admin || $petugas){
						?>
						<a href="<?php echo site_url('pengguna')?>">
							<button class="btn btn-sm btn-success" data-rel="tooltip" title="Pengguna">
								<i class="ace-icon fa fa-user"></i>
							</button>
						</a>
		
						<a href="<?php echo site_url('kendaraan')?>">
							<button class="btn btn-sm btn-info" data-rel="tooltip" title="Kendaraan">
								<i class="ace-icon fa fa-truck"></i>
							</button>
						</a>

						<a href="<?php echo site_url('setting')?>">
							<button class="btn btn-sm btn-warning">
								<i class="ace-icon fa fa-print"></i>
							</button>
						</a>
						
						<a href="<?php echo site_url('setting')?>">
							<button class="btn btn-sm btn-danger">
								<i class="ace-icon fa fa-cogs"></i>
							</button>
						</a>
						<?php } ?>

					</div>
					
					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<?php 
							if($admin || $petugas){
						?>
						<span class="btn btn-success" data-rel="tooltip" title="Pengguna"></span>

						<span class="btn btn-info" data-rel="tooltip" title="Kendaraan"></span>

						<span class="btn btn-warning" data-rel="tooltip" title="Cetak"></span>
						
						<span class="btn btn-danger" data-rel="tooltip" title="Setting"></span>
						<?php } ?>
					</div>
				</div>

				<ul class="nav nav-list">
					<li class="<?php if(isset($aktif_dashboard)){echo $aktif_dashboard ;}?>">
						<a href="<?php echo site_url('dashboard')?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Beranda </span>
						</a>

						<b class="arrow"></b>
					</li>

					<?php if($admin || $petugas || $penguji){ ?>
					<li class="<?php if(isset($aktif_kendaraan)){echo $aktif_kendaraan ;}?> <?php if(isset($open_kendaraan)){echo $open_kendaraan ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-truck"></i>

							<span class="menu-text">
								Kendaraan
							</span>
							<b class="arrow fa fa-angle-down"></b>

							<b class="arrow"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if($admin || $petugas || $penguji){ ?>
							
							<li class="<?php if(isset($daftar_kendaraan)){echo $daftar_kendaraan ;}?>">
								<a href="<?php echo site_url('kendaraan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Daftar Kendaraan
								</a>

								<b class="arrow"></b>
							</li>
							
							<?php } if($admin || $petugas){ ?>
							<li class="<?php if(isset($daftar_pemilik)){echo $daftar_pemilik ;}?>">
								<a href="<?php echo site_url('kendaraan/pemilik')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Daftar Pemilik
								</a>

								<b class="arrow"></b>
							</li>
							<?php } if($admin){ ?>
							<li class="<?php if(isset($daftar_kendaraan_diblokir)){echo $daftar_kendaraan_diblokir ;}?>">
								<a href="<?php echo site_url('kendaraan/rekap_blokir')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kendaraan Diblokir
								</a>

								<b class="arrow"></b>
							</li>
							<?php } if($admin || $petugas){ ?>
							<li class="<?php if(isset($daftar_kendaraan_mutasi)){echo $daftar_kendaraan_mutasi ;}?>">
								<a href="<?php echo site_url('kendaraan/mutasi')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kendaraan Mutasi
								</a>

								<b class="arrow"></b>
							</li>
							<?php } ?>
						</ul>
					</li>
					
					<?php } if($admin || $petugas){ ?>
					
					<li class="<?php if(isset($aktif_pendaftaran)){echo $aktif_pendaftaran ;}?> <?php if(isset($open_pendaftaran)){echo $open_pendaftaran ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Pendaftaran </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($daftar_online)){echo $daftar_online ;}?>">
								<a href="<?php echo site_url('pendaftaran/daftaronline')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Daftar Online
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($daftar)){echo $daftar ;}?>">
								<a href="<?php echo site_url('pendaftaran/uji')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pendaftaran Uji
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($rekap_pendaftaran)){echo $rekap_pendaftaran ;}?>">
								<a href="<?php echo site_url('pendaftaran')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Rekap Pendaftaran
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="<?php if(isset($aktif_retribusi)){echo $aktif_retribusi ;}?> <?php if(isset($open_retribusi)){echo $open_retribusi ;}?>">
						
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Retribusi </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
							
						<b class="arrow"></b>
						
						<ul class="submenu">
							
							<li class="<?php if(isset($rekap_retribusi)){echo $rekap_retribusi;}?>">
								<a href="<?php echo site_url('retribusi')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pembayaran Retribusi
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<?php } if($admin || $petugas || $penguji) { ?>
					
					<li class="<?php if(isset($aktif_uji)){echo $aktif_uji ;}?> <?php if(isset($open_uji)){echo $open_uji ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Uji </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							<?php if($admin || $penguji){ ?>
							<!--
							<li class="<?php if(isset($uji_visual)){echo $uji_visual ;}?>">
								<a href="<?php echo site_url('uji/visual')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Uji Visual
								</a>
								<b class="arrow"></b>
							</li>
							
							
							<li class="<?php if(isset($uji_emisi)){echo $uji_emisi ;}?>">
								<a href="<?php echo site_url('uji/emisi')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pra uji, Emisi
								</a>
								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($uji_sideslip)){echo $uji_sideslip ;}?>">
								<a href="<?php echo site_url('uji/sideslip')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Sound, Side Slip, Lampu
								</a>
								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($uji_rem)){echo $uji_rem ;}?>">
								<a href="<?php echo site_url('uji/rem')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Berat, Rem
								</a>
								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($uji_kecepatan)){echo $uji_kecepatan ;}?>">
								<a href="<?php echo site_url('uji/kecepatan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kecepatan
								</a>
								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($uji_massal)){echo $uji_massal ;}?>">
								<a href="<?php echo site_url('uji/massal')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Uji Massal
								</a>
								<b class="arrow"></b>
							</li>

							<li class="<?php if(isset($foto_kendaraan)){echo $foto_kendaraan ;}?>">
								<a href="<?php echo site_url('uji/foto')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Foto Kendaraan
								</a>

								<b class="arrow"></b>
							</li>
							-->
							
							<li class="<?php if(isset($uji_kendaraan)){echo $uji_kendaraan ;}?>">
								<a href="<?php echo site_url('uji/kendaraan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Uji Kendaraan
								</a>

								<b class="arrow"></b>
							</li>
							
							<!--
							<li class="<?php if(isset($belum_uji)){echo $belum_uji ;}?>">
								<a href="<?php echo site_url('uji/pengujian')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pengujian
								</a>

								<b class="arrow"></b>
							</li>
							-->

							<li class="<?php if(isset($pengesahan_uji)){echo $pengesahan_uji ;}?>">
								<a href="<?php echo site_url('uji/pengesahan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pengesahan
								</a>

								<b class="arrow"></b>
							</li>
							
							<?php } ?>
							
							<li class="<?php if(isset($perbaikan_uji)){echo $perbaikan_uji ;}?>">
								<a href="<?php echo site_url('uji/perbaikan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Perbaikan
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($daftar_uji)){echo $daftar_uji ;}?>">
								<a href="<?php echo site_url('uji')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Rekap Pengujian
								</a>

								<b class="arrow"></b>
							</li>
							
							<?php if($admin || $petugas){ ?>
							<li class="<?php if(isset($daftar_pengujian)){echo $daftar_pengujian ;}?>">
								<a href="<?php echo site_url('uji/data')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Pengujian
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($daftar_rfid)){echo $daftar_rfid ;}?>">
								<a href="<?php echo site_url('uji/datarfid')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data RFID
								</a>

								<b class="arrow"></b>
							</li>
							
							<?php } if($admin || $penguji){ ?>
							<li class="<?php if(isset($penyerahan_berkas)){echo $penyerahan_berkas ;}?>">
								<a href="<?php echo site_url('uji/berkas')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Penyerahan Berkas
								</a>

								<b class="arrow"></b>
							</li>
							<?php } ?>
						</ul>
					</li>
					
					<?php } if($admin || $petugas){ ?>
					
					<li class="<?php if(isset($aktif_laporan)){echo $aktif_laporan ;}?> <?php if(isset($open_laporan)){echo $open_laporan ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-text"></i>
							<span class="menu-text"> Laporan </span>
							
							<b class="arrow fa fa-angle-down"></b>
						</a>
						
						<b class="arrow"></b>
						
						<ul class="submenu">
							<li class="<?php if(isset($aktif_laporan_pengujian)){echo $aktif_laporan_pengujian;}?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Pengujian
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								
								<ul class="submenu">
									<li class="<?php if(isset($aktif_uji_tka1)){echo $aktif_uji_tka1;}?>">
										<a href="<?php echo site_url('laporan/uji_tka1');?>">
											Uji Harian (TKA-1)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_pertama)){echo $aktif_uji_pertama ;}?>">
										<a href="<?php echo site_url('laporan/ujipertama');?>">
											KBWU Uji Pertama
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkb4)){echo $aktif_uji_tkb4 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkb4');?>">
											Jumlah Kendaraan Uji Mingguan (TKB4)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkb5)){echo $aktif_uji_tkb5 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkb5');?>">
											Jumlah Kendaraan Uji (TKB5)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkb7)){echo $aktif_uji_tkb7 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkb7');?>">
											Jumlah Kendaraan Uji JBB & Umur (TKB7)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkc2)){echo $aktif_uji_tkc2 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkc2');?>">
											Jumlah KBWU Uji Jenis & JBB (TKC2)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkc3)){echo $aktif_uji_tkc3 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkc3');?>">
											Jumlah KBWU Uji Jenis & Daya Angkut (TKC3)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkc4)){echo $aktif_uji_tkc4 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkc4');?>">
											Jumlah KBWU Uji Jenis & MST (TKC4)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkc5)){echo $aktif_uji_tkc5 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkc5');?>">
											Jumlah KBWU Uji Pertama (TKC5)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkc6)){echo $aktif_uji_tkc6 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkc6');?>">
											Jumlah KBWU (TKC6)
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_uji_tkc7)){echo $aktif_uji_tkc7 ;}?>">
										<a href="<?php echo site_url('laporan/uji_tkc7');?>">
											Jumlah KBWU Uji Penumpang (TKC7)
										</a>

										<b class="arrow"></b>
									</li>
									<!--
									
									<li class="<?php if(isset($aktif_laporan_pendaftaran_jenisuji)){echo $aktif_laporan_pendaftaran_jenisuji ;}?>">
										<a href="<?php echo site_url('laporan/pendaftaran_jenisuji');?>">
											Jenis Permohonan Uji
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_laporan_pendaftaran_jeniskendaraan)){echo $aktif_laporan_pendaftaran_jeniskendaraan ;}?>">
										<a href="<?php echo site_url('laporan/pendaftaran_jeniskendaraan');?>">
											Jenis Kendaraan
										</a>

										<b class="arrow"></b>
									</li>
									-->
								</ul>
							</li>
			
							<li class="<?php if(isset($aktif_laporan_retribusi)){echo $aktif_laporan_retribusi;}?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Retribusi
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								
								<ul class="submenu">
									<li class="<?php if(isset($aktif_retribusi_harian)){echo $aktif_retribusi_harian ;}?>">
										<a href="<?php echo site_url('laporan/retribusi')?>">
											Harian
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_retribusi_bulanan)){echo $aktif_retribusi_bulanan ;}?>">
										<a href="<?php echo site_url('laporan/retribusi_bulanan')?>">
											Bulanan
										</a>

										<b class="arrow"></b>
									</li>
									
									<li class="<?php if(isset($aktif_retribusi_tahunan)){echo $aktif_retribusi_tahunan ;}?>">
										<a href="<?php echo site_url('laporan/retribusi_tahunan')?>">
											Tahunan
										</a>

										<b class="arrow"></b>
									</li>
									
									<!--
									<li class="<?php if(isset($aktif_retribusi_jeniskendaraan)){echo $aktif_retribusi_jeniskendaraan;}?>">
										<a href="<?php echo site_url('laporan/retribusi_jeniskendaraan')?>">
											Jenis Kendaraan Bulanan
										</a>

										<b class="arrow"></b>
									</li>
									-->
								</ul>	
							</li>
							
							<li class="<?php if(isset($aktif_laporan_surat)){echo $aktif_laporan_surat;}?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Surat-Surat
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								
								<ul class="submenu">
									<li class="<?php if(isset($aktif_laporan_surat_keluar)){echo $aktif_laporan_surat_keluar ;}?>">
										<a href="<?php echo site_url('laporan/suratkeluar')?>">
											Surat Keluar
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							
							<li class="<?php if(isset($aktif_sts)){echo $aktif_sts ;}?>">
								<a href="<?php echo site_url('laporan/sts')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Setoran
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<?php } ?>
					
					<?php 
						if($admin || $petugas){ ?>
					<li class="<?php if(isset($aktif_barang)){echo $aktif_barang ;}?> <?php if(isset($open_barang)){echo $open_barang ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-shopping-cart "></i>
							<span class="menu-text"> Barang </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($pengeluaran_barang)){echo $pengeluaran_barang ;}?>">
								<a href="<?php echo site_url('barang/kendaraan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pengeluaran Barang
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($rekap_barang)){echo $rekap_barang ;}?>">
								<a href="<?php echo site_url('barang/rekap')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Rekap Pengeluaran
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<?php } ?>
					
					<?php 
					if($admin || $petugas){ ?>
					<li class="<?php if(isset($aktif_surat)){echo $aktif_surat ;}?> <?php if(isset($open_surat)){echo $open_surat ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-envelope-o"></i>
							<span class="menu-text"> Surat </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						
						<b class="arrow"></b>
						
						<ul class="submenu">
							<li class="<?php if(isset($surat_rekomendasi)){echo $surat_rekomendasi;}?>">
								<a href="<?php echo site_url('surat/rekomendasi')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Numpang & Mutasi
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($surat_sktl)){echo $surat_sktl;}?>">
								<a href="<?php echo site_url('surat/sktl')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Keterangan Tidak Lulus
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="<?php if(isset($aktif_persetujuan)){echo $aktif_persetujuan ;}?> <?php if(isset($open_persetujuan)){echo $open_persetujuan ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-check"></i>
							<span class="menu-text"> Persetujuan </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($persetujuan_hapus)){echo $persetujuan_hapus ;}?>">
								<a href="<?php echo site_url('kendaraan/approv_hapus')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Hapus Kendaraan
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<?php } if($admin){ ?>
					<li class="<?php if(isset($aktif_wagateway)){echo $aktif_wagateway ;}?> <?php if(isset($open_wagateway)){echo $open_wagateway ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-whatsapp"></i>
							<span class="menu-text"> WhatsApp Gateway </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						
						<b class="arrow"></b>
						
						<ul class="submenu">
							<li class="<?php if(isset($wagateway_inbox)){echo $wagateway_inbox;}?>">
								<a href="<?php echo site_url('wagateway/inbox')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pesan Masuk
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($wagateway_outbox)){echo $wagateway_outbox;}?>">
								<a href="<?php echo site_url('wagateway/outbox')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pesan Keluar
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($wagateway_crontab)){echo $wagateway_crontab;}?>">
								<a href="<?php echo site_url('wagateway/crontab')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Log Crontab
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<?php }  if($admin || $petugas){ ?>
					
					<li class="<?php if(isset($aktif_ikm)){echo $aktif_ikm ;}?> <?php if(isset($open_ikm)){echo $open_ikm ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bar-chart-o "></i>
							<span class="menu-text"> IKM </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($aktif_rekap_ikm)){echo $aktif_rekap_ikm ;}?>">
								<a href="<?php echo site_url('ikm/rekap')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Rekap IKM
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="<?php if(isset($aktif_master)){echo $aktif_master ;}?> <?php if(isset($open_master)){echo $open_master ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> Master </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<!--
							<li class="<?php if(isset($profile_pengguna)){echo $profile_pengguna ;}?>">
								<a href="<?php echo site_url('pengguna/profile')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Profile Pengguna
								</a>

								<b class="arrow"></b>
							</li>
							-->
							
							
							<li class="<?php if(isset($rekap_pemohon)){echo $rekap_pemohon ;}?>">
								<a href="<?php echo site_url('master/pemohon')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pemohon
								</a>

								<b class="arrow"></b>
							</li>	

							<li class="<?php if(isset($rekap_penguji)){echo $rekap_penguji ;}?>">
								<a href="<?php echo site_url('master/penguji')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Penguji
								</a>

								<b class="arrow"></b>
							</li>
							
							<?php } 
								if($admin){
							?>
							
							<li class="<?php if(isset($master_operator)){echo $master_operator ;}?>">
								<a href="<?php echo site_url('master/operator')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Operator
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($master_admin)){echo $master_admin ;}?>">
								<a href="<?php echo site_url('master/admin')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Admin
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($master_kendaraan)){echo $master_kendaraan ;}?>">
								<a href="<?php echo site_url('master/master_kendaraan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Master Kendaraan
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($master_retribusi)){echo $master_retribusi ;}?>">
								<a href="<?php echo site_url('master/tarif')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Retribusi
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($master_bahanbakar)){echo $master_bahanbakar ;}?>">
								<a href="<?php echo site_url('master/bahan_bakar')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Bahan Bakar
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($master_jeniskendaraan)){echo $master_jeniskendaraan ;}?>">
								<a href="<?php echo site_url('master/jenis_kendaraan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Jenis Kendaraan
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($master_pejabat)){echo $master_pejabat ;}?>">
								<a href="<?php echo site_url('master/pejabat')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pejabat
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($master_printer)){echo $master_printer ;}?>">
								<a href="<?php echo site_url('master/printer')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Master Printer
								</a>

								<b class="arrow"></b>
							</li>
							
							<!--
							<li class="<?php if(isset($master_desa)){echo $master_desa ;}?>">
								<a href="<?php echo site_url('master/desa')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Desa
								</a>

								<b class="arrow"></b>
							</li>
							-->
							
							<li class="<?php if(isset($master_kecamatan)){echo $master_kecamatan ;}?>">
								<a href="<?php echo site_url('master/kecamatan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kecamatan
								</a>

								<b class="arrow"></b>
							</li>
							
							<!--
							<li class="<?php if(isset($master_kabupaten)){echo $master_kabupaten ;}?>">
								<a href="<?php echo site_url('master/kabupaten')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kabupaten
								</a>

								<b class="arrow"></b>
							</li>
							-->
							
							<li class="<?php if(isset($master_kerusakan)){echo $master_kerusakan ;}?>">
								<a href="<?php echo site_url('master/kerusakan')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kerusakan
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<?php } ?>
					
					<?php if($admin){ ?>
					
					<li class="<?php if(isset($aktif_pengaturan)){echo $aktif_pengaturan ;}?> <?php if(isset($open_pengaturan)){echo $open_pengaturan ;}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog"></i>
							<span class="menu-text"> Pengaturan </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($pengaturan_umum)){echo $pengaturan_umum ;}?>">
								<a href="<?php echo site_url('setting/umum')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Umum
								</a>

								<b class="arrow"></b>
							</li>	

							<li class="<?php if(isset($pengaturan_wilayah)){echo $pengaturan_wilayah ;}?>">
								<a href="<?php echo site_url('setting/wilayah')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kode Wilayah
								</a>

								<b class="arrow"></b>
							</li>
							
							<?php } 
								if($admin){
							?>
							
							<li class="<?php if(isset($pengaturan_kadis)){echo $pengaturan_kadis ;}?>">
								<a href="<?php echo site_url('setting/kadis')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kepala  Dinas
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($ttd_surat)){echo $ttd_surat ;}?>">
								<a href="<?php echo site_url('setting/ttdsurat')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tanda Tangan Surat
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($pengaturan_harilibur)){echo $pengaturan_harilibur;}?>">
								<a href="<?php echo site_url('setting/harilibur')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Hari Libur
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php if(isset($pengaturan_informasi)){echo $pengaturan_informasi;}?>">
								<a href="<?php echo site_url('setting/informasi')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Informasi
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if(isset($pengaturan_wagateway)){echo $pengaturan_wagateway;}?>">
								<a href="<?php echo site_url('setting/wagateway')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									WhatsApp Gateway
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<?php } ?>
				</ul>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo site_url('')?>">Dashboard</a>
							</li>
						</ul>
						
						<span id="ct" class="pull-right"></span>
					</div>
					
					<?php if($penguji){ 
					$idpenguji = $this->session->userdata('id_penguji');
					$jmlpengesahan = $this->model_dashboard->getNotifPengesahan($idpenguji);
					if($jmlpengesahan > 0){ ?>
					<a href="<?php echo site_url('uji/pengesahan');?>">
						<div class="alert alert-danger text-center">
							<strong>Perhatian!!!</strong> <?php echo $jmlpengesahan;?> kendaraan belum pengesahan.
						</div>
					</a>
					<?php }} ?>