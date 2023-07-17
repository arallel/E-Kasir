@extends('admin.layout.main')
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head nk-block-head-sm">
					<div class="nk-block-between">
						<div class="nk-block-head-content">
							<h3 class="nk-block-title page-title">Settings</h3>
						</div><!-- .nk-block-head-content -->
					</div><!-- .nk-block-between -->
				</div><!-- .nk-block-head -->
				<div class="nk-block nk-block-lg">
					<div class="card">
						<ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-laptop"></em><span>Web store settings</span></a>
							</li>
						</ul>
						<div class="card-inner">
							<div class="tab-content">
								<div class="tab-pane active" id="tabItem5">
									<h4 class="title nk-block-title">Setting</h4>
									<form action="{{ route('setting.destroy') }}" method="POST">
										@csrf
										<h6>Hapus Data Log</h6>
										<button type="submit" class="btn btn-danger">Hapus Log Data User</button>
									</form>
									<form action="{{ route('setting.update',$data->id_setting) }}" class="gy-3 form-settings" method="POST">
										@csrf
										@method('patch')
										<div class="row g-3 align-center">
											<div class="col-lg-5">
												<div class="form-group">
													<label class="form-label" for="site-name">Nama Toko</label>
													<span class="form-note">Nama Toko Mohon Di Isi</span>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group">
													<div class="form-control-wrap">
														<input type="text" name="nama_toko" class="form-control" id="site-name" value="{{ $data->nama_toko }}">
													</div>
												</div>
											</div>
										</div>
										<div class="row g-3 align-center">
											<div class="col-lg-5">
												<div class="form-group">
													<label class="form-label" for="site-email">Email Toko</label>
													<span class="form-note">Email Toko Digunakan Untuk Mengirim Email</span>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group">
													<div class="form-control-wrap">
														<input type="email" class="form-control" id="site-email" name="email_toko" value="{{ $data->email_toko }}">
													</div>
												</div>
											</div>
										</div>
										<div class="row g-3 align-center">
											<div class="col-lg-5">
												<div class="form-group">
													<label class="form-label" for="site-copyright"> Copyright Situs</label>
													<span class="form-note">Informasi Copyright Situs</span>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group">
													<div class="form-control-wrap">
														<input type="text" class="form-control" id="site-copyright" name="copyright_toko" value="{{ $data->copyright_toko }}">
													</div>
												</div>
											</div>
										</div>
										<div class="row g-3 align-center">
											<div class="col-lg-5">
												<div class="form-group">
													<label class="form-label">Pilih Cara Registrasi</label>
													<span class="form-note">Apabila pengguna memilih opsi <b>"Di Register Admin"</b>, maka admin akan membuat akun pengguna dan mengatur passwordnya.<br> Jika pengguna memilih opsi <b>"Di Register Pengguna"</b>, maka pengguna akan mengatur passwordnya sendiri melalui tautan yang dikirimkan melalui email.</span>
												</div>
											</div>
											<div class="col-lg-7">
												<ul class="custom-control-group g-3 align-center flex-wrap">
													<li>
														<div class="custom-control custom-radio">
															<input type="radio" value="true" name="is_register_admin" class="custom-control-input" {{ ($data->is_register_admin == 'true')?'checked':'' }}  id="reg-enable">
															<label class="custom-control-label" for="reg-enable">Di Register Admin</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-radio">
															<input type="radio" value="false" class="custom-control-input" ss="custom-control-input" {{ ($data->is_register_admin == 'false')?'checked':'' }}  name="is_register_admin" id="reg-disable">
															<label class="custom-control-label" for="reg-disable">Di Register Pengguna</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="row g-3">
											<div class="col-lg-7">
												<div class="form-group mt-2">
													<button type="submit" class="btn btn-lg btn-primary">Update</button>
												</div>
											</div>
										</div>
									</form>
								</div><!--tab pan -->
							</div>
						</div><!--card inner-->
					</div><!--card-->
				</div><!--nk-block-->
			</div>
		</div>
	</div>
</div>
{{-- <div class="modal fade" tabindex="-1" id="modalAlert">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross"></em></a>
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
                        <h4 class="nk-modal-title">Congratulations!</h4>
                        <div class="nk-modal-text">
                            <div class="caption-text">You’ve successfully Updated.</div>
                            <span class="sub-text-sm">Lorem ipsum dolor sit amet. <a href="#"> Click here</a></span>
                        </div>
                        <div class="nk-modal-action">
                            <a href="#" class="btn btn-lg btn-mw btn-primary" data-bs-dismiss="modal">OK</a>
                        </div>
                    </div>
                </div><!-- .modal-body -->
            </div>
        </div>
    </div> --}}
    @endsection