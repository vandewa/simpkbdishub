<?php
	$ci = &get_instance();
	$ci->load->model('model_beranda','model');
	$jml_uji = $this->model->getUjiToday();
	$jml_uji_total = $this->model->getUjiTotal();
	$ret_total = $this->model->getRetribusiTotal();
	$ret_today = $this->model->getRetribusiToday();
?>

<div class="content">
	<div class="row">
		<div class="col-sm-6 col-md-3">
			<div class="card card-body bg-primary has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?php foreach($ret_today as $row) { echo number_format($row->total, 0, ",", "."); }?></h3>
						<span class="text-uppercase font-size-xs">RETRIBUSI HARI INI</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-cash icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-md-3">
			<div class="card card-body bg-info has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?php foreach($jml_uji as $row) { echo $row->uji; }?></h3>
						<span class="text-uppercase font-size-xs">UJI HARI INI</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-truck icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-md-3">
			<div class="card card-body bg-indigo has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?php foreach($ret_total as $row) { echo number_format($row->total, 0, ",", "."); }?></h3>
						<span class="text-uppercase font-size-xs">RETRIBUSI TOTAL</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-cash3 icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-md-3">
			<div class="card card-body bg-slate has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?php foreach($jml_uji_total as $row) { echo $row->uji; }?></h3>
						<span class="text-uppercase font-size-xs">UJI TOTAL</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-truck icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<div class="card border-primary">
				<div class="card-header bg-primary text-white header-elements-inline">
					<h6 class="card-title"><i class="icon-statistics mr-2"></i>RETRIBUSI PERHARI</h6>
					<div class="header-elements">
						<div class="list-icons">
							<a class="list-icons-item" data-action="collapse"></a>
							<a class="list-icons-item" data-action="reload"></a>
							<a class="list-icons-item" data-action="remove"></a>
						</div>
					</div>
				</div>

				<div class="card-body">
					<div class="chart-container">
						<div class="chart has-fixed-height" id="retribusi_harian"></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="card border-primary">
				<div class="card-header bg-primary text-white header-elements-inline">
					<h6 class="card-title"><i class="icon-chart mr-2"></i>RETRIBUSI PERBULAN</h6>
					<div class="header-elements">
						<div class="list-icons">
							<a class="list-icons-item" data-action="collapse"></a>
							<a class="list-icons-item" data-action="reload"></a>
							<a class="list-icons-item" data-action="remove"></a>
						</div>
					</div>
				</div>

				<div class="card-body">
					<div class="chart-container">
						<div class="chart has-fixed-height" id="retribusi_bulanan"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--
	<div class="row">
		<div class="col-md-6">
			<div class="card border-primary">
				<div class="card-header bg-primary text-white header-elements-inline">
					<h6 class="card-title"><i class="icon-truck mr-2"></i>KENDARAAN UJI PERHARI</h6>
					<div class="header-elements">
						<div class="list-icons">
							<a class="list-icons-item" data-action="collapse"></a>
							<a class="list-icons-item" data-action="reload"></a>
							<a class="list-icons-item" data-action="remove"></a>
						</div>
					</div>
				</div>

				<div class="card-body">
					<div class="chart-container">
						<div class="chart has-fixed-height" id="kendaraan_harian"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	-->
</div>

