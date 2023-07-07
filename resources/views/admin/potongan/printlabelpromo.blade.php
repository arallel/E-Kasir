<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="{{ asset('./assets/css/dashlite.css?ver=3.1.1') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/print.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            @for ($i = 0; $i < $jumlah ; $i++)
            <div class="col-3 m-5 ">
               <div class="card border bg-warning" style="height:200px;width: 263px; page-break-inside: avoid;">
                <div class="card-header border-bottom bg-warning"><h5>{{ $data->databarang->nama_barang }} ({{ $data->databarang->stok }})</h5></div>
                <div class="card-inner">
                    <div class="row">
                        <div class="col">
                            <p class="fs-11px" style=" text-decoration: line-through;">{{ $data->databarang->harga_barang }}</p>
                            <p>Rp.</p>
                            <p class="fs-9px">{{ date('d-m-Y') }}</p>
                        </div>
                        <div class="col text-end">
                            <h3>{{ number_format($data->harga_setelah_potongan, 0, ',', '.') }}</h3>
                            <p></p>
                            <p class="fs-9px mt-2">{{ $data->databarang->id_barang }}</p>
                        </div>
                    </div>
                    <h5 class="mt-1 fw-bold">Promo Promo Promo</h5>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
<script>     
     
    </script>
</body>
</html>