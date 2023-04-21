<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('./assets/css/dashlite.css?ver=3.1.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('./assets/css/theme.css?ver=3.1.1') }}">
</head>

<body class="bg-white" onload="printPromot()">
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('assets/images/logo-dark.png')}}" alt="">
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Invoice To</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">Gregory Anderson</h4>
                            <ul class="list-plain">
                                <li><em class="icon ni ni-map-pin-fill fs-18px"></em><span>House #65, 4328 Marion Street<br>Newbury, VT 05051</span></li>
                                <li><em class="icon ni ni-call-fill fs-14px"></em><span>+012 8764 556</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="invoice-desc">
                        <h3 class="title">Invoice</h3>
                        <ul class="list-plain">
                            <li class="invoice-id"><span>Invoice ID</span>:<span>{{ $data->no_transaksi }}</span></li>
                            <li class="invoice-date"><span>Date</span>:<span>{{ date('d M, Y', strtotime($data->tgl_transaksi)) }}</span></li>
                            <li class="invoice-time"><span>Time</span>:<span>{{ $data->waktu_transaksi }}</span></li>
                            <li class="invoice-admin"><span>Kasir</span>:<span>Vito</span></li>
                        </ul>
                    </div>
                </div><!-- .invoice-head -->
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="w-150px">No</th>
                                    <th class="w-60">Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data->detailtransaksi as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->databarang->nama_barang }}</td>
                                    <td>Rp.{{ number_format($d->databarang->harga_barang, 2, ',', '.') }}</td>
                                    <td>{{ $d->qty }}</td>
                                    <td>Rp.{{ number_format($d->harga_item, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Subtotal</td>
                                    <td>Rp.{{ number_format($data->total_pembayaran, 2, ',', '.') }}</td>
                                </tr>
                                                           {{--  <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="2">Processing fee</td>
                                                                <td>$10.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="2">TAX</td>
                                                                <td>$43.50</td>
                                                            </tr> --}}
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="2">Total</td>
                                                                <td>Rp.{{ number_format($data->total_pembayaran, 2, ',', '.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="2">Kembalian</td>
                                                                <td>Rp.{{ number_format($data->total_kembalian, 2, ',', '.') }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <div class="nk-notes ff-italic fs-12px text-soft"> Invoice was created on a computer and is valid without the signature and seal. </div>
                                                </div>
                                            </div><!-- .invoice-bills -->
                                        </div><!-- .invoice-wrap -->
                                    </div><!-- .invoice -->
                                </div><!-- .nk-block -->
                                <script>
                                    function printPromot() {
                                        var load = setInterval( () => {
                                            window.print();
                                            window.location.href = '../../Transaksi';
                                        }, 1000);                                        
                                    }
                                </script>
                            </body>
                            </html>