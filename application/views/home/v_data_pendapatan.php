<section class="nopadding">
	<div class="container">		
		<div class="row">
			<div class="col-md-12">
				<header class="text-center margin-bottom-40 margin-top-40">
					<h3 class="weight-300">DATA PENDAPATAN RETRIBUSI PENGUJIAN KENDARAAN BERMOTOR</h3>
					<h2 class="weight-200 letter-spacing-1 size-17"><span>DINAS PERHUBUNGAN KABUPATEN MADIUN</span></h2>
				</header>
			</div>
			
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading text-center">
						<h2 class="panel-title">RETRIBUSI BULAN <?php echo strtoupper(date("F Y"));?></h2>
					</div>
					<div class="panel-body">
						<div>
							<canvas class="chartjs" id="ChartRetribusiBulan" width="547" height="300"></canvas>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading text-center">
						<h2 class="panel-title">RETRIBUSI TAHUN <?php echo date("Y");?></h2>
					</div>
					<div class="panel-body">
						<div>
							<canvas class="chartjs" id="ChartRetribusiTahun" width="547" height="300"></canvas>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading text-center">
						<h2 class="panel-title">TARGET RETRIBUSI <?php echo date("Y");?></h2>
					</div>
					<div class="panel-body">
						<div class="row">
							<?php $no=1; if(isset($dt_target)){ foreach($dt_target as $row){ ?>
							<div class="col-md-3">
								<div class="text-center"><canvas class="chartjs" id="ChartTargetRetribusi<?php echo $no++;?>" width="547" height="300"></canvas></div>
								<hr/>
								<div class="panel panel-info">
									<div class="panel-heading text-center">
										<h6 class="panel-title"><?php echo strtoupper($row->kategori);?></h6>
									</div>
									<div class="panel-body">	
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td>TARGET</td>
													<td>Rp <?php echo number_format($row->target, 0, ".", ",");?></td>
												</tr>
												<tr>
													<td>REALISASI</td>
													<td>Rp <?php echo number_format($row->total, 0, ".", ",");?></td>
												</tr>
												<tr>
													<td>PERSENTASE</td>
													<td><?php $persen = $row->total/$row->target*100; echo round($persen,3);?>%</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							<?php }} if(isset($dt_target_total)){ foreach($dt_target_total as $row){ ?>
							<div class="col-md-3">
								<div class="text-center"><canvas class="chartjs" id="ChartTarget" width="547" height="300"></canvas></div>
								<hr/>
								<div class="panel panel-info">
									<div class="panel-heading text-center">
										<h6 class="panel-title">TARGET RETRIBUSI TAHUN <?php echo date("Y");?></h6>
									</div>
									<div class="panel-body">	
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td>TARGET</td>
													<td>Rp <?php echo number_format($row->target, 0, ".", ",");?></td>
												</tr>
												<tr>
													<td>REALISASI</td>
													<td>Rp <?php echo number_format($row->total, 0, ".", ",");?></td>
												</tr>
												<tr>
													<td>PERSENTASE</td>
													<td><?php $persen = $row->total/$row->target*100; echo round($persen,3);?>%</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							<?php }} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

