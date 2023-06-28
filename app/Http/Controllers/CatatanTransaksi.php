<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi_barang;
use App\Models\databarang;
use App\Models\detail_transaksi;
use Str;
use Auth;

class CatatanTransaksi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = transaksi_barang::with('user','detailtransaksi')->get();
        return view('admin.catatantransaksi.index',compact('datas'));
    }
    public function create(){
        $searchbarang = null;
        $show_modal = false;
        return view('admin.catatantransaksi.createcatatan',compact('searchbarang','show_modal'));
    }
    public function store(Request $request){
        $validate = $request->validate([
            'tgl_transaksi' => 'required|date',
            'waktu_transaksi' => 'required',
            'total_pembayaran' => 'required|integer',
            'no_pesanan' => 'required|string',
            'no_resi' => 'required|string',
            'pembelian' => 'required',
            'id_barang' => 'required',
            'qty' => 'required|integer'
        ]);
        // Invoice 
        $lastinv = transaksi_barang::orderBy('id_transaksi','asc')->count();
        $prefix = 'INV-';
        $lastInvoiceNumber = $lastinv + 1; 
        $invoice = $prefix . sprintf('%06d', $lastInvoiceNumber);
        //transaksi
        $transaksi = transaksi_barang::create([
            'id_transaksi' => Str::uuid()->toString(),
            'no_transaksi' => $invoice,
            'tgl_transaksi' => $request->tgl_transaksi,
            'waktu_transaksi'=> $request->waktu_transaksi, 
            'total_pembayaran' => $request->total_pembayaran,
            'id_user' => Auth::user()->id_user,
            'no_pesanan' => $request->no_pesanan,
            'no_resi' => $request->no_resi,
            'pembelian' => $request->pembelian,
        ]); 
        $data = databarang::where('id_barang',$request->id_barang)->first();
        $detail_transaksi = detail_transaksi::create([
            'id_detail_transaksi' => Str::uuid()->toString(),
                'id_barang' => $request->id_barang,
                'id_transaksi' => $transaksi->id_transaksi,
                'qty' => $request->qty,
                'harga_item' => $data->harga_barang,
        ]);
        //update stok barang
        $hitung = $data->stok - $request->qty;
        $data->update([
            'stok' => $hitung,
        ]);

        if($transaksi && $detail_transaksi){
            return redirect()->route('Catatan-transaksi.index');
        }else{
            return redirect()->back();
        }
    }
    public function show($id)
    {
       $data = transaksi_barang::with('user','detailtransaksi','detailtransaksi.databarang')->find($id);
       if($data == null)
       {
        abort(404);
       }
        return view('admin.catatantransaksi.show',compact('data'));
    }
}
