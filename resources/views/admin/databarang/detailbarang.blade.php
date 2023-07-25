@extends('admin.layout.main')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head-content mb-3">
                        <h3 class="nk-block-title page-title ">Detail Barang {{ $data->nama_barang }}</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-inner">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="nama_barang">Nama Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->nama_barang }}" name="nama_barang" id="nama_barang"
                                                        placeholder="Nama Barang" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="stok">Kode Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" min="1" name="stok" class="form-control"
                                                        value="{{ $data->kode_barang }}" id="stok" placeholder="Stok Barang"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="stok">Stok</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" min="1" name="stok" class="form-control"
                                                        value="{{ $data->stok }}" id="stok" placeholder="Stok Barang"
                                                        required>
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
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="barcode">Barcode Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" 
                                                        value="{{ $data->barcode }}" name="barcode" id="barcode"
                                                        placeholder="Barcode Barang">
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
                                        {{-- <div class="col-4">
                                                <label class="form-label" for="customMultipleFiles">Foto Barang</label>
                                                 @if ($data->foto_barang == null)
                                                        <img src="{{ asset('assets/images/no-image.png') }}" alt=""
                                                            class="img-thumbnail">
                                                    @else
                                                        <img src="{{ url('storage/'.$data->foto_barang) }}" alt=""
                                                            class="img-thumbnail">
                                                    @endif
                                            </div> --}}
                                        <div class="text-end mt-5 col-12">
                                            <a href="{{ route('databarang.index') }}" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
