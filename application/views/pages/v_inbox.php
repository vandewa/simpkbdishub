<div class="page-content">
	<div class="page-header">
		<h1>
			Inbox
		</h1>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul id="inbox-tabs" class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
							<li class="li-new-mail pull-right">
								<a href="#write" data-toggle="modal" class="btn-new-mail">
									<span class="btn btn-purple no-border">
										<i class="ace-icon fa fa-envelope bigger-130"></i>
										<span class="bigger-110">Tulis Pesan</span>
									</span>
								</a>
							</li>

							<li class="active">
								<a data-toggle="tab" href="#inbox" data-target="inbox">
									<i class="blue ace-icon fa fa-inbox bigger-130"></i>
									<span class="bigger-110">Inbox</span>
								</a>
							</li>
						</ul>

						<div class="tab-content no-border no-padding">
							<div id="inbox" class="tab-pane in active">
								<div class="message-container">
									
									<!--
									<div id="id-message-list-navbar" class="message-navbar clearfix">
										<div class="message-bar">
											<div class="message-infobar" id="id-message-infobar">
												<span class="blue bigger-150">Inbox</span>
												<span class="grey bigger-110">(2 unread messages)</span>
											</div>
										</div>
									</div>
									-->
									
									<div class="message-list-container">
										<!-- #section:pages/inbox.message-list -->
										<?php 
										if(isset($data_pesan)){
											foreach($data_pesan as $row){
											?>
										<a href="<?php echo site_url('inbox/baca/'.$this->encryption->encode($row->id_pesan));?>"">	
										<div class="message-list" id="message-list">
											<div class="message-item">
												<label class="inline">
													<input type="checkbox" class="ace" />
													<span class="lbl"></span>
												</label>

												<i class="message-star ace-icon fa fa-star-o light-grey"></i>
												<span class="sender" title="<?php echo $row->nama;?>"><?php echo $row->nama;?></span>
												<span class="time"></span>

												<span class="summary">
													<span class="text">
														<?php echo $row->pesan;?>
													</span>
												</span>
											</div>
										</div>
										</a>
										<?php }
										} ?>
									</div>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>

<div id="write" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Kirim Pesan</h4>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('inbox/kirim_pesan')?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							
							<div class="form-group">
								<input type="hidden" name="id_pesan" value="PSN-<?php echo $now;?>">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								
								<label class="col-sm-2 control-label no-padding-left"> Penerima </label>
								<div class="col-sm-6">
									<select class="form-control" id="id_penerima" name="id_penerima" data-placeholder="Pilih Penerima">
										<option value=""></option>
										<?php 
										if(isset($data_penerima)){
											foreach($data_penerima as $row){
											?>
											<option value="<?php echo $row->id_user;?>"><?php echo $row->nama; ?></option>
											<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-left"> Pesan</label>
								<div class="col-sm-10">
									<textarea id="pesan" name="pesan" class="autosize-transition form-control"></textarea>
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

					<button type="submit" class="btn btn-sm btn-purple">
						<i class="ace-icon fa fa-check"></i>
						Kirim
					</button>
				</div>
			</form>
		</div>
	</div>
</div>