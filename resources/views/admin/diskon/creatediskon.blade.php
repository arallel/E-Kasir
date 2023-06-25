@extends('admin.layout.main')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-3">
                    <h3 class="nk-block-title page-title ">Tambah Potongan Harga</h3>
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
                            <div id="alert-container"></div>
                                
                                <form action="{{ route('diskon.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="kode_promo">Kode Promo</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                            name="kode_promo" value="{{ old('kode_promo') }}" id="kode_promo"
                                            placeholder="Kode Promo" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mt-1">
                                    <div class="form-group">
                                        <label class="form-label" for="persen_diskon">Jumlah Diskon Dalam Bentuk %</label>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>        
                                                </div>   
                                            <input type="number" class="form-control"
                                            name="persen_diskon" value="{{ old('persen_diskon') }}" id="persen_diskon"placeholder="Jumlah Diskon" required>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mt-1">
                                    <div class="form-group">
                                        <label class="form-label" for="tgl_mulai_promo">Tanggal Dimulai Promo</label>
                                        <div class="form-control-wrap">
                                            <input type="date" value="{{ date('Y-m-d') }}" class="form-control"
                                            name="tgl_mulai_promo" value="{{ old('tgl_mulai_promo') }}" id="tgl_mulai_promo" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mt-1">
                                    <div class="form-group">
                                        <label class="form-label" for="tgl_selesai_promo">Tanggal Selesai Promo</label>
                                        <div class="form-control-wrap">
                                            <input type="date" class="form-control"
                                            name="tgl_selesai_promo" value="{{ old('tgl_selesai_promo') }}" id="tgl_selesai_promo" required>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-12 text-end mt-3">
                                        <a href="{{ route('diskon.index') }}" class="btn btn-secondary">Kembali</a> 
                                        <button class="btn btn-success" >Simpan  Data</button>   
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
