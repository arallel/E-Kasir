<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\catatantransaksiresource;
use App\Models\transaksi_barang;
use App\Models\databarang;
use App\Models\detail_transaksi;
use Str;

class catatantransaksi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = transaksi_barang::with('user','detailtransaksi')->orderBy('id_barang','asc')->get();
        if($data){
            return response()->json(catatantransaksiresource::collection($data));
        }else{
            return response()->json(['message'=>'tidak Ada Data'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Invoice 
        $lastinv = transaksi_barang::orderBy('id_barang','asc')->count();
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
            'uang_dibayarkan' => $request->uang_dibayarkan,
            'id_user' => $request->id_user,
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
                'harga_item' => $data->harga_barang * $request->qty,
                'harga_asli' => $data->harga_barang,
        ]);
        //update stok barang
        $hitung = $data->stok - $request->qty;
        $data->update([
            'stok' => $hitung,
        ]);
        if($transaksi && $detail_transaksi){
            return response()->json(['message' => 'data berhasil disimpan'],200);
        }else{
            return response()->json(['message' => 'data gagal disimpan'],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = transaksi_barang::with('user','detailtransaksi','detailtransaksi.databarang')->find($id);
       if($data == null)
       {
        return response()->json(['message' => 'data tidak ada'],404);
       }
       return response()->json(new catatantransaksiresource($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = transaksi_barang::find($id);
         if($data == null){
           return response()->json(['message'=> 'Data Tidak Ada']);
         }
        $data->delete();
           return response()->json(['message'=> 'data berhasil dihapus']);
    }
}
