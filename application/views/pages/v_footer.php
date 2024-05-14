	<?php 
		$ci = &get_instance();
		$ci->load->model('model_beranda');
		
		$dt_setting = $this->model_beranda->getAllData('tbl_setting');
		foreach($dt_setting as $row){
			$footer = $row->dinas;
		}
	?>
				
	</div>
		</div>
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">SIMPKB</span>
							<?php echo ucwords($footer);?> &copy; <?php echo date("Y");?> 
							<span class="label label-warning">
								rilis 35 - 20201020
							</span>
						</span>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function display_c(){
				var refresh=10000; // Refresh rate in milli seconds
				mytime=setTimeout('display_ct()',refresh)
			}

			function display_ct(){
				var hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];
				var bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
				var today = new Date();
				var date = hari[today.getDay()]+', '+today.getDate()+' '+bulan[(today.getMonth())]+' '+today.getFullYear();
				var time = today.getHours() + ":" + today.getMinutes();
				var dateTime = date+' '+time;
				document.getElementById('ct').innerHTML = dateTime;
				tt=display_c();
			}
 
 
			jQuery(function($) {
				/*
				$('input').keyup(function(e){
					$(this).val($(this).val().toUpperCase());
				});
				
				$('textarea').keyup(function(e){
					$(this).val($(this).val().toUpperCase());
				});
				*/
				
				autosize($('textarea[class*=autosize]'));

				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max characters : %n.'
				});
				
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
				}
				
				$('#profile-feed-1').ace_scroll({
					height: '250px',
					mouseWheelLock: true,
					alwaysVisible : true
				});
				
				$('.dialogs,.comments').ace_scroll({
					size: 200
			    });
				
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				
				
				$('#foto1').ace_file_input({
					no_file:'Ambil foto ...',
					btn_choose:'Ambil',
					btn_change:'Ubah',
					droppable:true,
					onchange:null,
					thumbnail:true, //| true | large
				});
				
				
				$('#foto2').ace_file_input({
					no_file:'Ambil foto ...',
					btn_choose:'Ambil',
					btn_change:'Ubah',
					droppable:true,
					onchange:null,
					thumbnail:true, //| true | large
				});
				
				
				$('#foto3').ace_file_input({
					no_file:'Ambil foto ...',
					btn_choose:'Ambil',
					btn_change:'Ubah',
					droppable:true,
					onchange:null,
					thumbnail:true, //| true | large
				});
				
				
				$('#foto4').ace_file_input({
					no_file:'Ambil foto ...',
					btn_choose:'Ambil',
					btn_change:'Ubah',
					droppable:true,
					onchange:null,
					thumbnail:true, //| true | large
				});
				
				
				$('#id-input-file-2').ace_file_input({
					no_file:'Pilih berkas ...',
					btn_choose:'Pilih',
					btn_change:'Ubah',
					droppable:false,
					onchange:null,
					thumbnail:false, //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
					

				});
				 
				$('.select2').css('width','100%').select2({allowClear:true})
			});
		</script>
	</body>
</html>
