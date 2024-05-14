<div class="page-content">
	
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h1>
					Pembayaran Retribusi
				</h1>
			</div>
		</div>
	</div>
	<?php 
	if(isset($detail_proses_pembayaran)){
		foreach($detail_proses_pembayaran as $row){
		?>
	<form class="form-horizontal" role="form" action="<?php echo site_url('retribusi/simpan_retribusi')?>" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		
		
		<div class="row">
			<div class="col-xs-12 col-sm-10" align="right">
				<div class="form-group">
				</div>
			</div>
			<div class="col-xs-12 col-sm-2" align="right">
				<input type="text" id="tgl_retribusi" name="tgl_retribusi" value="<?php echo unix_to_human($now);?>" class="col-xs-12" readonly />
			</div>
		</div>
		
		<div class="space space-8"></div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				
				<input type="hidden" name="kode_uji" id="kode_uji" value="<?php echo $row->kode_uji;?>"/>
				<input type="hidden" name="id_log_barang" id="id_log_barang" value="LOG-<?php echo $now; ?>">
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> No Retribusi </label>
					<div class="col-sm-9">
						<input type="text" id="id_retribusi" name="id_retribusi" value="<?php echo $row->id_retribusi;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Nomor Kendaraan </label>
					<div class="col-sm-9">
						<input type="text" id="no_kendaraan" name="no_kendaraan" value="<?php echo $row->no_kendaraan;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Jenis Kendaraan </label>
					<div class="col-sm-9">
						<input type="text" id="jenis_kendaraan" name="jenis_kendaraan" value="<?php echo $row->jenis;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Jenis Uji </label>
					<div class="col-sm-9">
						<input type="text" id="jenis_uji" name="jenis_uji" value="<?php echo $row->jenis_uji;?>" class="col-xs-12" readonly />
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Nomor Pengujian </label>
					<div class="col-sm-9">
						<input type="text" id="no_uji" name="no_uji" value="<?php echo $row->no_uji;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Nama Pemilik </label>
					<div class="col-sm-9">
						<input type="text" id="nama" name="nama" value="<?php echo $row->nama;?>" class="col-xs-12" readonly />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left"> Jenis Retribusi </label>
					<div class="col-sm-9">
						<input type="text" id="jenis_retribusi" name="jenis_retribusi" value="<?php $jbb = $row->jenis_jbb;
																						if($jbb=='jbbpnm'){
																							echo "Penumpang Umum";
																						}
																						else if($jbb=='jbb0kg') {
																							echo "JBB s/d 4000kg";
																						} else if ($jbb=='jbb4kg') {
																							echo "JBB 4001kg s/d 8000kg";
																						} else if ($jbb=='jbb8kg') {
																							echo "JBB 8001kg s/d 14000kg";
																						} else if ($jbb=='jbb14kg') {
																							echo "JBB diatas 14000kg";
																						} else if ($jbb=='GN') {
																							echo "Kereta Gandeng";
																						}
																						else if ($jbb=='TP') {
																							echo "Kereta Tempelan";
																						}
																						?>" class="col-xs-12" readonly />
					</div>
				</div>	
			</div>
		</div>
		
		<h3 class="header smaller lighter blue"></h3>
		<div class="row">
			<div class="col-xs-12 col-sm-10">
			</div>
			<div class="col-xs-12 col-sm-2" align="right">
				<a href="#tambah-retribusi" data-toggle="modal">
					<button class="btn btn-white btn-info btn-round">
						<i class="ace-icon fa fa-plus bigger-120 blue"></i>
						Tambah
					</button>
				</a>
			</div>
		</div>
		
		&nbsp;
		
		<div class="row">
			<div class="col-xs-12">	
				<table id="simple-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Retribusi</th>
							<th>Jenis Retribusi</th>
							<th>Sifat</th>
							<th>Retribusi</th>
							<th>Qty</th>
							<th>Sub Total</th>
							<th>Opsi</th>
						</tr>
					</thead>
					
					<tbody>
					<?php $i=1; $no=1;?>
					<?php foreach($this->cart->contents() as $items): ?>
						<?php echo form_hidden('rowid[]', $items['rowid']); ?>
						<tr class="gradeX">
							<td><?php echo $no; ?></td>
							<td><?php echo $items['id']; ?></td>
							<td><?php echo $items['name']; ?></td>
							<td><?php echo $items['sifat']; ?></td>
							<td>Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
							<td><?php echo $items['qty']; ?></td>
							<td>Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
							<td>
								<a href="#" class="tooltip-error delbutton" data-rel="tooltip" title="Hapus" class="delbutton"
									id="<?php echo 'tambah/'.$items['rowid'].'/'.$id_retribusi.'/'.$items['id'].'/'.$items['qty']; ?>">
										<i class="ace-icon glyphicon glyphicon-remove bigger-120"></i>
								</a>
							</td>
						</tr>
						<?php $i++; $no++;?>
					<?php endforeach; ?>
					</tbody>
			</table>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-5 pull-right">
				<h4 class="pull-right">
					Total Retribusi :
					<span class="red">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></span>
					<input type="hidden" id="jumlah_retribusi" name="jumlah_retribusi" value="<?php echo $this->cart->total(); ?>" />
				</h4>
			</div>
			<div class="col-sm-7 pull-left"></div>
		</div>
		
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-left bolder blue"> Terbilang</label>
					<div class="col-sm-9">
						<input type="text" id="terbilang" name="terbilang" value="" class="col-xs-12" readonly />
					</div>
				</div>
			</div>
		</div>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-8">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Kirim
				</button>

				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</div>
	</form>
	<?php }
	} ?>
