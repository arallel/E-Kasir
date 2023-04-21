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
        <link rel="shortcut icon" href="assets/images/favicon.png">
        <!-- Page Title  -->
        <title></title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="{{ asset('./assets/css/dashlite.css?ver=3.1.1') }}" >
        <link id="skin-default" rel="stylesheet" href="{{ asset('./assets/css/theme.css?ver=3.1.1') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/print.css') }}" >
                <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/print.css') }}" media="print">

    </head>
    <body onload="printd()" class="nk-body bg-white npc-default pg-auth">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- wrap @s -->
                <div class="nk-wrap nk-wrap-nosidebar container mt-5">
                    <!-- content @s -->
                    <div class="row">
                        @for ($i = 0; $i < $jumlah ; $i++)
                        <div class="col-4 mt-3">
                            <div class="card border border-dark">
                                <div class="card-header border-bottom"><h2>{{ $data->nama_barang }}</h2></div>
                                <div class="card-inner">
                                    
                                    <div class="row">
                                        <div class="col">
                                            <h3>Rp.</h3>
                                        </div>
                                        <div class="col">
                                            <h2>{{ number_format($data->harga_barang, 0, ',', '.') }}</h2>
                                        </div>
                                    </div>
                                    <p>{{ date('d-m-Y') }}</p>
                                    {!! DNS1D::getBarcodeSVG($data->barcode, 'C128', 4, 50, true) !!}
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <!-- wrap @e -->
                </div>
                <!-- content @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->
        <script src="{{ asset('./assets/js/bundle.js?ver=3.1.1') }}"></script>
        <script src="{{ asset('./assets/js/scripts.js?ver=3.1.1') }}"></script>    
        {{-- <script>
            function printd() {
                var load = setInterval( () => {
                    window.print();
                    window.location.href = '../../databarang';
                }, 1000);                                        
            }
        </script> --}}
    </body>
    </html>