@extends('admin.layout.main')
@section('title', 'Data Barang')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Products</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <form action="{{ route('search.barang') }}" method="post">
                                                @csrf
                                                <input type="text" class="form-control" name="search" id="default-04"
                                                    placeholder="Cari Barang">
                                            </form>
                                        </div>
                                    </li>
                                    <li>
                                        <form action="{{ route('filter.barang') }}" method="post" id="filter">
                                            @csrf
                                            <div class="form-control-select">
                                                <select class="form-control" name="filter" id="filter-select">
                                                    <option selected disabled>Status</option>
                                                    <option value="semua"><span>Semua</span></option>
                                                    <option value="tidak_aktif"><span>Tidak Aktif</span></option>
                                                    <option value="aktif"><span>Aktif</span></option>
                                                    <option value="stok_kosong"><span>Stok Kosong</span></option>
                                                </select>
                                            </div>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('filter.kategory.barang') }}" method="post"
                                            id="filter-kategory">
                                            @csrf
                                            <div class="form-control-select">
                                                <select class="form-control" name="filter" id="filter-select-kategory">
                                                    <option selected disabled>Kategory</option>
                                                    @foreach ($kategory as $katef)
                                                        <option value="{{ $katef->id_kategory }}">
                                                            <span>{{ $katef->nama_kategory }}</span>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="#" data-target="addProduct"
                                            class="toggle btn btn-icon btn-primary d-md-none"><em
                                                class="icon ni ni-plus"></em></a>
                                        <a href="#" data-target="addProduct" onclick="storebarang()" 
                                            class="toggle btn btn-primary d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>Tambah Barang</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
