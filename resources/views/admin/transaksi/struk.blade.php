<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 300px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" style="margin-bottom: 30px;">
            <h2>Kasir COMP</h2>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No Order</li>
                    <li>Kasir</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li>{{ $data->no_transaksi }}</li>
                    <li>{{ $data->user->nama_pengguna }}</li>
                    <li>{{ \Carbon\Carbon::parse($data->tgl_transaksi)->isoFormat('D MMMM Y') }}</li>

                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Product</div>
            <div>Qty / Harga</div>
            <div>Total</div>
        </div>
        @foreach ($data->detailtransaksi as $item)
        <div class="flex-container" style="text-align: right;">
            <div style="text-align: left;">
                {{ ($item->databarang != null)?Str::limit($item->databarang->nama_barang,12):'Barang Di hapus Oleh Kasir' }}
            </div>
            <div>{{ $item->qty }} <span></span>Rp 
                {{ number_format($item->databarang->harga_barang) }} 
                {{ ($item->checkpotongan && $item->checkpotongan->harga_potongan_persen && $data->pembelian == 'offline')?"Diskon:":'' }}
                {{ ($item->checkpotongan && $item->checkpotongan->harga_potongan_rp && $data->pembelian == 'offline')?"Potongan:":'' }}
            </div>
            <div>Rp {{ number_format($item->databarang->harga_barang * $item->qty ) }}   
                {{ ($item->checkpotongan &&  $item->checkpotongan->harga_potongan_rp && $data->pembelian == 'offline' )?'(Rp.'.number_format($item->checkpotongan->harga_potongan_rp * $item->qty).')':'' }} 
                {{ ($item->checkpotongan && $item->checkpotongan->harga_potongan_persen && $data->pembelian == 'offline')?$item->checkpotongan->harga_potongan_persen.'%':'' }}
            </div>
        </div>
        @if($item->checkpotongan)     
            @php
             $sumharga_setelah_potongan = 0; 
             $harga_awal = 0; 
               $harga_awal += $item->checkpotongan->harga_awal;
               $sumharga_setelah_potongan += $item->checkpotongan->harga_setelah_potongan;
            @endphp 
            @endif
        @endforeach
        <hr>
        
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div></div>
            <div>
                <ul>
                    <li>Total:</li>
                    <li>Tunai:</li>
                    <li>Kembalian:</li>
                     @if($harga_awal > 0 && $data->pembelian == 'offline')
                    <li>hemat:</li>
                    @endif
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>Rp {{ number_format($data->total_pembayaran) }}</li>
                    <li>Rp {{ number_format($data->uang_dibayarkan) }}</li>
                    <li>Rp {{ number_format($data->total_kembalian) }}</li>
                    @if($harga_awal > 0 && $data->pembelian == 'offline')
                    <li>Rp {{ number_format($harga_awal - $sumharga_setelah_potongan) }}</li>
                    @endif
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 40px;">
            <p>Terima Kasih,Selamat Belanja Kembali</p>
        </div>
    </div>
     {{-- <script>     
        const url = document.referrer;
        const baseUrl = new URL(url).origin +'/';
        const modifiedUrl = url.replace(baseUrl, "");
         sessionStorage.clear("shoppingCart");
        function printPage() {
        window.print();
         window.location.href = "../../" + modifiedUrl;
       }
       setTimeout(()=>{
       printPage();
       },2000);
   </script> --}}
</body>
</html>
