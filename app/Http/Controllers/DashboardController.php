<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi_barang;
use App\Models\databarang;
use App\Models\kategory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksi_barang = transaksi_barang::with('user','detailtransaksi')->get();
        $databarang = databarang::count();
        $kategory = kategory::count();
        $user = User::count();
        $transaksi_harian = transaksi_barang::where('tgl_transaksi',date('Y-m-d'))->get();
        return view('admin.dashboard',compact('transaksi_barang','databarang','kategory','user','transaksi_harian'));
    }
}
