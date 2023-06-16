<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi_barang;
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
