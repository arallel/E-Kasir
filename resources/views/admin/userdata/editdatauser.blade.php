@extends('admin.layout.main')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head-content mb-3">
                        <h3 class="nk-block-title page-title ">Edit Pengguna</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="col-6">
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
                                <form action="{{ route('UserData.update', $data->id_user) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="nama_pengguna">Nama Pengguna</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" value="{{ $data->nama_pengguna }}" disabled placeholder="Nama Pengguna" required>
                                                    <input type="hidden" class="form-control" value="{{ $data->nama_pengguna }}" name="nama_pengguna">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="email">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control"
                                                        value="{{ $data->email }}" name="email" id="email"
                                                        placeholder="Nama Pengguna" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="status">status</label>
                                                <select name="status" class="form-select" id="">
                                                    <option disabled>Pilih Status</option>
                                                    <option {{ ($data->status == 'online') ? 'selected' : '' }} value="online">Online</option>
                                                    <option {{ ($data->status == 'offline') ? 'selected' : '' }} value="offline">Offline</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="status">Status Akun</label>
                                                <select name="status_akun" class="form-select" id="">
                                                    <option disabled>Pilih Status Akun</option>
                                                    <option {{ ($data->status_akun == 'aktif') ? 'selected' : '' }} value="aktif">Aktif</option>
                                                    <option {{ ($data->status_akun == 'diblokir') ? 'selected' : '' }} value="diblokir">Diblokir</option>
                                                    <option {{ ($data->status_akun == 'pending') ? 'selected' : '' }} value="pending">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="level">Role Pengguna</label>
                                                <select name="level" class="form-select" id="">
                                                    <option disabled>Pilih Role Pengguna</option>
                                                    <option  {{ ($data->level == 'admin') ? 'selected' : '' }} value="admin">Admin</option>
                                                    <option  {{ ($data->level == 'kasir') ? 'selected' : '' }} value="kasir">Kasir</option>
                                                    <option  {{ ($data->level == 'owner') ? 'selected' : '' }} value="owner">Owner</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-4 mt-3">
                                                <a href="{{ route('UserData.index') }}" class="btn btn-secondary">Kembali</a> 
                                            </div>
                                            <div class="col-4 mt-3">
                                                <button class="btn btn-success" >Perbarui Data</button>   
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
