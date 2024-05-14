			<!-- FOOTER -->
			<footer id="footer">
				<div class="copyright">
					<div class="container">
						Copyright &copy; <?php echo date("Y");?>. SIMPKB Dinas Perhubungan Kabupaten Wonosobo
					</div>
				</div>
			</footer>
			<!-- /FOOTER -->
		</div>
		<!-- /wrapper -->


		<!-- SCROLL TO TOP -->
		<a href="#" id="toTop"></a>


		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/home/plugins')?>/';</script>
		<script type="text/javascript" src="<?php echo base_url('assets/home/plugins/jquery/jquery-2.1.4.min.js')?>"></script>

		<script type="text/javascript" src="<?php echo base_url('assets/home/js/scripts.js')?>"></script>

		<!-- REVOLUTION SLIDER -->
		<script type="text/javascript" src="<?php echo base_url('assets/home/plugins/slider.revolution/js/jquery.themepunch.tools.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/home/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/home/js/view/demo.revolution_slider.js')?>"></script>

		
		<script type="text/javascript">
			loadScript(plugin_path + 'chart.chartjs/Chart.min.js', function() {
				<?php if(isset($dt_grafik)){ ?>
				var barChartCanvas = {
					labels:[<?php foreach($dt_grafik as $row){ echo $tgl = '"'.date("d M Y",strtotime($row->tgl_pembayaran)).'",'; } //echo rtrim($tgl,","); ?>],
					datasets:[
						{
							fillColor : "rgba(51,51,255,0.2)",
							strokeColor : "rgba(51,153,255,,1)",
							pointColor : "rgba(51,51,255,1)",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(51,153,255,1)",
							data : [<?php foreach($dt_grafik as $row){ echo $row->total.','; }?>]
						},
						
						{
							fillColor : "rgba(151,187,205,0.2)",
							strokeColor : "rgba(151,187,205,1)",
							pointColor : "rgba(151,187,205,1)",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(151,187,205,1)",
							data : [<?php foreach($dt_grafik as $row){ echo $row->jumlah.','; }?>]
						}
					]
				};
				var ct = document.getElementById("barChartCanvas").getContext("2d");
				new Chart(ct).Line(barChartCanvas);
				<?php } ?>
			});
			
			$('#search-form').submit(function(e) {
				e.preventDefault();
				$.ajax({
					type:$(this).attr('method'),
					url:$(this).attr('action'),
					data:$(this).serialize(),
					success:function(data){
						$('#formcari').html(data)
					}
				});
			});
			
			jQuery(function($) {
				$(document).ready(function() {
					$('input').keyup(function(e){
						$(this).val($(this).val().toUpperCase());
					});
				});
			});
		</script>
	</body>
</html>