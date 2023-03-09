@extends('admin.layout.main')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head-content mb-3">
                        <h3 class="nk-block-title page-title ">Edit Kategory</h3>
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
                                <form action="{{ route('Kategory.update', $data->id_kategory) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="nama_kategory">Nama Kategory</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->nama_kategory }}" name="nama_kategory" id="nama_kategory"
                                                        placeholder="Nama Barang" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-3">
                                                <a href="{{ route('Kategory.index') }}" class="btn btn-secondary">Kembali</a> 
                                            </div>
                                            <div class="col-4 mt-3">
                                                <button class="btn btn-success">Perbarui Data</button>   
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
