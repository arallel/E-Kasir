@extends('admin.layout.main')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head-content mb-3">
                        <h3 class="nk-block-title page-title ">Edit Barang</h3>
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
                                <form action="{{ route('databarang.update', $data->id_barang) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="nama_barang">Nama Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->nama_barang }}" name="nama_barang" id="nama_barang"
                                                        placeholder="Nama Barang" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="kode_barang">Kode Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" 
                                                        value="{{ $data->kode_barang }}" name="kode_barang" id="kode_barang"
                                                        placeholder="Kode Barang" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="stok">Stok</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" min="1" name="stok" class="form-control"
                                                        value="{{ $data->stok }}" id="stok" placeholder="Stok Barang"
                                                        min="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="harga_barang">Harga Pembelian</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-text-hint">
                                                        <span class="overline-title">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" required
                                                        value="{{ $data->harga_pembelian }}" name="harga_pembelian"
                                                        id="default-05" placeholder="Harga pembelian">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="harga_barang">Harga Barang</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-text-hint">
                                                        <span class="overline-title">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" required
                                                        value="{{ $data->harga_barang }}" name="harga_barang"
                                                        id="default-05" placeholder="Harga Barang">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="barcode">Barcode Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" 
                                                        value="{{ $data->barcode }}" name="barcode" id="barcode"
                                                        placeholder="Barcode Barang" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="category">Status Barang</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-select">
                                                        <select class="form-control" required name="status_barang"
                                                            id="category">
                                                            <option value="default_option" selected disabled>Status Barang
                                                            </option>
                                                            <option  {{ $data->status_barang == 'aktif' ? 'selected' : '' }} value="aktif">Aktif</option>
                                                            <option  {{ $data->status_barang == 'tidak_aktif' ? 'selected' : '' }} value="tidak_aktif">Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="category">Category</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-select">
                                                        <select class="form-control" required name="id_kategory"
                                                            id="category">
                                                            <option value="default_option" selected disabled>Pilih Kategory
                                                            </option>
                                                            @foreach ($kategory as $kate)
                                                                <option
                                                                    {{ $data->id_kategory == $kate->id_kategory ? 'selected' : '' }}
                                                                    value="{{ $kate->id_kategory }}">
                                                                    {{ $kate->nama_kategory }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-8">
                                            <label class="form-label" for="customMultipleFiles">Foto Barang</label>
                                            <div class="form-file">
                                                <input type="file" multiple class="form-file-input" name="foto_barang"
                                                    id="customMultipleFiles" accept="image/jpeg,image/png,image/jpg,image/bmp, image/webp,image/svg+xml">
                                                <label class="form-file-label" for="customMultipleFiles">Pilih
                                                    Foto</label>
                                            </div>
                                        </div>
                                    <div class="col-12 text-end mt-3">
                                        <a href="{{ route('databarang.index') }}" class="btn btn-secondary">Kembali</a> 
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
