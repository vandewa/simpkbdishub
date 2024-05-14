<?php 
	$grafik_pie = array("usia","jenis_kelamin","pendidikan","pekerjaan");
	$grafik_column = array("kesesuaian","kemudahan","kecepatan","sistem","kompetensi","kesopanan","sarana");
?>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card border-primary">
				<div class="card-header bg-primary text-white header-elements-inline">
					<h6 class="card-title"><i class="icon-statistics mr-2"></i>GRAFIK SURVEY KEPUASAN MASYARAKAT</h6>
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
						<div class="row">
						<?php for($b=0;$b<4; $b++) { ?>
							<div class="col-md-6">
								<div class="chart has-fixed-height" id="grafik_ikm_<?php echo $grafik_pie[$b];?>"></div>
							</div>
						<?php } ?>
						</div>
					</div>
					
					<div class="chart-container">
						<div class="chart has-fixed-height" id="grafik_ikm_column"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var EchartsColumnsWaterfalls = function() {
	
    var _columnsWaterfallsExamples = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        // Define charts elements
		<?php for($b=0;$b<4; $b++) { ?>
		var pie_basic_<?php echo $grafik_pie[$b];?> = document.getElementById('grafik_ikm_<?php echo $grafik_pie[$b];?>');
		<?php } ?>
        var columns_basic_element = document.getElementById('grafik_ikm_column');
		
		<?php for($b=0;$b<4; $b++) { ?>
		if (pie_basic_<?php echo $grafik_pie[$b];?>) {

            // Initialize chart
            var pie_<?php echo $grafik_pie[$b];?> = echarts.init(pie_basic_<?php echo $grafik_pie[$b];?>);
			
            // Options
            pie_<?php echo $grafik_pie[$b];?>.setOption({

                // Colors
                color: [
                    '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
                    '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
                    '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                    '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Add title
                title: {
                    text: '<?php echo ucfirst($grafik_pie[$b]);?>',
                    subtext: 'Grafik Survei <?php echo ucfirst($grafik_pie[$b]);?>',
                    left: 'center',
                    textStyle: {
                        fontSize: 17,
                        fontWeight: 500
                    },
                    subtextStyle: {
                        fontSize: 12
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    top: 'center',
                    left: 0,
                    data: ['IE', 'Opera', 'Safari', 'Firefox', 'Chrome'],
                    itemHeight: 8,
                    itemWidth: 8
                },

                // Add series
                series: [{
                    name: '<?php echo ucfirst($grafik_pie[$b]);?>',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 1,
                            borderColor: '#fff'
                        }
                    },
                    data: [
						<?php 
						$jenis = $grafik_pie[$b];
						$pie[$b] = $this->model->getPieChartIKM($jenis);
						foreach($pie[$b] as $row){ ?>
                        {value: <?php echo $row->jumlah;?>, name: '<?php echo $row->jenis;?>'},
						<?php } ?>
                    ]
                }]
            });
        }
		<?php } ?>
		
		if (columns_basic_element) {

            // Initialize chart
            var columns_basic = echarts.init(columns_basic_element);


            //
            // Chart config
            //

            // Options
            columns_basic.setOption({

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
                    data: [<?php for($a=0;$a<7; $a++) { echo "'".ucfirst($grafik_column[$a])."',"; }?>],
                    itemHeight: 8,
                    itemGap: 20,
                    textStyle: {
                        padding: [0, 5]
                    }
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
                    data: ['HASIL SURVEY KEPUASAN MASYARAKAT'],
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
                            color: ['#eee']
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
					<?php for($a=0;$a<7; $a++) {
					$jenis = $grafik_column[$a];
					$total[$a] = $this->model->getColumnChartIKM($jenis);
					foreach($total[$a] as $row){ $data = $row->$jenis; }?>
					{ 
						name: <?php echo "'".ucfirst($grafik_column[$a])."'";?>,
                        type: 'bar',
                        data: [<?php echo $data;?>],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        },
                        markLine: {
                            data: [{type: 'average', name: 'Average'}]
                        }
                    },
					<?php } ?>
                ]
            });
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _columnsWaterfallsExamples();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    EchartsColumnsWaterfalls.init();
});
</script>