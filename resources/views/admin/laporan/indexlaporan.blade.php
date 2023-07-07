@extends('admin.layout.main')
@section('title', 'Data Barang')
@section('content')
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Laporan</h3>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                  {{-- <li class="nk-block-tools-opt">
                                     <a href="#" class=" btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                    <a href="#"class=" btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Tambah Catatan Transaksi</span></a>
                                  </li>  --}}
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card">
                    <div class="card-inner-group">
                        <div class="card-inner">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection