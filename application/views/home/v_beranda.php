<!-- REVOLUTION SLIDER -->
<div class="slider fullwidthbanner-container roundedcorners">
	<div class="fullwidthbanner" data-height="300" data-shadow="0" data-navigationStyle="preview2">
		<ul class="hide">

			<!-- SLIDE  -->
			<li data-transition="random" data-slotamount="1" data-masterspeed="1000" data-delay="5000" data-saveperformance="off" data-title="Slide 1">
				<img src="<?php echo base_url('assets/images/1x1.png')?>" data-lazyload="<?php echo base_url('assets/home/images/slider/slider1.jpg')?>" alt="" data-bgfit="cover" data-bgrepeat="no-repeat" />
			</li>
			
			<li data-transition="random" data-slotamount="1" data-masterspeed="1000" data-delay="5000" data-saveperformance="off" data-title="Slide 2">
				<img src="<?php echo base_url('assets/images/1x1.png')?>" data-lazyload="<?php echo base_url('assets/home/images/slider/slider2.jpg')?>" alt="" data-bgfit="cover" data-bgrepeat="no-repeat" />
			</li>		
			
			<li data-transition="random" data-slotamount="1" data-masterspeed="1000" data-delay="5000" data-saveperformance="off" data-title="Slide 2">
				<img src="<?php echo base_url('assets/images/1x1.png')?>" data-lazyload="<?php echo base_url('assets/home/images/slider/slider3.jpg')?>" alt="" data-bgfit="cover" data-bgrepeat="no-repeat" />
			</li>	
		</ul>

		<div class="tp-bannertimer"><!-- progress bar --></div>
	</div>
</div>
<!-- /REVOLUTION SLIDER -->

<section class="nopadding">
	<div class="container">		
		<div class="row">
			<div class="col-md-8">

				<header class="text-center margin-bottom-20 margin-top-20">
					<h2 class="weight-300">PENDAPATAN RETRIBUSI KABUPATEN WONOSOBO</h2>
					<h2 class="weight-200 letter-spacing-1 size-13"><span>PELAYANAN PENGUJIAN KENDARAAN BERMOTOR</span></h2>
				</header>
				
				<div>
					<canvas class="chartjs" id="barChartCanvas" width="547" height="300"></canvas>
				</div>
			</div>
			
			<div class="col-md-4">
				<header class="text-center margin-bottom-20 margin-top-20">
					<h2 class="weight-300">CEK DATA KENDARAAN</h2>
					<h2 class="weight-200 letter-spacing-1 size-13"><span>KENDARAAN WAJIB UJI KABUPATEN WONOSOBO</span></h2>
				</header>
				
				<form role="form" action="<?php echo site_url('cekkendaraan')?>" method="post" id="search-form">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<div class="input-group">
						<input type="text" placeholder="Masukan nomor uji/ nomor kendaraan" name="no_uji" id="no_uji" class="form-control" required />
						<span class="input-group-btn">
							<button type="submit" class="btn btn-info">
								<span class="fa fa-search"></span>
								Cari
							</button>
						</span>
					</div>
					<label class="text-muted block">Contoh : AA-1492-AP / WS1234</label>
				</form>
				
				<div id="formcari"></div>
			</div>
		</div>
	</div>
</section>

