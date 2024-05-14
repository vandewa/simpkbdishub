<div class="page-content">
	<div class="page-header">
		<h1>
			WhatsApp Gateway - Pesan Keluar
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-4">
		<form action="<?php echo site_url('wagateway/cari_outbox')?>" method="post">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-search blue"></i>
				</span>
				
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="text" id="cari" name="cari" class="form-control search-query" placeholder="Cari pesan keluar..." autofocus/>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-info btn-sm">
						<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
						Cari
					</button>
				</span>
			</div>
		</form>
		</div>
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="col-xs-12 col-sm-4" align="right">
			<a href="#tambah-pesan" data-toggle="modal">
				<button class="btn btn-white btn-info btn-round">
					<i class="ace-icon fa fa-plus bigger-120 blue"></i>
					Buat Pesan Keluar
				</button>
			</a>
		</div>
	</div>
	&nbsp
	
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th>No</th>
						<th>No WhatsApp</th>
						<th>No Uji</th>
						<th class="hidden-480">Pesan</th>
						<th class="hidden-480">Tanggal</th>
						<th class="hidden-480">Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<?php
				$no = $start+1;
				if(isset($dt_pesan)){
					foreach($dt_pesan as $row){
					?>
				<tbody>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->phone;?></td>
						<td><?php echo $row->pushName ;?></td>
						<td class="hidden-480"><?php echo $row->message ;?></td>
						<td class="hidden-480"><?php echo date("d-m-Y H:i:s",strtotime($row->tgl_pesan));?></td>
						<td class="hidden-480"><?php if($row->status=='0'){ ?> Proses <?php } else if($row->status=='1'){ ?> Terkirim <?php } ?></td>
						<td>
							<a href="<?php echo site_url('wagateway/hapuspesan/'.$row->idx);?>" onclick="return confirm('Anda yakin menghapus pesan?')" class="tooltip-warning" data-rel="tooltip" title="Hapus Pesan">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</button>
							</a>
						</td>
					</tr>
				</tbody>
				<?php 
				}
			} ?>	
			</table>
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>

<div id="tambah-pesan" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Buat Pesan Keluar</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('wagateway/proses_outbox')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Penerima </label>
								<div class="col-sm-9">
									<select id="jenis_penerima" name="jenis_penerima" class="select2" data-placeholder="Pilih penerima..." required >
										<option></option>
										<option value="SEMUA">Semua nomor terdaftar dalam sistem</option>
										<option value="PILIH">Pilih nomor penerima tertentu</option>
										<option value="TULIS">Tulis nomor penerima</option>
									</select>
								</div>
							</div>
							
							<div id="form_whatsapp"></div>
							
							<div class="form-group">
							<label class="col-sm-3 control-label no-padding-left"> Pesan </label>
								<div class="col-sm-9">
									<textarea id="message" name="message" class="form-control" placeholder="Pesan WhatsApp..." required ></textarea>
								</div>
							</div>
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
						Kirim
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$("#jenis_penerima").on("change",function(e){
			var jenis = $("#jenis_penerima").val();
			$('#form_whatsapp').empty();
			$.ajax({
				url: "<?php echo base_url('wagateway/get_jenispenerima'); ?>",
				type: 'GET',
				data: {'id':jenis},
				success: function(data){
					$('#form_whatsapp').html(data)
				},
				failed: function(data){
					alert('Gagal mendapatkan jenis penerima');
				}
			});
		});
	});
</script>