</div>

<div id="tambah-retribusi" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Tambah Retribusi</h4>
			</div>
			<form id="frm" name="frm" class="form-horizontal" role="form" method="post" action="<?php echo site_url('retribusi/tambah_retribusi_to_cart')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="hidden" name="link_id_retribusi" value="<?php echo $this->encryption->encode($row->id_retribusi);?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							
							<div class="form-group">
								<label class="col-xs-3 control-label no-padding-left"> Pilih Retribusi </label>
								<div class="col-xs-9">
									<select class="form-control" id="kd_tarif" name="kd_tarif" data-placeholder="Pilih jenis retribusi">
										<option value=""></option>
										<?php
										if(isset($data_tarif)){
											foreach($data_tarif as $row){
											?>
											<option value="<?php echo $row->kd_tarif;?>"><?php echo $row->sifat; ?> - <?php echo $row->jenis; ?></option>
											<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							
							<div id="detail_retribusi"></div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i>
						Batal
					</button>

					<button type="submit" class="btn btn-sm btn-primary">
						<i class="ace-icon fa fa-check"></i>
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
<script type="text/javascript">
	jQuery(function($) {
		$("#kd_tarif").change(function(){
			var kd_tarif = $("#kd_tarif").val();
			$.ajax({
				type: "POST",
				url : "<?php echo base_url('retribusi/get_detail_retribusi'); ?>",
				data: "kd_tarif="+kd_tarif,
				cache:false,
				success: function(data){
					$('#detail_retribusi').html(data);
					document.frm.add.disabled=false;
				}
			});
		});
			
		$(".delbutton").click(function(){
			var element = $(this);
			var del_id = element.attr("id");
			var info = del_id;
			if(confirm("Anda yakin akan menghapus?"))
			{
				$.ajax({
					url: "<?php echo base_url(); ?>retribusi/hapus_retribusi",
					data: "kode="+info,
					cache: false,
					success: function(){
					}
				});
				$(this).parents(".gradeX").animate({ opacity: "hide" }, "slow");
			}
			return false;
		});
		
		$("#kd_barang").change(function(){
			var kd_barang = $("#kd_barang").val();
			$.ajax({
				type: "POST",
				url : "<?php echo base_url('barang/get_detail_barang'); ?>",
				data: "kd_barang="+kd_barang,
				cache:false,
				success: function(data){
					$('#detail_barang').html(data);
					document.brg.add.disabled=false;
				}
			});
		});
		
		$(".delbtn").click(function(){
			var element = $(this);
			var del_id = element.attr("id");
			var info = del_id;
			if(confirm("Anda yakin akan menghapus?"))
			{
				$.ajax({
					url: "<?php echo base_url(); ?>barang/hapus_pengadaan",
					data: "kode="+info,
					cache: false,
					success: function(){
					}
				});
				$(this).parents(".gradeX").animate({ opacity: "hide" }, "slow");
			}
			return false;
		});
		
		$("#jml_retribusi").append(function(e){
			var th = ['','Ribu','Juta', 'Milyar','Triliun'];
			var dg = ['Nol','Satu','Dua','Tiga','Empat', 'Lima','Enam','Tujuh','Delapan','Sembilan']; var tn = ['Sepuluh','Sebelas','Dua Belas','Tiga Belas', 'Empat Belas','Lima Belas','Enam Belas', 'Tujuh Belas','Delapan Belas','Sembilan Belas']; var tw = ['Dua Puluh','Tiga Puluh','Empat Puluh','Lima Puluh', 'Enam Puluh','Tujuh Puluh','Delapan Puluh','Sembilan Puluh'];
			function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'Bukan Angka'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'Angka Terlalu Besar'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'Ratus ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'Koma '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ').replace("Satu Ratus","Seratus").replace("Satu Ribu","Seribu").replace("Satu Puluh","Sepuluh");}
	
			$('#terbilang').val(toWords(this.value));
			
		});
	});
</script>	