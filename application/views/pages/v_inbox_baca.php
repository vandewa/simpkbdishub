<div class="page-content">
	<div class="page-header">
		<h1>
			Inbox
		</h1>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class="dialogs">
						<?php 
						if(isset($data_pesan)){
							foreach($data_pesan as $row){
							?>
						<div class="itemdiv dialogdiv">
							<div class="user">
								<img class="pull-left" alt="Alex Doe's avatar" src="<?php echo base_url('assets/avatars/avatar2.png')?>" />
							</div>

							<div class="body">
								<div class="time">
									<i class="ace-icon fa fa-clock-o"></i>
									<span class="green"><?php echo $row->waktu;?></span>
								</div>

								<div class="name">
									<a href="#"><?php echo $row->nama;?></a>
								</div>
								<div class="text"><?php echo $row->pesan;?></div>
							</div>
						</div>
						<?php }
						} ?>
					</div>

					<form action="<?php echo site_url('inbox/kirim_balas')?>" method="post">
						<div class="form-actions">
							<div class="input-group">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<input type="hidden" name="id_pesan" value="<?php echo $row->id_pesan;?>">
								<input type="hidden" name="id_penerima" value="<?php echo $row->id_user;?>">
								<input type="hidden" name="link_id_pesan" value="<?php echo $this->encryption->encode($row->id_pesan);?>">
								<input placeholder="Ketik pesan disini ..." type="text" class="form-control" name="pesan" id="pesan" />
								<span class="input-group-btn">
									<button class="btn btn-sm btn-info no-radius" type="submit">
										<i class="ace-icon fa fa-share"></i>
										Kirim
									</button>
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>