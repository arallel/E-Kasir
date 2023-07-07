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
             <div class="card border " style="width: 263px; page-break-inside: avoid;">
                <div class="card-header border-bottom bg-warning"><h5>{{ $data->nama_barang }} ({{ $data->stok }})</h5></div>
                <div class="card-inner">
                    <div class="row">
                        <div class="col">
                            <p></p>
                            <p>Rp.</p>
                            <p class="fs-9px">{{ date('d-m-Y') }}</p>
                        </div>
                        <div class="col text-end">
                            <h3>{{ number_format($data->harga_barang, 0, ',', '.') }}</h3>
                            <p class="fs-14px mt-2">{{ $data->id_barang }}</p>
                        </div>
                    </div>
                    <div class="justify-content-center ms-5 mt-2 ">  
                   {!! DNS1D::getBarcodeSVG($data->barcode, 'C128', 1, 50, true) !!}
               </div> 
                     </div>
       </div>
   </div>
   @endfor
</div>
</div>
<script>     
        const url = document.referrer;
        const baseUrl = new URL(url).origin +'/';
        const modifiedUrl = url.replace(baseUrl, "");
        console.log(modifiedUrl);
        function printPage() {
        window.print();
         window.location.href = "../../" + modifiedUrl;
       }
       setTimeout(()=>{
       printPage();
       },2000);
   </script>
</body>
</html>