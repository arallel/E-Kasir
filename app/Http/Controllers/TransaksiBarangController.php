<?php

namespace App\Http\Controllers;

use App\Models\databarang;
use App\Models\transaksi_barang;
use Illuminate\Http\Request;

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
        $datasementara = collect(session('databarang'))->groupBy('barcode');
        return view('admin.transaksi.indextransaksi',compact('databarang','datasementara'));
    }
    public function coba(Request $request)
    {
        $request->session()->forget('databarang');
         // return view('admin.transaksi.test');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storesesion(Request $request)
    {
        $data = databarang::where('barcode',$request->barcode)->first();
         $request->session()->push('databarang', $data);
    }
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi_barang  $transaksi_barang
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi_barang $transaksi_barang)
    {
        //
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
