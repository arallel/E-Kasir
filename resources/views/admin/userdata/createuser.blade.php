@extends('admin.layout.main')
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content mb-3">
					<h3 class="nk-block-title page-title ">Edit Pengguna</h3>
				</div><!-- .nk-block-head-content -->
				<div class="col-12">
					<div class="card">
						<div class="card-inner">
							@if ($errors->any())
							<div class="alert alert-icon alert-danger" role="alert"> <em
								class="icon ni ni-cross-circle"></em>
								@foreach ($errors->default->all() as $error)
								<strong>Error</strong>.{{ $error }}.
								@endforeach
							</div>
							@endif
							<form action="{{ route('UserData.store') }}" method="POST"
							enctype="multipart/form-data">
							@csrf
							<div class="row g-3">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label class="form-label" for="nama_pengguna">Nama Pengguna</label>
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Pengguna" required>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label class="form-label" for="email">Email</label>
										<div class="form-control-wrap">
											<input type="email" class="form-control"
											name="email" id="email"
											placeholder="Email Pengguna" required>
										</div>
									</div>
								</div>
								@if($setting->is_register_admin == 'true')
								<div class="col-12 col-md-6">
									<div class="form-group">
										<div class="form-label-group">
											<label class="form-label" for="password">Password</label>
										</div>
										<div class="form-control-wrap">
											<a href="#" class="form-icon form-icon-right passcode-switch lg"
											data-target="password">
											<em class="passcode-icon icon-show icon ni ni-eye"></em>
											<em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
										</a>
										<input type="password" min="6" name="password" required class="form-control form-control-lg" id="password"
										placeholder="Masukan Password">
									</div>
								</div>
							</div>
							@endif
							<div class="col-12 {{ ($setting->is_register_admin == 'true')?'col-md-6':'' }}">
								<div class="form-group">
									<label class="form-label" for="level">Role Pengguna</label>
									<select name="level" class="form-select form-select-lg" id="">
										<option disabled>Pilih Role Pengguna</option>
										<option value="admin">Admin</option>
										<option  value="kasir">Kasir</option>
									</select>
								</div>
							</div>
							<div class="col-12 text-end mt-3">
								<a href="{{ route('UserData.index') }}" class="btn btn-secondary">Kembali</a> 
								<button class="btn btn-success" >Simpan Data</button>   
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
@endsection