<script>
var EchartsAreas = function() {
    var _areaChartExamples = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        // Define charts elements
        var grafik_retribusi_harian = document.getElementById('retribusi_harian');
		var grafik_retribusi_bulanan = document.getElementById('retribusi_bulanan');
		var grafik_kendaraan_harian = document.getElementById('kendaraan_harian');

        // Bar chart
        if (grafik_retribusi_harian) {

            // Initialize chart
            var area_basic = echarts.init(grafik_retribusi_harian);
                
			area_basic.setOption({

				// Define colors
				color: ['#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80'],

				// Global text styles
				textStyle: {
					fontFamily: 'Roboto, Arial, Verdana, sans-serif',
					fontSize: 13
				},

				// Chart animation duration
				animationDuration: 2000,

				// Setup grid
				grid: {
					left: 0,
					right: 40,
					top: 35,
					bottom: 0,
					containLabel: true
				},

				// Add legend
				legend: {
					data: ['Retribusi'],
					itemHeight: 8,
					itemGap: 20
				},

				// Add tooltip
				tooltip: {
					trigger: 'axis',
					backgroundColor: 'rgba(0,0,0,0.75)',
					padding: [10, 15],
					textStyle: {
						fontSize: 13,
						fontFamily: 'Roboto, sans-serif'
					}
				},

				// Horizontal axis
				xAxis: [{
					type: 'category',
					boundaryGap: false,
					data: [<?php foreach($dt_grafik as $row){ echo $tgl = "'".strftime("%d %B %Y", strtotime($row->tgl_pembayaran))."',"; }?>],
					axisLabel: {
						color: '#333'
					},
					axisLine: {
						lineStyle: {
							color: '#999'
						}
					},
					splitLine: {
						show: true,
						lineStyle: {
							color: '#eee',
							type: 'dashed'
						}
					}
				}],

				// Vertical axis
				yAxis: [{
					type: 'value',
					axisLabel: {
						color: '#333'
					},
					axisLine: {
						lineStyle: {
							color: '#999'
						}
					},
					splitLine: {
						lineStyle: {
							color: '#eee'
						}
					},
					splitArea: {
						show: true,
						areaStyle: {
							color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
						}
					}
				}],

				// Add series
				series: [
					{
						name: 'Retribusi',
						type: 'line',
						data: [<?php foreach($dt_grafik as $row){ echo $row->total.','; }?>],
						areaStyle: {
							normal: {
								opacity: 0.25
							}
						},
						smooth: true,
						symbolSize: 7,
						itemStyle: {
							normal: {
								borderWidth: 2
							}
						}
					},
				]
			});
        }
		
		// Bar chart
        if (grafik_retribusi_bulanan) {

            // Initialize chart
            var area_basic = echarts.init(grafik_retribusi_bulanan);
                
			area_basic.setOption({

				// Define colors
				color: ['#EC407A'],

				// Global text styles
				textStyle: {
					fontFamily: 'Roboto, Arial, Verdana, sans-serif',
					fontSize: 13
				},

				// Chart animation duration
				animationDuration: 2000,

				// Setup grid
				grid: {
					left: 0,
					right: 40,
					top: 35,
					bottom: 0,
					containLabel: true
				},

				// Add legend
				legend: {
					data: ['Retribusi'],
					itemHeight: 8,
					itemGap: 20
				},

				// Add tooltip
				tooltip: {
					trigger: 'axis',
					backgroundColor: 'rgba(0,0,0,0.75)',
					padding: [10, 15],
					textStyle: {
						fontSize: 13,
						fontFamily: 'Roboto, sans-serif'
					}
				},

				// Horizontal axis
				xAxis: [{
					type: 'category',
					boundaryGap: false,
					data: [<?php foreach($dt_retribusi_tahun as $row){ echo $tgl = "'".strftime("%B", strtotime($row->tgl_pembayaran))."',"; }?>],
					axisLabel: {
						color: '#333'
					},
					axisLine: {
						lineStyle: {
							color: '#999'
						}
					},
					splitLine: {
						show: true,
						lineStyle: {
							color: '#eee',
							type: 'dashed'
						}
					}
				}],

				// Vertical axis
				yAxis: [{
					type: 'value',
					axisLabel: {
						color: '#333'
					},
					axisLine: {
						lineStyle: {
							color: '#999'
						}
					},
					splitLine: {
						lineStyle: {
							color: '#eee'
						}
					},
					splitArea: {
						show: true,
						areaStyle: {
							color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
						}
					}
				}],

				// Add series
				series: [
					{
						name: 'Retribusi',
						type: 'line',
						data: [<?php foreach($dt_retribusi_tahun as $row){ echo $row->total.','; }?>],
						areaStyle: {
							normal: {
								opacity: 0.25
							}
						},
						smooth: true,
						symbolSize: 7,
						itemStyle: {
							normal: {
								borderWidth: 2
							}
						},
					},
				]
			});
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _areaChartExamples();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
	EchartsAreas.init();
});
</script>