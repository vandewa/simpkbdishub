<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title;?></title>
		<meta name="keywords" content="SIM PKB, Sistem Informasi Pengujian Kendaraan Bermotor, Wonosobo, Simpkb wonobsoso, kabupaten wonosobo" />
		<meta name="description" content="Sistem Informasi Pengujian Kendaraan Bermotor Dinas Perhubungan Kabupaten Wonosobo" />
		<meta name="Author" content="Dishub Kab Wonosobo" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<!-- WEB FONTS : use %7C instead of | (pipe) -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="<?php echo base_url('assets/home/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />

		<!-- REVOLUTION SLIDER -->
		<link href="<?php echo base_url('assets/home/plugins/slider.revolution/css/extralayers.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/home/plugins/slider.revolution/css/settings.css')?>" rel="stylesheet" type="text/css" />

		<!-- THEME CSS -->
		<link href="<?php echo base_url('assets/home/css/essentials.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/home/css/layout.css')?>" rel="stylesheet" type="text/css" />

		<!-- PAGE LEVEL SCRIPTS -->
		<link href="<?php echo base_url('assets/home/css/header-6.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/home/css/color_scheme/blue.css')?>" rel="stylesheet" type="text/css" id="color_scheme" />
		
	</head>

	<body class="smoothscroll enable-animation boxed pattern11">
		<!-- wrapper -->
		<div id="wrapper">
			<div id="header" class="header-md sticky clearfix">

				<!-- TOP NAV -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!-- Logo -->
						<a class="logo pull-left" href="<?php echo site_url('');?>">
							<img src="<?php echo base_url('assets/home/images/simpkb.png')?>" alt="" />
						</a>

						<!-- 
							Top Nav 
							
							AVAILABLE CLASSES:
							submenu-dark = dark sub menu
						-->
						<div class="navbar-collapse pull-right nav-main-collapse collapse ">
							<nav class="nav-main">
								<ul id="topMain" class="nav nav-pills nav-main">
									<li class="<?php if(isset($aktif_beranda)){echo $aktif_beranda ;}?>">
										<a href="<?php echo site_url('beranda')?>">
											BERANDA
										</a>
									</li>
									
									<li class="<?php if(isset($aktif_info)){echo $aktif_info ;}?>">
										<a href="<?php echo site_url('app')?>">
											APLIKASI
										</a>
									</li>
									
									<li class="<?php if(isset($aktif_daftar)){echo $aktif_daftar ;}?>">
										<a href="<?php echo site_url('bookingonline')?>">
											PENDAFTARAN ONLINE
										</a>
									</li>
									
									<li class="<?php if(isset($aktif_info)){echo $aktif_info ;}?>">
										<a href="<?php echo site_url('info/pendaftaran')?>">
											INFO PELAYANAN
										</a>
									</li>
									
									<li class="<?php if(isset($aktif_tarif)){echo $aktif_tarif ;}?>">
										<a href="<?php echo site_url('info/retribusi')?>">
											TARIF PENGUJIAN
										</a>
									</li>
									
									<!--
									<li class="<?php if(isset($aktif_data)){echo $aktif_data ;}?>">
										<a href="<?php echo site_url('beranda/data');?>">
											DATA PENDAPATAN
										</a>
									</li>
									-->
									<?php if($this->session->userdata('login') != '1'){; ?>
									<li>
										<a href="<?php echo site_url('auth')?>">
											LOGIN
										</a>
									</li>
									<?php } else { ?>
									<li>
										<a href="<?php echo site_url('dashboard')?>">
											DASHBOARD
										</a>
									</li>
									<?php } ?>
								</ul>
							</nav>
						</div>

					</div>
				</header>
				<!-- /Top Nav -->

			</div>