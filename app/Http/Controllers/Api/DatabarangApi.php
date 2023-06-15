<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\databarang;
use App\Http\Resources\DatabarangResource;
use App\Http\Resources\databarangcollectionresource;
use Illuminate\Support\Str;


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
 public function filtersearch(Request $request){
        $search = $request->search;
        $status = $request->status_barang;
        $id_category = $request->id_kategory;
        // dd($search);

        $query = databarang::with('kategory');
        $emptyQueries = true; // Flag to check if all queries are empty

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
            $results = $query->get();
        }
        return response()->json(DatabarangResource::collection($results));
    }
}
