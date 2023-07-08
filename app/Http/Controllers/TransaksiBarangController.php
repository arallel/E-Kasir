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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\databarangcollectionresource;


class TransaksiBarangController extends Controller
    {
        public function index()
        {
          $databarang = databarang::with('kategory','checkpotongan')->get();
          return view('admin.transaksi.indextransaksi',compact('databarang'));
        }
        public function store(Request $request)
        {
            $data = request()->all();
            $datacarts = json_decode($data['datastorageweb']);
            // Invoice 
            $lastinv = transaksi_barang::orderBy('id_transaksi','asc')->count();
            $prefix = 'INV-';
            $lastInvoiceNumber = $lastinv + 1; 
            $invoice = $prefix . sprintf('%06d', $lastInvoiceNumber);
            //transaksi
            $transaksi = transaksi_barang::create([
                'id_transaksi' => Str::uuid()->toString(),
                'no_transaksi' => $invoice,
                'tgl_transaksi' => Carbon::now()->format('Y-m-d') ,
                'waktu_transaksi'=> Carbon::now()->format('H:i'), 
                'total_pembayaran' => $data['total_harga'],
                'uang_dibayarkan' => $data['uang_dibayarkan'],
                'id_user' => Auth::user()->id_user,
                'total_kembalian' => ($data['kembalian'] != null)?$data['kembalian']:0,
                'pembelian' => 'offline',
            ]); 

            foreach ($datacarts as $datacart) {
                //detail transaksi
                $detail_transaksi = detail_transaksi::create([
                    'id_detail_transaksi' => Str::uuid()->toString(),
                    'id_barang' => $datacart->id,
                    'id_transaksi' => $transaksi['id_transaksi'],
                    'qty' => $datacart->count,
                    'harga_item' => $datacart->price,
                ]);

                // //update stok barang
                $updatestokbarang = databarang::where('id_barang',$datacart->id)->first();
                    $hitung = $updatestokbarang->stok - $datacart->count;
                    $updatestokbarang->update([
                        'stok' => $hitung,
                    ]);
            }           
            if($transaksi && $detail_transaksi){
                return redirect()->route('cetak.struk',$transaksi->id_transaksi);
            }else{
                return redirect()->back();
            }
        }
            public function cetakstruk($id)
            {
                $data = transaksi_barang::with('detailtransaksi','user','detailtransaksi.databarang')->findOrfail($id);
                if($data == null){abort(404);}
                return view('admin.transaksi.struk',compact('data'));
            }
        }
