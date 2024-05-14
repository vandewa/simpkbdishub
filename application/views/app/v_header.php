<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title;?></title>

	<meta name="description" content="Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Wonosobo">
	<meta name="author" content="duamedia">
	<meta name="robots" content="noindex, nofollow">

	<!-- Open Graph Meta -->
	<meta property="og:title" content="Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Wonosobo">
	<meta property="og:site_name" content="SIMPKB">
	<meta property="og:description" content="Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Wonosobo">
	<meta property="og:type" content="website">
	<meta property="og:url" content="">
	<meta property="og:image" content="">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/bootstrap_limitless.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/layout.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/components.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/app/css/colors.min.css');?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo base_url('assets/app/js/main/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/main/bootstrap.bundle.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/loaders/blockui.min.js');?>"></script>
	
	<!-- /core JS files -->

	<!-- Theme JS files -->
	
	<script src="<?php echo base_url('assets/app/js/plugins/forms/wizards/steps.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/extensions/jquery_ui/widgets.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/extensions/jquery_ui/interactions.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/forms/selects/select2.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/forms/styling/uniform.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/ui/moment/moment.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/pickers/daterangepicker.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/pickers/pickadate/picker.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/pickers/pickadate/picker.date.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/ui/perfect_scrollbar.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/tables/datatables/datatables.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/forms/validation/validate.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/media/fancybox.min.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/plugins/visualization/echarts/echarts.min.js');?>"></script>
	
	<script src="<?php echo base_url('assets/app/js/app.js');?>"></script>
	<script src="<?php echo base_url('assets/app/js/custom.js');?>"></script>
	
	<!-- /theme JS files -->
</head>

<body class="navbar-top <?php if(isset($sidebar)){echo $sidebar;}?>">

	<!-- Main navbar -->
	<div class="navbar navbar-dark bg-primary navbar-expand-md fixed-top">
		<div class="navbar-brand">
			<a href="<?php echo site_url('app');?>" class="d-inline-block">
				<img src="<?php echo base_url('assets/app/images/logo.png');?>" alt="">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		
		<?php if($this->session->userdata('login') == '1'){; ?>
		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url('assets/app/images/image.png');?>" class="rounded-circle" alt="">
						<span><?php echo $this->session->userdata('nama');?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<div class="dropdown-divider"></div>
						<a href="<?php echo site_url('logout');?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>
			</ul>
		</div>
		<?php } ?>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-light sidebar-main sidebar-expand-md sidebar-fixed">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigasi Menu
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="<?php echo base_url('assets/app/images/image.png');?>" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold"><?php if($this->session->userdata('login') == '1'){ echo mb_substr($this->session->userdata('nama'),0,15); } else { ?>DINAS PERHUBUNGAN<?php } ?></div>
								<div class="font-size-xs opacity-70">
									<i class="icon-pin font-size-sm"></i> <?php if($this->session->userdata('login') == '1'){ echo $this->session->userdata('bidang'); } else { ?>KABUPATEN WONOSOBO<?php } ?>
								</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item">
							<a href="<?php echo site_url('');?>" class="nav-link">
								<i class="icon-home4"></i>
								<span>Beranda</span>
							</a>
						</li>
						
						<li class="nav-item">
							<a href="<?php echo site_url('app');?>" class="nav-link <?php if(isset($aktif_dashboard)){echo $aktif_dashboard;}?>">
								<i class="icon-stats-bars"></i>
								<span>Dashboard</span>
							</a>
						</li>
						
						<li class="nav-item">
							<a href="<?php echo site_url('bookingonline');?>" class="nav-link <?php if(isset($aktif_daftar)){echo $aktif_daftar;}?>">
								<i class="icon-file-text2"></i>
								<span>Pendaftaran</span>
							</a>
						</li>
						
						<!--
						<li class="nav-item nav-item-submenu <?php if(isset($open_pembayaran)){echo $open_pembayaran;}?>">
							<a href="#" class="nav-link"><i class="icon-cash"></i> <span>Pembayaran</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Pembayaran">
								<li class="nav-item"><a href="<?php echo site_url('app/petunjukpembayaran');?>" class="nav-link <?php if(isset($aktif_petunjukpembayaran)){echo $aktif_petunjukpembayaran;}?>">Petunjuk Pembayaran</a></li>
							</ul>
						</li>
						-->
						
						<li class="nav-item nav-item-submenu <?php if(isset($open_ikm)){echo $open_ikm;}?>">
							<a href="#" class="nav-link"><i class="icon-statistics"></i> <span>IKM</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Indeks Kepuasan Masyarat">
								<li class="nav-item"><a href="<?php echo site_url('formikm');?>" class="nav-link <?php if(isset($aktif_formikm)){echo $aktif_formikm;}?>">Formulir IKM</a></li>
								<li class="nav-item"><a href="<?php echo site_url('surveyikm');?>" class="nav-link <?php if(isset($aktif_surveyikm)){echo $aktif_surveyikm;}?>">Hasil Survey IKM</a></li>
							</ul>
						</li>
						
						<li class="nav-item">
							<a href="<?php echo site_url('app/hasiluji');?>" class="nav-link <?php if(isset($aktif_hasiluji)){echo $aktif_hasiluji;}?>">
								<i class="icon-magazine"></i>
								<span>Hasil Uji</span>
							</a>
						</li>
						<!-- /main -->
					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<?php if($header!="Peta"){ ?>
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo strtoupper($header);?></span> - <?php echo strtoupper($headertitle);?></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- /page header -->