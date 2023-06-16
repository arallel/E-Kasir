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
 public function filterstatus(Request $request)
{

    if ($request->status == 'aktif') {
        $databarang = databarang::with('kategory')
                    ->where('status_barang','aktif')
                    ->get();
                    // dd($databarang);
    } 
    if($request->status == 'tidak_aktif') {
        $databarang = databarang::with('kategory')
               ->where('status_barang','tidak_aktif')
               ->get();
    }

    if($request->status == 'stok_kosong'){
        $databarang = databarang::with('kategory')
               ->where('stok','0')
               ->get();
    }
    if($request->status == 'semua'){
        $databarang = databarang::with('kategory')->get();    
    }
    if(is_array($databarang) && empty($databarang) || count($databarang) == 0){
        return response()->json(['message'=> 'Tidak Ada Data'],401);
    }else{
        return response()->json(DatabarangResource::collection($databarang));
    }
  }
  public function search(Request $request)
  {
    $databarang = databarang::with('kategory')
    ->where('nama_barang','like','%'.$request->search.'%')
    ->Orwhere('stok',$request->search)
    ->get();
      if($request->search === null){
        return response()->json(['message' => 'Tidak Ada Data'],401);
    }else{
     return response()->json(DatabarangResource::collection($databarang));
    }
  }
  public function filterkategory(Request $request)
  {
    $databarang = databarang::with('kategory')
    ->where('id_kategory', $request->filter)
    ->get();
    if(count($databarang) == 0){
        return response()->json(['message' => 'Tidak Ada Data'],401);
    }else{
     return response()->json(DatabarangResource::collection($databarang));
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
}
