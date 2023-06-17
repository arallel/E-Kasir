<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\databarang;
use App\Models\transaksi_barang;
use App\Http\Resources\DatabarangResource;
use App\Http\Resources\databarangcollectionresource;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class DatabarangApi extends Controller
{ 
    public function getitembybarcode(Request $request){
        $barcode = $request->barcode;
        $databarang = Databarang::with('checkpotongan','kategory')->where('barcode',$request->barcode)->first();
        // return response()->json(['data' => $databarang]);
        return response()->json(new databarangcollectionresource($databarang));
    }
    public function getitembyname(Request $request){
        $nama_barang = $request->nama_barang;
        $databarang = Databarang::with('checkpotongan','kategory')->where('nama_barang',$nama_barang)->first();
        return response()->json(new databarangcollectionresource($databarang));
    }
    public function index()
    {
      $databarang = Databarang::with('kategory')->get();
       if(count($databarang) == 0){
        return response()->json(['message' => 'Tidak Ada Data'],401);
       }else{
        return response()->json(DatabarangResource::collection($databarang));
       }
  }
  public function show($databarang)
  {
    $databarang = databarang::with('kategory')->findOrFail($databarang);
    return new DatabarangResource($databarang);
}
public function store(Request $request)
{
    if ($request->foto_barang == null) {
        $data = databarang::create([
            'id_barang' => Str::uuid()->toString(),
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,
            'status_barang' => $request->status_barang,
            'barcode' => $request->barcode,
            'harga_barang' => $request->harga_barang,
            'harga_pembelian' => $request->harga_pembelian,
        ]);
    } else {
       $data = databarang::create([
        'id_barang' => Str::uuid()->toString(),
        'nama_barang' => $request->nama_barang,
        'foto_barang' => $request->file('foto_barang')->store('images'),
        'stok' => $request->stok,
        'id_kategory' => $request->id_kategory,
        'status_barang' => $request->status_barang,
        'barcode' => $request->barcode,
        'harga_barang' => $request->harga_barang,
        'harga_pembelian' => $request->harga_pembelian,
    ]);
   }
   if ($data) {
    return response()->json(['message' => 'Berhasil Menambahkan Barang'], 200);
 } else {
    return response()->json(['message' => 'Gagal Menambahkan Barang'], 401);
}

}
public function update(Request $request, $databarang)
{
    if ($request->foto_barang == null) {
        $data = databarang::findOrFail($databarang);
        $data->update([
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,
            'status_barang' => $request->status_barang,
            'barcode' => $request->barcode,
            'harga_barang' => $request->harga_barang,
            'harga_pembelian' => $request->harga_pembelian,
        ]);
    } else {
       $data = databarang::findOrFail($databarang);
       Storage::delete($data->foto_barang);
       $data->update([
        'nama_barang' => $request->nama_barang,
        'foto_barang' => $request->file('foto_barang')->store('images'),
        'stok' => $request->stok,
        'id_kategory' => $request->id_kategory,
        'status_barang' => $request->status_barang,
        'barcode' => $request->barcode,
        'harga_barang' => $request->harga_barang,
        'harga_pembelian' => $request->harga_pembelian,
    ]);
   }
   if ($data) {
    return response()->json(['message' => 'Berhasil Merubah Data Barang'], 200);
 } else {
    return response()->json(['message' => 'Gagal Update Data Barang'], 401);
}
}
public function destroy($databarang)
{
    $data = databarang::findOrFail($databarang);
    if ($data->foto_barang != null) {
        Storage::delete($data->foto_barang);
        $data->delete();
    }else{
        $data->delete();
    }
    if ($data) {
        return response()->json(['message' => 'Barang Berhasil Dihapus'], 200);
    } else {
        return response()->json(['message' => 'Gagal Hapus Data Barang'], 401);
    }
 }
  public function urutkan(Request $request)
  {
    if($request->urutkan == 'asc'){
       $data = databarang::with('kategory')->orderBy('nama_barang','asc')->get();
    }
    if($request->urutkan == 'desc'){
        $data = databarang::with('kategory')->orderBy('nama_barang','desc')->get();
    }

    if($data){
        return response()->json(DatabarangResource::collection($data));
    }else{
        return response()->json(['message' => 'Tidak Ada Data'],401);
    }
  }
  public function filtersearch(Request $request)
{
    $search = $request->search;
    $status = $request->status_barang;
    $id_category = $request->id_kategory;
    $urutkan = $request->urutkan;

    $query = databarang::with('kategory');

    $emptyQueries = true; // Flag to check if all queries are empty

    $orderBy = '';
    switch ($urutkan) {
        case 'asc':
            $orderBy = 'asc';
            break;
        case 'desc':
            $orderBy = 'desc';
            break;
        default:
            $orderBy = 'asc';
            break;
    }

    if (!empty($search)) {
        $query->where('nama_barang', 'like', '%' . $search . '%');
        $emptyQueries = false;
    }

    if (!empty($status)) {
        $query->where('status_barang', $status);
        $emptyQueries = false;
    }

    if (!empty($id_category)) {
        $query->where('id_kategory', $id_category);
        $emptyQueries = false;
    }

    if ($emptyQueries) {
        $results = [];
    } else {
        $results = $query->orderBy('nama_barang',$orderBy)->get();
    }
    return response()->json([
        DatabarangResource::collection($results),
    ]);
}
public function chartpenjualan()
    {
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $salesData = transaksi_barang::whereBetween('tgl_transaksi', [$startDate, $endDate])
            ->groupBy('tgl_transaksi')
            ->orderBy('tgl_transaksi')
            ->get([
                DB::raw('DATE(tgl_transaksi) as date'),
                DB::raw('SUM(total_pembayaran) as total')
            ]);

        $monthlyTotal = transaksi_barang::whereBetween('tgl_transaksi', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('total_pembayaran');

        $weeklyTotal = transaksi_barang::whereBetween('tgl_transaksi', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total_pembayaran');

        return response()->json([
            'data' => $salesData,
            'total_bulanan' => $monthlyTotal,
            'total_mingguan' => $weeklyTotal
        ]);
    }
}
