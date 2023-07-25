@extends('admin.layout.main')
@section('title', 'Data Barang')
@section('content')
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Catatan Transaksi</h3>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                  <li class="nk-block-tools-opt">
                                     <a href="{{ route('Catatan-transaksi.create') }}" class=" btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                    <a href="{{ route('Catatan-transaksi.create') }}"class=" btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Tambah Catatan Transaksi</span></a>
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
                        <div class="card-inner ">
                            <div class="container">
                                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col ">
                                                <span class="sub-text">No Transaksi</span>
                                            </th>
                                            <th class="nk-tb-col"><span class="sub-text">Kasir</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Uang Masuk</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">tanggal Transaksi</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Jam Transaksi</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Jenis Transaksi</span></th>
                                            <th class="nk-tb-col nk-tb-col-tools text-end">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $data)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col ">
                                               <span class="sub-text">{{ $data->no_transaksi }}</span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                                        <span>{{ strtoupper(substr($data->user->nama_pengguna, 0, 3)) }}</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ $data->user->nama_pengguna }}<span class="dot dot-success d-md-none ms-1"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb" >
                                                <span class="currency text-success">+Rp. {{ number_format($data->total_pembayaran, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{ \Carbon\Carbon::parse($data->tgl_transaksi)->isoFormat('D MMMM Y') }}</span>
                                            </td>
                                            
                                            <td class="nk-tb-col tb-col-lg">
                                                <span>{{  str_replace(":00", "", $data->waktu_transaksi); }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-lg">
                                                @if($data->pembelian == 'online')
                                               <span class="badge rounded-pill bg-warning badge-md">Online</span>
                                               @else
                                                 <span class="badge rounded-pill bg-primary badge-md">Offline</span>
                                               @endif
                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="{{ route('cetak.struk',$data->id_transaksi) }}"><em class="icon ni ni-file-text"></em><span>Cetak Struk</span></a></li>
                                                                    <li><a href="{{ route('Catatan-transaksi.show',$data->id_transaksi) }}"><em class="icon ni ni-eye"></em><span>Tampilkan Transaksi</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr><!-- .nk-tb-item  -->  
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
