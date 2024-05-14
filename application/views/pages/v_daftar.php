<div class="content d-flex justify-content-center align-items-center">

	<form class="form-validate flex-fill" action="<?php echo site_url('qregister');?>" method="post" >
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<div class="row">
			<div class="col-lg-6 offset-lg-3">
				<div class="card mb-0">
					<div class="card-body">
						<div class="text-center mb-3">
							<i class="icon-user-plus icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
							<h5 class="mb-0">Registrasi Akun</h5>
							<span class="d-block text-muted">Layanan Tata Ruang Kabupaten Magelang</span>
						</div>

						<div class="form-group form-group-feedback form-group-feedback-right">
							<input type="text" class="form-control" name="nama" placeholder="Nama anda" required>
							<div class="form-control-feedback">
								<i class="icon-user-plus text-muted"></i>
							</div>
						</div>
						
						<div class="form-group form-group-feedback form-group-feedback-right">
							<textarea class="form-control" rows="2" name="alamat" placeholder="Alamat lengkap" required></textarea>
							<div class="form-control-feedback">
								<i class="icon-user-check text-muted"></i>
							</div>
						</div>
						
						<!--
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-feedback form-group-feedback-right">
									<input type="text" class="form-control" name="telepon" placeholder="Nomor telepon anda" required>
									<div class="form-control-feedback">
										<i class="icon-user-check text-muted"></i>
									</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-group-feedback form-group-feedback-right">
									<input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan anda" required>
									<div class="form-control-feedback">
										<i class="icon-user-check text-muted"></i>
									</div>
								</div>
							</div>
						</div>
						-->

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-feedback form-group-feedback-right">
									<input type="text" class="form-control" name="rusername" placeholder="Nomor telepon (sebagai username)" required>
									<div class="form-control-feedback">
										<i class="icon-user-plus text-muted"></i>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-group-feedback form-group-feedback-right">
									<input type="email" class="form-control" name="email" placeholder="Alamat email">
									<div class="form-control-feedback">
										<i class="icon-mention text-muted"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-feedback form-group-feedback-right">
									<input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Password" required>
									<div class="form-control-feedback">
										<i class="icon-user-lock text-muted"></i>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-group-feedback form-group-feedback-right">
									<input type="password" class="form-control" name="reppassword"placeholder="Ulangi password" required>
									<div class="form-control-feedback">
										<i class="icon-user-lock text-muted"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="text-center">
							<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b> Daftar Akun</button>
						</div>
						
						</form>
						
						<div class="form-group text-center text-muted content-divider mt-3">
							<span class="px-2">sudah punya akun?</span>
						</div>
						
						<div class="form-group text-center">
							<a href="<?php echo site_url('login');?>" class="btn btn-primary">Login <b><i class="icon-circle-right2 ml-2"></i></b></a>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>


			