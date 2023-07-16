<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LaporanTransaksi;
use App\Exports\databarangexport;
use App\Exports\Laporanmultiplesheet;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\detail_transaksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.laporan.indexlaporan');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LaporanHarian(Request $request)
    {
        $carbon = Carbon::now();
        if($request->tipe_laporan == 'laporanharian'){
         $date = Carbon::createFromDate($request->tanggal);
         return Excel::download(new LaporanTransaksi($date), 'Laporan Penjualan Harian Tanggal '.strtoupper($date->isoFormat('D MMMM Y')).'.xlsx');
        }else{
         $date = Carbon::createFromDate($request->tanggal);
         $tanggalawal = $date->startOfMonth(); 
         $namafile = 'Bulan '.$date->isoFormat('MMMM');
         return Excel::download(new Laporanmultiplesheet($tanggalawal), 'Laporan Penjualan '.$namafile.'.xlsx');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportdatabarang()
    {
        return Excel::download(new databarangexport(), 'Export Databarang.xlsx');
    }
}
