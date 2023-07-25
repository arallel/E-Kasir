<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi_barang;
use App\Models\databarang;
use App\Models\kategory;
use App\Models\detail_transaksi;
use App\Models\User;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksi_barang = transaksi_barang::with('user','detailtransaksi')->orderBy('no_transaksi')->get();
        $databarang = databarang::count();
        $kategory = kategory::count();
        $user = User::count();
        $transaksi_harian = transaksi_barang::where('tgl_transaksi',date('Y-m-d'))->get();
         $total_bulanan = transaksi_barang::whereBetween('tgl_transaksi', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('total_pembayaran');

        $total_mingguan = transaksi_barang::whereBetween('tgl_transaksi', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total_pembayaran');
       $top5item = detail_transaksi::with('databarang')
                   ->select('id_barang',DB::raw('SUM(qty) as total_qty'),DB::raw('SUM(harga_item) as total'))
                   ->groupBy('id_barang')
                   ->orderByDesc('total_qty')
                   ->limit(5)
                   ->get();
        return view('admin.dashboard',compact('transaksi_barang','databarang','kategory','user','transaksi_harian','total_bulanan','total_mingguan','top5item'));
    }
}
