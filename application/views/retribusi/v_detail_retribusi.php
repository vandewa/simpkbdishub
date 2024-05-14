<div class="space-6"></div>

<?php
if(isset($detail_pembayaran)){
    foreach($detail_pembayaran as $row){
        ?>

<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-large">
				<h3 class="widget-title grey lighter">
					<i class="ace-icon fa fa-leaf blue"></i>
					Detail Pembayaran Retribusi
				</h3>
				
				<div class="widget-toolbar no-border invoice-info">
					<span class="invoice-info-label">Nomor:</span>
					<span class="red"><?php echo $row->id_retribusi;?></span>

					<br />
					<span class="invoice-info-label">Tanggal:</span>
					<span class="blue"><?php echo $row->tgl_pembayaran;?></span>
				</div>

				<div class="widget-toolbar hidden-480">
					<a href="#">
						<i class="ace-icon fa fa-print"></i>
					</a>
				</div>

				<!-- /section:pages/invoice.info -->
			</div>

			<div class="widget-body">
				<div class="widget-main padding-24">
					<div class="row">
						<div class="col-sm-6">
							<div class="row">
								<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
									<b>Informasi Pemilik</b>
								</div>
							</div>

							<div>
								<ul class="list-unstyled spaced">
									<li>
										<i class="ace-icon fa fa-caret-right blue"></i><?php echo $row->nama;?>
									</li>

									<li>
										<i class="ace-icon fa fa-caret-right blue"></i><?php echo $row->alamat;?>
									</li>
									
									<li>
										<i class="ace-icon fa fa-caret-right blue"></i><?php echo $row->kecamatan;?>
									</li>

									<li>
										<i class="ace-icon fa fa-caret-right blue"></i><?php echo $row->telp;?>
									</li>
								</ul>
							</div>
						</div><!-- /.col -->

						<div class="col-sm-6">
							<div class="row">
								<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
									<b>Informasi Kendaraan</b>
								</div>
							</div>

							<div>
								<ul class="list-unstyled  spaced">
									<li>
										<i class="ace-icon fa fa-caret-right green"></i><b class="blue"><?php echo $row->no_uji;?></b>
									</li>

									<li>
										<i class="ace-icon fa fa-caret-right green"></i><?php echo $row->no_kendaraan;?>
									</li>

									<li>
										<i class="ace-icon fa fa-caret-right green"></i><?php echo $row->merek;?> / <?php echo $row->tipe;?>
									</li>

									<li>
										<i class="ace-icon fa fa-caret-right green"></i><?php echo $row->jenis;?>
									</li>
								</ul>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
    <?php
    }
}
?>

					<div class="space"></div>

					<div>
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="center">No</th>
									<th class="center">Kode Retribusi</th>
									<th>Jenis Retribusi</th>
									<th class="hidden-480">Sifat</th>
									<th>Retribusi</th>
									<th class="center">Qty</th>
									<th>Sub Total</th>
								</tr>
							</thead>
							
							<tbody>
							
							<?php
							$no=1;
							if(isset($retribusi_detail)){
								foreach($retribusi_detail as $row ){
								?>
								<tr>
									<td class="center"><?php echo $no++;?></td>
									<td class="center"><?php echo $row->kd_tarif;?></td>
									<td class=""><?php echo $row->jenis;?></td>
									<td class="hidden-480"><?php echo $row->sifat;?></td>
									<?php
										$tarif = $row->tarif;
										$qty = $row->qty;
										$subtotal = $tarif*$qty;
									?>
									<td>Rp. <?php echo $this->cart->format_number($tarif);?></td>
									<td class="center"><?php echo $qty;?></td>
									<td>Rp. <?php echo $this->cart->format_number($subtotal);?></td>
								</tr>
								<?php }
									}
								?>
								
							</tbody>
						</table>
					</div>

					<div class="hr hr8 hr-double hr-dotted"></div>
					<?php
					if(isset($detail_pembayaran)){
						foreach($detail_pembayaran as $row){
							?>
					<div class="row">
						<div class="col-sm-5 pull-right">
							<h4 class="pull-right">
								Total Pembayaran :
								<span class="red">Rp. <?php echo $this->cart->format_number($row->total_retribusi);?></span>
							</h4>
						</div>
						<div class="col-sm-7 pull-left"></div>
					</div>
					<?php }
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>


