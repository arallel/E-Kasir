@extends('admin.layout.main')
@section('content')
<div class="container-fluid">
	<div class="nk-content-inner">
		<div class="nk-content-body">
			<div class="nk-block">
				<div class="card">
					<div class="card-aside-wrap">
						<div class="card-inner card-inner-lg">
							<div class="nk-block-head nk-block-head-lg">
								<div class="nk-block-between">
									<div class="nk-block-head-content">
										<h4 class="nk-block-title">Informasi Personal</h4>

									</div>
									<div class="nk-block-head-content align-self-start d-lg-none">
										<a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
									</div>
								</div>
							</div><!-- .nk-block-head -->
							<div class="nk-block">
								<div class="card-inner shadow">
									<div class="tab-content">
										<div class="tab-pane active" id="personal">
											<form action="{{ route('profile.update',$data->id_user) }}" method="post">
												@csrf
												@method('put')
												<div class="row">
													<div class="col-12">
														<div class="form-group">
															<label class="form-label" for="nama_pengguna">Nama Pengguna</label>
															<div class="form-control-wrap">
																<input type="text" class="form-control"
																value="{{ $data->nama_pengguna }}" name="nama_pengguna" id="nama_pengguna"
																placeholder="Nama Pengguna" required>
															</div>
														</div>
													</div>
													<div class="col-12 mt-2">
														<div class="form-group">
															<label class="form-label" for="nama_pengguna">Email Pengguna</label>
															<div class="form-control-wrap">
																<input type="text" disabled class="form-control"
																value="{{ $data->email }}"
																>
																<input type="hidden" value="{{ $data->email }}" name="email">
															</div>
														</div>
													</div>
													<div class="col-12 mt-2">
														<div class="form-group">
															<label class="form-label" for="level">Role Pengguna</label>
															<div class="form-control-wrap">
																<input type="text" disabled class="form-control"
																value="{{ $data->level }}" name="level" id="level"
																placeholder="Email Pengguna" required>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12 text-end mt-2">
													<button class="btn btn-success">Update</button>
												</div>
											</form>
											<hr>
											<div class="mt-3 between-center flex-wrap g-3">
												<div class="nk-block-text">
													<h6>Ganti Password</h6>
													<p>Set a unique password to protect your account.</p>
												</div>
												<div class="nk-block-actions flex-shrink-sm-0">
													<ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
														<li class="order-md-last">
															<a type="button" data-bs-toggle="modal" data-bs-target="#gantipassword" class="btn btn-primary">Change Password</a>
														</li>
													</ul>
												</div>
											</div>

										</div>
										<div class="tab-pane" id="loguser">
											<table class="datatable-init table table-ulogs">
												<thead class="table-light">
													<tr>
														<th class="tb-col-os"><span class="overline-title">No</span></th>
														<th class="tb-col-os"><span class="overline-title">Browser</span></th>
														<th class="tb-col-ip"><span class="overline-title">IP</span></th>
														<th class="tb-col-time"><span class="overline-title">Tanggal Dan Jam Login</span></th>
														<th class="tb-col-time"><span class="overline-title">Tanggal Dan Jam Logout</span></th>
														<th class="tb-col-time"><span class="overline-title">Total Jam Login Harian</span></th>
													</tr>
												</thead>
												<tbody>
													@foreach($data->userlog as $loguser)
													@if($loguser->time_logout_at && $loguser->date_logout_at)
													@php
													$start = \Carbon\Carbon::createFromTimeString($loguser->time_login_at);
													$end = \Carbon\Carbon::createFromTimeString($loguser->time_logout_at);
													$diff = $end->diff($start);
													$hours = $diff->h;
													$minutes = $diff->i;
													$seconds = $diff->s;
													$timeString = '';
													if ($hours > 0) {
														$timeString .= $hours . " jam ";
													}
													if ($minutes > 0) {
														$timeString .= $minutes . " menit ";
													}
													if ($seconds > 0) {
														$timeString .= $seconds . " detik";
													}
													@endphp
													@endif
													<tr>
														<td class="tb-col-os">{{ $loop->iteration }}</td>
														<td class="tb-col-os">{{ $loguser->user_agent }}</td>
														<td class="tb-col-ip"><span class="sub-text">{{ $loguser->ip_address }}</span></td>
														<td class="tb-col-time"><span class="sub-text">{{ $loguser->date_login_at }}   {{ $loguser->time_login_at }}</span></td>
														<td class="tb-col-time"><span class="sub-text">{{ $loguser->date_logout_at }}  {{ $loguser->time_logout_at }}</span></td>
														<td class="tb-col-time"><span class="title text-success">{{ ($loguser->time_logout_at && $loguser->date_logout_at)?$timeString:'-' }}</span></td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- .nk-block -->
						</div>
						<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
							<div class="card-inner-group" data-simplebar>
								<div class="card-inner">
									<div class="user-card">
										<div class="user-avatar">
											<span>{{ strtoupper(substr($data->nama_pengguna, 0, 3)) }}</span>
										</div>
										<div class="user-info">
											<span class="lead-text">{{ $data->nama_pengguna }}</span>
											<span class="sub-text">{{ $data->email }}</span>
										</div>
									</div>
								</div><!-- .card-inner -->
								<div class="card-inner p-0">
									<ul class="nav link-list-menu  round m-0">
										<li>
											<a class="active" data-bs-toggle="tab" href="#personal"><em class="icon ni ni-user-fill-c"></em><span>Data Personal Pengguna</span></a>
										</li>
										<li>
											<a data-bs-toggle="tab" href="#loguser"><em class="icon ni ni-activity-round-fill"></em><span>Aktivitas Akun</span></a></li>
										</li>
										
									</ul>
								</div><!-- .card-inner -->
							</div><!-- .card-inner-group -->
						</div><!-- card-aside -->
					</div><!-- .card-aside-wrap -->
				</div><!-- .card -->
			</div><!-- .nk-block -->
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" id="gantipassword" aria-modal="true" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ganti Password</h5>
				<a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
					<em class="icon ni ni-cross"></em>
				</a>
			</div>
			<div class="modal-body">
				<form action="{{ route('profile.update.password',$data->id_user) }}" method="post">
					@csrf
					@method('put')
					<div class="row">
						<div class="col-12 mb-2">
							<div class="form-group">
								<label>Password</label>
								<div class="form-control-wrap">
									<a  href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
										<em class="passcode-icon icon-show icon ni ni-eye"></em>
										<em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
									</a>
									<input type="password" class="form-control" id="password" name="password">
								</div>
								
								
								<p id="text" style="display:none;" class="text-danger">Password Minimal 6 Huruf</p>
							</div>
						</div> 
						<div class="col-12 mb-2">
							<div class="form-group">
								<label>Masukan Kembali Password</label>
								<div class="form-control-wrap">
									<a  href="#" class="form-icon form-icon-right passcode-switch" data-target="confirm">
										<em class="passcode-icon icon-show icon ni ni-eye"></em>
										<em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
									</a>
								    <input type="password" class="form-control" id="confirm" name="confirm_password">
								</div>
								<p id="textconfirm" style="display:none;" class="text-danger">Password Tidak Sama</p>
							</div>
						</div>
						<div class="text-end">
							<button class="btn btn-success" id="export-bulanan" data-bs-dismiss="modal">Ganti Password</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
	const inputpassword = document.getElementById('password');
	const confirminputpassword = document.getElementById('confirm');
	const textpassword = document.getElementById('text');
	const textconfirm = document.getElementById('textconfirm');

	inputpassword.addEventListener('input',function (){
		if(this.value.length < 6){
			inputpassword.classList.add('error');
			textpassword.style.display = 'block';
		}else{
			inputpassword.classList.remove('error');
			textpassword.style.display = 'none';
		}
	});
	confirminputpassword.addEventListener('input',function(){
		if(this.value == inputpassword.value){
			confirminputpassword.classList.remove('error');
			textconfirm.style.display = 'none';
		}else{
			confirminputpassword.classList.add('error');
			textconfirm.style.display = 'block';
		}
	});
</script>
@endsection
