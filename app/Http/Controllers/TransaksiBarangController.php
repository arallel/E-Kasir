<?php
namespace App\Http\Controllers;

    use App\Models\databarang;
    use App\Models\transaksi_barang;
    use App\Models\detail_transaksi;
    use Illuminate\Http\Request;
    use Carbon\Carbon;
    use Auth;
    use Illuminate\Support\Str;
    use DB;


    class TransaksiBarangController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $databarang = databarang::with('kategory')->get();
            $datasementara = session('databarang');
            return view('admin.transaksi.indextransaksi',compact('databarang','datasementara'));
        }
        public function coba(Request $request)
        {
            // $request->session()->forget('databarang');
            // dd(session('databarang'));
           return view('admin.transaksi.test');
        }
        public function removeFromCart(Request $request)
        {
            $id_barang = $request->input('id_barang');
            $cart = session()->get('databarang');
            unset($cart[$id_barang]);
            session()->put('databarang', $cart);
        }

        public function getdatasession()
        {
         $sessionData = session('databarang');
         return response()->json($sessionData);
     }

     public function updatecart(Request $request)
     {
        $id_barang = $request->input('id_barang');
        $newQty = $request->input('qty');
        $databarang = databarang::find($id_barang);
        if ($databarang) {
            $cart = session()->get('databarang');

            if ($cart && isset($cart[$id_barang])) {
                $cart[$id_barang]['qty'] = $newQty;
                session()->put('databarang', $cart);
                return response()->json(['success' => true, 'databarang' => $cart]);
            } else {
                $cart[$id_barang] = [
                    'id_barang' => $databarang->id_barang,
                    'nama_barang' => $databarang->nama_barang,
                    'harga_barang' => $databarang->harga_barang,
                    'foto_barang' => $databarang->foto_barang,
                    'qty' => $newQty
                ];
                session()->put('databarang', $cart);
                return response()->json(['success' => true, 'databarang' => $cart]);
            }
        }
    }
    public function storesesion(Request $request)
    {
        $databarang = databarang::where('barcode',$request->barcode)->first();
        $cart = session()->get('databarang', []);
        if (isset($cart[$databarang->id_barang])) {
            $cart[$databarang->id_barang]['qty'] += $request->input('qty', 1);
        } else {
            $cart[$databarang->id_barang] = [
                'id_barang' => $databarang->id_barang,
                'nama_barang' => $databarang->nama_barang,
                'harga_barang' => $databarang->harga_barang,
                'foto_barang' => $databarang->foto_barang,
                'qty' => $request->input('qty', 1)
            ];
        }
        session()->put('databarang', $cart);

    }
    public function store(Request $request)
    {
            // Invoice 
        $lastinv = transaksi_barang::orderBy('id_transaksi','asc')->count();
        $prefix = 'INV-';
        $lastInvoiceNumber = $lastinv + 1; 
        $invoice = $prefix . sprintf('%06d', $lastInvoiceNumber); 

            //hitung barang
        $total_barang = 0;
        foreach(session('databarang') as $databarang)
        {
            $hitung = $databarang['harga_barang'] * $databarang['qty'];
            $total_barang += $hitung;
        }
        $kembalian = $request->jumlah_uang - $total_barang;

        // //make transaksi
        $data = transaksi_barang::create([
            'id_transaksi' => Str::uuid()->toString(),
            'no_transaksi' => $invoice,
            'tgl_transaksi' => Carbon::now()->format('Y-m-d') ,
            'waktu_transaksi'=> Carbon::now()->format('H:i'), 
            'total_pembayaran' => $total_barang,
            'id_user' => Auth::user()->id_user,
            'total_kembalian' => $kembalian,
        ]);
            //make detail transaksi
        foreach(session('databarang') as $itemstore){
            $storeitem = detail_transaksi::create([
                'id_detail_transaksi' => Str::uuid()->toString(),
                'id_barang' => $itemstore['id_barang'],
                'id_transaksi' => $data->id_transaksi,
                 // 'id_transaksi' => 'e8993a6b-329f-45d9-b333-54227f8f4daf',
                'qty' => $itemstore['qty'],
                'harga_item' => $itemstore['harga_barang'],
            ]);     
            $updatestokbarang = databarang::where('id_barang',$itemstore['id_barang'])
                                      ->first();
              $hitung = $updatestokbarang->stok - $itemstore['qty'];
            $updatestokbarang->update([
                'stok' => $hitung,
            ]);
        }
        if($data && $itemstore){
            $request->session()->forget('databarang');
            return redirect()->route('cetak.struk',$data->id_transaksi);
        }else{
            return redirect()->back();
        }
    }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\transaksi_barang  $transaksi_barang
         * @return \Illuminate\Http\Response
         */
        public function cetakstruk($id)
        {
            $data = transaksi_barang::with('detailtransaksi','detailtransaksi.databarang')->findOrfail($id);
            return view('admin.transaksi.struk',compact('data'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\transaksi_barang  $transaksi_barang
         * @return \Illuminate\Http\Response
         */
        public function edit(transaksi_barang $transaksi_barang)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\transaksi_barang  $transaksi_barang
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, transaksi_barang $transaksi_barang)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\transaksi_barang  $transaksi_barang
         * @return \Illuminate\Http\Response
         */
        public function destroy(transaksi_barang $transaksi_barang)
        {
            //
        }
    }
