<div class="content">
	<div class="card bg-primary-400 text-white text-center p-3" style="background-image: url(<?php echo base_url('assets/images/backgrounds/panel_bg.png');?>); background-size: contain;">
		<div>
			<a href="#" class="btn btn-lg btn-icon mb-3 mt-1 btn-outline text-white border-white bg-white rounded-round border-2">
				<i class="icon-quotes-right"></i>
			</a>
		</div>

		<blockquote class="blockquote mb-0">
			<p>"Hai <?php echo $this->session->flashdata('sukses');?>, Terima kasih telah mengisi kuesioner kepuasan masyarakat Pelayanan Uji Berkala Kendaraan Bermotor Dinas Perhubungan Kabupaten Wonosobo"</p>
			<footer class="blockquote-footer text-white">
				<span>
					Tetap patuhi peraturan lalu lintas.<cite title="Source Title">#SalamKeselamatan</cite>
				</span>
			</footer>
		</blockquote>
	</div>
	
	<div class="row">
		<div class="col-lg-12 text-center">
			<a href="<?php echo site_url('surveyikm');?>">
				<button type="button" class="btn btn-info btn-labeled btn-labeled-left btn-lg"><b><i class="icon-statistics"></i></b> LIHAT HASIL IKM</button>
			</a>
			
			<a href="<?php echo site_url('formikm');?>">
				<button type="button" class="btn btn-warning btn-labeled btn-labeled-left btn-lg"><b><i class="icon-statistics"></i></b> ISI KUESIONER IKM</button>
			</a>
		</div>
	</div>
</div>