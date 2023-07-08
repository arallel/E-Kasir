<!DOCTYPE html>
<html>

<head>
    <html lang="zxx" class="js">

    <head>
        <meta charset="utf-8">
        <meta name="author" content="Parallel">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <!-- Fav Icon  -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
        <!-- Page Title  -->
        <title>@yield('title')</title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.1.1') }}">
        <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=3.1.1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/libs/fontawesome-icons.css') }}"> 

    </head>

    <body class="nk-body bg-lighter npc-default has-sidebar ui-clean">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                @include('admin.layout.component.sidebar')
                <!-- wrap @s -->
                <div class="nk-wrap ">
                 @include('admin.layout.component.header')
                 <!-- content @s -->
                 <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Dashboard </h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                    {{-- <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><span>Last 30 Days</span></a></li>
                                                <li><a href="#"><span>Last 6 Months</span></a></li>
                                                <li><a href="#"><span>Last 1 Years</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="row g-gs">
                <div class="col-xxl-6">
                    <div class="row g-gs">
                        <div class="col-lg-6 col-xxl-12">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-2">
                                        <div class="card-title">
                                            <h6 class="title">Penjualan Mingguan</h6>
                                            <p>Penjualan Selama Seminggu</p>
                                        </div>
                                        <div class="card-tools">
                                            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
                                        </div>
                                    </div>
                                    <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                        <div class="nk-sale-data-group flex-md-nowrap g-4">
                                            <div class="nk-sale-data">
                                                <span class="amount">Rp.{{ number_format($total_bulanan) }}</span>
                                            </div>
                                            <div class="nk-sale-data">
                                                <span class="amount">Rp.{{ number_format($total_mingguan) }}</span>
                                            </div>
                                        </div>
                                        <div class="nk-sales-ck sales-revenue">
                                            <canvas class="sales-bar-chart" id="salesRevenue"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-lg-6 col-xxl-12">
                            <div class="row g-gs">
                                <div class="col-sm-6 col-lg-12 col-xxl-6">
                                    <div class="card">
                                        <div class="nk-ecwg nk-ecwg6">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Pendapatan Keseluruhan</h6>
                                                    </div>
                                                </div>
                                                <div class="data">
                                                    <div class="data-group">
                                                        <div class="amount">Rp.{{ number_format($transaksi_barang->sum('total_pembayaran')) }}</div>
                                                        <div class="nk-ecwg6-ck">
                                                            <canvas class="ecommerce-line-chart-s3" id="todayCustomers"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card-inner -->
                                        </div><!-- .nk-ecwg -->
                                    </div><!-- .card -->
                                </div><!-- .col -->
                                <div class="col-sm-6 col-lg-12 col-xxl-6">
                                    <div class="card">
                                        <div class="nk-ecwg nk-ecwg6">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Pendapatan Harian</h6>
                                                    </div>
                                                </div>
                                                <div class="data">
                                                    <div class="data-group">
                                                        <div class="amount">Rp.{{ number_format($transaksi_harian->sum('total_pembayaran')) }}</div>
                                                        <div class="nk-ecwg6-ck">
                                                            <canvas class="ecommerce-line-chart-s3" id="todayVisitors"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card-inner -->
                                        </div><!-- .nk-ecwg -->
                                    </div><!-- .card -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .col -->
                <div class="col-xxl-4 col-md-6 col-lg-6">
                    <div class="card h-100">
                        <div class="card-inner">
                            <div class="card-title-group mb-2">
                                <div class="card-title">
                                    <h6 class="title">Top Penjualan Produk</h6>
                                </div>
                                <div class="card-tools">
                                </div>
                            </div>
                            <ul class="nk-top-products">
                                @if($top5item)
                                @foreach($top5item as $topitem)
                                <li class="item">
                                    <div class="thumb">
                                        @if ($topitem->foto_barang == null)
                                        <img src="{{ asset('assets/images/no-image.png') }}" alt="" >
                                        @else
                                        <img src="storage/{{ $topitem->foto_barang }}" >
                                        @endif
                                    </div>
                                    <div class="info">
                                        <div class="title">{{ $topitem->databarang->nama_barang }}</div>
                                        <div class="price">Rp.{{ number_format($topitem->databarang->harga_barang) }}</div>
                                    </div>
                                    <div class="total">
                                        <div class="amount">Rp.{{ $topitem->databarang->harga_barang * $topitem->total_qty}}</div>
                                        <div class="count">Terjual {{ $topitem->total_qty }}</div>
                                    </div>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card h-100">
                        <div class="card-inner">
                            <div class="card-title-group mb-2">
                                <div class="card-title">
                                    <h6 class="title">Statistik Toko</h6>
                                </div>
                            </div>
                            <ul class="nk-store-statistics">
                                <li class="item">
                                    <div class="info">
                                        <div class="title">Transaksi</div>
                                        <div class="count">{{ count($transaksi_barang) }}</div>
                                    </div>
                                    <em class="icon bg-primary-dim ni ni-cart"></em>
                                </li>
                                <li class="item">
                                    <div class="info">
                                        <div class="title">Jumlah Pengguna</div>
                                        <div class="count">{{ $user }}</div>
                                    </div>
                                    <em class="icon bg-info-dim ni ni-users"></em>
                                </li>
                                <li class="item">
                                    <div class="info">
                                        <div class="title">Produk</div>
                                        <div class="count">{{ $databarang }}</div>
                                    </div>
                                    <em class="icon bg-pink-dim ni ni-box"></em>
                                </li>
                                <li class="item">
                                    <div class="info">
                                        <div class="title">Category</div>
                                        <div class="count">{{ $kategory }}</div>
                                    </div>
                                    <em class="icon bg-purple-dim ni ni-server"></em>
                                </li>
                            </ul>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-6">
                    <div class="card h-100">
                        <div class="card-inner">
                            <div class="card-title-group align-start gx-3 mb-3">
                                <div class="card-title">
                                    <h6 class="title">Pendapatan Bulanan</h6>
                                    <p>Penjualan Barang Pada Bulan {{ \Carbon\Carbon::now()->isoFormat('MMMM') }}.</p>
                                </div>
                            </div>
                            <div class="nk-sale-data-group align-center justify-between gy-3 gx-5">
                                <div class="nk-sale-data">
                                    <span class="amount" id="jumlahbulanan"></span>
                                </div>
                            </div>
                            <div class="nk-sales-ck large pt-4">
                                <canvas class="sales-overview-chart" id="salesOverview"></canvas>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-8">
                    <div class="card card-full">
                        <div class="card-inner container">
                            <div class="card-title-group">
                                <div class="card-title mb-4">
                                    <h4 class="title"><span class="me-2">Transaksi</span></h4>
                                </div>
                            </div>
                            <table class="datatable-init table table-tranx">
                                <thead>
                                    <tr class="tb-tnx-head">
                                        <th class="tb-tnx-id"><span class="">No</span></th> <th class="tb-tnx-id"><span class="">Kode Invoice</span></th>
                                        <th class="tb-tnx-info">
                                            <span class="tb-tnx-desc ">
                                                <span>Kasir Bertugas</span>
                                            </span>
                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                <span class="d-md-none">Date</span>
                                                <span class="d-none d-md-block">
                                                    <span>Tanggal Transaksi</span>
                                                    <span>Jam Transaksi</span>
                                                </span>
                                            </span>
                                        </th>
                                        <th class="tb-tnx-amount">
                                            <span class="tb-tnx-total">Uang Masuk</span>
                                            <span class="tb-tnx-status d-none d-md-inline-block text-end">Aksi</span>
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach($transaksi_barang as $transaksi)
                                        <tr class="tb-tnx-item">
                                            <td class="tb-tnx-id">
                                                <span>{{ $loop->iteration }}</span>
                                            </td><td class="tb-tnx-id">
                                                <span>{{ $transaksi->no_transaksi }}</span>
                                            </td>
                                            <td class="tb-tnx-info">
                                                <div class="tb-tnx-desc">
                                                    <span class="title">{{ $transaksi->user->nama_pengguna }}</span>
                                                </div>
                                                <div class="tb-tnx-date">
                                                    <span class="date">{{  \Carbon\Carbon::parse($transaksi->tgl_transaksi)->isoFormat('D MMMM Y')  }}</span>
                                                    <span class="date">{{  str_replace(":00", "", $transaksi->waktu_transaksi); }}</span>
                                                </div>
                                            </td>
                                            <td class="tb-tnx-amount">
                                                <div class="tb-tnx-total">
                                                    <span class="amount text-success">+Rp. {{ number_format($transaksi->total_pembayaran) }}</span>
                                                </div>
                                                <div class="tb-tnx-status">
                                                   <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="{{ route('cetak.struk',$transaksi->id_transaksi) }}"><em class="icon ni ni-file-text"></em><span>Cetak Struk</span></a></li>
                                                                    <li><a href="{{ route('Catatan-transaksi.show',$transaksi->id_transaksi) }}"><em class="icon ni ni-eye"></em><span>Tampilkan Transaksi</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-inner-sm border-top text-center d-sm-none">
                            <a href="#" class="btn btn-link btn-block">See History</a>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .nk-block -->
    </div>
</div>
</div>
</div>
<!-- content @e -->
<!-- footer @s -->
<div class="nk-footer">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            @include('admin.layout.component.footer')
        </div>
    </div>
</div>
<!-- footer @e -->
</div>
<!-- wrap @e -->
</div>
<!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<!-- FontAwesome Icons --> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/bundle.js?ver=3.1.1') }}"></script>
<script src="{{ asset('assets/js/datadashboard.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js?ver=3.1.1') }}"></script>

</body>
</html>
